<?php
namespace PoP\UserStateAccessControl\Conditional\CacheControl\TypeResolverDecorators;

use PoP\CacheControl\Helpers\CacheControlHelper;
use PoP\AccessControl\TypeResolverDecorators\AbstractConfigurableAccessControlForDirectivesInPrivateSchemaTypeResolverDecorator;
use PoP\UserStateAccessControl\TypeResolverDecorators\ValidateBasedOnUserStateForDirectivesTypeResolverDecoratorTrait;

abstract class AbstractValidateBasedOnUserStateForDirectivesPrivateSchemaTypeResolverDecorator extends AbstractConfigurableAccessControlForDirectivesInPrivateSchemaTypeResolverDecorator
{
    use ValidateBasedOnUserStateForDirectivesTypeResolverDecoratorTrait;

    protected function getMandatoryDirectives($entryValue = null): array
    {
        return [
            CacheControlHelper::getNoCacheDirective(),
        ];
    }
}
