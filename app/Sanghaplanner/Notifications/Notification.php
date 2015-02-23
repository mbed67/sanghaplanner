<?php namespace Sanghaplanner\Notifications;

use Sanghaplanner\Users\User;
use Eloquent;
use Carbon\Carbon;
use Laracasts\Presenter\PresentableTrait;

class Notification extends Eloquent
{

    use PresentableTrait;

    /**
     * Which fields may be mass assigned
     * @var array
     */
    protected $fillable = [
        'user_id',
        'sender_id',
        'type',
        'subject',
        'body',
        'object_id',
        'object_type',
        'is_read',
        'sent_at'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
    */
    protected $table = 'notifications';

    /**
     * Path to the presenter for the notification
     *
     * @var string
     */
    protected $presenter = 'Sanghaplanner\Notifications\NotificationPresenter';

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
    public function sender()
    {
        return $this->belongsTo('Sanghaplanner\Users\User', 'sender_id');
    }

    /**
     * @param User $user
     * @return $this
     */
    public function from(User $user)
    {
        $this->sender()->associate($user);

        return $this;
    }

    /**
     * @param string $subject
     * @return $this
     */
    public function withSubject($subject)
    {
        $this->setAttribute('subject', $subject);

        return $this;
    }

    /**
     * @param string $body
     * @return $this
     */
    public function withBody($body)
    {
        $this->setAttribute('body', $body);

        return $this;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function withType($type)
    {
        $this->setAttribute('type', $type);

        return $this;
    }

    /**
     * @param $object
     * @return $this
     */
    public function regarding($object)
    {
        if (is_object($object)) {
            $this->setAttribute('object_id', $object->id);
            $this->setAttribute('object_type', get_class($object));
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function deliver()
    {
        $this->setAttribute('sent_at', new Carbon);
        $this->save();

        return $this;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', '=', 0);
    }

    /**
     * @return bool
     */
    public function hasValidObject()
    {
        try {
            $object = call_user_func_array($this->object_type . '::findOrFail', [$this->object_id]);
        } catch (\Exception $e) {
            return false;
        }

        $this->setAttribute('relatedObject', $object);

        return true;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        if (!$this->relatedObject) {
            $hasObject = $this->hasValidObject();

            if (!$hasObject) {
                throw new \Exception(sprintf(
                    "No valid object (%s with ID %s) associated with this notification.",
                    $this->object_type,
                    $this->object_id
                ));
            }
        }

        return $this->relatedObject;
    }
}
