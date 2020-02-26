<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\UserState\DirectiveResolvers\ValidateIsUserNotLoggedInDirectiveResolver;
use PoP\UserStateAccessControl\Hooks\AbstractMaybeDisableFieldsBasedOnUserStatePrivateSchemaHookSet;

class ValidateUserNotLoggedInForDirectivesPublicSchemaTypeResolverDecorator extends AbstractValidateBasedOnUserStateForDirectivesPublicSchemaTypeResolverDecorator
{
    protected function getConfiguredEntryState(): string
    {
        return AbstractMaybeDisableFieldsBasedOnUserStatePrivateSchemaHookSet::CONFIGURATION_VALUE_OUT;
    }
    protected function getValidateUserStateDirectiveResolverClass(): string
    {
        return ValidateIsUserNotLoggedInDirectiveResolver::class;
    }
}
