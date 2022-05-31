<?php

declare (strict_types=1);
namespace ConfigTransformer202205319\Symplify\Astral\NodeNameResolver;

use ConfigTransformer202205319\PhpParser\Node;
use ConfigTransformer202205319\PhpParser\Node\Stmt\ClassMethod;
use ConfigTransformer202205319\Symplify\Astral\Contract\NodeNameResolverInterface;
final class ClassMethodNodeNameResolver implements \ConfigTransformer202205319\Symplify\Astral\Contract\NodeNameResolverInterface
{
    public function match(\ConfigTransformer202205319\PhpParser\Node $node) : bool
    {
        return $node instanceof \ConfigTransformer202205319\PhpParser\Node\Stmt\ClassMethod;
    }
    /**
     * @param ClassMethod $node
     */
    public function resolve(\ConfigTransformer202205319\PhpParser\Node $node) : ?string
    {
        return $node->name->toString();
    }
}
