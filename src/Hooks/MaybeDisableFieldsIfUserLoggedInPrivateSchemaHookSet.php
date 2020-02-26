<?php
namespace PoP\UserStateAccessControl\Hooks;

class MaybeDisableFieldsIfUserLoggedInPrivateSchemaHookSet extends AbstractMaybeDisableFieldsBasedOnUserStatePrivateSchemaHookSet
{
    protected function removeFieldNameBasedOnUserState(array $configuredEntryStates, bool $isUserLoggedIn): bool
    {
        // Remove if the user is not logged in and, by configuration, he/she must be
        return $isUserLoggedIn && in_array(self::CONFIGURATION_VALUE_OUT, $configuredEntryStates);
    }
}
