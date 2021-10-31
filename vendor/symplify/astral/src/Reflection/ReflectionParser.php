<?php

declare (strict_types=1);
namespace ConfigTransformer202110315\Symplify\Astral\Reflection;

use ConfigTransformer202110315\PhpParser\Node\Stmt\Class_;
use ConfigTransformer202110315\PhpParser\Node\Stmt\ClassMethod;
use ConfigTransformer202110315\PhpParser\Node\Stmt\Property;
use ConfigTransformer202110315\PhpParser\NodeFinder;
use ReflectionMethod;
use ReflectionProperty;
use ConfigTransformer202110315\Symplify\Astral\PhpParser\SmartPhpParser;
use Throwable;
/**
 * @api
 */
final class ReflectionParser
{
    /**
     * @var \Symplify\Astral\PhpParser\SmartPhpParser
     */
    private $smartPhpParser;
    /**
     * @var \PhpParser\NodeFinder
     */
    private $nodeFinder;
    public function __construct(\ConfigTransformer202110315\Symplify\Astral\PhpParser\SmartPhpParser $smartPhpParser, \ConfigTransformer202110315\PhpParser\NodeFinder $nodeFinder)
    {
        $this->smartPhpParser = $smartPhpParser;
        $this->nodeFinder = $nodeFinder;
    }
    public function parseMethodReflectionToClassMethod(\ReflectionMethod $reflectionMethod) : ?\ConfigTransformer202110315\PhpParser\Node\Stmt\ClassMethod
    {
        $class = $this->parseReflectionToClass($reflectionMethod);
        if (!$class instanceof \ConfigTransformer202110315\PhpParser\Node\Stmt\Class_) {
            return null;
        }
        return $class->getMethod($reflectionMethod->getName());
    }
    public function parsePropertyReflectionToProperty(\ReflectionProperty $reflectionProperty) : ?\ConfigTransformer202110315\PhpParser\Node\Stmt\Property
    {
        $class = $this->parseReflectionToClass($reflectionProperty);
        if (!$class instanceof \ConfigTransformer202110315\PhpParser\Node\Stmt\Class_) {
            return null;
        }
        return $class->getProperty($reflectionProperty->getName());
    }
    /**
     * @param \ReflectionMethod|\ReflectionProperty $reflector
     */
    private function parseReflectionToClass($reflector) : ?\ConfigTransformer202110315\PhpParser\Node\Stmt\Class_
    {
        $reflectionClass = $reflector->getDeclaringClass();
        $fileName = $reflectionClass->getFileName();
        if ($fileName === \false) {
            return null;
        }
        try {
            $stmts = $this->smartPhpParser->parseFile($fileName);
        } catch (\Throwable $exception) {
            // not reachable
            return null;
        }
        $class = $this->nodeFinder->findFirstInstanceOf($stmts, \ConfigTransformer202110315\PhpParser\Node\Stmt\Class_::class);
        if (!$class instanceof \ConfigTransformer202110315\PhpParser\Node\Stmt\Class_) {
            return null;
        }
        return $class;
    }
}