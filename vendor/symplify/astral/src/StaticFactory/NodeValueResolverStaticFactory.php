<?php

declare (strict_types=1);
namespace ConfigTransformer202111017\Symplify\Astral\StaticFactory;

use ConfigTransformer202111017\PhpParser\NodeFinder;
use ConfigTransformer202111017\Symplify\Astral\NodeFinder\SimpleNodeFinder;
use ConfigTransformer202111017\Symplify\Astral\NodeValue\NodeValueResolver;
use ConfigTransformer202111017\Symplify\PackageBuilder\Php\TypeChecker;
/**
 * @api
 */
final class NodeValueResolverStaticFactory
{
    public static function create() : \ConfigTransformer202111017\Symplify\Astral\NodeValue\NodeValueResolver
    {
        $simpleNameResolver = \ConfigTransformer202111017\Symplify\Astral\StaticFactory\SimpleNameResolverStaticFactory::create();
        $simpleNodeFinder = new \ConfigTransformer202111017\Symplify\Astral\NodeFinder\SimpleNodeFinder(new \ConfigTransformer202111017\Symplify\PackageBuilder\Php\TypeChecker(), new \ConfigTransformer202111017\PhpParser\NodeFinder());
        return new \ConfigTransformer202111017\Symplify\Astral\NodeValue\NodeValueResolver($simpleNameResolver, new \ConfigTransformer202111017\Symplify\PackageBuilder\Php\TypeChecker(), $simpleNodeFinder);
    }
}
