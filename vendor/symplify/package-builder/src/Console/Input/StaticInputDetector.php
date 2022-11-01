<?php

declare (strict_types=1);
namespace ConfigTransformer202211\Symplify\PackageBuilder\Console\Input;

use ConfigTransformer202211\Symfony\Component\Console\Input\ArgvInput;
/**
 * @api
 */
final class StaticInputDetector
{
    public static function isDebug() : bool
    {
        $argvInput = new ArgvInput();
        return $argvInput->hasParameterOption(['--debug', '-v', '-vv', '-vvv']);
    }
}
