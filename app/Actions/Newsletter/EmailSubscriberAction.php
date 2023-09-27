<?php

namespace App\Actions\Newsletter;

use App\Models\Subscriber;

class EmailSubscriberAction
{
    public function __invoke(array $formData)
    {
        $this->getOrCreateSubsciberEmail($formData);
    }

    private function getOrCreateSubsciberEmail(array $formData): Subscriber
    {
        return Subscriber::firstOrCreate($formData);
    }
}
