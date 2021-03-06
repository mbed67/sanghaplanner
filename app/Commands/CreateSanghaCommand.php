<?php namespace App\Commands;

use App\Commands\Command;
use App\Events\SanghaCreated;
use Sanghaplanner\Roles\RoleRepositoryInterface;
use Sanghaplanner\Users\UserRepositoryInterface;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
use Sanghaplanner\Sanghas\Sangha;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Image;
use File;

class CreateSanghaCommand extends Command implements SelfHandling
{

    /**
     * @var int
     */
    public $userId;

    /**
     * @var string
     */
    public $sanghaname;

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
    public $filePath;

    /**
     * @var string
     */
    public $fileName;

    /**
     * @param int $userId
     * @param string $sanghaname
     * @param string $address
     * @param string $zipcode
     * @param string $place
     * @param string $filePath
     * @param string $fileName
     */
    public function __construct(
        $userId,
        $sanghaname,
        $address,
        $zipcode,
        $place,
        $filePath,
        $fileName
    ) {
        $this->userId = $userId;
        $this->sanghaname = $sanghaname;
        $this->address = $address;
        $this->zipcode = $zipcode;
        $this->place = $place;
        $this->filePath = $filePath;
        $this->fileName = $fileName;
    }

    /**
     * Execute the command.
     *
     * @param sanghaRepositoryInterface $sanghaRepository
     * @param UserRepositoryInterface $userRepository
     * @param RoleRepositoryInterface $roleRepository
     * @param Dispatcher $event
     *
     * @return void
     */
    public function handle(
        UserRepositoryInterface $userRepository,
        SanghaRepositoryInterface $sanghaRepository,
        RoleRepositoryInterface $roleRepository,
        Dispatcher $event
    ) {
        $sangha = Sangha::createSangha(
            $this->sanghaname,
            $this->address,
            $this->zipcode,
            $this->place,
            $this->fileName,
            'tn_' . $this->fileName
        );

        $user = $userRepository->findById($this->userId);
        $role = $roleRepository->getRoleByName('administrator')->id;

        if (isset($this->fileName)) {
            $this->savePhoto();
        }

        $sanghaRepository->save($sangha);

        $sanghaRepository->createSanghaUser($sangha, $user, $role);

        $event->fire(new SanghaCreated($sangha));

        return $sangha;

    }

    /**
     * @return string The path to the photos of a sangha
     */
    private function sanghaPhotosPath()
    {
        return public_path() . '/images/' . str_replace(' ', '_', $this->sanghaname) . '/';
    }

    /**
     * Save the uploaded photos to the directory for the sangha photos
     */
    private function savePhoto()
    {
        $image = Image::make($this->filePath);

        File::exists($this->sanghaPhotosPath()) or File::makeDirectory($this->sanghaPhotosPath());

        $image->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
        })
            ->save($this->sanghaPhotosPath() . $this->fileName)
            ->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($this->sanghaPhotosPath() . 'tn_' . $this->fileName);

    }
}
