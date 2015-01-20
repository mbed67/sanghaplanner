<?php namespace Sanghaplanner\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * Register Sanghaplanner event listeners
	 */
	public function register()
	{
		$this->app['events']->listen('Sanghaplanner.*', 'Sanghaplanner\Handlers\EmailNotifier');

	}
}