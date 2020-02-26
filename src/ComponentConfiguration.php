<?php
namespace PoP\UserStateAccessControl;

use PoP\ComponentModel\AbstractComponentConfiguration;

class ComponentConfiguration extends AbstractComponentConfiguration
{
    private static $getRestrictedFieldsByUserState;
    private static $getRestrictedDirectivesByUserState;

    public static function getRestrictedFieldsByUserState(): array
    {
        // Define properties
        $envVariable = Environment::RESTRICTED_FIELDS_BY_USER_STATE;
        $selfProperty = &self::$getRestrictedFieldsByUserState;
        $callback = [Environment::class, 'getRestrictedFieldsByUserState'];

        // Initialize property from the environment/hook
        self::maybeInitEnvironmentVariable(
            $envVariable,
            $selfProperty,
            $callback
        );
        return $selfProperty;
    }

    public static function getRestrictedDirectivesByUserState(): array
    {
        // Define properties
        $envVariable = Environment::RESTRICTED_DIRECTIVES_BY_USER_STATE;
        $selfProperty = &self::$getRestrictedDirectivesByUserState;
        $callback = [Environment::class, 'getRestrictedDirectivesByUserState'];

        // Initialize property from the environment/hook
        self::maybeInitEnvironmentVariable(
            $envVariable,
            $selfProperty,
            $callback
        );
        return $selfProperty;
    }
}

