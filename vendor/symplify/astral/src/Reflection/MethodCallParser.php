<?php

declare (strict_types=1);
namespace ConfigTransformer202206063\Symplify\Astral\Reflection;

use ConfigTransformer202206063\PhpParser\Node\Expr\MethodCall;
use ConfigTransformer202206063\PhpParser\Node\Stmt\ClassMethod;
use ConfigTransformer202206063\PHPStan\Analyser\Scope;
use ConfigTransformer202206063\PHPStan\Reflection\ClassReflection;
use ConfigTransformer202206063\PHPStan\Type\ObjectType;
use ConfigTransformer202206063\PHPStan\Type\ThisType;
use ConfigTransformer202206063\Symplify\Astral\Naming\SimpleNameResolver;
/**
 * @api
 */
final class MethodCallParser
{
    /**
     * @var \Symplify\Astral\Naming\SimpleNameResolver
     */
    private $simpleNameResolver;
    /**
     * @var \Symplify\Astral\Reflection\ReflectionParser
     */
    private $reflectionParser;
    public function __construct(\ConfigTransformer202206063\Symplify\Astral\Naming\SimpleNameResolver $simpleNameResolver, \ConfigTransformer202206063\Symplify\Astral\Reflection\ReflectionParser $reflectionParser)
    {
        $this->simpleNameResolver = $simpleNameResolver;
        $this->reflectionParser = $reflectionParser;
    }
    /**
     * @return \PhpParser\Node\Stmt\ClassMethod|null
     */
    public function parseMethodCall(\ConfigTransformer202206063\PhpParser\Node\Expr\MethodCall $methodCall, \ConfigTransformer202206063\PHPStan\Analyser\Scope $scope)
    {
        $callerType = $scope->getType($methodCall->var);
        if ($callerType instanceof \ConfigTransformer202206063\PHPStan\Type\ThisType) {
            $callerType = $callerType->getStaticObjectType();
        }
        if (!$callerType instanceof \ConfigTransformer202206063\PHPStan\Type\ObjectType) {
            return null;
        }
        $classReflection = $callerType->getClassReflection();
        if (!$classReflection instanceof \ConfigTransformer202206063\PHPStan\Reflection\ClassReflection) {
            return null;
        }
        $methodName = $this->simpleNameResolver->getName($methodCall->name);
        if ($methodName === null) {
            return null;
        }
        if (!$classReflection->hasNativeMethod($methodName)) {
            return null;
        }
        $methodReflection = $classReflection->getNativeMethod($methodName);
        return $this->reflectionParser->parsePHPStanMethodReflection($methodReflection);
    }
}
