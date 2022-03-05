<?php

declare (strict_types=1);
namespace ConfigTransformer202203058\Symplify\Astral\PhpDocParser\PhpDocNodeVisitor;

use ConfigTransformer202203058\PHPStan\PhpDocParser\Ast\Node;
use ConfigTransformer202203058\Symplify\Astral\PhpDocParser\Contract\PhpDocNodeVisitorInterface;
/**
 * Inspired by https://github.com/nikic/PHP-Parser/blob/master/lib/PhpParser/NodeVisitorAbstract.php
 */
abstract class AbstractPhpDocNodeVisitor implements \ConfigTransformer202203058\Symplify\Astral\PhpDocParser\Contract\PhpDocNodeVisitorInterface
{
    public function beforeTraverse(\ConfigTransformer202203058\PHPStan\PhpDocParser\Ast\Node $node) : void
    {
    }
    /**
     * @return int|Node|null
     */
    public function enterNode(\ConfigTransformer202203058\PHPStan\PhpDocParser\Ast\Node $node)
    {
        return null;
    }
    /**
     * @return null|int|\PhpParser\Node|Node[] Replacement node (or special return)
     */
    public function leaveNode(\ConfigTransformer202203058\PHPStan\PhpDocParser\Ast\Node $node)
    {
        return null;
    }
    public function afterTraverse(\ConfigTransformer202203058\PHPStan\PhpDocParser\Ast\Node $node) : void
    {
    }
}
