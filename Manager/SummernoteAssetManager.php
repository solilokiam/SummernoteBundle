<?php
/**
 * Created by PhpStorm.
 * User: miquel
 * Date: 09/03/14
 * Time: 21:04
 */

namespace Solilokiam\SummernoteBundle\Manager;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SummernoteAssetManager
{
    protected $objectManager;
    protected $entityName;
    protected $destinationPath;

    public function __construct(ObjectManager $objectManager, $entityName, $destinationPath)
    {
        $this->objectManager = $objectManager;
        $this->entityName = $entityName;
        $this->destinationPath = $destinationPath;
    }

    public function handleUpload(UploadedFile $file)
    {
        $assetEntity = new $this->entityName;
        $assetEntity->setFile($file);
        $assetEntity->setUploadPath($this->destinationPath);
        $assetEntity->upload();
        $this->objectManager->persist($assetEntity);
        $this->objectManager->flush();

        return $assetEntity;
    }


}
