<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ConfigTransformer202108309\Symfony\Component\Config\Builder;

/**
 * Build PHP classes to generate config.
 *
 * @internal
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class ClassBuilder
{
    /** @var string */
    private $namespace;
    /** @var string */
    private $name;
    /** @var Property[] */
    private $properties = [];
    /** @var Method[] */
    private $methods = [];
    private $require = [];
    private $use = [];
    private $implements = [];
    public function __construct(string $namespace, string $name)
    {
        $this->namespace = $namespace;
        $this->name = \ucfirst($this->camelCase($name)) . 'Config';
    }
    public function getDirectory() : string
    {
        return \str_replace('\\', \DIRECTORY_SEPARATOR, $this->namespace);
    }
    public function getFilename() : string
    {
        return $this->name . '.php';
    }
    public function build() : string
    {
        $rootPath = \explode(\DIRECTORY_SEPARATOR, $this->getDirectory());
        $require = '';
        foreach ($this->require as $class) {
            // figure out relative path.
            $path = \explode(\DIRECTORY_SEPARATOR, $class->getDirectory());
            $path[] = $class->getFilename();
            foreach ($rootPath as $key => $value) {
                if ($path[$key] !== $value) {
                    break;
                }
                unset($path[$key]);
            }
            $require .= \sprintf('require_once __DIR__.\\DIRECTORY_SEPARATOR.\'%s\';', \implode('\'.\\DIRECTORY_SEPARATOR.\'', $path)) . "\n";
        }
        $use = '';
        foreach (\array_keys($this->use) as $statement) {
            $use .= \sprintf('use %s;', $statement) . "\n";
        }
        $implements = [] === $this->implements ? '' : 'implements ' . \implode(', ', $this->implements);
        $body = '';
        foreach ($this->properties as $property) {
            $body .= '    ' . $property->getContent() . "\n";
        }
        foreach ($this->methods as $method) {
            $lines = \explode("\n", $method->getContent());
            foreach ($lines as $line) {
                $body .= '    ' . $line . "\n";
            }
        }
        $content = \strtr('<?php

namespace NAMESPACE;

REQUIRE
USE

/**
 * This class is automatically generated to help creating config.
 *
 * @experimental in 5.3
 */
class CLASS IMPLEMENTS
{
BODY
}
', ['NAMESPACE' => $this->namespace, 'REQUIRE' => $require, 'USE' => $use, 'CLASS' => $this->getName(), 'IMPLEMENTS' => $implements, 'BODY' => $body]);
        return $content;
    }
    /**
     * @param $this $class
     */
    public function addRequire($class) : void
    {
        $this->require[] = $class;
    }
    /**
     * @param string $class
     */
    public function addUse($class) : void
    {
        $this->use[$class] = \true;
    }
    /**
     * @param string $interface
     */
    public function addImplements($interface) : void
    {
        $this->implements[] = '\\' . \ltrim($interface, '\\');
    }
    /**
     * @param string $name
     * @param string $body
     * @param mixed[] $params
     */
    public function addMethod($name, $body, $params = []) : void
    {
        $this->methods[] = new \ConfigTransformer202108309\Symfony\Component\Config\Builder\Method(\strtr($body, ['NAME' => $this->camelCase($name)] + $params));
    }
    /**
     * @param string $name
     * @param string|null $classType
     */
    public function addProperty($name, $classType = null) : \ConfigTransformer202108309\Symfony\Component\Config\Builder\Property
    {
        $property = new \ConfigTransformer202108309\Symfony\Component\Config\Builder\Property($name, $this->camelCase($name));
        if (null !== $classType) {
            $property->setType($classType);
        }
        $this->properties[] = $property;
        $property->setContent(\sprintf('private $%s;', $property->getName()));
        return $property;
    }
    public function getProperties() : array
    {
        return $this->properties;
    }
    private function camelCase(string $input) : string
    {
        $output = \lcfirst(\str_replace(' ', '', \ucwords(\str_replace('_', ' ', $input))));
        return \preg_replace('#\\W#', '', $output);
    }
    public function getName() : string
    {
        return $this->name;
    }
    public function getNamespace() : string
    {
        return $this->namespace;
    }
    public function getFqcn() : string
    {
        return '\\' . $this->namespace . '\\' . $this->name;
    }
}
