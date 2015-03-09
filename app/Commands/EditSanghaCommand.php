<?php namespace App\Commands;

use App\Commands\Command;
use App\Events\SanghaCreated;
use Sanghaplanner\Roles\RoleRepositoryInterface;
use Sanghaplanner\Users\UserRepositoryInterface;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
use Sanghaplanner\Sanghas\Sangha;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;
use File;

class EditSanghaCommand extends Command implements SelfHandling
{

    /**
     * @var int
     */
    public $id;

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
     * @param int $id
     * @param string $sanghaname
     * @param string $address
     * @param string $zipcode
     * @param string $place
     * @param string $filePath
     * @param string $fileName
     */
    public function __construct(
        $id,
        $sanghaname,
        $address,
        $zipcode,
        $place,
        $filePath,
        $fileName
    ) {
        $this->id = $id;
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
     *
     * @return void
     */
    public function handle(SanghaRepositoryInterface $repository)
    {
        $sangha = $repository->findById($this->id);

        $sangha->sanghaname = $this->sanghaname;
        $sangha->address = $this->address;
        $sangha->zipcode = $this->zipcode;
        $sangha->place = $this->place;

        if (isset($this->fileName)) {
            $sangha->fileName = $this->fileName;
            $sangha->thumbnailName = 'tn_' . $this->fileName;

            $this->savePhoto();
        }

        $repository->save($sangha);

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
