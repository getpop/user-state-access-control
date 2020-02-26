<?php
namespace PoP\UserStateAccessControl\Hooks;

class MaybeDisableDirectivesIfUserLoggedInPrivateSchemaHookSet extends AbstractMaybeDisableDirectivesBasedOnUserStatePrivateSchemaHookSet
{
    protected function enableBasedOnUserState(bool $isUserLoggedIn): bool
    {
        return $isUserLoggedIn;
    }

    protected function getEntryValue(): string
    {
        return AbstractMaybeDisableFieldsBasedOnUserStatePrivateSchemaHookSet::CONFIGURATION_VALUE_OUT;
    }
}
