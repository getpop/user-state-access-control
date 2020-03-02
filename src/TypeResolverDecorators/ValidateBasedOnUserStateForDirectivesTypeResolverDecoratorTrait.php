<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\UserStateAccessControl\Services\AccessControlGroups;
use PoP\AccessControl\TypeResolverDecorators\ValidateBasedOnConditionForDirectivesTypeResolverDecoratorTrait;

trait ValidateBasedOnUserStateForDirectivesTypeResolverDecoratorTrait
{
    use ValidateBasedOnConditionForDirectivesTypeResolverDecoratorTrait;

    protected function getConfigurationEntries(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForDirectives(AccessControlGroups::STATE);
    }

    abstract protected function getValidateUserStateDirectiveResolverClass(): string;
}
