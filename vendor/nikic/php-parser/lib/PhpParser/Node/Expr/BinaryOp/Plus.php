<?php

declare (strict_types=1);
namespace ConfigTransformerPrefix202401\PhpParser\Node\Expr\BinaryOp;

use ConfigTransformerPrefix202401\PhpParser\Node\Expr\BinaryOp;
class Plus extends BinaryOp
{
    public function getOperatorSigil() : string
    {
        return '+';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_Plus';
    }
}
