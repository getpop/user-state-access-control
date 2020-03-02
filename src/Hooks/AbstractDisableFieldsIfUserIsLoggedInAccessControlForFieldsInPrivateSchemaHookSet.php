<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\ComponentModel\Engine_Vars;
use PoP\AccessControl\Hooks\AbstractAccessControlForFieldsInPrivateSchemaHookSet;

abstract class AbstractDisableFieldsIfUserIsLoggedInAccessControlForFieldsInPrivateSchemaHookSet extends AbstractAccessControlForFieldsInPrivateSchemaHookSet
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
        $vars = Engine_Vars::getVars();
        return $vars['global-userstate']['is-user-logged-in'];
    }
}
