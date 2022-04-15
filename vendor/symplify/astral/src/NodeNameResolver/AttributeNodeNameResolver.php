<?php

declare (strict_types=1);
namespace ConfigTransformer202204152\Symplify\Astral\NodeNameResolver;

use ConfigTransformer202204152\PhpParser\Node;
use ConfigTransformer202204152\PhpParser\Node\Attribute;
use ConfigTransformer202204152\Symplify\Astral\Contract\NodeNameResolverInterface;
final class AttributeNodeNameResolver implements \ConfigTransformer202204152\Symplify\Astral\Contract\NodeNameResolverInterface
{
    public function match(\ConfigTransformer202204152\PhpParser\Node $node) : bool
    {
        return $node instanceof \ConfigTransformer202204152\PhpParser\Node\Attribute;
    }
    /**
     * @param Attribute $node
     */
    public function resolve(\ConfigTransformer202204152\PhpParser\Node $node) : ?string
    {
        return $node->name->toString();
    }
}
