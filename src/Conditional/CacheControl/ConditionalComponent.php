<?php

declare(strict_types=1);

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

    public static function initialize(
        array $configuration = [],
        bool $skipSchema = false,
        array $skipSchemaComponentClasses = []
    ): void {
        self::maybeInitYAMLSchemaServices(Component::$COMPONENT_DIR, $skipSchema, '/Conditional/CacheControl');
    }

    /**
     * Boot component
     *
     * @return void
     */
    public static function afterBoot(): void
    {
        // Initialize classes
        ContainerBuilderUtils::attachTypeResolverDecoratorsFromNamespace(__NAMESPACE__ . '\\TypeResolverDecorators');
    }
}
