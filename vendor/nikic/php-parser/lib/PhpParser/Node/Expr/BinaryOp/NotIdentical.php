<?php

declare (strict_types=1);
namespace ConfigTransformer202110212\PhpParser\Node\Expr\BinaryOp;

use ConfigTransformer202110212\PhpParser\Node\Expr\BinaryOp;
class NotIdentical extends \ConfigTransformer202110212\PhpParser\Node\Expr\BinaryOp
{
    public function getOperatorSigil() : string
    {
        return '!==';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_NotIdentical';
    }
}
