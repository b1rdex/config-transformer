<?php

declare (strict_types=1);
namespace ConfigTransformer202112141\Symplify\Astral\StaticFactory;

use ConfigTransformer202112141\Symplify\Astral\Naming\SimpleNameResolver;
use ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\ArgNodeNameResolver;
use ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\AttributeNodeNameResolver;
use ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\ClassLikeNodeNameResolver;
use ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\ClassMethodNodeNameResolver;
use ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\ConstFetchNodeNameResolver;
use ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\FuncCallNodeNameResolver;
use ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\IdentifierNodeNameResolver;
use ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\NamespaceNodeNameResolver;
use ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\ParamNodeNameResolver;
use ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\PropertyNodeNameResolver;
/**
 * This would be normally handled by standard Symfony or Nette DI, but PHPStan does not use any of those, so we have to
 * make it manually.
 */
final class SimpleNameResolverStaticFactory
{
    public static function create() : \ConfigTransformer202112141\Symplify\Astral\Naming\SimpleNameResolver
    {
        $nameResolvers = [new \ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\ArgNodeNameResolver(), new \ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\AttributeNodeNameResolver(), new \ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\ClassLikeNodeNameResolver(), new \ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\ClassMethodNodeNameResolver(), new \ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\ConstFetchNodeNameResolver(), new \ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\FuncCallNodeNameResolver(), new \ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\IdentifierNodeNameResolver(), new \ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\NamespaceNodeNameResolver(), new \ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\ParamNodeNameResolver(), new \ConfigTransformer202112141\Symplify\Astral\NodeNameResolver\PropertyNodeNameResolver()];
        return new \ConfigTransformer202112141\Symplify\Astral\Naming\SimpleNameResolver($nameResolvers);
    }
}
