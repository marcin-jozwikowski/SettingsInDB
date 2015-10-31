<?php

namespace MarcinJozwikowski\SettingsInDBBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    const CONFIG_ROOT = 'settings_in_db';
    const ALLOW_INSERTS = 'allow_inserts';
    const RETURN_NULL = 'return_null_on_not_found';
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root(Configuration::CONFIG_ROOT);

        $rootNode
            ->children()
                ->booleanNode(Configuration::ALLOW_INSERTS)->defaultTrue()->end()
                ->booleanNode(Configuration::RETURN_NULL)->defaultFalse()->end()
            ->end();

        return $treeBuilder;
    }
}
