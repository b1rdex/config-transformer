<?php

declare (strict_types=1);
namespace ConfigTransformer202111246\PhpParser\Node\Expr\AssignOp;

use ConfigTransformer202111246\PhpParser\Node\Expr\AssignOp;
class Plus extends \ConfigTransformer202111246\PhpParser\Node\Expr\AssignOp
{
    public function getType() : string
    {
        return 'Expr_AssignOp_Plus';
    }
}
