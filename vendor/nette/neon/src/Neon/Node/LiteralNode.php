<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */
declare (strict_types=1);
namespace ConfigTransformer2022011110\Nette\Neon\Node;

use ConfigTransformer2022011110\Nette\Neon\Node;
/** @internal */
final class LiteralNode extends \ConfigTransformer2022011110\Nette\Neon\Node
{
    private const SIMPLE_TYPES = ['true' => \true, 'True' => \true, 'TRUE' => \true, 'yes' => \true, 'Yes' => \true, 'YES' => \true, 'on' => \true, 'On' => \true, 'ON' => \true, 'false' => \false, 'False' => \false, 'FALSE' => \false, 'no' => \false, 'No' => \false, 'NO' => \false, 'off' => \false, 'Off' => \false, 'OFF' => \false, 'null' => null, 'Null' => null, 'NULL' => null];
    private const DEPRECATED_TYPES = ['on' => 1, 'On' => 1, 'ON' => 1, 'off' => 1, 'Off' => 1, 'OFF' => 1];
    private const PATTERN_DATETIME = '#\\d\\d\\d\\d-\\d\\d?-\\d\\d?(?:(?:[Tt]| ++)\\d\\d?:\\d\\d:\\d\\d(?:\\.\\d*+)? *+(?:Z|[-+]\\d\\d?(?::?\\d\\d)?)?)?$#DA';
    private const PATTERN_HEX = '#0x[0-9a-fA-F]++$#DA';
    private const PATTERN_OCTAL = '#0o[0-7]++$#DA';
    private const PATTERN_BINARY = '#0b[0-1]++$#DA';
    /** @var mixed */
    public $value;
    public function __construct($value, int $pos = null)
    {
        $this->value = $value;
        $this->startPos = $this->endPos = $pos;
    }
    public function toValue()
    {
        return $this->value;
    }
    /** @return mixed */
    public static function parse(string $value, bool $isKey = \false)
    {
        if (!$isKey && \array_key_exists($value, self::SIMPLE_TYPES)) {
            if (isset(self::DEPRECATED_TYPES[$value])) {
                \trigger_error("Neon: keyword '{$value}' is deprecated, use true/yes or false/no.", \E_USER_DEPRECATED);
            }
            return self::SIMPLE_TYPES[$value];
        } elseif (\is_numeric($value)) {
            return $value * 1;
        } elseif (\preg_match(self::PATTERN_HEX, $value)) {
            return \hexdec($value);
        } elseif (\preg_match(self::PATTERN_OCTAL, $value)) {
            return \octdec($value);
        } elseif (\preg_match(self::PATTERN_BINARY, $value)) {
            return \bindec($value);
        } elseif (!$isKey && \preg_match(self::PATTERN_DATETIME, $value)) {
            return new \DateTimeImmutable($value);
        } else {
            return $value;
        }
    }
    public function toString() : string
    {
        if ($this->value instanceof \DateTimeInterface) {
            return $this->value->format('Y-m-d H:i:s O');
        } elseif (\is_string($this->value)) {
            return $this->value;
        } elseif (\is_float($this->value)) {
            $res = \json_encode($this->value);
            return \strpos($res, '.') === \false ? $res . '.0' : $res;
        } elseif (\is_int($this->value) || \is_bool($this->value) || $this->value === null) {
            return \json_encode($this->value);
        } else {
            throw new \LogicException();
        }
    }
}
