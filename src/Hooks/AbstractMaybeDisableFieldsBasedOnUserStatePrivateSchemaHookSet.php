<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\UserStateAccessControl\ComponentConfiguration;
use PoP\UserState\Facades\UserStateTypeDataResolverFacade;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\FieldResolvers\FieldResolverInterface;
use PoP\API\Hooks\AbstractMaybeDisableFieldsInPrivateSchemaHookSet;
use PoP\UserStateAccessControl\Hooks\MaybeDisableFieldsIfConditionPrivateSchemaHookSetTrait;

abstract class AbstractMaybeDisableFieldsBasedOnUserStatePrivateSchemaHookSet extends AbstractMaybeDisableFieldsInPrivateSchemaHookSet
{
    public const CONFIGURATION_VALUE_IN = 'in';
    public const CONFIGURATION_VALUE_OUT = 'out';

    use MaybeDisableFieldsIfConditionPrivateSchemaHookSetTrait;

    /**
     * Configuration entries
     *
     * @return array
     */
    protected static function getConfiguredEntryList(): array
    {
        return ComponentConfiguration::getRestrictedFieldsByUserState();
    }

    /**
     * Remove fieldName "roles" if the user is not logged in
     *
     * @param boolean $include
     * @param TypeResolverInterface $typeResolver
     * @param FieldResolverInterface $fieldResolver
     * @param string $fieldName
     * @return boolean
     */
    protected function removeFieldName(TypeResolverInterface $typeResolver, FieldResolverInterface $fieldResolver, string $fieldName): bool
    {
        // Obtain all entries for the current combination of typeResolver/fieldName
        if ($matchingEntries = $this->getMatchingEntriesFromConfiguration(
            ComponentConfiguration::getRestrictedFieldsByUserState(),
            $typeResolver,
            $fieldName
        )) {
            // Obtain the 3rd value on each entry: if the validation is "in" or "out"
            $configuredEntryStates = array_values(array_unique(array_map(
                function($entry) {
                    return $entry[2];
                },
                $matchingEntries
            )));
            // Obtain the user state: logged in or not
            $userStateTypeDataResolver = UserStateTypeDataResolverFacade::getInstance();
            $isUserLoggedIn = $userStateTypeDataResolver->isUserLoggedIn();
            // Let the implementation class decide if to remove the field or not
            return $this->removeFieldNameBasedOnUserState($configuredEntryStates, $isUserLoggedIn);
        }
        return false;
    }

    abstract protected function removeFieldNameBasedOnUserState(array $configuredEntryStates, bool $isUserLoggedIn): bool;
}
