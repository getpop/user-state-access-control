<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\UserStateAccessControl\ConfigurationEntries\MaybeDisableDirectivesIfConditionTrait;
use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;

trait ValidateConditionForDirectivesPublicSchemaTypeResolverDecoratorTrait
{
    use MaybeDisableDirectivesIfConditionTrait;

    public function enabled(TypeResolverInterface $typeResolver): bool
    {
        $calledClass = get_called_class();
        return parent::enabled($typeResolver) && !empty($calledClass::getConfiguredEntryList());
    }

    /**
     * Because the validation can be done on any directive applied to any typeResolver, then attach it to the base abstract class: AbstractTypeResolver::class
     *
     * @return array
     */
    public static function getClassesToAttachTo(): array
    {
        return [
            AbstractTypeResolver::class,
        ];
    }
}
