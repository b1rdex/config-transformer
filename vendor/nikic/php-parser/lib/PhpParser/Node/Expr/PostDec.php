<?php

declare (strict_types=1);
namespace ConfigTransformer202112080\PhpParser\Node\Expr;

use ConfigTransformer202112080\PhpParser\Node\Expr;
class PostDec extends \ConfigTransformer202112080\PhpParser\Node\Expr
{
    /** @var Expr Variable */
    public $var;
    /**
     * Constructs a post decrement node.
     *
     * @param Expr  $var        Variable
     * @param array $attributes Additional attributes
     */
    public function __construct(\ConfigTransformer202112080\PhpParser\Node\Expr $var, array $attributes = [])
    {
        $this->attributes = $attributes;
        $this->var = $var;
    }
    public function getSubNodeNames() : array
    {
        return ['var'];
    }
    public function getType() : string
    {
        return 'Expr_PostDec';
    }
}
