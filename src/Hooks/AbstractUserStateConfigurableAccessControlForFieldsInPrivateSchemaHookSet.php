<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\ComponentModel\Engine_Vars;
use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\UserStateAccessControl\Services\AccessControlGroups;
use PoP\AccessControl\Hooks\AbstractConfigurableAccessControlForFieldsInPrivateSchemaHookSet;

abstract class AbstractUserStateConfigurableAccessControlForFieldsInPrivateSchemaHookSet extends AbstractConfigurableAccessControlForFieldsInPrivateSchemaHookSet
{
    /**
     * Configuration entries
     *
     * @return array
     */
    protected static function getConfigurationEntries(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForFields(AccessControlGroups::STATE);
    }

    protected function removeFieldNameBasedOnMatchingEntryValue($entryValue): bool
    {
        // Obtain the user state: logged in or not
        $vars = Engine_Vars::getVars();
        $isUserLoggedIn = $vars['global-userstate']['is-user-logged-in'];
        // Let the implementation class decide if to remove the field or not
        return $this->removeFieldNameBasedOnUserState((string)$entryValue, $isUserLoggedIn);
    }

    abstract protected function removeFieldNameBasedOnUserState(string $entryValue, bool $isUserLoggedIn): bool;
}
