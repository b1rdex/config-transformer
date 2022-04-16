<?php

declare (strict_types=1);
namespace ConfigTransformer202204164\PHPStan\PhpDocParser\Ast\ConstExpr;

use ConfigTransformer202204164\PHPStan\PhpDocParser\Ast\NodeAttributes;
class ConstExprTrueNode implements \ConfigTransformer202204164\PHPStan\PhpDocParser\Ast\ConstExpr\ConstExprNode
{
    use NodeAttributes;
    public function __toString() : string
    {
        return 'true';
    }
}
