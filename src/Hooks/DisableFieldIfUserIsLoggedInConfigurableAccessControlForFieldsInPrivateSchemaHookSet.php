<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\UserStateAccessControl\ConfigurationEntries\UserStates;

class DisableFieldIfUserIsLoggedInConfigurableAccessControlForFieldsInPrivateSchemaHookSet extends AbstractUserStateConfigurableAccessControlForFieldsInPrivateSchemaHookSet
{
    protected function removeFieldNameBasedOnUserState(array $configuredEntryStates, bool $isUserLoggedIn): bool
    {
        // Remove if the user is not logged in and, by configuration, he/she must be
        return $isUserLoggedIn && in_array(UserStates::OUT, $configuredEntryStates);
    }
}
