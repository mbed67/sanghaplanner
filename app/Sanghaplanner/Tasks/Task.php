<?php namespace Sanghaplanner\Tasks;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    /**
     * Which fields may be mass assigned
     * @var array
     */
    protected $fillable = [
        'sangha_user_id',
        'retreat_id',
        'description'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function retreat()
    {
        return $this->belongsTo('Sanghaplanner\Retreats\Retreat');
    }

    /**
     * @param $sangha_user_id
     * @param $description
     * @return Sanghaplanner\Tasks\Task
     */
    public static function makeRetreatTask($sangha_user_id, $description)
    {
        $task = new static(compact('sangha_user_id', 'description'));

        return $task;
    }
}
