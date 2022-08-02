<?php

declare (strict_types=1);
namespace ConfigTransformer202208\Symplify\Astral\NodeNameResolver;

use ConfigTransformer202208\PhpParser\Node;
use ConfigTransformer202208\PhpParser\Node\Attribute;
use ConfigTransformer202208\Symplify\Astral\Contract\NodeNameResolverInterface;
final class AttributeNodeNameResolver implements NodeNameResolverInterface
{
    public function match(Node $node) : bool
    {
        return $node instanceof Attribute;
    }
    /**
     * @param Attribute $node
     */
    public function resolve(Node $node) : ?string
    {
        return $node->name->toString();
    }
}
