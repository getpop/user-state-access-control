<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\UserStateAccessControl\Services\AccessControlGroups;
use PoP\AccessControl\TypeResolverDecorators\ValidateBasedOnConditionForFieldsTypeResolverDecoratorTrait;

trait ValidateBasedOnUserStateForFieldsTypeResolverDecoratorTrait
{
    use ValidateBasedOnConditionForFieldsTypeResolverDecoratorTrait;

    protected static function getConfigurationEntries(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForFields(AccessControlGroups::STATE);
    }

    protected function removeFieldNameBasedOnMatchingEntryValue($entryValue): bool
    {
        return $this->removeFieldNameBasedOnUserState((string)$entryValue);
    }
    abstract protected function removeFieldNameBasedOnUserState(string $state): bool;
    abstract protected function getValidateUserStateDirectiveResolverClass(): string;
}
