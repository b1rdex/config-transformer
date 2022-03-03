<?php

declare (strict_types=1);
namespace ConfigTransformer202203034\Symplify\PhpConfigPrinter\CaseConverter;

use ConfigTransformer202203034\PhpParser\Node\Arg;
use ConfigTransformer202203034\PhpParser\Node\Expr\MethodCall;
use ConfigTransformer202203034\PhpParser\Node\Expr\Variable;
use ConfigTransformer202203034\PhpParser\Node\Stmt\Expression;
use ConfigTransformer202203034\Symplify\PhpConfigPrinter\Contract\CaseConverterInterface;
use ConfigTransformer202203034\Symplify\PhpConfigPrinter\NodeFactory\CommonNodeFactory;
use ConfigTransformer202203034\Symplify\PhpConfigPrinter\ValueObject\VariableName;
use ConfigTransformer202203034\Symplify\PhpConfigPrinter\ValueObject\YamlKey;
final class NameOnlyServiceCaseConverter implements \ConfigTransformer202203034\Symplify\PhpConfigPrinter\Contract\CaseConverterInterface
{
    /**
     * @var \Symplify\PhpConfigPrinter\NodeFactory\CommonNodeFactory
     */
    private $commonNodeFactory;
    public function __construct(\ConfigTransformer202203034\Symplify\PhpConfigPrinter\NodeFactory\CommonNodeFactory $commonNodeFactory)
    {
        $this->commonNodeFactory = $commonNodeFactory;
    }
    /**
     * @param mixed $key
     * @param mixed $values
     */
    public function convertToMethodCall($key, $values) : \ConfigTransformer202203034\PhpParser\Node\Stmt\Expression
    {
        $classConstFetch = $this->commonNodeFactory->createClassReference($key);
        $setMethodCall = new \ConfigTransformer202203034\PhpParser\Node\Expr\MethodCall(new \ConfigTransformer202203034\PhpParser\Node\Expr\Variable(\ConfigTransformer202203034\Symplify\PhpConfigPrinter\ValueObject\VariableName::SERVICES), 'set', [new \ConfigTransformer202203034\PhpParser\Node\Arg($classConstFetch)]);
        return new \ConfigTransformer202203034\PhpParser\Node\Stmt\Expression($setMethodCall);
    }
    /**
     * @param mixed $key
     * @param mixed $values
     */
    public function match(string $rootKey, $key, $values) : bool
    {
        if ($rootKey !== \ConfigTransformer202203034\Symplify\PhpConfigPrinter\ValueObject\YamlKey::SERVICES) {
            return \false;
        }
        return $values === null || $values === [];
    }
}
