<?php
namespace PoP\UserStateAccessControl\Conditional\CacheControl\TypeResolverDecorators;

use PoP\UserStateAccessControl\ConfigurationEntries\UserStates;
use PoP\UserStateAccessControl\DirectiveResolvers\ValidateIsUserLoggedInDirectiveResolver;

class ValidateUserLoggedInForDirectivesPrivateSchemaTypeResolverDecorator extends AbstractValidateBasedOnUserStateForDirectivesPrivateSchemaTypeResolverDecorator
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
