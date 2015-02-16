<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserRegistered' => [
            'App\Handlers\Events\EmailNotifier@whenUserRegistered',
        ],
        'App\Events\MembershipRequested' => [
            'App\Handlers\Events\EmailNotifier@whenMembershipRequested',
        ],
        'App\Events\MemberApproved' => [
            'App\Handlers\Events\MarkNotificationRead@whenMemberApproved',
            'App\Handlers\Events\EmailNotifier@whenMemberApproved',
        ],
        'App\Events\MemberAlreadyExists' => [
            'App\Handlers\Events\MarkNotificationRead@whenMemberAlreadyExists',
        ],
        'App\Events\MemberRejected' => [
            'App\Handlers\Events\EmailNotifier@whenMemberRejected',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
