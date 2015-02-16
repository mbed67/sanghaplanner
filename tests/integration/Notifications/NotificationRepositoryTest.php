<?php

use Sanghaplanner\Notifications\DbNotificationRepository;
use Sanghaplanner\Notifications\Notification;
use Laracasts\TestDummy\Factory as TestDummy;

class NotificationRepositoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \IntegrationTester
     */
    protected $tester;

    protected function _before()
    {
        $notification = new Notification();
        $this->repo = new DbNotificationRepository($notification);
    }

    /** @tests */
    public function it_marks_a_notification_read()
    {
        $notification = TestDummy::create('Sanghaplanner\Notifications\Notification');

        $this->repo->markNotificationRead($notification->id);

        $this->tester->seeRecord('notifications', array('is_read' => 1));
    }

    /** @tests */
    public function it_shows_membership_requests_for_a_sangha()
    {
        $user = $this->tester->haveAUserWithTwoSanghas();

        $sangha = $user->sanghas()->first();

        $notification = TestDummy::create('Sanghaplanner\Notifications\Notification', [
            'user_id' => $user->id,
            'object_id' => $sangha->id
        ]);

        $members = $this->repo->showMembershipRequestsForSangha($sangha, $user->id);

        $this->assertCount(1, $members);
    }

    /** @tests */
    public function it_finds_membership_requests_for_sender_with_object()
    {
        TestDummy::times(4)->create('Sanghaplanner\Notifications\Notification', [
            'sender_id' => 1,
            'type' => 'MembershipRequest',
            'object_id' => 2,
            'is_read' => 0
            ]);

        $requests = $this->repo->findMembershipRequestsForSenderWithObject(1, 2);

        $this->assertCount(4, $requests);
    }
}
