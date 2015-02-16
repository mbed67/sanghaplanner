<?php namespace Sanghaplanner\Mailers;

use Sanghaplanner\Users\User;
use Sanghaplanner\Sanghas\Sangha;

class UserMailer extends Mailer
{

    public function sendWelcomeToSanghaplannerMessageTo(User $user)
    {
        $subject = 'Welkom bij de Sanghaplanner!';
        $view = 'emails.registration.confirm';

        return $this->sendTo($user, $subject, $view);
    }

    public function sendWelcomeToSanghaMessageTo(User $user, Sangha $sangha)
    {
        $subject = 'Welkom bij sangha ' . $sangha->sanghaname;
        $view = 'emails.memberships.welcome';
        $data = ['user' => $user, 'sangha' => $sangha];

        return $this->sendTo($user, $subject, $view, $data);
    }

    public function sendSorryMessageTo(User $user, Sangha $sangha)
    {
        $subject = 'Helaas, uw verzoek om lid te worden van ' . $sangha->sanghaname . ' is afgewezen.';
        $view = 'emails.memberships.sorry';
        $data = ['user' => $user, 'sangha' => $sangha];

        return $this->sendTo($user, $subject, $view, $data);
    }

    public function sendMembershipRequestPendingMessageTo(User $user, Sangha $sangha)
    {
        $subject = 'Uw verzoek om lid te worden van ' . $sangha->sanghaname . ' is in behandeling.';
        $view = 'emails.memberships.pending';
        $data = ['user' => $user, 'sangha' => $sangha];

        return $this->sendTo($user, $subject, $view, $data);
    }
}
