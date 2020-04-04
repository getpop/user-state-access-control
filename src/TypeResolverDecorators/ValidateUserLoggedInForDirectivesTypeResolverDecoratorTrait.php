<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\UserStateAccessControl\ConfigurationEntries\UserStates;
use PoP\UserStateAccessControl\DirectiveResolvers\ValidateIsUserLoggedInForDirectivesDirectiveResolver;

trait ValidateUserLoggedInForDirectivesTypeResolverDecoratorTrait
{
    protected function getRequiredEntryValue(): ?string
    {
        return UserStates::IN;
    }
    protected function getValidateUserStateDirectiveResolverClass(): string
    {
        return ValidateIsUserLoggedInForDirectivesDirectiveResolver::class;
    }
}
