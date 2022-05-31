<?php

declare (strict_types=1);
namespace ConfigTransformer202205319\PHPStan\PhpDocParser\Ast\Type;

use ConfigTransformer202205319\PHPStan\PhpDocParser\Ast\NodeAttributes;
class ThisTypeNode implements \ConfigTransformer202205319\PHPStan\PhpDocParser\Ast\Type\TypeNode
{
    use NodeAttributes;
    public function __toString() : string
    {
        return '$this';
    }
}
