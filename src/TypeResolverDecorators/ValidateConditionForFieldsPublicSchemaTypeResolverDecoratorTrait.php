<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\UserStateAccessControl\ConfigurationEntries\MaybeDisableFieldsIfConditionTrait;

trait ValidateConditionForFieldsPublicSchemaTypeResolverDecoratorTrait
{
    use MaybeDisableFieldsIfConditionTrait;

    public function enabled(TypeResolverInterface $typeResolver): bool
    {
        return parent::enabled($typeResolver) && !empty(self::getConfiguredEntryList());
    }

    public static function getClassesToAttachTo(): array
    {
        return array_map(
            function($configuredEntry) {
                // The tuple has format [typeResolverClass, fieldName] or [typeResolverClass, fieldName, $role] or [typeResolverClass, fieldName, $capability]
                // So, in position [0], will always be the $typeResolverClass
                return $configuredEntry[0];
            },
            self::getConfiguredEntryList()
        );
    }
}
