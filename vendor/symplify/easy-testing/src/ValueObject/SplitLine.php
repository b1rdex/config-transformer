<?php

declare (strict_types=1);
namespace ConfigTransformerPrefix202302\Symplify\EasyTesting\ValueObject;

final class SplitLine
{
    /**
     * @see https://regex101.com/r/8fuULy/1
     * @var string
     */
    public const SPLIT_LINE_REGEX = "#\\-\\-\\-\\-\\-\r?\n#";
}
