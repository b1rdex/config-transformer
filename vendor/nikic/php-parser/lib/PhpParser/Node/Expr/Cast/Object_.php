<?php

declare (strict_types=1);
namespace ConfigTransformerPrefix202301\PhpParser\Node\Expr\Cast;

use ConfigTransformerPrefix202301\PhpParser\Node\Expr\Cast;
class Object_ extends Cast
{
    public function getType() : string
    {
        return 'Expr_Cast_Object';
    }
}
