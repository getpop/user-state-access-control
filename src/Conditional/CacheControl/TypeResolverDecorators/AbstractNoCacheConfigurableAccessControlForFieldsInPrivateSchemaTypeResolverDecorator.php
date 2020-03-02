<?php
namespace PoP\UserStateAccessControl\Conditional\CacheControl\TypeResolverDecorators;

use PoP\AccessControl\TypeResolverDecorators\AbstractConfigurableAccessControlForFieldsInPrivateSchemaTypeResolverDecorator;
use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\UserStateAccessControl\Services\AccessControlGroups;

abstract class AbstractNoCacheConfigurableAccessControlForFieldsInPrivateSchemaTypeResolverDecorator extends AbstractConfigurableAccessControlForFieldsInPrivateSchemaTypeResolverDecorator
{
    use NoCacheConfigurableAccessControlTypeResolverDecoratorTrait;

    protected static function getConfigurationEntries(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForFields(AccessControlGroups::STATE);
    }
}
