<?php

declare (strict_types=1);
namespace ConfigTransformer2021090710\Symplify\PhpConfigPrinter\ExprResolver;

use ConfigTransformer2021090710\PhpParser\Node\Expr;
use ConfigTransformer2021090710\Symfony\Component\Yaml\Tag\TaggedValue;
use ConfigTransformer2021090710\Symplify\PhpConfigPrinter\ValueObject\FunctionName;
final class TaggedServiceResolver
{
    /**
     * @var \Symplify\PhpConfigPrinter\ExprResolver\ServiceReferenceExprResolver
     */
    private $serviceReferenceExprResolver;
    public function __construct(\ConfigTransformer2021090710\Symplify\PhpConfigPrinter\ExprResolver\ServiceReferenceExprResolver $serviceReferenceExprResolver)
    {
        $this->serviceReferenceExprResolver = $serviceReferenceExprResolver;
    }
    public function resolve(\ConfigTransformer2021090710\Symfony\Component\Yaml\Tag\TaggedValue $taggedValue) : \ConfigTransformer2021090710\PhpParser\Node\Expr
    {
        $serviceName = $taggedValue->getValue()['class'];
        $functionName = \ConfigTransformer2021090710\Symplify\PhpConfigPrinter\ValueObject\FunctionName::INLINE_SERVICE;
        return $this->serviceReferenceExprResolver->resolveServiceReferenceExpr($serviceName, \false, $functionName);
    }
}
