<?php

declare(strict_types=1);

namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\UserStateAccessControl\ConfigurationEntries\UserStates;
use PoP\UserStateAccessControl\DirectiveResolvers\ValidateIsUserNotLoggedInDirectiveResolver;

trait ValidateUserNotLoggedInForFieldsTypeResolverDecoratorTrait
{
    protected function removeFieldNameBasedOnMatchingEntryValue($entryValue = null): bool
    {
        return UserStates::OUT == $entryValue;
    }
    protected function getValidateUserStateDirectiveResolverClass(): string
    {
        return ValidateIsUserNotLoggedInDirectiveResolver::class;
    }
}
