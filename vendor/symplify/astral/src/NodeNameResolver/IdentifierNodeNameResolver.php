<?php

declare (strict_types=1);
namespace ConfigTransformer2021082410\Symplify\Astral\NodeNameResolver;

use ConfigTransformer2021082410\PhpParser\Node;
use ConfigTransformer2021082410\PhpParser\Node\Identifier;
use ConfigTransformer2021082410\PhpParser\Node\Name;
use ConfigTransformer2021082410\Symplify\Astral\Contract\NodeNameResolverInterface;
final class IdentifierNodeNameResolver implements \ConfigTransformer2021082410\Symplify\Astral\Contract\NodeNameResolverInterface
{
    /**
     * @param \PhpParser\Node $node
     */
    public function match($node) : bool
    {
        if ($node instanceof \ConfigTransformer2021082410\PhpParser\Node\Identifier) {
            return \true;
        }
        return $node instanceof \ConfigTransformer2021082410\PhpParser\Node\Name;
    }
    /**
     * @param Identifier|Name $node
     */
    public function resolve($node) : ?string
    {
        return (string) $node;
    }
}
