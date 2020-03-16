<?php
namespace PoP\UserStateAccessControl\Conditional\CacheControl;

use PoP\Root\Component\YAMLServicesTrait;
use PoP\UserStateAccessControl\Component;
use PoP\ComponentModel\Container\ContainerBuilderUtils;

/**
 * Initialize component
 */
class ConditionalComponent
{
    use YAMLServicesTrait;

    public static function init()
    {
        self::initYAMLServices(Component::$COMPONENT_DIR, '/Conditional/CacheControl');
    }

    /**
     * Boot component
     *
     * @return void
     */
    public static function afterBoot()
    {
        // Initialize classes
        ContainerBuilderUtils::attachTypeResolverDecoratorsFromNamespace(__NAMESPACE__.'\\TypeResolverDecorators');
    }
}
