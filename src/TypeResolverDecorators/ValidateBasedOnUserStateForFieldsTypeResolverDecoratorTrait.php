<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\UserStateAccessControl\Services\AccessControlGroups;
use PoP\AccessControl\TypeResolverDecorators\ValidateBasedOnConditionForFieldsTypeResolverDecoratorTrait;

trait ValidateBasedOnUserStateForFieldsTypeResolverDecoratorTrait
{
    use ValidateBasedOnConditionForFieldsTypeResolverDecoratorTrait;

    protected static function getEntryList(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForFields(AccessControlGroups::STATE);
    }

    protected function removeFieldNameBasedOnCondition(array $states): bool
    {
        return $this->removeFieldNameBasedOnUserState($states);
    }
    abstract protected function removeFieldNameBasedOnUserState(array $states): bool;
    abstract protected function getValidateUserStateDirectiveResolverClass(): string;
}
