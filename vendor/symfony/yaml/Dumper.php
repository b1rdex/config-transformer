<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ConfigTransformerPrefix202301\Symfony\Component\Yaml;

use ConfigTransformerPrefix202301\Symfony\Component\Yaml\Tag\TaggedValue;
/**
 * Dumper dumps PHP variables to YAML strings.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @final
 */
class Dumper
{
    /**
     * The amount of spaces to use for indentation of nested nodes.
     * @var int
     */
    private $indentation;
    public function __construct(int $indentation = 4)
    {
        if ($indentation < 1) {
            throw new \InvalidArgumentException('The indentation must be greater than zero.');
        }
        $this->indentation = $indentation;
    }
    /**
     * Dumps a PHP value to YAML.
     *
     * @param mixed $input  The PHP value
     * @param int   $inline The level where you switch to inline YAML
     * @param int   $indent The level of indentation (used internally)
     * @param int   $flags  A bit field of Yaml::DUMP_* constants to customize the dumped YAML string
     */
    public function dump($input, int $inline = 0, int $indent = 0, int $flags = 0) : string
    {
        $output = '';
        $prefix = $indent ? \str_repeat(' ', $indent) : '';
        $dumpObjectAsInlineMap = \true;
        if (Yaml::DUMP_OBJECT_AS_MAP & $flags && ($input instanceof \ArrayObject || $input instanceof \stdClass)) {
            $dumpObjectAsInlineMap = empty((array) $input);
        }
        if ($inline <= 0 || !\is_array($input) && !$input instanceof TaggedValue && $dumpObjectAsInlineMap || empty($input)) {
            $output .= $prefix . Inline::dump($input, $flags);
        } elseif ($input instanceof TaggedValue) {
            $output .= $this->dumpTaggedValue($input, $inline, $indent, $flags, $prefix);
        } else {
            $dumpAsMap = Inline::isHash($input);
            foreach ($input as $key => $value) {
                if ('' !== $output && "\n" !== $output[-1]) {
                    $output .= "\n";
                }
                if (Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK & $flags && \is_string($value) && \strpos($value, "\n") !== \false && \strpos($value, "\r") === \false) {
                    // If the first line starts with a space character, the spec requires a blockIndicationIndicator
                    // http://www.yaml.org/spec/1.2/spec.html#id2793979
                    $blockIndentationIndicator = \strncmp($value, ' ', \strlen(' ')) === 0 ? (string) $this->indentation : '';
                    if (isset($value[-2]) && "\n" === $value[-2] && "\n" === $value[-1]) {
                        $blockChompingIndicator = '+';
                    } elseif ("\n" === $value[-1]) {
                        $blockChompingIndicator = '';
                    } else {
                        $blockChompingIndicator = '-';
                    }
                    $output .= \sprintf('%s%s%s |%s%s', $prefix, $dumpAsMap ? Inline::dump($key, $flags) . ':' : '-', '', $blockIndentationIndicator, $blockChompingIndicator);
                    foreach (\explode("\n", $value) as $row) {
                        if ('' === $row) {
                            $output .= "\n";
                        } else {
                            $output .= \sprintf("\n%s%s%s", $prefix, \str_repeat(' ', $this->indentation), $row);
                        }
                    }
                    continue;
                }
                if ($value instanceof TaggedValue) {
                    $output .= \sprintf('%s%s !%s', $prefix, $dumpAsMap ? Inline::dump($key, $flags) . ':' : '-', $value->getTag());
                    if (Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK & $flags && \is_string($value->getValue()) && \strpos($value->getValue(), "\n") !== \false && \strpos($value->getValue(), "\r\n") === \false) {
                        // If the first line starts with a space character, the spec requires a blockIndicationIndicator
                        // http://www.yaml.org/spec/1.2/spec.html#id2793979
                        $blockIndentationIndicator = \strncmp($value->getValue(), ' ', \strlen(' ')) === 0 ? (string) $this->indentation : '';
                        $output .= \sprintf(' |%s', $blockIndentationIndicator);
                        foreach (\explode("\n", $value->getValue()) as $row) {
                            $output .= \sprintf("\n%s%s%s", $prefix, \str_repeat(' ', $this->indentation), $row);
                        }
                        continue;
                    }
                    if ($inline - 1 <= 0 || null === $value->getValue() || \is_scalar($value->getValue())) {
                        $output .= ' ' . $this->dump($value->getValue(), $inline - 1, 0, $flags) . "\n";
                    } else {
                        $output .= "\n";
                        $output .= $this->dump($value->getValue(), $inline - 1, $dumpAsMap ? $indent + $this->indentation : $indent + 2, $flags);
                    }
                    continue;
                }
                $dumpObjectAsInlineMap = \true;
                if (Yaml::DUMP_OBJECT_AS_MAP & $flags && ($value instanceof \ArrayObject || $value instanceof \stdClass)) {
                    $dumpObjectAsInlineMap = empty((array) $value);
                }
                $willBeInlined = $inline - 1 <= 0 || !\is_array($value) && $dumpObjectAsInlineMap || empty($value);
                $output .= \sprintf('%s%s%s%s', $prefix, $dumpAsMap ? Inline::dump($key, $flags) . ':' : '-', $willBeInlined ? ' ' : "\n", $this->dump($value, $inline - 1, $willBeInlined ? 0 : $indent + $this->indentation, $flags)) . ($willBeInlined ? "\n" : '');
            }
        }
        return $output;
    }
    private function dumpTaggedValue(TaggedValue $value, int $inline, int $indent, int $flags, string $prefix) : string
    {
        $output = \sprintf('%s!%s', $prefix ? $prefix . ' ' : '', $value->getTag());
        if (Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK & $flags && \is_string($value->getValue()) && \false !== \strpos($value->getValue(), "\n") && \false === \strpos($value->getValue(), "\r\n")) {
            // If the first line starts with a space character, the spec requires a blockIndicationIndicator
            // http://www.yaml.org/spec/1.2/spec.html#id2793979
            $blockIndentationIndicator = ' ' === \substr($value->getValue(), 0, 1) ? (string) $this->indentation : '';
            $output .= \sprintf(' |%s', $blockIndentationIndicator);
            foreach (\explode("\n", $value->getValue()) as $row) {
                $output .= \sprintf("\n%s%s%s", $prefix, \str_repeat(' ', $this->indentation), $row);
            }
            return $output;
        }
        if ($inline - 1 <= 0 || null === $value->getValue() || \is_scalar($value->getValue())) {
            return $output . ' ' . $this->dump($value->getValue(), $inline - 1, 0, $flags) . "\n";
        }
        return $output . "\n" . $this->dump($value->getValue(), $inline - 1, $indent, $flags);
    }
}
