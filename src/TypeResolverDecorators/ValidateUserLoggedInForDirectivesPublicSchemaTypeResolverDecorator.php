<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\UserState\DirectiveResolvers\ValidateIsUserLoggedInDirectiveResolver;
use PoP\UserStateAccessControl\Hooks\AbstractMaybeDisableFieldsBasedOnUserStatePrivateSchemaHookSet;

class ValidateUserLoggedInForDirectivesPublicSchemaTypeResolverDecorator extends AbstractValidateBasedOnUserStateForDirectivesPublicSchemaTypeResolverDecorator
{
    protected function getConfiguredEntryState(): string
    {
        return AbstractMaybeDisableFieldsBasedOnUserStatePrivateSchemaHookSet::CONFIGURATION_VALUE_IN;
    }
    protected function getValidateUserStateDirectiveResolverClass(): string
    {
        return ValidateIsUserLoggedInDirectiveResolver::class;
    }
}
