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

    public function setUp()
    {
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }

        $this->objectManager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');

        $this->destinationPath = __DIR__;

        $this->assetManager = new SummernoteAssetManager($this->objectManager,'Solilokiam\SummernoteBundle\Model\SummernoteAsset',$this->destinationPath);
    }

    public function testUpload()
    {
        $testUploadedFile = new UploadedFile(__DIR__.'/uploadtestfile','uploadtestfile');

        $this->objectManager->expects($this->once())->method('persist');
        $this->objectManager->expects($this->once())->method('flush');

        $return = $this->assetManager->handleUpload($testUploadedFile);

        $this->assertInstanceOf('Doctrine\Common\Persistence\ObjectManager',$return);
    }
}
