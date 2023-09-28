<?php

namespace App\Actions\Newsletter;

use App\Models\Subscriber;

class EmailSubscriberAction
{
    // __invoke 是 PHP 中的一个特殊方法，也被称为魔术方法（magic method）。它允许对象实例像函数一样被调用。
    // 定义 __invoke
    public function __invoke(array $formData)
    {
        $this->getOrCreateSubsciberEmail($formData);
    }

    private function getOrCreateSubsciberEmail(array $formData): Subscriber
    {
        // firstOrCreate 是 Laravel Eloquent 模型提供的方法，
        // 用于查找符合指定条件的记录，如果找到则返回该记录，如果未找到则创建新记录并返回。
        return Subscriber::firstOrCreate($formData);
    }


    // __invoke     // __invoke     // __invoke
    //     class ExampleClass {
    //         public function __invoke($param) {
    //             echo 'Called with parameter: ' . $param;
    //         }
    //     }
    //     $instance = new ExampleClass();
    // $instance('Hello');  // 输出: Called with parameter: Hello
    /// 这样，实例 $instance 就像一个函数一样被调用，并将 'Hello' 作为参数传递给 __invoke 方法。
}
