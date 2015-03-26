<?php namespace Sanghaplanner\Retreats;

use Illuminate\Database\Eloquent\Model;
use Sanghaplanner\Tasks\Task;

class Retreat extends Model
{

    /**
     * Which fields may be mass assigned
     * @var array
     */
    protected $fillable = [
        'description',
        'retreat_start',
        'retreat_end'
    ];

    /**
     * The dates that are converted to Carbon
     */
    public function getDates()
    {
        return ['retreat_start', 'retreat_end', 'created_at', 'updated_at'];
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'retreats';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany('Sanghaplanner\Tasks\Task');
    }

    /**
     * Find a retreat based on input from a search box
     *
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->where('description', 'LIKE', "%$search%");
        });
    }

    /**
     * @param $description
     * @param $retreat_start
     * @param $retreat_end
     * @return Sanghaplanner\Retreats\Retreat
     */
    public static function createRetreat($description, $retreat_start, $retreat_end)
    {
        $retreat = new static(compact('description', 'retreat_start', 'retreat_end'));

        return $retreat;
    }
}
