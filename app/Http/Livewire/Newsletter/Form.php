<?php

namespace App\Http\Livewire\Newsletter;

use App\Actions\Newsletter\EmailSubscriberAction;
use App\Mail\SubscriberMailable;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Spatie\Newsletter\Facades\Newsletter;

class Form extends Component
{
    public  string $name = '';
    public string $email = '';

    protected $rules = [
        'name'       => ['required'],
        'email'      => ['required', 'email', 'unique:subscribers'],
    ];
    public function render()
    {
        return view('livewire.newsletter.form');
    }
    public function formSubmit()
    {
        // dd('WORKING');

        $this->validate();

        $token = bcrypt($this->email);

        $formData = array(
            'name' => $this->name,
            'email' => $this->email,
        );
        //    调用 action： EmailSubscriberAction
        // 调用 __invoke    // 调用 __invoke    // 调用 __invoke
        // 查询是否有这个email的订阅，如果没有则在数据库 添加
        (new EmailSubscriberAction)([
            'name' => $this->name,
            'email' => $this->email,
            'token' =>  $token,
        ]);


        // 如果没有订阅，则在 mailchimp 设置为订阅
        // 用户信息，会保存在 mailchimp server上
        if (!Newsletter::isSubscribed($this->email)) {
            // https://us21.admin.mailchimp.com/lists/settings/merge-tags?id=318564  has NAME
            Newsletter::subscribe($this->email, [
                'NAME'  => $this->name,
                'TOKEN' => $token,
            ]);
        }
        // 发送 邮件
        // SubscriberMailable：一个自己创建的 邮件类
        Mail::to($this->email)
            ->send(new SubscriberMailable($formData));
        //（邮件被在Mailtrap.io捕获和查看 ）
        // https://mailtrap.io/inboxes/2426507/messages/3739975196


        session()->flash('success', 'You are subscribed!');

        // clear form
        $this->reset();
    }
}

///  mailtrap： 用来测试发邮件功能：是否能发出去？ 发了什么  【捕获所有邮件】
 /// spatie/laravel-newsletter是一个基于Laravel框架的电子邮件订阅服务包，它提供了一系列方便的功能来处理电子邮件订阅和取消订阅、发送电子邮件和管理电子邮件列表等
