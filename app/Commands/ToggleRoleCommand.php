<?php namespace App\Commands;

use App\Commands\Command;
use Sanghaplanner\Users\UserRepositoryInterface;
use Laracasts\Flash\Flash;
use Illuminate\Contracts\Bus\SelfHandling;

class ToggleRoleCommand extends Command implements SelfHandling
{

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var int
     */
    protected $sanghaId;

    /**
     * @param int $user_id
     * @param int $sangha_id
     */
    public function __construct($userId, $sanghaId)
    {
        $this->userId = $userId;
        $this->sanghaId = $sanghaId;
    }


    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle(UserRepositoryInterface $repo)
    {
        $repo->toggleRole($this->userId, $this->sanghaId);
    }
}
