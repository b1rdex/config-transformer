<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ConfigTransformer202109079\Symfony\Component\DependencyInjection\Loader\Configurator\Traits;

use ConfigTransformer202109079\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
trait AutoconfigureTrait
{
    /**
     * Sets whether or not instanceof conditionals should be prepended with a global set.
     *
     * @return $this
     *
     * @throws InvalidArgumentException when a parent is already set
     * @param bool $autoconfigured
     */
    public final function autoconfigure($autoconfigured = \true)
    {
        $this->definition->setAutoconfigured($autoconfigured);
        return $this;
    }
}
