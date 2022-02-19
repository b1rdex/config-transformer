<?php

declare (strict_types=1);
namespace ConfigTransformer202202198\PhpParser\Node\Expr\BinaryOp;

use ConfigTransformer202202198\PhpParser\Node\Expr\BinaryOp;
class Pow extends \ConfigTransformer202202198\PhpParser\Node\Expr\BinaryOp
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
