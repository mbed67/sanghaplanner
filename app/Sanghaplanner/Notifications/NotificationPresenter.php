<?php namespace Sanghaplanner\Notifications;

use Laracasts\Presenter\Presenter;

class NotificationPresenter extends Presenter
{

    /**
     * Display how long it has been since the publish date
     *
     * @return mixed
     */
    public function timeSinceCreated()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * @return mixed
     */
    public function timeWhenCreated()
    {
        return $this->created_at->format('d-m-Y H:i');
    }
}
