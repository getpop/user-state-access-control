<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\UserState\DirectiveResolvers\ValidateIsUserLoggedInDirectiveResolver;
use PoP\UserStateAccessControl\Hooks\AbstractMaybeDisableFieldsBasedOnUserStatePrivateSchemaHookSet;

class ValidateUserLoggedInForFieldsPublicSchemaTypeResolverDecorator extends AbstractValidateBasedOnUserStateForFieldsPublicSchemaTypeResolverDecorator
{
    protected function removeFieldNameBasedOnUserState(array $states): bool
    {
        return in_array(AbstractMaybeDisableFieldsBasedOnUserStatePrivateSchemaHookSet::CONFIGURATION_VALUE_IN, $states);
    }
    protected function getValidateUserStateDirectiveResolverClass(): string
    {
        return ValidateIsUserLoggedInDirectiveResolver::class;
    }
}
