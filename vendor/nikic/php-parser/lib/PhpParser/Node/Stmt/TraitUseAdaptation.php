<?php

declare (strict_types=1);
namespace ConfigTransformer2022011110\PhpParser\Node\Stmt;

use ConfigTransformer2022011110\PhpParser\Node;
abstract class TraitUseAdaptation extends \ConfigTransformer2022011110\PhpParser\Node\Stmt
{
    /** @var Node\Name|null Trait name */
    public $trait;
    /** @var Node\Identifier Method name */
    public $method;
}
