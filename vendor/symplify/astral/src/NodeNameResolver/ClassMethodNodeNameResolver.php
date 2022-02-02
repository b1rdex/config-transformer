<?php

declare (strict_types=1);
namespace ConfigTransformer202202029\Symplify\Astral\NodeNameResolver;

use ConfigTransformer202202029\PhpParser\Node;
use ConfigTransformer202202029\PhpParser\Node\Stmt\ClassMethod;
use ConfigTransformer202202029\Symplify\Astral\Contract\NodeNameResolverInterface;
final class ClassMethodNodeNameResolver implements \ConfigTransformer202202029\Symplify\Astral\Contract\NodeNameResolverInterface
{
    public function match(\ConfigTransformer202202029\PhpParser\Node $node) : bool
    {
        return $node instanceof \ConfigTransformer202202029\PhpParser\Node\Stmt\ClassMethod;
    }
    /**
     * @param ClassMethod $node
     */
    public function resolve(\ConfigTransformer202202029\PhpParser\Node $node) : ?string
    {
        return $node->name->toString();
    }
}
