<?php

declare (strict_types=1);
namespace ConfigTransformer202206072\PhpParser\Node;

use ConfigTransformer202206072\PhpParser\Node;
use ConfigTransformer202206072\PhpParser\NodeAbstract;
class MatchArm extends NodeAbstract
{
    /** @var null|Node\Expr[] */
    public $conds;
    /** @var Node\Expr */
    public $body;
    /**
     * @param null|Node\Expr[] $conds
     */
    public function __construct($conds, Node\Expr $body, array $attributes = [])
    {
        $this->conds = $conds;
        $this->body = $body;
        $this->attributes = $attributes;
    }
    public function getSubNodeNames() : array
    {
        return ['conds', 'body'];
    }
    public function getType() : string
    {
        return 'MatchArm';
    }
}
