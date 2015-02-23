<?php namespace App\Services;

use Sanghaplanner\Users\User;
use App\Events\UserRegistered;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Event;

class Registrar implements RegistrarContract
{

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'zipcode' => 'required',
            'place' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function create(array $data)
    {
        $user =  User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'firstname' => $data['firstname'],
            'middlename' => $data['middlename'],
            'lastname' => $data['lastname'],
            'address' => $data['address'],
            'zipcode' => $data['zipcode'],
            'place' => $data['place'],
            'phone' => $data['phone'],
            'gsm' => $data['gsm'],
        ]);

        Event::fire(new UserRegistered($user));

        return $user;
    }
}
