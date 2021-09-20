<?php

declare (strict_types=1);
namespace ConfigTransformer202109202\PhpParser\Lexer\TokenEmulator;

use ConfigTransformer202109202\PhpParser\Lexer\Emulative;
class ExplicitOctalEmulator extends \ConfigTransformer202109202\PhpParser\Lexer\TokenEmulator\TokenEmulator
{
    public function getPhpVersion() : string
    {
        return \ConfigTransformer202109202\PhpParser\Lexer\Emulative::PHP_8_1;
    }
    /**
     * @param string $code
     */
    public function isEmulationNeeded($code) : bool
    {
        return \strpos($code, '0o') !== \false || \strpos($code, '0O') !== \false;
    }
    /**
     * @param string $code
     * @param mixed[] $tokens
     */
    public function emulate($code, $tokens) : array
    {
        for ($i = 0, $c = \count($tokens); $i < $c; ++$i) {
            if ($tokens[$i][0] == \T_LNUMBER && $tokens[$i][1] === '0' && isset($tokens[$i + 1]) && $tokens[$i + 1][0] == \T_STRING && \preg_match('/[oO][0-7]+(?:_[0-7]+)*/', $tokens[$i + 1][1])) {
                $tokenKind = $this->resolveIntegerOrFloatToken($tokens[$i + 1][1]);
                \array_splice($tokens, $i, 2, [[$tokenKind, '0' . $tokens[$i + 1][1], $tokens[$i][2]]]);
                $c--;
            }
        }
        return $tokens;
    }
    private function resolveIntegerOrFloatToken(string $str) : int
    {
        $str = \substr($str, 1);
        $str = \str_replace('_', '', $str);
        $num = \octdec($str);
        return \is_float($num) ? \T_DNUMBER : \T_LNUMBER;
    }
    /**
     * @param string $code
     * @param mixed[] $tokens
     */
    public function reverseEmulate($code, $tokens) : array
    {
        // Explicit octals were not legal code previously, don't bother.
        return $tokens;
    }
}