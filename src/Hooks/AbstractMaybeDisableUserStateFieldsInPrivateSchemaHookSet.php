<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\FieldResolvers\FieldResolverInterface;
use PoP\AccessControl\Hooks\AbstractMaybeDisableFieldsInPrivateSchemaHookSet;

abstract class AbstractMaybeDisableUserStateFieldsInPrivateSchemaHookSet extends AbstractMaybeDisableFieldsInPrivateSchemaHookSet
{
    public const HOOK_MAYBE_FILTER = __CLASS__.':maybeFilter';
    public function maybeFilterFieldName(bool $include, TypeResolverInterface $typeResolver, FieldResolverInterface $fieldResolver, string $fieldName): bool
    {
        // Results can't be cached! This is because, depending on the user being logged in or not, we will have different results
        // Then, through this hook we can set, if there is CacheControl, the maxAge to 0
        $hooksAPI = HooksAPIFacade::getInstance();
        $hooksAPI->doAction(self::HOOK_MAYBE_FILTER);

        // Now process the response
        return parent::maybeFilterFieldName($include, $typeResolver, $fieldResolver, $fieldName);
    }
}
