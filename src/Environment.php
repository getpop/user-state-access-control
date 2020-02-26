<?php
namespace PoP\UserStateAccessControl;

class Environment
{
    public const RESTRICTED_FIELDS_BY_USER_STATE = 'RESTRICTED_FIELDS_BY_USER_STATE';
    public const RESTRICTED_DIRECTIVES_BY_USER_STATE = 'RESTRICTED_DIRECTIVES_BY_USER_STATE';

    public static function getRestrictedFieldsByUserState(): array
    {
        return isset($_ENV[self::RESTRICTED_FIELDS_BY_USER_STATE]) ? json_decode($_ENV[self::RESTRICTED_FIELDS_BY_USER_STATE]) : [];
    }

    public static function getRestrictedDirectivesByUserState(): array
    {
        return isset($_ENV[self::RESTRICTED_DIRECTIVES_BY_USER_STATE]) ? json_decode($_ENV[self::RESTRICTED_DIRECTIVES_BY_USER_STATE]) : [];
    }
}

