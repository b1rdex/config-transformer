<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ConfigTransformer202201151\Symfony\Component\ExpressionLanguage;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface ExpressionFunctionProviderInterface
{
    /**
     * @return ExpressionFunction[]
     */
    public function getFunctions();
}
