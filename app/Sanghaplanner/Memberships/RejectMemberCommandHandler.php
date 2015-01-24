<?php namespace Sanghaplanner\Memberships;

use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
use Sanghaplanner\Users\UserRepositoryInterface;
use Sanghaplanner\Memberships\Events\MemberRejected;
use Sanghaplanner\Notifications\MarkNotificationsReadCommand;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Laracasts\Commander\CommanderTrait;
use Laracasts\Flash\Flash;

class RejectMemberCommandHandler implements CommandHandler {

	use DispatchableTrait, CommanderTrait;

	/**
	 * @var SanghaRepositoryInterface
	 */
	protected $sanghaRepository;

	/**
	 * @var UserRepositoryInterface
	 */
	protected $userRepository;

	/**
	 * @param sanghaRepositoryInterface $sanghaRepository
	 * @param UserRepositoryInterface $userRepository
	 */
	public function __construct(
		SanghaRepositoryInterface $sanghaRepository,
		UserRepositoryInterface $userRepository
	) {
		$this->sanghaRepository = $sanghaRepository;
		$this->userRepository = $userRepository;
	}

	/**
	 * Handle the command.
	 *
	 * @param object $command
	 * @return void
	 */
	public function handle($command)
	{
		$sangha = $this->sanghaRepository->findById($command->sanghaId);
		$user = $this->userRepository->findById($command->userId);

		$input = ['senderId' => $user->id, 'sanghaId' => $sangha->id];
		$this->execute(MarkNotificationsReadCommand::class, $input);

			Flash::success('Deze persoon is geweigerd als lid van sangha ' . $sangha->sanghaname);

			$sangha->raise(new MemberRejected($user, $sangha));

		$this->dispatchEventsFor($sangha);
	}
}
