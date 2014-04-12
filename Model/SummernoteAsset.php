<?php
/**
 * Created by PhpStorm.
 * User: miquel
 * Date: 01/03/14
 * Time: 22:06
 */

namespace Solilokiam\SummernoteBundle\Model;


class SummernoteFileAsset
{
    protected $file;

    protected $path;

    protected $uploadDir;

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
            : $this->getUploadDir() . '/' . $this->path;
    }

    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        $imagename = md5($this->getFile()->getClientOriginalName() . time()) . '.' . $this->getFile()->guessExtension();

        $this->getFile()->move(
            $this->getUploadRootDir(),
            $imagename
        );

        // set the path property to the filename where you've saved the file
        $this->path = $imagename;

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    public function setUploadDir($uploadDir)
    {
        $this->uploadDir = $uploadDir;

        return $this;
    }

    public function getUploadDir()
    {
        return $this->uploadDir;
    }
} 