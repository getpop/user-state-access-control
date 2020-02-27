<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\UserState\Facades\UserStateTypeDataResolverFacade;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\FieldResolvers\FieldResolverInterface;
use PoP\UserStateAccessControl\Hooks\AbstractMaybeDisableUserStateFieldsInPrivateSchemaHookSet;

abstract class AbstractMaybeDisableFieldsIfUserNotLoggedInPrivateSchemaHookSet extends AbstractMaybeDisableUserStateFieldsInPrivateSchemaHookSet
{
    /**
     * Decide if to remove the fieldNames
     *
     * @param TypeResolverInterface $typeResolver
     * @param FieldResolverInterface $fieldResolver
     * @param string $fieldName
     * @return boolean
     */
    protected function removeFieldName(TypeResolverInterface $typeResolver, FieldResolverInterface $fieldResolver, string $fieldName): bool
    {
        /**
         * If the user is not logged in, then remove the field
         */
        return !$this->isUserLoggedIn();
    }

    protected function isUserLoggedIn(): bool
    {
        /**
         * If the user is not logged in, then remove the field
         */
        $userStateTypeDataResolver = UserStateTypeDataResolverFacade::getInstance();
        return $userStateTypeDataResolver->isUserLoggedIn();
    }
}
