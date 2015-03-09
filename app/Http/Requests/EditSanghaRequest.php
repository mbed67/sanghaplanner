<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;

class EditSanghaRequest extends Request
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
     * @return array
     */
    public function rules(SanghaRepositoryInterface $repository)
    {
        $sangha = $repository->findById($this->id);

        return [
        'sanghaname' => 'required|unique:sanghas,sanghaname,' . $sangha->id,
        'address' => 'required',
        'zipcode' => 'required',
        'place' => 'required',
        'image' => 'image'
        ];
    }
}
