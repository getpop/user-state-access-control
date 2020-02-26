<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\UserStateAccessControl\ConfigurationEntries\MaybeDisableFieldsIfConditionTrait;

trait MaybeDisableFieldsIfConditionPrivateSchemaHookSetTrait
{
    use MaybeDisableFieldsIfConditionTrait;

    protected function enabled(): bool
    {
        return parent::enabled() && !empty(self::getConfiguredEntryList());
    }
}
