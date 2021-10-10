<?php

declare (strict_types=1);
namespace ConfigTransformer202110101\Symplify\Astral\NodeAnalyzer;

use ConfigTransformer202110101\Nette\Application\UI\Template;
use ConfigTransformer202110101\PhpParser\Node\Expr;
use ConfigTransformer202110101\PhpParser\Node\Expr\PropertyFetch;
use ConfigTransformer202110101\PHPStan\Analyser\Scope;
use ConfigTransformer202110101\Symplify\Astral\Naming\SimpleNameResolver;
use ConfigTransformer202110101\Symplify\Astral\TypeAnalyzer\ContainsTypeAnalyser;
final class NetteTypeAnalyzer
{
    /**
     * @var array<class-string<Template>>
     */
    private const TEMPLATE_TYPES = ['ConfigTransformer202110101\\Nette\\Application\\UI\\Template', 'ConfigTransformer202110101\\Nette\\Bridges\\ApplicationLatte\\Template', 'ConfigTransformer202110101\\Nette\\Bridges\\ApplicationLatte\\DefaultTemplate'];
    /**
     * @var \Symplify\Astral\Naming\SimpleNameResolver
     */
    private $simpleNameResolver;
    /**
     * @var \Symplify\Astral\TypeAnalyzer\ContainsTypeAnalyser
     */
    private $containsTypeAnalyser;
    public function __construct(\ConfigTransformer202110101\Symplify\Astral\Naming\SimpleNameResolver $simpleNameResolver, \ConfigTransformer202110101\Symplify\Astral\TypeAnalyzer\ContainsTypeAnalyser $containsTypeAnalyser)
    {
        $this->simpleNameResolver = $simpleNameResolver;
        $this->containsTypeAnalyser = $containsTypeAnalyser;
    }
    /**
     * E.g. $this->template->key
     */
    public function isTemplateMagicPropertyType(\ConfigTransformer202110101\PhpParser\Node\Expr $expr, \ConfigTransformer202110101\PHPStan\Analyser\Scope $scope) : bool
    {
        if (!$expr instanceof \ConfigTransformer202110101\PhpParser\Node\Expr\PropertyFetch) {
            return \false;
        }
        if (!$expr->var instanceof \ConfigTransformer202110101\PhpParser\Node\Expr\PropertyFetch) {
            return \false;
        }
        return $this->isTemplateType($expr->var, $scope);
    }
    /**
     * E.g. $this->template
     */
    public function isTemplateType(\ConfigTransformer202110101\PhpParser\Node\Expr $expr, \ConfigTransformer202110101\PHPStan\Analyser\Scope $scope) : bool
    {
        return $this->containsTypeAnalyser->containsExprTypes($expr, $scope, self::TEMPLATE_TYPES);
    }
    /**
     * This type has getComponent() method
     */
    public function isInsideComponentContainer(\ConfigTransformer202110101\PHPStan\Analyser\Scope $scope) : bool
    {
        $className = $this->simpleNameResolver->getClassNameFromScope($scope);
        if ($className === null) {
            return \false;
        }
        // this type has getComponent() method
        return \is_a($className, 'ConfigTransformer202110101\\Nette\\ComponentModel\\Container', \true);
    }
    public function isInsideControl(\ConfigTransformer202110101\PHPStan\Analyser\Scope $scope) : bool
    {
        $className = $this->simpleNameResolver->getClassNameFromScope($scope);
        if ($className === null) {
            return \false;
        }
        return \is_a($className, 'ConfigTransformer202110101\\Nette\\Application\\UI\\Control', \true);
    }
}