<?php

declare (strict_types=1);
namespace ConfigTransformer2021083010\PhpParser\Node\Scalar\MagicConst;

use ConfigTransformer2021083010\PhpParser\Node\Scalar\MagicConst;
class Class_ extends \ConfigTransformer2021083010\PhpParser\Node\Scalar\MagicConst
{
    public function getName() : string
    {
        return '__CLASS__';
    }
    public function getType() : string
    {
        return 'Scalar_MagicConst_Class';
    }
}
