<?php

declare(strict_types=1);

namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\UserStateAccessControl\ConfigurationEntries\UserStates;
use PoP\UserStateAccessControl\DirectiveResolvers\ValidateIsUserNotLoggedInForDirectivesDirectiveResolver;

trait ValidateUserNotLoggedInForDirectivesTypeResolverDecoratorTrait
{
    protected function getRequiredEntryValue(): ?string
    {
        return UserStates::OUT;
    }
    protected function getValidateUserStateDirectiveResolverClass(): string
    {
        return ValidateIsUserNotLoggedInForDirectivesDirectiveResolver::class;
    }
}
