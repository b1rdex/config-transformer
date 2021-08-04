<?php

declare (strict_types=1);
namespace ConfigTransformer202108047\Symplify\PhpConfigPrinter\ExprResolver;

use ConfigTransformer202108047\PhpParser\Node\Expr\Array_;
use ConfigTransformer202108047\PhpParser\Node\Expr\ArrayItem;
use ConfigTransformer202108047\Symfony\Component\Yaml\Tag\TaggedValue;
use ConfigTransformer202108047\Symplify\PhpConfigPrinter\Configuration\SymfonyFunctionNameProvider;
final class TaggedReturnsCloneResolver
{
    /**
     * @var \Symplify\PhpConfigPrinter\Configuration\SymfonyFunctionNameProvider
     */
    private $symfonyFunctionNameProvider;
    /**
     * @var \Symplify\PhpConfigPrinter\ExprResolver\ServiceReferenceExprResolver
     */
    private $serviceReferenceExprResolver;
    public function __construct(\ConfigTransformer202108047\Symplify\PhpConfigPrinter\Configuration\SymfonyFunctionNameProvider $symfonyFunctionNameProvider, \ConfigTransformer202108047\Symplify\PhpConfigPrinter\ExprResolver\ServiceReferenceExprResolver $serviceReferenceExprResolver)
    {
        $this->symfonyFunctionNameProvider = $symfonyFunctionNameProvider;
        $this->serviceReferenceExprResolver = $serviceReferenceExprResolver;
    }
    public function resolve(\ConfigTransformer202108047\Symfony\Component\Yaml\Tag\TaggedValue $taggedValue) : \ConfigTransformer202108047\PhpParser\Node\Expr\Array_
    {
        $serviceName = $taggedValue->getValue()[0];
        $functionName = $this->symfonyFunctionNameProvider->provideRefOrService();
        $funcCall = $this->serviceReferenceExprResolver->resolveServiceReferenceExpr($serviceName, \false, $functionName);
        return new \ConfigTransformer202108047\PhpParser\Node\Expr\Array_([new \ConfigTransformer202108047\PhpParser\Node\Expr\ArrayItem($funcCall)]);
    }
}
