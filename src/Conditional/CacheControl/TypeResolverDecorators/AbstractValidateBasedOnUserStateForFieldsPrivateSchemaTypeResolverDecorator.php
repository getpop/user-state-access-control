<?php
namespace PoP\UserStateAccessControl\Conditional\CacheControl\TypeResolverDecorators;

use PoP\CacheControl\Helpers\CacheControlHelper;
use PoP\AccessControl\TypeResolverDecorators\AbstractPublicSchemaTypeResolverDecorator;
use PoP\UserStateAccessControl\TypeResolverDecorators\ValidateConditionForFieldsTypeResolverDecoratorTrait;
use PoP\UserStateAccessControl\TypeResolverDecorators\ValidateBasedOnUserStateForFieldsTypeResolverDecoratorTrait;

abstract class AbstractValidateBasedOnUserStateForFieldsPrivateSchemaTypeResolverDecorator extends AbstractPublicSchemaTypeResolverDecorator
{
    use ValidateConditionForFieldsTypeResolverDecoratorTrait;
    use ValidateBasedOnUserStateForFieldsTypeResolverDecoratorTrait;

    protected function getMandatoryDirectives(): array
    {
        return [
            CacheControlHelper::getNoCacheDirective(),
        ];
    }
}
