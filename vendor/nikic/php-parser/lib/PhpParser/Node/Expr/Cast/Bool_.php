<?php

declare (strict_types=1);
namespace ConfigTransformer202211\PhpParser\Node\Expr\Cast;

use ConfigTransformer202211\PhpParser\Node\Expr\Cast;
class Bool_ extends Cast
{
    public function getType() : string
    {
        return 'Expr_Cast_Bool';
    }
}
