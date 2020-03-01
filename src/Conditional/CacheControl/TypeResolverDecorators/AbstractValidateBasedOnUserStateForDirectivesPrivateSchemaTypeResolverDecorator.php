<?php
namespace PoP\UserStateAccessControl\Conditional\CacheControl\TypeResolverDecorators;

use PoP\CacheControl\Helpers\CacheControlHelper;
use PoP\AccessControl\TypeResolverDecorators\AbstractPrivateSchemaTypeResolverDecorator;
use PoP\AccessControl\TypeResolverDecorators\ValidateConditionForDirectivesTypeResolverDecoratorTrait;
use PoP\UserStateAccessControl\TypeResolverDecorators\ValidateBasedOnUserStateForDirectivesTypeResolverDecoratorTrait;

abstract class AbstractValidateBasedOnUserStateForDirectivesPrivateSchemaTypeResolverDecorator extends AbstractPrivateSchemaTypeResolverDecorator
{
    use ValidateConditionForDirectivesTypeResolverDecoratorTrait;
    use ValidateBasedOnUserStateForDirectivesTypeResolverDecoratorTrait;

    protected function getMandatoryDirectives(): array
    {
        return [
            CacheControlHelper::getNoCacheDirective(),
        ];
    }
}
