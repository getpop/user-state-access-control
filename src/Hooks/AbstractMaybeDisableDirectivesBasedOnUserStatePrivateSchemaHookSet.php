<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\UserState\Facades\UserStateTypeDataResolverFacade;
use PoP\UserStateAccessControl\Services\AccessControlGroups;
use PoP\AccessControl\Hooks\AbstractMaybeDisableDirectivesInPrivateSchemaHookSet;

abstract class AbstractMaybeDisableDirectivesBasedOnUserStatePrivateSchemaHookSet extends AbstractMaybeDisableDirectivesInPrivateSchemaHookSet
{
    protected function enabled(): bool
    {
        $userStateTypeDataResolver = UserStateTypeDataResolverFacade::getInstance();
        $isUserLoggedIn = $userStateTypeDataResolver->isUserLoggedIn();
        return parent::enabled() && $this->enableBasedOnUserState($isUserLoggedIn);
    }

    abstract protected function enableBasedOnUserState(bool $isUserLoggedIn): bool;

    /**
     * Configuration entries
     *
     * @return array
     */
    protected function getEntryList(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForDirectives(AccessControlGroups::STATE);
    }
}
