<?php
namespace PoP\UserStateAccessControl\Conditional\CacheControl\TypeResolverDecorators;

use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\UserStateAccessControl\Services\AccessControlGroups;
use PoP\ComponentModel\Facades\Schema\FieldQueryInterpreterFacade;
use PoP\CacheControl\DirectiveResolvers\AbstractCacheControlDirectiveResolver;
use PoP\AccessControl\TypeResolverDecorators\AbstractPrivateSchemaTypeResolverDecorator;
use PoP\UserStateAccessControl\TypeResolverDecorators\ValidateConditionForDirectivesPublicSchemaTypeResolverDecoratorTrait;

abstract class AbstractValidateBasedOnUserStateForDirectivesPrivateSchemaTypeResolverDecorator extends AbstractPrivateSchemaTypeResolverDecorator
{
    use ValidateConditionForDirectivesPublicSchemaTypeResolverDecoratorTrait;

    protected function getEntryList(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForDirectives(AccessControlGroups::STATE);
    }

    public function getMandatoryDirectivesForDirectives(TypeResolverInterface $typeResolver): array
    {
        $mandatoryDirectivesForDirectives = [];
        $fieldQueryInterpreter = FieldQueryInterpreterFacade::getInstance();
        $entryList = static::getEntryList();
        $noCacheControlDirectiveResolver = $fieldQueryInterpreter->getDirective(
            AbstractCacheControlDirectiveResolver::getDirectiveName(),
            [
                'maxAge' => 0,
            ]
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
                    $noCacheControlDirectiveResolver,
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