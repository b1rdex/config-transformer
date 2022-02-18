<?php

declare (strict_types=1);
namespace ConfigTransformer202202180\PhpParser\Node\Expr\BinaryOp;

use ConfigTransformer202202180\PhpParser\Node\Expr\BinaryOp;
class Mul extends \ConfigTransformer202202180\PhpParser\Node\Expr\BinaryOp
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
