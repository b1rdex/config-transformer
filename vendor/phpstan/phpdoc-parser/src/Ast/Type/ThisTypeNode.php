<?php

declare (strict_types=1);
namespace ConfigTransformer20220611\PHPStan\PhpDocParser\Ast\Type;

use ConfigTransformer20220611\PHPStan\PhpDocParser\Ast\NodeAttributes;
class ThisTypeNode implements TypeNode
{
    use NodeAttributes;
    public function __toString() : string
    {
        return '$this';
    }
}
