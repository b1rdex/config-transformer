<?php

declare (strict_types=1);
namespace ConfigTransformer2022053010\PHPStan\PhpDocParser\Ast\Type;

use ConfigTransformer2022053010\PHPStan\PhpDocParser\Ast\NodeAttributes;
use function implode;
class GenericTypeNode implements \ConfigTransformer2022053010\PHPStan\PhpDocParser\Ast\Type\TypeNode
{
    use NodeAttributes;
    /** @var IdentifierTypeNode */
    public $type;
    /** @var TypeNode[] */
    public $genericTypes;
    public function __construct(\ConfigTransformer2022053010\PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode $type, array $genericTypes)
    {
        $this->type = $type;
        $this->genericTypes = $genericTypes;
    }
    public function __toString() : string
    {
        return $this->type . '<' . \implode(', ', $this->genericTypes) . '>';
    }
}
