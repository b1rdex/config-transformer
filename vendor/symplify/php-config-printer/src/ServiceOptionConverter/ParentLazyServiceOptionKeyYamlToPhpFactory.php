<?php

declare (strict_types=1);
namespace ConfigTransformer2022022410\Symplify\PhpConfigPrinter\ServiceOptionConverter;

use ConfigTransformer2022022410\PhpParser\BuilderHelpers;
use ConfigTransformer2022022410\PhpParser\Node\Arg;
use ConfigTransformer2022022410\PhpParser\Node\Expr\MethodCall;
use ConfigTransformer2022022410\Symplify\PhpConfigPrinter\Contract\Converter\ServiceOptionsKeyYamlToPhpFactoryInterface;
use ConfigTransformer2022022410\Symplify\PhpConfigPrinter\ValueObject\YamlKey;
final class ParentLazyServiceOptionKeyYamlToPhpFactory implements \ConfigTransformer2022022410\Symplify\PhpConfigPrinter\Contract\Converter\ServiceOptionsKeyYamlToPhpFactoryInterface
{
    /**
     * @param mixed $key
     * @param mixed|mixed[] $yaml
     * @param mixed $values
     */
    public function decorateServiceMethodCall($key, $yaml, $values, \ConfigTransformer2022022410\PhpParser\Node\Expr\MethodCall $methodCall) : \ConfigTransformer2022022410\PhpParser\Node\Expr\MethodCall
    {
        $method = $key;
        $methodCall = new \ConfigTransformer2022022410\PhpParser\Node\Expr\MethodCall($methodCall, $method);
        $methodCall->args[] = new \ConfigTransformer2022022410\PhpParser\Node\Arg(\ConfigTransformer2022022410\PhpParser\BuilderHelpers::normalizeValue($values[$key]));
        return $methodCall;
    }
    /**
     * @param mixed $key
     * @param mixed $values
     */
    public function isMatch($key, $values) : bool
    {
        return \in_array($key, [\ConfigTransformer2022022410\Symplify\PhpConfigPrinter\ValueObject\YamlKey::PARENT, \ConfigTransformer2022022410\Symplify\PhpConfigPrinter\ValueObject\YamlKey::LAZY], \true);
    }
}
