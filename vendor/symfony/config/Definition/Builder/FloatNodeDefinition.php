<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ConfigTransformer202210\Symfony\Component\Config\Definition\Builder;

use ConfigTransformer202210\Symfony\Component\Config\Definition\FloatNode;
/**
 * This class provides a fluent interface for defining a float node.
 *
 * @author Jeanmonod David <david.jeanmonod@gmail.com>
 */
class FloatNodeDefinition extends NumericNodeDefinition
{
    /**
     * Instantiates a Node.
     */
    protected function instantiateNode() : \ConfigTransformer202210\Symfony\Component\Config\Definition\VariableNode
    {
        return new FloatNode($this->name, $this->parent, $this->min, $this->max, $this->pathSeparator);
    }
}
