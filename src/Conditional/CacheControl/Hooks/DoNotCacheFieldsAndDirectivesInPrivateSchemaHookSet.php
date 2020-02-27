<?php
namespace PoP\UserStateAccessControl\Conditional\CacheControl\Hooks;

use PoP\CacheControl\Facades\CacheControlManagerFacade;
use PoP\Engine\Hooks\AbstractHookSet;
use PoP\UserStateAccessControl\Hooks\AbstractMaybeDisableUserStateDirectivesInPrivateSchemaHookSet;
use PoP\UserStateAccessControl\Hooks\AbstractMaybeDisableUserStateFieldsInPrivateSchemaHookSet;

class DoNotCacheFieldsAndDirectivesInPrivateSchemaHookSet extends AbstractHookSet
{
    protected function init()
    {
        // Response can't be cached, then set the cache maxAge to 0
        $this->hooksAPI->addAction(
            AbstractMaybeDisableUserStateDirectivesInPrivateSchemaHookSet::HOOK_MAYBE_FILTER,
            array($this, 'setNoCache')
        );
        $this->hooksAPI->addAction(
            AbstractMaybeDisableUserStateFieldsInPrivateSchemaHookSet::HOOK_MAYBE_FILTER,
            array($this, 'setNoCache')
        );
    }
    public function setNoCache(): void
    {
        $cacheControlManager = CacheControlManagerFacade::getInstance();
        $cacheControlManager->addMaxAge(0);
    }
}
