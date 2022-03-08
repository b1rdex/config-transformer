<?php

declare (strict_types=1);
namespace ConfigTransformer202203082\Symplify\PhpConfigPrinter\NodeFactory;

use ConfigTransformer202203082\PhpParser\BuilderHelpers;
use ConfigTransformer202203082\PhpParser\Node\Expr;
use ConfigTransformer202203082\PhpParser\Node\Expr\BinaryOp\Concat;
use ConfigTransformer202203082\PhpParser\Node\Expr\ClassConstFetch;
use ConfigTransformer202203082\PhpParser\Node\Expr\ConstFetch;
use ConfigTransformer202203082\PhpParser\Node\Name;
use ConfigTransformer202203082\PhpParser\Node\Name\FullyQualified;
use ConfigTransformer202203082\PhpParser\Node\Scalar\MagicConst\Dir;
use ConfigTransformer202203082\PhpParser\Node\Scalar\String_;
final class CommonNodeFactory
{
    /**
     * @param mixed $argument
     */
    public function createAbsoluteDirExpr($argument) : \ConfigTransformer202203082\PhpParser\Node\Expr
    {
        if ($argument === '') {
            return new \ConfigTransformer202203082\PhpParser\Node\Scalar\String_('');
        }
        if (\is_string($argument)) {
            // preslash with dir
            $argument = '/' . $argument;
        }
        $argumentValue = \ConfigTransformer202203082\PhpParser\BuilderHelpers::normalizeValue($argument);
        if ($argumentValue instanceof \ConfigTransformer202203082\PhpParser\Node\Scalar\String_) {
            $argumentValue = new \ConfigTransformer202203082\PhpParser\Node\Expr\BinaryOp\Concat(new \ConfigTransformer202203082\PhpParser\Node\Scalar\MagicConst\Dir(), $argumentValue);
        }
        return $argumentValue;
    }
    public function createClassReference(string $className) : \ConfigTransformer202203082\PhpParser\Node\Expr\ClassConstFetch
    {
        return $this->createConstFetch($className, 'class');
    }
    public function createConstFetch(string $className, string $constantName) : \ConfigTransformer202203082\PhpParser\Node\Expr\ClassConstFetch
    {
        return new \ConfigTransformer202203082\PhpParser\Node\Expr\ClassConstFetch(new \ConfigTransformer202203082\PhpParser\Node\Name\FullyQualified($className), $constantName);
    }
    public function createFalse() : \ConfigTransformer202203082\PhpParser\Node\Expr\ConstFetch
    {
        return new \ConfigTransformer202203082\PhpParser\Node\Expr\ConstFetch(new \ConfigTransformer202203082\PhpParser\Node\Name('false'));
    }
    public function createTrue() : \ConfigTransformer202203082\PhpParser\Node\Expr\ConstFetch
    {
        return new \ConfigTransformer202203082\PhpParser\Node\Expr\ConstFetch(new \ConfigTransformer202203082\PhpParser\Node\Name('true'));
    }
}
