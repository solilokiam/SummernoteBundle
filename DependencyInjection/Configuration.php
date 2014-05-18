<?php

namespace Solilokiam\SummernoteBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('solilokiam_summernote');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $supportedDrivers = array('orm', 'mongodb');
        $defaultToolbar = array(
            array('style', array('bold', 'italic', 'underline', 'clear')),
            array('para', array('ul', 'ol', 'paragraph')),
            array('insert', array('picture', 'link', 'video'))
        );

        $rootNode
            ->children()
                ->scalarNode('db_driver')
                    ->validate()
                        ->ifNotInArray($supportedDrivers)
                        ->thenInvalid('The driver %s is not supported. Please choose onf of '.implode(',',$supportedDrivers))
                    ->end()
                    ->cannotBeOverwritten()
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('asset_class')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('asset_path')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
            ->integerNode('height')
            ->min(1)
                  ->defaultValue(300)
                ->end()
                ->booleanNode('focus')
                  ->defaultValue(true)
                ->end()
                ->arrayNode('toolbar')
            ->children()
            ->arrayNode('style')
            ->prototype('scalar')->end()
            ->end()
            ->arrayNode('layout')
            ->prototype('scalar')->end()
            ->end()
            ->arrayNode('insert')
            ->prototype('scalar')->end()
            ->end()
            ->arrayNode('misc')
            ->prototype('scalar')->end()
            ->end()
            ->end()
            ->end()
            ->end();


        return $treeBuilder;
    }
}
