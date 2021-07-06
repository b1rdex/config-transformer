<?php

declare (strict_types=1);
namespace ConfigTransformer202107069\Symplify\Astral\NodeNameResolver;

use ConfigTransformer202107069\PhpParser\Node;
use ConfigTransformer202107069\PhpParser\Node\Attribute;
use ConfigTransformer202107069\Symplify\Astral\Contract\NodeNameResolverInterface;
final class AttributeNodeNameResolver implements \ConfigTransformer202107069\Symplify\Astral\Contract\NodeNameResolverInterface
{
    public function match(\ConfigTransformer202107069\PhpParser\Node $node) : bool
    {
        return $node instanceof \ConfigTransformer202107069\PhpParser\Node\Attribute;
    }
    /**
     * @param Attribute $node
     */
    public function resolve(\ConfigTransformer202107069\PhpParser\Node $node) : ?string
    {
        return $node->name->toString();
    }
}