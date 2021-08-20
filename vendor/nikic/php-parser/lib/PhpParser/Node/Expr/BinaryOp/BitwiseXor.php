<?php

declare (strict_types=1);
namespace ConfigTransformer202108202\PhpParser\Node\Expr\BinaryOp;

use ConfigTransformer202108202\PhpParser\Node\Expr\BinaryOp;
class BitwiseXor extends \ConfigTransformer202108202\PhpParser\Node\Expr\BinaryOp
{
    public function getOperatorSigil() : string
    {
        return '^';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_BitwiseXor';
    }
}
