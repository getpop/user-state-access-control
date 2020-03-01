<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\AccessControl\ConfigurationEntries\MaybeDisableFieldsIfConditionTrait;

trait MaybeDisableFieldsIfConditionPrivateSchemaHookSetTrait
{
    use MaybeDisableFieldsIfConditionTrait;

    protected function enabled(): bool
    {
        return parent::enabled() && !empty(static::getEntryList());
    }
}
