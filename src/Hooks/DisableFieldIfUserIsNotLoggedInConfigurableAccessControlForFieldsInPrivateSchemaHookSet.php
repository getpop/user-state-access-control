<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\UserStateAccessControl\ConfigurationEntries\UserStates;

class DisableFieldIfUserIsNotLoggedInConfigurableAccessControlForFieldsInPrivateSchemaHookSet extends AbstractUserStateConfigurableAccessControlForFieldsInPrivateSchemaHookSet
{
    protected function removeFieldNameBasedOnUserState(string $entryValue, bool $isUserLoggedIn): bool
    {
        // Remove if the user is logged in and, by configuration, he/she must not be
        return !$isUserLoggedIn && UserStates::IN == $entryValue;
    }
}
