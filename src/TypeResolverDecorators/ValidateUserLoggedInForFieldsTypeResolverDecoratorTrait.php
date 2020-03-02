<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\UserStateAccessControl\ConfigurationEntries\UserStates;
use PoP\UserStateAccessControl\DirectiveResolvers\ValidateIsUserLoggedInDirectiveResolver;

trait ValidateUserLoggedInForFieldsTypeResolverDecoratorTrait
{
    protected function removeFieldNameBasedOnMatchingEntryValue(string $entryValue): bool
    {
        return UserStates::IN == $entryValue;
    }
    protected function getValidateUserStateDirectiveResolverClass(): string
    {
        return ValidateIsUserLoggedInDirectiveResolver::class;
    }
}
