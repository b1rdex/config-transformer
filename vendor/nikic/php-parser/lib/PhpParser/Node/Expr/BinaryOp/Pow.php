<?php

declare (strict_types=1);
namespace ConfigTransformer202204145\PhpParser\Node\Expr\BinaryOp;

use ConfigTransformer202204145\PhpParser\Node\Expr\BinaryOp;
class Pow extends \ConfigTransformer202204145\PhpParser\Node\Expr\BinaryOp
{
    public function getOperatorSigil() : string
    {
        return '**';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_Pow';
    }
}
