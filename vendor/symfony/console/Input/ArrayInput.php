<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ConfigTransformer202112316\Symfony\Component\Console\Input;

use ConfigTransformer202112316\Symfony\Component\Console\Exception\InvalidArgumentException;
use ConfigTransformer202112316\Symfony\Component\Console\Exception\InvalidOptionException;
/**
 * ArrayInput represents an input provided as an array.
 *
 * Usage:
 *
 *     $input = new ArrayInput(['command' => 'foo:bar', 'foo' => 'bar', '--bar' => 'foobar']);
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class ArrayInput extends \ConfigTransformer202112316\Symfony\Component\Console\Input\Input
{
    /**
     * @var mixed[]
     */
    private $parameters;
    public function __construct(array $parameters, \ConfigTransformer202112316\Symfony\Component\Console\Input\InputDefinition $definition = null)
    {
        $this->parameters = $parameters;
        parent::__construct($definition);
    }
    /**
     * {@inheritdoc}
     */
    public function getFirstArgument() : ?string
    {
        foreach ($this->parameters as $param => $value) {
            if ($param && \is_string($param) && '-' === $param[0]) {
                continue;
            }
            return $value;
        }
        return null;
    }
    /**
     * {@inheritdoc}
     * @param mixed[]|string $values
     */
    public function hasParameterOption($values, bool $onlyParams = \false) : bool
    {
        $values = (array) $values;
        foreach ($this->parameters as $k => $v) {
            if (!\is_int($k)) {
                $v = $k;
            }
            if ($onlyParams && '--' === $v) {
                return \false;
            }
            if (\in_array($v, $values)) {
                return \true;
            }
        }
        return \false;
    }
    /**
     * {@inheritdoc}
     * @param mixed[]|string $values
     * @param mixed[]|bool|float|int|string|null $default
     * @return mixed
     */
    public function getParameterOption($values, $default = \false, bool $onlyParams = \false)
    {
        $values = (array) $values;
        foreach ($this->parameters as $k => $v) {
            if ($onlyParams && ('--' === $k || \is_int($k) && '--' === $v)) {
                return $default;
            }
            if (\is_int($k)) {
                if (\in_array($v, $values)) {
                    return \true;
                }
            } elseif (\in_array($k, $values)) {
                return $v;
            }
        }
        return $default;
    }
    /**
     * Returns a stringified representation of the args passed to the command.
     */
    public function __toString() : string
    {
        $params = [];
        foreach ($this->parameters as $param => $val) {
            if ($param && \is_string($param) && '-' === $param[0]) {
                $glue = '-' === $param[1] ? '=' : ' ';
                if (\is_array($val)) {
                    foreach ($val as $v) {
                        $params[] = $param . ('' != $v ? $glue . $this->escapeToken($v) : '');
                    }
                } else {
                    $params[] = $param . ('' != $val ? $glue . $this->escapeToken($val) : '');
                }
            } else {
                $params[] = \is_array($val) ? \implode(' ', \array_map([$this, 'escapeToken'], $val)) : $this->escapeToken($val);
            }
        }
        return \implode(' ', $params);
    }
    /**
     * {@inheritdoc}
     */
    protected function parse()
    {
        foreach ($this->parameters as $key => $value) {
            if ('--' === $key) {
                return;
            }
            if (\strncmp($key, '--', \strlen('--')) === 0) {
                $this->addLongOption(\substr($key, 2), $value);
            } elseif (\strncmp($key, '-', \strlen('-')) === 0) {
                $this->addShortOption(\substr($key, 1), $value);
            } else {
                $this->addArgument($key, $value);
            }
        }
    }
    /**
     * Adds a short option value.
     *
     * @throws InvalidOptionException When option given doesn't exist
     * @param mixed $value
     */
    private function addShortOption(string $shortcut, $value)
    {
        if (!$this->definition->hasShortcut($shortcut)) {
            throw new \ConfigTransformer202112316\Symfony\Component\Console\Exception\InvalidOptionException(\sprintf('The "-%s" option does not exist.', $shortcut));
        }
        $this->addLongOption($this->definition->getOptionForShortcut($shortcut)->getName(), $value);
    }
    /**
     * Adds a long option value.
     *
     * @throws InvalidOptionException When option given doesn't exist
     * @throws InvalidOptionException When a required value is missing
     * @param mixed $value
     */
    private function addLongOption(string $name, $value)
    {
        if (!$this->definition->hasOption($name)) {
            if (!$this->definition->hasNegation($name)) {
                throw new \ConfigTransformer202112316\Symfony\Component\Console\Exception\InvalidOptionException(\sprintf('The "--%s" option does not exist.', $name));
            }
            $optionName = $this->definition->negationToName($name);
            $this->options[$optionName] = \false;
            return;
        }
        $option = $this->definition->getOption($name);
        if (null === $value) {
            if ($option->isValueRequired()) {
                throw new \ConfigTransformer202112316\Symfony\Component\Console\Exception\InvalidOptionException(\sprintf('The "--%s" option requires a value.', $name));
            }
            if (!$option->isValueOptional()) {
                $value = \true;
            }
        }
        $this->options[$name] = $value;
    }
    /**
     * Adds an argument value.
     *
     * @throws InvalidArgumentException When argument given doesn't exist
     * @param int|string $name
     * @param mixed $value
     */
    private function addArgument($name, $value)
    {
        if (!$this->definition->hasArgument($name)) {
            throw new \ConfigTransformer202112316\Symfony\Component\Console\Exception\InvalidArgumentException(\sprintf('The "%s" argument does not exist.', $name));
        }
        $this->arguments[$name] = $value;
    }
}
