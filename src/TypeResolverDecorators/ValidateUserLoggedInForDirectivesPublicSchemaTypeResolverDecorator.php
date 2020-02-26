<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\UserStateAccessControl\ConfigurationEntries\UserStates;
use PoP\UserState\DirectiveResolvers\ValidateIsUserLoggedInDirectiveResolver;

class ValidateUserLoggedInForDirectivesPublicSchemaTypeResolverDecorator extends AbstractValidateBasedOnUserStateForDirectivesPublicSchemaTypeResolverDecorator
{
    protected function getConfiguredEntryState(): string
    {
        return UserStates::IN;
    }
    protected function getValidateUserStateDirectiveResolverClass(): string
    {
        return ValidateIsUserLoggedInDirectiveResolver::class;
    }
}
