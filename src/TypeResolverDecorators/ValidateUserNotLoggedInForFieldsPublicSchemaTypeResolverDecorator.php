<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\UserState\DirectiveResolvers\ValidateIsUserNotLoggedInDirectiveResolver;
use PoP\UserStateAccessControl\Hooks\AbstractMaybeDisableFieldsBasedOnUserStatePrivateSchemaHookSet;

class ValidateUserNotLoggedInForFieldsPublicSchemaTypeResolverDecorator extends AbstractValidateBasedOnUserStateForFieldsPublicSchemaTypeResolverDecorator
{
    protected function removeFieldNameBasedOnUserState(array $states): bool
    {
        return in_array(AbstractMaybeDisableFieldsBasedOnUserStatePrivateSchemaHookSet::CONFIGURATION_VALUE_OUT, $states);
    }
    protected function getValidateUserStateDirectiveResolverClass(): string
    {
        return ValidateIsUserNotLoggedInDirectiveResolver::class;
    }
}
