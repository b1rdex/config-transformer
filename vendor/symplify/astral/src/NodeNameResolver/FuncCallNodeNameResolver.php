<?php

declare (strict_types=1);
namespace ConfigTransformer202112191\Symplify\Astral\NodeNameResolver;

use ConfigTransformer202112191\PhpParser\Node;
use ConfigTransformer202112191\PhpParser\Node\Expr;
use ConfigTransformer202112191\PhpParser\Node\Expr\FuncCall;
use ConfigTransformer202112191\Symplify\Astral\Contract\NodeNameResolverInterface;
final class FuncCallNodeNameResolver implements \ConfigTransformer202112191\Symplify\Astral\Contract\NodeNameResolverInterface
{
    public function match(\ConfigTransformer202112191\PhpParser\Node $node) : bool
    {
        return $node instanceof \ConfigTransformer202112191\PhpParser\Node\Expr\FuncCall;
    }
    /**
     * @param FuncCall $node
     */
    public function resolve(\ConfigTransformer202112191\PhpParser\Node $node) : ?string
    {
        if ($node->name instanceof \ConfigTransformer202112191\PhpParser\Node\Expr) {
            return null;
        }
        return (string) $node->name;
    }
}
