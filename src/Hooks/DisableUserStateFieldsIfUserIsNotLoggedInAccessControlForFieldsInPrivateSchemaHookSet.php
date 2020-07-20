<?php

declare(strict_types=1);

namespace PoP\UserStateAccessControl\Hooks;

use PoP\AccessControl\ComponentConfiguration;
use PoP\ComponentModel\State\ApplicationState;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\FieldResolvers\FieldResolverInterface;
use PoP\UserState\FieldResolvers\AbstractUserStateFieldResolver;
use PoP\AccessControl\Hooks\AbstractAccessControlForFieldsHookSet;

class DisableUserStateFieldsIfUserIsNotLoggedInAccessControlForFieldsInPrivateSchemaHookSet extends AbstractAccessControlForFieldsHookSet
{
    protected function enabled(): bool
    {
        return ComponentConfiguration::usePrivateSchemaMode() && !$this->isUserLoggedIn();
    }

    protected function isUserLoggedIn(): bool
    {
        /**
         * If the user is not logged in, then remove the field
         */
        $vars = ApplicationState::getVars();
        return $vars['global-userstate']['is-user-logged-in'];
    }

    /**
     * Apply to all fields
     *
     * @return array
     */
    protected function getFieldNames(): array
    {
        return [];
    }
    /**
     * Remove the fieldNames if the fieldResolver is an instance of the "user state" one
     *
     * @param boolean $include
     * @param TypeResolverInterface $typeResolver
     * @param FieldResolverInterface $fieldResolver
     * @param string $fieldName
     * @return boolean
     */
    protected function removeFieldName(TypeResolverInterface $typeResolver, FieldResolverInterface $fieldResolver, string $fieldName): bool
    {
        return $fieldResolver instanceof AbstractUserStateFieldResolver;
    }
}
