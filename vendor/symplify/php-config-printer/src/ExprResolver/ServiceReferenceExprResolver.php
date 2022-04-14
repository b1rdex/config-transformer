<?php

declare (strict_types=1);
namespace ConfigTransformer202204145\Symplify\PhpConfigPrinter\ExprResolver;

use ConfigTransformer202204145\PhpParser\Node\Arg;
use ConfigTransformer202204145\PhpParser\Node\Expr;
use ConfigTransformer202204145\PhpParser\Node\Expr\FuncCall;
use ConfigTransformer202204145\PhpParser\Node\Name\FullyQualified;
final class ServiceReferenceExprResolver
{
    /**
     * @var \Symplify\PhpConfigPrinter\ExprResolver\StringExprResolver
     */
    private $stringExprResolver;
    public function __construct(\ConfigTransformer202204145\Symplify\PhpConfigPrinter\ExprResolver\StringExprResolver $stringExprResolver)
    {
        $this->stringExprResolver = $stringExprResolver;
    }
    public function resolveServiceReferenceExpr(string $value, bool $skipServiceReference, string $functionName) : \ConfigTransformer202204145\PhpParser\Node\Expr
    {
        $value = \ltrim($value, '@');
        $expr = $this->stringExprResolver->resolve($value, $skipServiceReference, \false);
        if ($skipServiceReference) {
            return $expr;
        }
        $args = [new \ConfigTransformer202204145\PhpParser\Node\Arg($expr)];
        return new \ConfigTransformer202204145\PhpParser\Node\Expr\FuncCall(new \ConfigTransformer202204145\PhpParser\Node\Name\FullyQualified($functionName), $args);
    }
}
