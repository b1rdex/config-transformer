<?php

declare (strict_types=1);
namespace ConfigTransformer20220611\Symplify\Astral\StaticFactory;

use ConfigTransformer20220611\Symplify\Astral\NodeValue\NodeValueResolver;
use ConfigTransformer20220611\Symplify\PackageBuilder\Php\TypeChecker;
/**
 * @api
 */
final class NodeValueResolverStaticFactory
{
    public static function create() : NodeValueResolver
    {
        $simpleNameResolver = SimpleNameResolverStaticFactory::create();
        return new NodeValueResolver($simpleNameResolver, new TypeChecker());
    }
}
