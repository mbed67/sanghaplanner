<?php namespace App\Commands;

use App\Commands\Command;
use Sanghaplanner\Users\User;
use Sanghaplanner\Users\UserRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

class EditUserCommand extends Command implements SelfHandling
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $middlename;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var string
     */
    protected $zipcode;

    /**
     * @var string
     */
    protected $place;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $gsm;

    /**
     * @param int $id
     * @param string $email
     * @param string $firstname
     * @param string $middlename
     * @param string $lastname
     * @param string $address
     * @param string $zipcode
     * @param string $place
     * @param string $phone
     * @param string $gsm
     */
    public function __construct(
        $id,
        $email,
        $firstname,
        $middlename,
        $lastname,
        $address,
        $zipcode,
        $place,
        $phone,
        $gsm
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->middlename = $middlename;
        $this->lastname = $lastname;
        $this->address = $address;
        $this->zipcode = $zipcode;
        $this->place = $place;
        $this->phone = $phone;
        $this->gsm = $gsm;
    }
    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle(UserRepositoryInterface $repository)
    {
        $user = $repository->findById($this->id);

        $user->email = $this->email;
        $user->firstname = $this->firstname;
        $user->middlename = $this->middlename;
        $user->lastname = $this->lastname;
        $user->address = $this->address;
        $user->zipcode = $this->zipcode;
        $user->place = $this->place;
        $user->phone = $this->phone;
        $user->gsm = $this->gsm;

        $user->save();
    }
}
