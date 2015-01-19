<?php namespace Sanghaplanner\Notifications;

use Sanghaplanner\Users\User;
use Eloquent;

class Notification extends Eloquent {

	/**
	 * Which fields may be mass assigned
	 * @var array
	 */
	protected $fillable = ['user_id', 'subject', 'body', 'is_read', 'sent_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
	protected $table = 'notifications';

	public function __construct(User $user)
	{
		$this->setAttribute('user_id', $user->id);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function users()
	{
		return $this->belongsTo('Sanghaplanner\Users\User');
	}

	public function withSubject($subject)
	{
	    $this->setAttribute('subject', $subject);

	    return $this;
	}

	public function withBody($body)
	{
	    $this->setAttribute('body', $body);

	    return $this;
	}
}