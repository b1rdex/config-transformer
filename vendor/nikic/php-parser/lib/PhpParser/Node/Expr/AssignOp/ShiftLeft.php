<?php

declare (strict_types=1);
namespace ConfigTransformer202211\PhpParser\Node\Expr\AssignOp;

use ConfigTransformer202211\PhpParser\Node\Expr\AssignOp;
class ShiftLeft extends AssignOp
{
    public function getType() : string
    {
        return 'Expr_AssignOp_ShiftLeft';
    }
}
