<?php
namespace PoP\UserStateAccessControl\Hooks;

class MaybeDisableDirectivesIfUserNotLoggedInPrivateSchemaHookSet extends AbstractMaybeDisableDirectivesBasedOnUserStatePrivateSchemaHookSet
{
    protected function enableBasedOnUserState(bool $isUserLoggedIn): bool
    {
        return !$isUserLoggedIn;
    }

    protected function getEntryValue(): string
    {
        return AbstractMaybeDisableFieldsBasedOnUserStatePrivateSchemaHookSet::CONFIGURATION_VALUE_IN;
    }
}
