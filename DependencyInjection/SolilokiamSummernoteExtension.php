<?php

namespace Solilokiam\SummernoteBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SolilokiamSummernoteExtension extends Extension implements PrependExtensionInterface
{
    /** @var string */
    protected $formTypeTemplate = 'SolilokiamSummernoteBundle:Form:summernotefield.html.twig';

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $loader->load(sprintf('%s.xml', $config['db_driver']));

        $container->setParameter($this->getAlias() . '.backendtype_' . $config['db_driver'], true);

        $container->setParameter($this->getAlias() . '.asset.class',$config['asset_class']);

        $container->setParameter($this->getAlias() . '.destination.path',$config['asset_path']);

        $this->configWidget($container, $config);
    }

    /**
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $configs = $container->getExtensionConfig($this->getAlias());

        $this->processConfiguration(new Configuration(), $configs);

        $this->configureTwigBundle($container);
    }

    protected function configureTwigBundle(ContainerBuilder $container)
    {
        foreach (array_keys($container->getExtensions()) as $name) {
            switch ($name) {
                case 'twig':
                    $container->prependExtensionConfig(
                        $name,
                        array('form' => array('resources' => array($this->formTypeTemplate)))
                    );
                    break;
            }
        }
    }

    /**
     * @param ContainerBuilder $container
     * @param $config
     */
    protected function configWidget(ContainerBuilder $container, $config)
    {
        $widgetConfig = array(
            'width' => $config['width'],
            'focus' => $config['focus'],
            'toolbar' => $config['toolbar']
        );

        $container->setParameter($this->getAlias() . '.widget.config', $widgetConfig);
    }


}
