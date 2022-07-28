<?php

declare (strict_types=1);
namespace Symplify\PhpConfigPrinter\ServiceOptionConverter\NodeModifier;

use ConfigTransformer202207\Nette\Utils\Strings;
use ConfigTransformer202207\PhpParser\Node\Arg;
use ConfigTransformer202207\PhpParser\Node\Expr\Array_;
use ConfigTransformer202207\PhpParser\Node\Expr\ArrayItem;
use ConfigTransformer202207\PhpParser\Node\Expr\FuncCall;
use ConfigTransformer202207\PhpParser\Node\Name\FullyQualified;
use ConfigTransformer202207\PhpParser\Node\Scalar\String_;
use Symplify\PhpConfigPrinter\NodeFactory\ArgsNodeFactory;
use Symplify\PhpConfigPrinter\ValueObject\FunctionName;
final class SingleFactoryReferenceNodeModifier
{
    /**
     * @see https://regex101.com/r/Smydt1/1
     * @var string
     */
    private const SERVICE_METHOD_REGEX = '#(?<service_name>.*?)\\:(?<method_name>\\w+)#';
    /**
     * @var \Symplify\PhpConfigPrinter\NodeFactory\ArgsNodeFactory
     */
    private $argsNodeFactory;
    public function __construct(ArgsNodeFactory $argsNodeFactory)
    {
        $this->argsNodeFactory = $argsNodeFactory;
    }
    /**
     * @param Arg[] $args
     */
    public function modifyArgs(array $args) : void
    {
        // split "service_name:methodName" shortcut to 2 args
        if (\count($args) !== 1) {
            return;
        }
        $singleArgValue = $args[0]->value;
        if (!$singleArgValue instanceof Array_) {
            return;
        }
        if (\count($singleArgValue->items) !== 1) {
            return;
        }
        $singleArrayItem = $singleArgValue->items[0];
        if (!$singleArrayItem instanceof ArrayItem) {
            return;
        }
        if (!$singleArrayItem->value instanceof String_) {
            return;
        }
        $factoryValue = $singleArrayItem->value;
        $match = Strings::match($factoryValue->value, self::SERVICE_METHOD_REGEX);
        if ($match === null) {
            return;
        }
        $serviceName = $match['service_name'];
        $methodName = $match['method_name'];
        $serviceFuncCall = $this->createServiceFuncCall($serviceName);
        $methodNameString = new String_($methodName);
        $singleArgValue->items = [new ArrayItem($serviceFuncCall), new ArrayItem($methodNameString)];
    }
    private function createServiceFuncCall(string $serviceName) : FuncCall
    {
        $serviceFuncCallArgs = $this->argsNodeFactory->createFromValues([$serviceName]);
        return new FuncCall(new FullyQualified(FunctionName::SERVICE), $serviceFuncCallArgs);
    }
}