<?php
namespace PoP\UserStateAccessControl\Conditional\CacheControl\TypeResolverDecorators;

use PoP\UserStateAccessControl\ConfigurationEntries\UserStates;
use PoP\UserStateAccessControl\DirectiveResolvers\ValidateIsUserLoggedInDirectiveResolver;
use PoP\UserStateAccessControl\Conditional\CacheControl\TypeResolverDecorators\AbstractValidateBasedOnUserStateForFieldsPrivateSchemaTypeResolverDecorator;

class ValidateUserLoggedInForFieldsPrivateSchemaTypeResolverDecorator extends AbstractValidateBasedOnUserStateForFieldsPrivateSchemaTypeResolverDecorator
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
