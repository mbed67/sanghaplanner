<?php namespace Sanghaplanner\Users;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laracasts\Presenter\PresentableTrait;
use App\Events\UserRegistered;
use Sanghaplanner\Sanghas\Sangha;
use Sanghaplanner\Roles\Role;
use Sanghaplanner\Pivot\SanghaUser;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword, PresentableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
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
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Path to the presenter for the user
     *
     * @var string
     */
    protected $presenter = 'Sanghaplanner\Users\UserPresenter';

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
     * @param Model $parent
     * @param $attributes
     * @param $table
     * @param $exists
     * @return mixed
     */
    public function newPivot(Model $parent, array $attributes, $table, $exists)
    {
        if ($parent instanceof Sangha) {
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
        return $query->where(function($query) use ($search) {
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
        if ($this->sanghas->find($id)) {
            $role = $this->sanghas->find($id)->pivot->role->rolename;

            return $role;
        }
    }
}
