<?php namespace Sanghaplanner\Sanghas;

use Sanghaplanner\Sanghas\Events\SanghaCreated;
use Sanghaplanner\Users\User;
use Sanghaplanner\Pivot\SanghaUser;
use Eloquent;
use Laracasts\Commander\Events\EventGenerator;

class Sangha extends Eloquent {

	use EventGenerator;

	/**
	 * Which fields may be mass assigned
	 * @var array
	 */
	protected $fillable = ['sanghaname'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sanghas';

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users()
	{
		return $this->belongsToMany('Sanghaplanner\Users\User')->withTimestamps()->withPivot('role_id');
	}


	/**
	 * This is a relationship to the pivot table. You need not know the parameters
	 * in order to call this method.
	 * Just do for instance $sangha->pivot->role->rolename
	 *
	 * @param Eloquent $parent
	 * @param $attributes
	 * @param $table
	 * @param $exists
	 * @return mixed
	 */
	public function newPivot(Eloquent $parent, array $attributes, $table, $exists)
	{
		if ($parent instanceof User) {
			return new SanghaUser($parent, $attributes, $table, $exists);
		}
		return parent::newPivot($parent, $attributes, $table, $exists);
	}


	/**
	 * Create een new sangha
	 *
	 * @param $username
	 * @param $email
	 * @param $password
	 * @return static
	 */
	public static function createSangha($sanghaname)
	{
		$sangha = new static(compact('sanghaname'));

		$sangha->raise(new SanghaCreated($sangha));

		return $sangha;
	}

	/**
	 * Find a sangha based on input from a search box
	 *
	 * @param $query
	 * @param $search
	 * @return mixed
	 */
	public function scopeSearch($query, $search)
	{
		return $query->where(function($query) use ($search)
		{
			$query->where('sanghaname', 'LIKE', "%$search%");
		});
	}
}