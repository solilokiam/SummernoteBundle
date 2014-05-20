<?php
/**
 * Created by PhpStorm.
 * User: miquel
 * Date: 20/05/14
 * Time: 12:44
 */

namespace Solilokiam\SummernoteBundle\Tests\DependencyInjection;



use Solilokiam\SummernoteBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testHasMinimumDefaults()
    {
        $configurations = array(
            'solilokiam_summenote' => array(
                'db_driver' => 'mongodb',
                'asset_class' => 'TestClass',
                'asset_path' => 'testpath'
            )
        );
        $processedConfig = $this->processConfiguration($configurations);

        $expectedConfiguration = array(
            'db_driver' => 'mongodb',
            'asset_class' => 'TestClass',
            'asset_path' => 'testpath',
            'height' => 300,
            'focus' => true,
            'toolbar' => Array (
                Array (
                    'name' => 'style',
                    'buttons' => Array ('bold','italic','underline','clear')
                ),
                Array (
                    'name' => 'para',
                    'buttons' => Array ('ul','ol','paragraph')
                ),
                Array (
                    'name' => 'insert',
                    'buttons' => Array ('picture','link','video')
                )
            )
        );

        $this->assertSame($expectedConfiguration,$processedConfig);
    }

    private function processConfiguration(array $configValues)
    {
        $configuration = new Configuration();
        $processor = new Processor();
        return $processor->processConfiguration(
            $configuration,
            $configValues
        );
    }
}
