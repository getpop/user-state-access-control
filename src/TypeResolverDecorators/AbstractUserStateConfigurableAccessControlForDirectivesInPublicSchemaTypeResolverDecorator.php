<?php

declare(strict_types=1);

namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\UserStateAccessControl\Services\AccessControlGroups;
use PoP\AccessControl\TypeResolverDecorators\AbstractConfigurableAccessControlForDirectivesInPublicSchemaTypeResolverDecorator;
use PoP\UserStateAccessControl\TypeResolverDecorators\UserStateConfigurableAccessControlInPublicSchemaTypeResolverDecoratorTrait;

abstract class AbstractUserStateConfigurableAccessControlForDirectivesInPublicSchemaTypeResolverDecorator extends AbstractConfigurableAccessControlForDirectivesInPublicSchemaTypeResolverDecorator
{
    use UserStateConfigurableAccessControlInPublicSchemaTypeResolverDecoratorTrait;

    protected function getConfigurationEntries(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForDirectives(AccessControlGroups::STATE);
    }
}
