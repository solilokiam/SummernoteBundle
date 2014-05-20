<?php
/**
 * Created by PhpStorm.
 * User: miquel
 * Date: 20/05/14
 * Time: 13:35
 */

namespace Manager;


use Solilokiam\SummernoteBundle\Manager\SummernoteAssetManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SummerNoteAssetManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $assetManager;
    protected $objectManager;
    protected $destinationPath;
    protected $uploadedFile;

    public function setUp()
    {
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }

        $this->objectManager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');

        $this->destinationPath = '/tmp';

        $this->assetManager = new SummernoteAssetManager($this->objectManager,'Solilokiam\SummernoteBundle\Model\SummernoteAsset',$this->destinationPath);

        touch(__DIR__.'/uploadtestfile');
        $this->uploadedFile = new UploadedFile(__DIR__.'/uploadtestfile','uploadtestfile',null,null,null,true);
    }

    public function testUpload()
    {
        $this->objectManager->expects($this->once())->method('persist');
        $this->objectManager->expects($this->once())->method('flush');

        $return = $this->assetManager->handleUpload($this->uploadedFile);

        $this->assertInstanceOf('Solilokiam\SummernoteBundle\Model\SummernoteAsset',$return);
    }
}
