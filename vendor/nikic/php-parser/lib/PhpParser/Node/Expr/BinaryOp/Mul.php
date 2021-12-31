<?php

declare (strict_types=1);
namespace ConfigTransformer202112316\PhpParser\Node\Expr\BinaryOp;

use ConfigTransformer202112316\PhpParser\Node\Expr\BinaryOp;
class Mul extends \ConfigTransformer202112316\PhpParser\Node\Expr\BinaryOp
{
    public function getOperatorSigil() : string
    {
        return '*';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_Mul';
    }
}
