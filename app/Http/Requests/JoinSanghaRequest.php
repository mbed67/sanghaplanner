<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class JoinSanghaRequest extends Request
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
    public function rules()
    {
        return [
            'sanghaIdToJoin' => 'required'
        ];
    }
}
