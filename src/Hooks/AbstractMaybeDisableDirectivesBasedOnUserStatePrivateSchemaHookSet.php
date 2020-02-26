<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\UserStateAccessControl\ComponentConfiguration;
use PoP\UserState\Facades\UserStateTypeDataResolverFacade;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\API\Hooks\AbstractMaybeDisableDirectivesInPrivateSchemaHookSet;

abstract class AbstractMaybeDisableDirectivesBasedOnUserStatePrivateSchemaHookSet extends AbstractMaybeDisableDirectivesInPrivateSchemaHookSet
{
    protected function enabled(): bool
    {
        $userStateTypeDataResolver = UserStateTypeDataResolverFacade::getInstance();
        $isUserLoggedIn = $userStateTypeDataResolver->isUserLoggedIn();
        return parent::enabled() && !empty($this->getMatchingEntries()) && $this->enableBasedOnUserState($isUserLoggedIn);
    }

    abstract protected function enableBasedOnUserState(bool $isUserLoggedIn): bool;

    /**
     * Configuration entries
     *
     * @return array
     */
    protected function getMatchingEntries(): array
    {
        return $this->getMatchingEntriesFromConfiguration(
            $this->getConfiguredEntryList(),
            $this->getEntryValue()
        );
    }

    /**
     * Configuration entries
     *
     * @return array
     */
    protected function getConfiguredEntryList(): array
    {
        return ComponentConfiguration::getRestrictedDirectivesByUserState();
    }

    /**
     * Remove directiveName "translate" if the user is not logged in
     *
     * @param boolean $include
     * @param TypeResolverInterface $typeResolver
     * @param string $directiveName
     * @return boolean
     */
    protected function getDirectiveResolverClasses(): array
    {
        // Obtain all entries for the current combination of typeResolver/fieldName
        return array_values(array_unique(array_map(
            function($entry) {
                return $entry[0];
            },
            $this->getMatchingEntries()
        )));
    }

    protected abstract function getEntryValue(): string;

    /**
     * Filter all the entries from the list which apply to the passed typeResolver and fieldName
     *
     * @param boolean $include
     * @param array $configuredEntryList
     * @param TypeResolverInterface $typeResolver
     * @param string $fieldName
     * @return boolean
     */
    protected function getMatchingEntriesFromConfiguration(array $configuredEntryList, string $value): array
    {
        return array_filter(
            $configuredEntryList,
            function($configuredEntry) use($value) {
                return $configuredEntry[1] == $value;
            }
        );
    }
}
