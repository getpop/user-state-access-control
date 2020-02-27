<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\UserStateAccessControl\Services\AccessControlGroups;

trait ValidateBasedOnUserStateForFieldsTypeResolverDecoratorTrait
{
    use ValidateConditionForFieldsTypeResolverDecoratorTrait;

    protected static function getEntryList(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForFields(AccessControlGroups::STATE);
    }

    abstract protected function getMandatoryDirectives(): array;

    public function getMandatoryDirectivesForFields(TypeResolverInterface $typeResolver): array
    {
        $mandatoryDirectivesForFields = [];
        $entryList = static::getEntryList();
        $mandatoryDirectives = $this->getMandatoryDirectives();
        // Obtain all capabilities allowed for the current combination of typeResolver/fieldName
        foreach ($this->getFieldNames() as $fieldName) {
            if ($matchingEntries = $this->getMatchingEntriesFromConfiguration(
                $entryList,
                $typeResolver,
                $fieldName
            )) {
                if ($states = array_values(array_unique(array_map(
                    function($entry) {
                        return $entry[2];
                    },
                    $matchingEntries
                )))) {
                    if ($this->removeFieldNameBasedOnUserState($states)) {
                        $mandatoryDirectivesForFields[$fieldName] = $mandatoryDirectives;
                    }
                }
            }
        }
        return $mandatoryDirectivesForFields;
    }

    abstract protected function removeFieldNameBasedOnUserState(array $states): bool;
    abstract protected function getValidateUserStateDirectiveResolverClass(): string;
}
