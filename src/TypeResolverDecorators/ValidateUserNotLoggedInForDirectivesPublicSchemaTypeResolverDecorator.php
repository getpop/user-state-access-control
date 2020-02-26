<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\UserStateAccessControl\ConfigurationEntries\UserStates;
use PoP\UserState\DirectiveResolvers\ValidateIsUserNotLoggedInDirectiveResolver;

class ValidateUserNotLoggedInForDirectivesPublicSchemaTypeResolverDecorator extends AbstractValidateBasedOnUserStateForDirectivesPublicSchemaTypeResolverDecorator
{
    protected function getConfiguredEntryState(): string
    {
        return UserStates::OUT;
    }
    protected function getValidateUserStateDirectiveResolverClass(): string
    {
        return ValidateIsUserNotLoggedInDirectiveResolver::class;
    }
}
