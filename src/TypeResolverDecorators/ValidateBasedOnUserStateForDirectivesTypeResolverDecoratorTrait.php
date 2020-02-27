<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\UserStateAccessControl\Services\AccessControlGroups;

trait ValidateBasedOnUserStateForDirectivesTypeResolverDecoratorTrait
{
    use ValidateConditionForDirectivesTypeResolverDecoratorTrait;

    protected function getEntryList(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForDirectives(AccessControlGroups::STATE);
    }

    abstract protected function getMandatoryDirectives(): array;

    public function getMandatoryDirectivesForDirectives(TypeResolverInterface $typeResolver): array
    {
        $mandatoryDirectivesForDirectives = [];
        $entryList = static::getEntryList();

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
                $mandatoryDirectivesForDirectives[$directiveName] = $this->getMandatoryDirectives();
            }
        }
        return $mandatoryDirectivesForDirectives;
    }

    abstract protected function getValidateUserStateDirectiveResolverClass(): string;
    abstract protected function getRequiredEntryState(): string;
}
