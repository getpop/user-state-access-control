<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\UserStateAccessControl\ConfigurationEntries\UserStates;

class MaybeDisableDirectivesIfUserLoggedInPrivateSchemaHookSet extends AbstractMaybeDisableDirectivesBasedOnUserStatePrivateSchemaHookSet
{
    protected function enableBasedOnUserState(bool $isUserLoggedIn): bool
    {
        return $isUserLoggedIn;
    }

    protected function getEntryValue(): string
    {
        return UserStates::OUT;
    }
}