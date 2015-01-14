<?php namespace Sanghaplanner\Pivot;

use \Eloquent;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Sanghaplanner\Roles\Role;
use Sanghaplanner\Sanghas\Sangha;

class SanghaUser extends Pivot {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sangha_user';

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function role()
	{
	    return $this->belongsTo('Sanghaplanner\Roles\Role');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
	    return $this->belongsTo('Sanghaplanner\Users\User');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function sangha()
	{
	    return $this->belongsTo('Sanghaplanner\Sanghas\Sangha');
	}
}