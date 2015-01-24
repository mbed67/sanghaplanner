<?php namespace Sanghaplanner\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Sanghaplanner\Users\UserRepositoryInterface',
			'Sanghaplanner\Users\DbUserRepository'
		);
		$this->app->bind(
			'Sanghaplanner\Sanghas\SanghaRepositoryInterface',
			'Sanghaplanner\Sanghas\DbSanghaRepository'
		);
		$this->app->bind(
			'Sanghaplanner\Roles\RoleRepositoryInterface',
			'Sanghaplanner\Roles\DbRoleRepository'
		);
		$this->app->bind(
			'Sanghaplanner\Notifications\NotificationRepositoryInterface',
			'Sanghaplanner\Notifications\DbNotificationRepository'
		);
	}
}