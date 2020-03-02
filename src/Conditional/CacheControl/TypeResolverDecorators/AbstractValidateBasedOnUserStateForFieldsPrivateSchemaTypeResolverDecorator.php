<?php
namespace PoP\UserStateAccessControl\Conditional\CacheControl\TypeResolverDecorators;

use PoP\CacheControl\Helpers\CacheControlHelper;
use PoP\AccessControl\TypeResolverDecorators\AbstractPublicSchemaTypeResolverDecorator;
use PoP\AccessControl\TypeResolverDecorators\ConfigurableAccessControlForFieldsTypeResolverDecoratorTrait;
use PoP\UserStateAccessControl\TypeResolverDecorators\ValidateBasedOnUserStateForFieldsTypeResolverDecoratorTrait;

abstract class AbstractValidateBasedOnUserStateForFieldsPrivateSchemaTypeResolverDecorator extends AbstractPublicSchemaTypeResolverDecorator
{
    use ConfigurableAccessControlForFieldsTypeResolverDecoratorTrait;
    use ValidateBasedOnUserStateForFieldsTypeResolverDecoratorTrait;

    protected function getMandatoryDirectives($entryValue = null): array
    {
        return [
            CacheControlHelper::getNoCacheDirective(),
        ];
    }
}
