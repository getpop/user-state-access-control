<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\UserStateAccessControl\ComponentConfiguration;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\Facades\Schema\FieldQueryInterpreterFacade;
use PoP\AccessControl\TypeResolverDecorators\AbstractPublicSchemaTypeResolverDecorator;

abstract class AbstractValidateBasedOnUserStateForDirectivesPublicSchemaTypeResolverDecorator extends AbstractPublicSchemaTypeResolverDecorator
{
    use ValidateConditionForDirectivesPublicSchemaTypeResolverDecoratorTrait;

    protected function getEntryList(): array
    {
        return ComponentConfiguration::getRestrictedDirectivesByUserState();
    }

    public function getMandatoryDirectivesForDirectives(TypeResolverInterface $typeResolver): array
    {
        $mandatoryDirectivesForDirectives = [];
        $fieldQueryInterpreter = FieldQueryInterpreterFacade::getInstance();
        $entryList = ComponentConfiguration::getRestrictedDirectivesByUserState();
        $validateUserStateDirective = $this->getValidateUserStateDirectiveResolverClass();
        $validateUserStateDirectiveName = $validateUserStateDirective::getDirectiveName();
        $validateUserStateDirective = $fieldQueryInterpreter->getDirective(
            $validateUserStateDirectiveName
        );
        if ($matchingEntries = $this->getMatchingEntriesFromConfiguration(
            $entryList,
            $this->getRequiredEntryState()
        )) {
            $directiveResolverClasses = array_values(array_unique(array_map(
                function($entry) {
                    return $entry[0];
                },
                $matchingEntries
            )));
            foreach ($directiveResolverClasses as $directiveResolverClass) {
                $directiveName = $directiveResolverClass::getDirectiveName();
                $mandatoryDirectivesForDirectives[$directiveName] = [
                    $validateUserStateDirective,
                ];
            }
        }
        return $mandatoryDirectivesForDirectives;
    }

    abstract protected function getValidateUserStateDirectiveResolverClass(): string;
    abstract protected function getRequiredEntryState(): string;

    public function enabled(TypeResolverInterface $typeResolver): bool
    {
        return parent::enabled($typeResolver) && !empty(static::getEntryList());
    }
}
