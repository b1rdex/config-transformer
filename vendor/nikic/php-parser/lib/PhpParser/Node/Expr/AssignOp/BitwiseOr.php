<?php

declare (strict_types=1);
namespace ConfigTransformer202110072\PhpParser\Node\Expr\AssignOp;

use ConfigTransformer202110072\PhpParser\Node\Expr\AssignOp;
class BitwiseOr extends \ConfigTransformer202110072\PhpParser\Node\Expr\AssignOp
{
    public function getType() : string
    {
        return 'Expr_AssignOp_BitwiseOr';
    }
}
