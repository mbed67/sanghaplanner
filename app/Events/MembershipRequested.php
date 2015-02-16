<?php namespace App\Events;

use App\Events\Event;
use Sanghaplanner\Users\User;
use Sanghaplanner\Sanghas\Sangha;
use Illuminate\Queue\SerializesModels;

class MembershipRequested extends Event
{

    use SerializesModels;

    /**
     * @var Sangha $sangha
     */
    public $sangha;

    /**
     * @var User $user
     */
    public $user;

    /**
     * @param Sangha $sangha
     * @param User $user
     */
    public function __construct(Sangha $sangha, User $user)
    {
        $this->sangha = $sangha;
        $this->user = $user;
    }
}
