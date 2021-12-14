<?php

declare (strict_types=1);
namespace ConfigTransformer202112141\Symplify\Astral\NodeValue;

use ConfigTransformer202112141\PHPStan\Type\ConstantScalarType;
use ConfigTransformer202112141\PHPStan\Type\UnionType;
final class UnionTypeValueResolver
{
    /**
     * @return mixed[]
     */
    public function resolveConstantTypes(\ConfigTransformer202112141\PHPStan\Type\UnionType $unionType) : array
    {
        $resolvedValues = [];
        foreach ($unionType->getTypes() as $unionedType) {
            if (!$unionedType instanceof \ConfigTransformer202112141\PHPStan\Type\ConstantScalarType) {
                continue;
            }
            $resolvedValues[] = $unionedType->getValue();
        }
        return $resolvedValues;
    }
}
