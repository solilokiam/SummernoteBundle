<?php
/**
 * Created by PhpStorm.
 * User: miquel
 * Date: 01/03/14
 * Time: 22:06
 */

namespace Solilokiam\SummernoteBundle\Model;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class SummernoteFileAsset
 * @package Solilokiam\SummernoteBundle\Model
 */
class SummernoteAsset
{
    protected $file;

    protected $path;

    protected $uploadPath;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadPath() . '/' . $this->path;
    }

    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        $filename = md5($this->getFile()->getClientOriginalName() . time()) . '.' . $this->getFile()->guessExtension();

        $newFile = $this->getFile()->move(
            $this->getUploadRootDir(),
            $filename
        );

        // set the path property to the filename where you've saved the file
        $this->path = $newFile->getFilename();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return $this->getUploadPath();
    }

    public function setUploadPath($uploadPath)
    {
        $this->uploadPath = $uploadPath;

        return $this;
    }

    public function getUploadPath()
    {
        return $this->uploadPath;
    }
}
