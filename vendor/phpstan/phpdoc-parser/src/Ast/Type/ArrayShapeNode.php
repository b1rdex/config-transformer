<?php

declare (strict_types=1);
namespace ConfigTransformer2022030310\PHPStan\PhpDocParser\Ast\Type;

use ConfigTransformer2022030310\PHPStan\PhpDocParser\Ast\NodeAttributes;
class ArrayShapeNode implements \ConfigTransformer2022030310\PHPStan\PhpDocParser\Ast\Type\TypeNode
{
    use NodeAttributes;
    /** @var ArrayShapeItemNode[] */
    public $items;
    public function __construct(array $items)
    {
        $this->items = $items;
    }
    public function __toString() : string
    {
        return 'array{' . \implode(', ', $this->items) . '}';
    }
}