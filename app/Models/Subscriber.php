<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;
    /// use token to unSubscriber
    protected $fillable = [
        'name',
        'email',
        'token',
    ];

    /// get method: in MODEL
    /// get method
    /// get method
    // so in blade: we can use {{ $post->title() }}
    // so in blade: we can use {{ $post->title() }}
    // so in blade: we can use {{ $post->title() }}
    public function name(): string
    {
        return $this->name;
    }
    public function email(): string
    {
        return $this->email;
    }
    public function token(): string
    {
        return $this->token;
    }
}
