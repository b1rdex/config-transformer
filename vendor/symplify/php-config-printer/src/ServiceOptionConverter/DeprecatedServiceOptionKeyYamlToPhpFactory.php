<?php

declare (strict_types=1);
namespace ConfigTransformer202202247\Symplify\PhpConfigPrinter\ServiceOptionConverter;

use ConfigTransformer202202247\PhpParser\Node\Expr\MethodCall;
use ConfigTransformer202202247\Symplify\PhpConfigPrinter\Contract\Converter\ServiceOptionsKeyYamlToPhpFactoryInterface;
use ConfigTransformer202202247\Symplify\PhpConfigPrinter\NodeFactory\ArgsNodeFactory;
use ConfigTransformer202202247\Symplify\PhpConfigPrinter\ValueObject\YamlServiceKey;
final class DeprecatedServiceOptionKeyYamlToPhpFactory implements \ConfigTransformer202202247\Symplify\PhpConfigPrinter\Contract\Converter\ServiceOptionsKeyYamlToPhpFactoryInterface
{
    /**
     * @var \Symplify\PhpConfigPrinter\NodeFactory\ArgsNodeFactory
     */
    private $argsNodeFactory;
    public function __construct(\ConfigTransformer202202247\Symplify\PhpConfigPrinter\NodeFactory\ArgsNodeFactory $argsNodeFactory)
    {
        $this->argsNodeFactory = $argsNodeFactory;
    }
    /**
     * @param mixed $key
     * @param mixed|mixed[] $yaml
     * @param mixed $values
     */
    public function decorateServiceMethodCall($key, $yaml, $values, \ConfigTransformer202202247\PhpParser\Node\Expr\MethodCall $methodCall) : \ConfigTransformer202202247\PhpParser\Node\Expr\MethodCall
    {
        // the old, simple format
        if (!\is_array($yaml)) {
            $args = $this->argsNodeFactory->createFromValues([$yaml]);
        } else {
            $items = [$yaml['package'] ?? '', $yaml['version'] ?? '', $yaml['message'] ?? ''];
            $args = $this->argsNodeFactory->createFromValues($items);
        }
        return new \ConfigTransformer202202247\PhpParser\Node\Expr\MethodCall($methodCall, 'deprecate', $args);
    }
    /**
     * @param mixed $key
     * @param mixed $values
     */
    public function isMatch($key, $values) : bool
    {
        return $key === \ConfigTransformer202202247\Symplify\PhpConfigPrinter\ValueObject\YamlServiceKey::DEPRECATED;
    }
}
