<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\FieldResolvers\FieldResolverInterface;
use PoP\UserState\FieldResolvers\AbstractUserStateFieldResolver;
use PoP\UserStateAccessControl\Hooks\AbstractDisableFieldsIfUserIsNotLoggedInAccessControlForFieldsInPrivateSchemaHookSet;

class DisableUserStateFieldsIfUserIsNotLoggedInAccessControlForFieldsInPrivateSchemaHookSet extends AbstractDisableFieldsIfUserIsNotLoggedInAccessControlForFieldsInPrivateSchemaHookSet
{
    protected function enabled(): bool
    {
        return parent::enabled() && !$this->isUserLoggedIn();
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
