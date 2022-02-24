<?php

declare (strict_types=1);
namespace ConfigTransformer2022022410\PhpParser\Node\Expr\BinaryOp;

use ConfigTransformer2022022410\PhpParser\Node\Expr\BinaryOp;
class Mul extends \ConfigTransformer2022022410\PhpParser\Node\Expr\BinaryOp
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
