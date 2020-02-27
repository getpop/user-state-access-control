<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\ComponentModel\Facades\Schema\FieldQueryInterpreterFacade;
use PoP\AccessControl\TypeResolverDecorators\AbstractPublicSchemaTypeResolverDecorator;
use PoP\UserStateAccessControl\TypeResolverDecorators\ValidateBasedOnUserStateForFieldsTypeResolverDecoratorTrait;

abstract class AbstractValidateBasedOnUserStateForFieldsPublicSchemaTypeResolverDecorator extends AbstractPublicSchemaTypeResolverDecorator
{
    use ValidateConditionForFieldsTypeResolverDecoratorTrait;
    use ValidateBasedOnUserStateForFieldsTypeResolverDecoratorTrait;

    protected function getMandatoryDirectives(): array
    {
        $fieldQueryInterpreter = FieldQueryInterpreterFacade::getInstance();
        $validateUserStateDirective = $this->getValidateUserStateDirectiveResolverClass();
        $validateUserStateDirectiveName = $validateUserStateDirective::getDirectiveName();
        return $fieldQueryInterpreter->getDirective(
            $validateUserStateDirectiveName
        );
    }
}
