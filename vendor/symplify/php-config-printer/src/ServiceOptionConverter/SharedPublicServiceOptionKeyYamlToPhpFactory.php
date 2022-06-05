<?php

declare (strict_types=1);
namespace ConfigTransformer202206056\Symplify\PhpConfigPrinter\ServiceOptionConverter;

use ConfigTransformer202206056\PhpParser\Node\Arg;
use ConfigTransformer202206056\PhpParser\Node\Expr\MethodCall;
use ConfigTransformer202206056\Symplify\PhpConfigPrinter\Contract\Converter\ServiceOptionsKeyYamlToPhpFactoryInterface;
use ConfigTransformer202206056\Symplify\PhpConfigPrinter\Exception\NotImplementedYetException;
use ConfigTransformer202206056\Symplify\PhpConfigPrinter\NodeFactory\CommonNodeFactory;
final class SharedPublicServiceOptionKeyYamlToPhpFactory implements \ConfigTransformer202206056\Symplify\PhpConfigPrinter\Contract\Converter\ServiceOptionsKeyYamlToPhpFactoryInterface
{
    /**
     * @var \Symplify\PhpConfigPrinter\NodeFactory\CommonNodeFactory
     */
    private $commonNodeFactory;
    public function __construct(\ConfigTransformer202206056\Symplify\PhpConfigPrinter\NodeFactory\CommonNodeFactory $commonNodeFactory)
    {
        $this->commonNodeFactory = $commonNodeFactory;
    }
    /**
     * @param mixed $key
     * @param mixed $yaml
     * @param mixed $values
     */
    public function decorateServiceMethodCall($key, $yaml, $values, \ConfigTransformer202206056\PhpParser\Node\Expr\MethodCall $methodCall) : \ConfigTransformer202206056\PhpParser\Node\Expr\MethodCall
    {
        if ($key === 'public') {
            if ($yaml === \false) {
                return new \ConfigTransformer202206056\PhpParser\Node\Expr\MethodCall($methodCall, 'private');
            }
            return new \ConfigTransformer202206056\PhpParser\Node\Expr\MethodCall($methodCall, 'public');
        }
        if ($key === 'shared') {
            if ($yaml === \false) {
                return new \ConfigTransformer202206056\PhpParser\Node\Expr\MethodCall($methodCall, 'share', [new \ConfigTransformer202206056\PhpParser\Node\Arg($this->commonNodeFactory->createFalse())]);
            }
            return new \ConfigTransformer202206056\PhpParser\Node\Expr\MethodCall($methodCall, 'share');
        }
        throw new \ConfigTransformer202206056\Symplify\PhpConfigPrinter\Exception\NotImplementedYetException();
    }
    /**
     * @param mixed $key
     * @param mixed $values
     */
    public function isMatch($key, $values) : bool
    {
        return \in_array($key, ['shared', 'public'], \true);
    }
}
