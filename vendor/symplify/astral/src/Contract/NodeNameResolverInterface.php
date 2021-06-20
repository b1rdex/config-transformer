<?php

declare (strict_types=1);
namespace ConfigTransformer202106202\Symplify\Astral\Contract;

use ConfigTransformer202106202\PhpParser\Node;
interface NodeNameResolverInterface
{
    public function match(\ConfigTransformer202106202\PhpParser\Node $node) : bool;
    public function resolve(\ConfigTransformer202106202\PhpParser\Node $node) : ?string;
}