<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\UserStateAccessControl\ConfigurationEntries\UserStates;

class MaybeDisableDirectivesIfUserLoggedInPrivateSchemaHookSet extends AbstractUserStateConfigurableAccessControlForDirectivesInPrivateSchemaHookSet
{
    protected function enableBasedOnUserState(bool $isUserLoggedIn): bool
    {
        return $isUserLoggedIn;
    }

    protected function getRequiredEntryValue(): ?string
    {
        return UserStates::OUT;
    }
}
