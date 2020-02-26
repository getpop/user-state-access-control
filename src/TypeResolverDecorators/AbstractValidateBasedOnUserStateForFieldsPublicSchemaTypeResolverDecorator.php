<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\UserStateAccessControl\ComponentConfiguration;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\Facades\Schema\FieldQueryInterpreterFacade;
use PoP\ComponentModel\TypeResolverDecorators\AbstractPublicSchemaTypeResolverDecorator;

abstract class AbstractValidateBasedOnUserStateForFieldsPublicSchemaTypeResolverDecorator extends AbstractPublicSchemaTypeResolverDecorator
{
    use ValidateConditionForFieldsPublicSchemaTypeResolverDecoratorTrait;

    protected static function getConfiguredEntryList(): array
    {
        return ComponentConfiguration::getRestrictedFieldsByUserState();
    }

    public function getMandatoryDirectivesForFields(TypeResolverInterface $typeResolver): array
    {
        $mandatoryDirectivesForFields = [];
        $fieldQueryInterpreter = FieldQueryInterpreterFacade::getInstance();
        $configuredEntryList = ComponentConfiguration::getRestrictedFieldsByUserState();
        $validateUserStateDirective = $this->getValidateUserStateDirectiveResolverClass();
        $validateUserStateDirectiveName = $validateUserStateDirective::getDirectiveName();
        $validateUserStateDirective = $fieldQueryInterpreter->getDirective(
            $validateUserStateDirectiveName
        );
        // Obtain all capabilities allowed for the current combination of typeResolver/fieldName
        foreach ($this->getFieldNames() as $fieldName) {
            if ($matchingEntries = $this->getMatchingEntriesFromConfiguration(
                $configuredEntryList,
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
        return parent::enabled($typeResolver) && !empty(self::getConfiguredEntryList());
    }
}
