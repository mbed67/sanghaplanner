<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Sanghaplanner\Users\UserRepositoryInterface;
use Auth;

class EditUserRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (! Auth::check()) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Sanghaplanner\Users\UserRepositoryInterface $repository
     * @return array
     */
    public function rules(UserRepositoryInterface $repository)
    {
        $user = $repository->findById($this->id);

        return [
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'zipcode' => 'required',
            'place' => 'required'
        ];
    }
}
