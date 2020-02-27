<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\UserStateAccessControl\ConfigurationEntries\UserStates;
use PoP\UserStateAccessControl\DirectiveResolvers\ValidateIsUserLoggedInDirectiveResolver;

class ValidateUserLoggedInForDirectivesPublicSchemaTypeResolverDecorator extends AbstractValidateBasedOnUserStateForDirectivesPublicSchemaTypeResolverDecorator
{
    protected function getRequiredEntryState(): string
    {
        return UserStates::IN;
    }
    protected function getValidateUserStateDirectiveResolverClass(): string
    {
        return ValidateIsUserLoggedInDirectiveResolver::class;
    }
}
