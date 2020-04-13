<?php

declare(strict_types=1);

namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\UserStateAccessControl\Services\AccessControlGroups;
use PoP\AccessControl\TypeResolverDecorators\AbstractConfigurableAccessControlForFieldsInPublicSchemaTypeResolverDecorator;
use PoP\UserStateAccessControl\TypeResolverDecorators\UserStateConfigurableAccessControlInPublicSchemaTypeResolverDecoratorTrait;

abstract class AbstractUserStateConfigurableAccessControlForFieldsInPublicSchemaTypeResolverDecorator extends AbstractConfigurableAccessControlForFieldsInPublicSchemaTypeResolverDecorator
{
    use UserStateConfigurableAccessControlInPublicSchemaTypeResolverDecoratorTrait;

    protected static function getConfigurationEntries(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForFields(AccessControlGroups::STATE);
    }
}
