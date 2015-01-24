<?php namespace Sanghaplanner\Notifications;

class MarkNotificationsReadCommand {

	/**
	 * @var int
	 */
	public $senderId;

	/**
	 * @var int
	 */
	public $sanghaId;

	/**
	 * @param int senderId
	 * @param int sanghaId
	 */
	public function __construct($senderId, $sanghaId)
	{
		$this->senderId = $senderId;
		$this->sanghaId = $sanghaId;
	}
}
