<?php

declare (strict_types=1);
namespace ConfigTransformer202108029\Symplify\PhpConfigPrinter\ServiceOptionConverter;

use ConfigTransformer202108029\PhpParser\BuilderHelpers;
use ConfigTransformer202108029\PhpParser\Node\Arg;
use ConfigTransformer202108029\PhpParser\Node\Expr\MethodCall;
use ConfigTransformer202108029\Symplify\PhpConfigPrinter\Contract\Converter\ServiceOptionsKeyYamlToPhpFactoryInterface;
use ConfigTransformer202108029\Symplify\PhpConfigPrinter\ValueObject\YamlKey;
final class ParentLazyServiceOptionKeyYamlToPhpFactory implements \ConfigTransformer202108029\Symplify\PhpConfigPrinter\Contract\Converter\ServiceOptionsKeyYamlToPhpFactoryInterface
{
    /**
     * @param \PhpParser\Node\Expr\MethodCall $methodCall
     */
    public function decorateServiceMethodCall($key, $yaml, $values, $methodCall) : \ConfigTransformer202108029\PhpParser\Node\Expr\MethodCall
    {
        $method = $key;
        $methodCall = new \ConfigTransformer202108029\PhpParser\Node\Expr\MethodCall($methodCall, $method);
        $methodCall->args[] = new \ConfigTransformer202108029\PhpParser\Node\Arg(\ConfigTransformer202108029\PhpParser\BuilderHelpers::normalizeValue($values[$key]));
        return $methodCall;
    }
    public function isMatch($key, $values) : bool
    {
        return \in_array($key, [\ConfigTransformer202108029\Symplify\PhpConfigPrinter\ValueObject\YamlKey::PARENT, \ConfigTransformer202108029\Symplify\PhpConfigPrinter\ValueObject\YamlKey::LAZY], \true);
    }
}