<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\UserStateAccessControl\ConfigurationEntries\UserStates;
use PoP\UserState\DirectiveResolvers\ValidateIsUserNotLoggedInDirectiveResolver;

class ValidateUserNotLoggedInForFieldsPublicSchemaTypeResolverDecorator extends AbstractValidateBasedOnUserStateForFieldsPublicSchemaTypeResolverDecorator
{
    protected function removeFieldNameBasedOnUserState(array $states): bool
    {
        return in_array(UserStates::OUT, $states);
    }
    protected function getValidateUserStateDirectiveResolverClass(): string
    {
        return ValidateIsUserNotLoggedInDirectiveResolver::class;
    }
}
