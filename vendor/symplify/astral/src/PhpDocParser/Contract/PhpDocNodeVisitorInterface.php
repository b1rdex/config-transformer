<?php

declare (strict_types=1);
namespace ConfigTransformer202202247\Symplify\Astral\PhpDocParser\Contract;

use ConfigTransformer202202247\PHPStan\PhpDocParser\Ast\Node;
/**
 * Inspired by https://github.com/nikic/PHP-Parser/blob/master/lib/PhpParser/NodeVisitor.php
 */
interface PhpDocNodeVisitorInterface
{
    public function beforeTraverse(\ConfigTransformer202202247\PHPStan\PhpDocParser\Ast\Node $node) : void;
    /**
     * @return int|Node|null
     */
    public function enterNode(\ConfigTransformer202202247\PHPStan\PhpDocParser\Ast\Node $node);
    /**
     * @return null|int|\PhpParser\Node|Node[] Replacement node (or special return)
     */
    public function leaveNode(\ConfigTransformer202202247\PHPStan\PhpDocParser\Ast\Node $node);
    public function afterTraverse(\ConfigTransformer202202247\PHPStan\PhpDocParser\Ast\Node $node) : void;
}
