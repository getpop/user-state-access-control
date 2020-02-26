<?php
namespace PoP\UserStateAccessControl\ConfigurationEntries;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;

trait MaybeDisableDirectivesIfConditionTrait
{
    /**
     * Configuration entries
     *
     * @return array
     */
    abstract protected static function getConfiguredEntryList(): array;

    /**
     * Directive names to remove
     *
     * @return array
     */
    protected function getDirectiveResolverClasses(): array
    {
        return array_map(
            function($configuredEntry) {
                // The entry has format [directiveResolverClass, value]
                // So, in position [0], will always be the $directiveResolverClass
                return $configuredEntry[0];
            },
           self::getConfiguredEntryList()
        );
    }

    /**
     * Filter all the entries from the list which apply to the passed typeResolver and fieldName
     *
     * @param boolean $include
     * @param array $configuredEntryList
     * @param TypeResolverInterface $typeResolver
     * @param string $fieldName
     * @return boolean
     */
    protected function getMatchingEntriesFromConfiguration(array $configuredEntryList, string $state): array
    {
        return array_filter(
            $configuredEntryList,
            function($configuredEntry) use($state) {
                return $configuredEntry[1] == $state;
            }
        );
    }
}
