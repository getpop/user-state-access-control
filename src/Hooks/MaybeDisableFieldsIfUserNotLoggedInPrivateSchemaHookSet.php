<?php
namespace PoP\UserStateAccessControl\Hooks;

class MaybeDisableFieldsIfUserNotLoggedInPrivateSchemaHookSet extends AbstractMaybeDisableFieldsBasedOnUserStatePrivateSchemaHookSet
{
    protected function removeFieldNameBasedOnUserState(array $configuredEntryStates, bool $isUserLoggedIn): bool
    {
        // Remove if the user is logged in and, by configuration, he/she must not be
        return !$isUserLoggedIn && in_array(self::CONFIGURATION_VALUE_IN, $configuredEntryStates);
    }
}
