<?php namespace App\Events;

use App\Events\Event;
use Sanghaplanner\Users\User;

use Illuminate\Queue\SerializesModels;

class UserRegistered extends Event
{

    use SerializesModels;

    /**
     * @var User $user
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
