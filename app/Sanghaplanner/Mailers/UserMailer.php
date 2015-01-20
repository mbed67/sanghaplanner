<?php namespace Sanghaplanner\Mailers;

use Sanghaplanner\Users\User;

class UserMailer extends Mailer {

	public function sendWelcomeMessageTo(User $user)
	{
		$subject = 'Welkom bij de Sanghaplanner!';
		$view = 'emails.registration.confirm';

		return $this->sendTo($user, $subject, $view);
	}
}