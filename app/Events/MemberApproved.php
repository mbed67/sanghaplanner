<?php namespace App\Events;

use App\Events\Event;
use Sanghaplanner\Users\User;
use Sanghaplanner\Sanghas\Sangha;
use Illuminate\Queue\SerializesModels;

class MemberApproved extends Event
{

    use SerializesModels;

    /**
     * @var User $user
     */
    public $user;

    /**
     * @var Sangha $sangha
     */
    public $sangha;

    /**
     * @param User $user
     * @param Sangha $sangha
     */
    public function __construct($user, $sangha)
    {
        $this->user = $user;
        $this->sangha = $sangha;
    }
}
