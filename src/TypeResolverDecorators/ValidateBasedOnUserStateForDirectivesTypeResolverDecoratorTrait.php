<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\UserStateAccessControl\Services\AccessControlGroups;
use PoP\AccessControl\TypeResolverDecorators\ValidateConditionForDirectivesTypeResolverDecoratorTrait;
use PoP\AccessControl\TypeResolverDecorators\ValidateBasedOnConditionForDirectivesTypeResolverDecoratorTrait;

trait ValidateBasedOnUserStateForDirectivesTypeResolverDecoratorTrait
{
    use ValidateConditionForDirectivesTypeResolverDecoratorTrait;
    use ValidateBasedOnConditionForDirectivesTypeResolverDecoratorTrait;

    protected function getEntryList(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForDirectives(AccessControlGroups::STATE);
    }

    abstract protected function getValidateUserStateDirectiveResolverClass(): string;
}
