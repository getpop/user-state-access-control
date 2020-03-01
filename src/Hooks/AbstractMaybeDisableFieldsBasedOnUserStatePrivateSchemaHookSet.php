<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\UserState\Facades\UserStateTypeDataResolverFacade;
use PoP\UserStateAccessControl\Services\AccessControlGroups;
use PoP\AccessControl\Hooks\AbstractMaybeDisableFieldsIfConditionInPrivateSchemaHookSet;

abstract class AbstractMaybeDisableFieldsBasedOnUserStatePrivateSchemaHookSet extends AbstractMaybeDisableFieldsIfConditionInPrivateSchemaHookSet
{
    /**
     * Configuration entries
     *
     * @return array
     */
    protected static function getEntryList(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForFields(AccessControlGroups::STATE);
    }

    protected function removeFieldNameBasedOnCondition(array $configuredEntryStates): bool
    {
        // Obtain the user state: logged in or not
        $userStateTypeDataResolver = UserStateTypeDataResolverFacade::getInstance();
        $isUserLoggedIn = $userStateTypeDataResolver->isUserLoggedIn();
        // Let the implementation class decide if to remove the field or not
        return $this->removeFieldNameBasedOnUserState($configuredEntryStates, $isUserLoggedIn);
    }

    abstract protected function removeFieldNameBasedOnUserState(array $configuredEntryStates, bool $isUserLoggedIn): bool;
}
