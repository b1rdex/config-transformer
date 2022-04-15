<?php

declare (strict_types=1);
namespace ConfigTransformer202204152\Symplify\Astral\TypeAnalyzer;

use ConfigTransformer202204152\PhpParser\Node\Stmt\ClassMethod;
use ConfigTransformer202204152\PHPStan\Analyser\Scope;
use ConfigTransformer202204152\PHPStan\Reflection\ClassReflection;
use ConfigTransformer202204152\PHPStan\Reflection\FunctionVariant;
use ConfigTransformer202204152\PHPStan\Reflection\ParametersAcceptorSelector;
use ConfigTransformer202204152\PHPStan\Type\MixedType;
use ConfigTransformer202204152\PHPStan\Type\Type;
use ConfigTransformer202204152\Symplify\Astral\Exception\ShouldNotHappenException;
use ConfigTransformer202204152\Symplify\Astral\Naming\SimpleNameResolver;
/**
 * @api
 */
final class ClassMethodReturnTypeResolver
{
    /**
     * @var \Symplify\Astral\Naming\SimpleNameResolver
     */
    private $simpleNameResolver;
    public function __construct(\ConfigTransformer202204152\Symplify\Astral\Naming\SimpleNameResolver $simpleNameResolver)
    {
        $this->simpleNameResolver = $simpleNameResolver;
    }
    public function resolve(\ConfigTransformer202204152\PhpParser\Node\Stmt\ClassMethod $classMethod, \ConfigTransformer202204152\PHPStan\Analyser\Scope $scope) : \ConfigTransformer202204152\PHPStan\Type\Type
    {
        $methodName = $this->simpleNameResolver->getName($classMethod);
        if (!\is_string($methodName)) {
            throw new \ConfigTransformer202204152\Symplify\Astral\Exception\ShouldNotHappenException();
        }
        $classReflection = $scope->getClassReflection();
        if (!$classReflection instanceof \ConfigTransformer202204152\PHPStan\Reflection\ClassReflection) {
            return new \ConfigTransformer202204152\PHPStan\Type\MixedType();
        }
        $methodReflection = $classReflection->getMethod($methodName, $scope);
        $functionVariant = \ConfigTransformer202204152\PHPStan\Reflection\ParametersAcceptorSelector::selectSingle($methodReflection->getVariants());
        if (!$functionVariant instanceof \ConfigTransformer202204152\PHPStan\Reflection\FunctionVariant) {
            return new \ConfigTransformer202204152\PHPStan\Type\MixedType();
        }
        return $functionVariant->getReturnType();
    }
}
