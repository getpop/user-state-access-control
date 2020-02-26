<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\UserStateAccessControl\ConfigurationEntries\UserStates;
use PoP\UserState\DirectiveResolvers\ValidateIsUserLoggedInDirectiveResolver;

class ValidateUserLoggedInForFieldsPublicSchemaTypeResolverDecorator extends AbstractValidateBasedOnUserStateForFieldsPublicSchemaTypeResolverDecorator
{
    protected function removeFieldNameBasedOnUserState(array $states): bool
    {
        return in_array(UserStates::IN, $states);
    }
    protected function getValidateUserStateDirectiveResolverClass(): string
    {
        return ValidateIsUserLoggedInDirectiveResolver::class;
    }
}
