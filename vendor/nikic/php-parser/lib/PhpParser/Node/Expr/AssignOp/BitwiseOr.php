<?php

declare (strict_types=1);
namespace ConfigTransformer202107211\PhpParser\Node\Expr\AssignOp;

use ConfigTransformer202107211\PhpParser\Node\Expr\AssignOp;
class BitwiseOr extends \ConfigTransformer202107211\PhpParser\Node\Expr\AssignOp
{
    public function getType() : string
    {
        return 'Expr_AssignOp_BitwiseOr';
    }
}
