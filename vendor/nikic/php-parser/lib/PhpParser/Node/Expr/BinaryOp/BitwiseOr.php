<?php

declare (strict_types=1);
namespace ConfigTransformer202205300\PhpParser\Node\Expr\BinaryOp;

use ConfigTransformer202205300\PhpParser\Node\Expr\BinaryOp;
class BitwiseOr extends \ConfigTransformer202205300\PhpParser\Node\Expr\BinaryOp
{
    public function getOperatorSigil() : string
    {
        return '|';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_BitwiseOr';
    }
}
