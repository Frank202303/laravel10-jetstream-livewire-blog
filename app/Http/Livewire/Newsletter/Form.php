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
        // Call action: EmailSubscriberAction
        // Call __invoke // Call __invoke // Call __invoke
        // Check if there is a subscription for this email, if not, add it to the database
        (new EmailSubscriberAction)([
            'name' => $this->name,
            'email' => $this->email,
            'token' =>  $token,
        ]);


        // If not subscribed, set it as subscription in mailchimp
        // User information will be saved on mailchimp server
        if (!Newsletter::isSubscribed($this->email)) {
            // https://us21.admin.mailchimp.com/lists/settings/merge-tags?id=318564  has NAME
            Newsletter::subscribe($this->email, [
                'NAME'  => $this->name,
                'TOKEN' => $token,
            ]);
        }
        // Send mail
        // SubscriberMailable: a self-created mail class
        Mail::to($this->email)
            ->send(new SubscriberMailable($formData));
        // (Emails are captured and viewed at Mailtrap.io)
        // https://mailtrap.io/inboxes/2426507/messages/3739975196


        session()->flash('success', 'You are subscribed!');

        // clear form
        $this->reset();
    }
}

/// mailtrap: used to test the email sending function: can it be sent? What was sent [capture all emails]
/// spatie/laravel-newsletter is an email subscription service package based on the Laravel framework, which provides a series of convenient functions to handle email subscription and unsubscription, send emails and manage email lists, etc.
