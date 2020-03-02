<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\UserState\Facades\UserStateTypeDataResolverFacade;
use PoP\AccessControl\Hooks\AbstractAccessControlForFieldsInPrivateSchemaHookSet;

abstract class AbstractMaybeDisableFieldsIfUserLoggedInPrivateSchemaHookSet extends AbstractAccessControlForFieldsInPrivateSchemaHookSet
{
    protected function enabled(): bool
    {
        // If it is not a private schema, then already do not enable
        if (!parent::enabled()) {
            return false;
        }

        /**
         * If the user is logged in, then do not register field names
         */
        $userStateTypeDataResolver = UserStateTypeDataResolverFacade::getInstance();
        return $userStateTypeDataResolver->isUserLoggedIn();
    }
}
