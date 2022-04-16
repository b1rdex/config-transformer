<?php

declare (strict_types=1);
namespace ConfigTransformer202204164\Symplify\PhpConfigPrinter\ServiceOptionConverter;

use ConfigTransformer202204164\PhpParser\BuilderHelpers;
use ConfigTransformer202204164\PhpParser\Node\Arg;
use ConfigTransformer202204164\PhpParser\Node\Expr\MethodCall;
use ConfigTransformer202204164\Symplify\PhpConfigPrinter\Contract\Converter\ServiceOptionsKeyYamlToPhpFactoryInterface;
use ConfigTransformer202204164\Symplify\PhpConfigPrinter\ValueObject\YamlKey;
final class ParentLazyServiceOptionKeyYamlToPhpFactory implements \ConfigTransformer202204164\Symplify\PhpConfigPrinter\Contract\Converter\ServiceOptionsKeyYamlToPhpFactoryInterface
{
    /**
     * @param mixed $key
     * @param mixed $yaml
     * @param mixed $values
     */
    public function decorateServiceMethodCall($key, $yaml, $values, \ConfigTransformer202204164\PhpParser\Node\Expr\MethodCall $methodCall) : \ConfigTransformer202204164\PhpParser\Node\Expr\MethodCall
    {
        $method = $key;
        $methodCall = new \ConfigTransformer202204164\PhpParser\Node\Expr\MethodCall($methodCall, $method);
        $methodCall->args[] = new \ConfigTransformer202204164\PhpParser\Node\Arg(\ConfigTransformer202204164\PhpParser\BuilderHelpers::normalizeValue($values[$key]));
        return $methodCall;
    }
    /**
     * @param mixed $key
     * @param mixed $values
     */
    public function isMatch($key, $values) : bool
    {
        return \in_array($key, [\ConfigTransformer202204164\Symplify\PhpConfigPrinter\ValueObject\YamlKey::PARENT, \ConfigTransformer202204164\Symplify\PhpConfigPrinter\ValueObject\YamlKey::LAZY], \true);
    }
}
