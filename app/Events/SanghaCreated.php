<?php namespace App\Events;

use App\Events\Event;
use Sanghaplanner\Sanghas\Sangha;
use Illuminate\Queue\SerializesModels;

class SanghaCreated extends Event
{

    use SerializesModels;

    /**
     * @var Sangha $sangha
     */
    public $sangha;

    /**
     * @param Sangha $sangha
     */
    public function __construct(Sangha $sangha)
    {
        $this->sangha = $sangha;
    }
}
