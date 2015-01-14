<?php
namespace Sanghaplanner\Roles;

use \Eloquent;

class Role extends Eloquent {

	/**
	 * Which fields may be mass assigned
	 * @var array
	 */
	protected $fillable = ['rolename'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function sanghaUsers()
	{
	    return $this->hasMany('Sanghaplanner\Users\SanghaUser')->withTimestamps();
	}

	/**
	 * @param $rolename
	 * @return Sanghaplanner\Roles\Role
	 */
	public static function createRole($rolename)
	{
	    $role = new static(compact('rolename'));

	    return $role;
	}
}