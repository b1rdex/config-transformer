<?php

declare (strict_types=1);
namespace ConfigTransformer202205300\PHPStan\PhpDocParser\Ast\PhpDoc;

use ConfigTransformer202205300\PHPStan\PhpDocParser\Ast\NodeAttributes;
use ConfigTransformer202205300\PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use function trim;
class UsesTagValueNode implements \ConfigTransformer202205300\PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagValueNode
{
    use NodeAttributes;
    /** @var GenericTypeNode */
    public $type;
    /** @var string (may be empty) */
    public $description;
    public function __construct(\ConfigTransformer202205300\PHPStan\PhpDocParser\Ast\Type\GenericTypeNode $type, string $description)
    {
        $this->type = $type;
        $this->description = $description;
    }
    public function __toString() : string
    {
        return \trim("{$this->type} {$this->description}");
    }
}
