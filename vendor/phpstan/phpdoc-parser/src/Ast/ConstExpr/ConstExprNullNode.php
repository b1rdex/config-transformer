<?php

declare (strict_types=1);
namespace ConfigTransformer202205123\PHPStan\PhpDocParser\Ast\ConstExpr;

use ConfigTransformer202205123\PHPStan\PhpDocParser\Ast\NodeAttributes;
class ConstExprNullNode implements \ConfigTransformer202205123\PHPStan\PhpDocParser\Ast\ConstExpr\ConstExprNode
{
    use NodeAttributes;
    public function __toString() : string
    {
        return 'null';
    }
}
