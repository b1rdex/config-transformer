<?php

declare (strict_types=1);
namespace ConfigTransformer202206055\Symplify\PhpConfigPrinter\CaseConverter;

use ConfigTransformer202206055\PhpParser\Node\Expr\MethodCall;
use ConfigTransformer202206055\PhpParser\Node\Expr\Variable;
use ConfigTransformer202206055\PhpParser\Node\Stmt\Expression;
use ConfigTransformer202206055\Symplify\PhpConfigPrinter\Contract\CaseConverterInterface;
use ConfigTransformer202206055\Symplify\PhpConfigPrinter\NodeFactory\ArgsNodeFactory;
use ConfigTransformer202206055\Symplify\PhpConfigPrinter\NodeFactory\Service\ServiceOptionNodeFactory;
use ConfigTransformer202206055\Symplify\PhpConfigPrinter\ValueObject\MethodName;
use ConfigTransformer202206055\Symplify\PhpConfigPrinter\ValueObject\VariableName;
use ConfigTransformer202206055\Symplify\PhpConfigPrinter\ValueObject\YamlKey;
final class ClassServiceCaseConverter implements \ConfigTransformer202206055\Symplify\PhpConfigPrinter\Contract\CaseConverterInterface
{
    /**
     * @var \Symplify\PhpConfigPrinter\NodeFactory\ArgsNodeFactory
     */
    private $argsNodeFactory;
    /**
     * @var \Symplify\PhpConfigPrinter\NodeFactory\Service\ServiceOptionNodeFactory
     */
    private $serviceOptionNodeFactory;
    public function __construct(\ConfigTransformer202206055\Symplify\PhpConfigPrinter\NodeFactory\ArgsNodeFactory $argsNodeFactory, \ConfigTransformer202206055\Symplify\PhpConfigPrinter\NodeFactory\Service\ServiceOptionNodeFactory $serviceOptionNodeFactory)
    {
        $this->argsNodeFactory = $argsNodeFactory;
        $this->serviceOptionNodeFactory = $serviceOptionNodeFactory;
    }
    /**
     * @param mixed $key
     * @param mixed $values
     */
    public function convertToMethodCall($key, $values) : \ConfigTransformer202206055\PhpParser\Node\Stmt\Expression
    {
        $args = $this->argsNodeFactory->createFromValues([$key, $values[\ConfigTransformer202206055\Symplify\PhpConfigPrinter\ValueObject\YamlKey::CLASS_KEY]]);
        $methodCall = new \ConfigTransformer202206055\PhpParser\Node\Expr\MethodCall(new \ConfigTransformer202206055\PhpParser\Node\Expr\Variable(\ConfigTransformer202206055\Symplify\PhpConfigPrinter\ValueObject\VariableName::SERVICES), \ConfigTransformer202206055\Symplify\PhpConfigPrinter\ValueObject\MethodName::SET, $args);
        unset($values[\ConfigTransformer202206055\Symplify\PhpConfigPrinter\ValueObject\YamlKey::CLASS_KEY]);
        $decoratedMethodCall = $this->serviceOptionNodeFactory->convertServiceOptionsToNodes($values, $methodCall);
        return new \ConfigTransformer202206055\PhpParser\Node\Stmt\Expression($decoratedMethodCall);
    }
    /**
     * @param mixed $key
     * @param mixed $values
     */
    public function match(string $rootKey, $key, $values) : bool
    {
        if ($rootKey !== \ConfigTransformer202206055\Symplify\PhpConfigPrinter\ValueObject\YamlKey::SERVICES) {
            return \false;
        }
        if (\is_array($values) && \count($values) !== 1) {
            return \false;
        }
        if (!isset($values[\ConfigTransformer202206055\Symplify\PhpConfigPrinter\ValueObject\YamlKey::CLASS_KEY])) {
            return \false;
        }
        return !isset($values[\ConfigTransformer202206055\Symplify\PhpConfigPrinter\ValueObject\YamlKey::ALIAS]);
    }
}
