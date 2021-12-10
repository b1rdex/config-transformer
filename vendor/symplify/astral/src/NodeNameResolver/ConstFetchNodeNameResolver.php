<?php

declare (strict_types=1);
namespace ConfigTransformer202112105\Symplify\Astral\NodeNameResolver;

use ConfigTransformer202112105\PhpParser\Node;
use ConfigTransformer202112105\PhpParser\Node\Expr\ConstFetch;
use ConfigTransformer202112105\Symplify\Astral\Contract\NodeNameResolverInterface;
final class ConstFetchNodeNameResolver implements \ConfigTransformer202112105\Symplify\Astral\Contract\NodeNameResolverInterface
{
    /**
     * @param \PhpParser\Node $node
     */
    public function match($node) : bool
    {
        return $node instanceof \ConfigTransformer202112105\PhpParser\Node\Expr\ConstFetch;
    }
    /**
     * @param \PhpParser\Node $node
     */
    public function resolve($node) : ?string
    {
        return $node->name->toString();
    }
}
