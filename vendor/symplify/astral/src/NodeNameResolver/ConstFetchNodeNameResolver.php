<?php

declare (strict_types=1);
namespace ConfigTransformer202112141\Symplify\Astral\NodeNameResolver;

use ConfigTransformer202112141\PhpParser\Node;
use ConfigTransformer202112141\PhpParser\Node\Expr\ConstFetch;
use ConfigTransformer202112141\Symplify\Astral\Contract\NodeNameResolverInterface;
final class ConstFetchNodeNameResolver implements \ConfigTransformer202112141\Symplify\Astral\Contract\NodeNameResolverInterface
{
    public function match(\ConfigTransformer202112141\PhpParser\Node $node) : bool
    {
        return $node instanceof \ConfigTransformer202112141\PhpParser\Node\Expr\ConstFetch;
    }
    /**
     * @param ConstFetch $node
     */
    public function resolve(\ConfigTransformer202112141\PhpParser\Node $node) : ?string
    {
        return $node->name->toString();
    }
}
