<?php

declare(strict_types=1);

namespace PoP\UserStateAccessControl\Hooks;

use PoP\UserStateAccessControl\ConfigurationEntries\UserStates;

class DisableDirectivesIfUserIsNotLoggedInConfigurableAccessControlForDirectivesInPrivateSchemaHookSet extends AbstractUserStateConfigurableAccessControlForDirectivesInPrivateSchemaHookSet
{
    protected function enableBasedOnUserState(bool $isUserLoggedIn): bool
    {
        return !$isUserLoggedIn;
    }

    protected function getRequiredEntryValue(): ?string
    {
        return UserStates::IN;
    }
}
