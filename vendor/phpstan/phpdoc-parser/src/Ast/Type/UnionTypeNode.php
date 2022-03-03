<?php

declare (strict_types=1);
namespace ConfigTransformer2022030310\PHPStan\PhpDocParser\Ast\Type;

use ConfigTransformer2022030310\PHPStan\PhpDocParser\Ast\NodeAttributes;
class UnionTypeNode implements \ConfigTransformer2022030310\PHPStan\PhpDocParser\Ast\Type\TypeNode
{
    use NodeAttributes;
    /** @var TypeNode[] */
    public $types;
    public function __construct(array $types)
    {
        $this->types = $types;
    }
    public function __toString() : string
    {
        return '(' . \implode(' | ', $this->types) . ')';
    }
}