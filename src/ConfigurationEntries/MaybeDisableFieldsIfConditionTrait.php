<?php
namespace PoP\UserStateAccessControl\ConfigurationEntries;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;

trait MaybeDisableFieldsIfConditionTrait
{
    /**
     * Configuration entries
     *
     * @return array
     */
    abstract protected static function getConfiguredEntryList(): array;

    /**
     * Field names to remove
     *
     * @return array
     */
    protected function getFieldNames(): array
    {
        return array_map(
            function($configuredEntry) {
                // The tuple has format [typeResolverClass, fieldName] or [typeResolverClass, fieldName, $role] or [typeResolverClass, fieldName, $capability]
                // So, in position [1], will always be the $fieldName
                return $configuredEntry[1];
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
    protected function getMatchingEntriesFromConfiguration(array $configuredEntryList, TypeResolverInterface $typeResolver, string $fieldName): array
    {
        $typeResolverClass = get_class($typeResolver);
        return array_filter(
            $configuredEntryList,
            function($configuredEntry) use($typeResolverClass, $fieldName) {
                return $configuredEntry[0] == $typeResolverClass && $configuredEntry[1] == $fieldName;
            }
        );
    }
}
