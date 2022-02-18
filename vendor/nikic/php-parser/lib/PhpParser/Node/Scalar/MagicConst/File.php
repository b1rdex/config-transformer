<?php

declare (strict_types=1);
namespace ConfigTransformer202202180\PhpParser\Node\Scalar\MagicConst;

use ConfigTransformer202202180\PhpParser\Node\Scalar\MagicConst;
class File extends \ConfigTransformer202202180\PhpParser\Node\Scalar\MagicConst
{
    public function getName() : string
    {
        return '__FILE__';
    }
    public function getType() : string
    {
        return 'Scalar_MagicConst_File';
    }
}
