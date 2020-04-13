<?php

declare(strict_types=1);

namespace PoP\UserStateAccessControl\DirectiveResolvers;

class ValidateIsUserNotLoggedInForDirectivesDirectiveResolver extends ValidateIsUserNotLoggedInDirectiveResolver
{
    const DIRECTIVE_NAME = 'validateIsUserNotLoggedInForDirectives';
    public static function getDirectiveName(): string
    {
        return self::DIRECTIVE_NAME;
    }

    protected function isValidatingDirective(): bool
    {
        return true;
    }
}
