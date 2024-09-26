<?php

namespace App\Actions\Newsletter;

use App\Models\Subscriber;

class EmailSubscriberAction
{
    // __invoke is a special method in PHP, also known as a magic method. It allows object instances to be called like functions.
    // Define __invoke
    public function __invoke(array $formData)
    {
        $this->getOrCreateSubsciberEmail($formData);
    }

    private function getOrCreateSubsciberEmail(array $formData): Subscriber
    {
        // firstOrCreate is a method provided by the Laravel Eloquent model,
        // used to find records that meet the specified conditions, return the record if found, and create a new record and return it if not found.
        return Subscriber::firstOrCreate($formData);
    }


    // __invoke     // __invoke     // __invoke
    //     class ExampleClass {
    //         public function __invoke($param) {
    //             echo 'Called with parameter: ' . $param;
    //         }
    //     }
    //     $instance = new ExampleClass();
    // $instance('Hello'); // Output: Called with parameter: Hello
    /// In this way, the instance $instance is called like a function and 'Hello' is passed as a parameter to the __invoke method.
}
