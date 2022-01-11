<?php

declare (strict_types=1);
namespace ConfigTransformer2022011110\PhpParser\NodeVisitor;

use ConfigTransformer2022011110\PhpParser\Node;
use ConfigTransformer2022011110\PhpParser\NodeVisitorAbstract;
/**
 * Visitor cloning all nodes and linking to the original nodes using an attribute.
 *
 * This visitor is required to perform format-preserving pretty prints.
 */
class CloningVisitor extends \ConfigTransformer2022011110\PhpParser\NodeVisitorAbstract
{
    public function enterNode(\ConfigTransformer2022011110\PhpParser\Node $origNode)
    {
        $node = clone $origNode;
        $node->setAttribute('origNode', $origNode);
        return $node;
    }
}
