<?php

declare (strict_types=1);
namespace ConfigTransformer202108165\PhpParser\Lexer\TokenEmulator;

use ConfigTransformer202108165\PhpParser\Lexer\Emulative;
final class MatchTokenEmulator extends \ConfigTransformer202108165\PhpParser\Lexer\TokenEmulator\KeywordEmulator
{
    public function getPhpVersion() : string
    {
        return \ConfigTransformer202108165\PhpParser\Lexer\Emulative::PHP_8_0;
    }
    public function getKeywordString() : string
    {
        return 'match';
    }
    public function getKeywordToken() : int
    {
        return \T_MATCH;
    }
}
