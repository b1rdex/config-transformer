<?php

declare (strict_types=1);
namespace ConfigTransformer202208\PhpParser\Node\Expr\Cast;

use ConfigTransformer202208\PhpParser\Node\Expr\Cast;
class Unset_ extends Cast
{
    public function getType() : string
    {
        return 'Expr_Cast_Unset';
    }
}
