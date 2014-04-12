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
    }

    /**
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        // Configure Twig if TwigBundle is activated and the option
        // "solilokiam_summernote.auto_configure.twig" is set to TRUE (default value).
        //if (true === isset($bundles['TwigBundle']) && true === $config['auto_configure']['twig']) {
        $this->configureTwigBundle($container);
        //}
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


}