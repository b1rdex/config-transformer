<?php

declare (strict_types=1);
namespace ConfigTransformer202111246\PhpParser\Node\Expr\BinaryOp;

use ConfigTransformer202111246\PhpParser\Node\Expr\BinaryOp;
class Identical extends \ConfigTransformer202111246\PhpParser\Node\Expr\BinaryOp
{
    public function getOperatorSigil() : string
    {
        return '===';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_Identical';
    }
}
