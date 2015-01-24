<?php namespace Sanghaplanner\Users;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Eloquent;
use Hash;
use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Presenter\PresentableTrait;
use Sanghaplanner\Registration\Events\UserRegistered;
use Sanghaplanner\Sanghas\Sangha;
use Sanghaplanner\Roles\Role;
use Sanghaplanner\Pivot\SanghaUser;

class User extends Eloquent implements UserInterface, RemindableInterface {

use UserTrait, RemindableTrait, EventGenerator, PresentableTrait;

	/**
	 * Which fields may be mass assigned
	 * @var array
	 */
	protected $fillable = [
		'email',
		'password',
		'firstname',
		'middlename',
		'lastname',
		'address',
		'zipcode',
		'place',
		'phone',
		'gsm'
	];

	/**
	 * Path to the presenter for the user
	 *
	 * @var string
	 */
	protected $presenter = 'Sanghaplanner\Users\UserPresenter';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	/**
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * @param string $value
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Passwords must always be hashed
	 *
	 * @param $password
	 */
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = Hash::make($password);
	}

	/**
	 * Register een new user
	 *
	 * @param $username
	 * @param $email
	 * @param $password
	 * @return static
	 */
	public static function register(
		$email,
		$password,
		$firstname,
		$middlename,
		$lastname,
		$address,
		$zipcode,
		$place,
		$phone,
		$gsm
	) {
		$user = new static(compact(
			'email',
			'password',
			'firstname',
			'middlename',
			'lastname',
			'address',
			'zipcode',
			'place',
			'phone',
			'gsm'
		));

		$user->raise(new UserRegistered($user));

		return $user;
	}

	/**
	 * A user has many roles
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function roles()
	{
		return $this->belongsToMany('Sanghaplanner\Roles\Role')->withTimestamps();
	}

	/**
	 * A user has many sanghas
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function sanghas()
	{
		return $this->belongsToMany('Sanghaplanner\Sanghas\Sangha')->withTimestamps()->withPivot('role_id');
	}

	/**
	 * This is a relationship to the pivot table. You need not know the parameters
	 * in order to call this method.
	 * Just do for instance $user->pivot->role->rolename
	 *
	 * @param Eloquent $parent
	 * @param $attributes
	 * @param $table
	 * @param $exists
	 * @return mixed
	 */
	public function newPivot(Eloquent $parent, array $attributes, $table, $exists)
	{
		if ($parent instanceof Sangha)
		{
			return new SanghaUser($parent, $attributes, $table, $exists);
		}
		return parent::newPivot($parent, $attributes, $table, $exists);
	}

	/**
	 * A user has many notifications
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function notifications()
	{
		return $this->hasMany('Sanghaplanner\Notifications\Notification');
	}

	/**
	 * Find a user based on input from a search box
	 *
	 * @param $query
	 * @param $search
	 * @return mixed
	 */
	public function scopeSearch($query, $search)
	{
		return $query->where(function($query) use ($search)
		{
			$query->where('firstname', 'LIKE', "%$search%")
			->orWhere('lastname', 'LIKE', "%$search%");
		});
	}

	/**
	 * Returns the role the user has for this sangha
	 *
	 * @param $id
	 * @return Sanghaplanner\Roles\Role
	 */
	public function roleForSangha($id)
	{
		if ($this->sanghas->find($id))
		{
			$role = $this->sanghas->find($id)->pivot->role->rolename;

			return $role;
		}
	}
}
