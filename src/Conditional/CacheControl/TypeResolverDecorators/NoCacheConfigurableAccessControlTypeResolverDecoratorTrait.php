<?php
namespace PoP\UserStateAccessControl\Conditional\CacheControl\TypeResolverDecorators;

use PoP\CacheControl\Helpers\CacheControlHelper;

trait NoCacheConfigurableAccessControlTypeResolverDecoratorTrait
{
    protected function getMandatoryDirectives($entryValue = null): array
    {
        return [
            CacheControlHelper::getNoCacheDirective(),
        ];
    }
}
