<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\UserStateAccessControl\ConfigurationEntries\UserStates;

class MaybeDisableFieldsIfUserNotLoggedInPrivateSchemaHookSet extends AbstractMaybeDisableFieldsBasedOnUserStatePrivateSchemaHookSet
{
    protected function removeFieldNameBasedOnUserState(array $configuredEntryStates, bool $isUserLoggedIn): bool
    {
        // Remove if the user is logged in and, by configuration, he/she must not be
        return !$isUserLoggedIn && in_array(UserStates::IN, $configuredEntryStates);
    }
}
