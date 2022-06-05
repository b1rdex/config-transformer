<?php

declare (strict_types=1);
namespace ConfigTransformer202206056\Symplify\Astral\NodeNameResolver;

use ConfigTransformer202206056\PhpParser\Node;
use ConfigTransformer202206056\PhpParser\Node\Identifier;
use ConfigTransformer202206056\PhpParser\Node\Name;
use ConfigTransformer202206056\Symplify\Astral\Contract\NodeNameResolverInterface;
final class IdentifierNodeNameResolver implements \ConfigTransformer202206056\Symplify\Astral\Contract\NodeNameResolverInterface
{
    public function match(\ConfigTransformer202206056\PhpParser\Node $node) : bool
    {
        if ($node instanceof \ConfigTransformer202206056\PhpParser\Node\Identifier) {
            return \true;
        }
        return $node instanceof \ConfigTransformer202206056\PhpParser\Node\Name;
    }
    /**
     * @param Identifier|Name $node
     */
    public function resolve(\ConfigTransformer202206056\PhpParser\Node $node) : ?string
    {
        return (string) $node;
    }
}
