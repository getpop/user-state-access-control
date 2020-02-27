<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\UserStateAccessControl\ComponentConfiguration;
use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\UserStateAccessControl\Services\AccessControlGroups;
use PoP\ComponentModel\Facades\Schema\FieldQueryInterpreterFacade;
use PoP\AccessControl\TypeResolverDecorators\AbstractPublicSchemaTypeResolverDecorator;

abstract class AbstractValidateBasedOnUserStateForFieldsPublicSchemaTypeResolverDecorator extends AbstractPublicSchemaTypeResolverDecorator
{
    use ValidateConditionForFieldsPublicSchemaTypeResolverDecoratorTrait;

    protected static function getEntryList(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForFields(AccessControlGroups::STATE);
    }

    public function getMandatoryDirectivesForFields(TypeResolverInterface $typeResolver): array
    {
        $mandatoryDirectivesForFields = [];
        $fieldQueryInterpreter = FieldQueryInterpreterFacade::getInstance();
        $entryList = static::getEntryList();
        $validateUserStateDirective = $this->getValidateUserStateDirectiveResolverClass();
        $validateUserStateDirectiveName = $validateUserStateDirective::getDirectiveName();
        $validateUserStateDirective = $fieldQueryInterpreter->getDirective(
            $validateUserStateDirectiveName
        );
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
                        $mandatoryDirectivesForFields[$fieldName] = [
                            $validateUserStateDirective,
                        ];
                    }
                }
            }
        }
        return $mandatoryDirectivesForFields;
    }

    abstract protected function removeFieldNameBasedOnUserState(array $states): bool;
    abstract protected function getValidateUserStateDirectiveResolverClass(): string;

    public function enabled(TypeResolverInterface $typeResolver): bool
    {
        return parent::enabled($typeResolver) && !empty(static::getEntryList());
    }
}
