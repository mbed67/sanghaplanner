<?php namespace Sanghaplanner\Registration;

class RegisterUserCommand {

	/**
	 * @var string
	 */
	public $email;

	/**
	 * @var string
	 */
	public $password;

	/**
	 * @var string
	 */
	public $firstname;

	/**
	 * @var string
	 */
	public $middlename;

	/**
	 * @var string
	 */
	public $lastname;

	/**
	 * @var string
	 */
	public $address;

	/**
	 * @var string
	 */
	public $zipcode;

	/**
	 * @var string
	 */
	public $place;

	/**
	 * @var string
	 */
	public $phone;

	/**
	 * @var string
	 */
	public $gsm;

	/**
	 * @param string email
	 * @param string password
	 * @param string firstname
	 * @param string middlename
	 * @param string lastname
	 * @param string address
	 * @param string zipcode
	 * @param string place
	 * @param string phone
	 * @param string gsm
	 */
	public function __construct(
		$email,
		$password,
		$firstname,
		$middlename,
		$lastname,
		$address,
		$zipcode,
		$place,
		$phone,
		$gsm
	) {
		$this->email = $email;
		$this->password = $password;
		$this->firstname = $firstname;
		$this->middlename = $middlename;
		$this->lastname = $lastname;
		$this->address = $address;
		$this->zipcode = $zipcode;
		$this->place = $place;
		$this->phone = $phone;
		$this->gsm = $gsm;
	}
}
