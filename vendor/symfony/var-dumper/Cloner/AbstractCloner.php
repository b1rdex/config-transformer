<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ConfigTransformer202106202\Symfony\Component\VarDumper\Cloner;

use ConfigTransformer202106202\Symfony\Component\VarDumper\Caster\Caster;
use ConfigTransformer202106202\Symfony\Component\VarDumper\Exception\ThrowingCasterException;
/**
 * AbstractCloner implements a generic caster mechanism for objects and resources.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
abstract class AbstractCloner implements \ConfigTransformer202106202\Symfony\Component\VarDumper\Cloner\ClonerInterface
{
    public static $defaultCasters = ['__PHP_Incomplete_Class' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\Caster', 'castPhpIncompleteClass'], 'ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\CutStub' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castStub'], 'ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\CutArrayStub' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castCutArray'], 'ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ConstStub' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castStub'], 'ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\EnumStub' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castEnum'], 'Closure' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castClosure'], 'Generator' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castGenerator'], 'ReflectionType' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castType'], 'ReflectionAttribute' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castAttribute'], 'ReflectionGenerator' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castReflectionGenerator'], 'ReflectionClass' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castClass'], 'ReflectionClassConstant' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castClassConstant'], 'ReflectionFunctionAbstract' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castFunctionAbstract'], 'ReflectionMethod' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castMethod'], 'ReflectionParameter' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castParameter'], 'ReflectionProperty' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castProperty'], 'ReflectionReference' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castReference'], 'ReflectionExtension' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castExtension'], 'ReflectionZendExtension' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castZendExtension'], 'ConfigTransformer202106202\\Doctrine\\Common\\Persistence\\ObjectManager' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'ConfigTransformer202106202\\Doctrine\\Common\\Proxy\\Proxy' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castCommonProxy'], 'ConfigTransformer202106202\\Doctrine\\ORM\\Proxy\\Proxy' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castOrmProxy'], 'ConfigTransformer202106202\\Doctrine\\ORM\\PersistentCollection' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castPersistentCollection'], 'ConfigTransformer202106202\\Doctrine\\Persistence\\ObjectManager' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'DOMException' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castException'], 'DOMStringList' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNameList' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMImplementation' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castImplementation'], 'DOMImplementationList' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNode' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNode'], 'DOMNameSpaceNode' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNameSpaceNode'], 'DOMDocument' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castDocument'], 'DOMNodeList' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNamedNodeMap' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMCharacterData' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castCharacterData'], 'DOMAttr' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castAttr'], 'DOMElement' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castElement'], 'DOMText' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castText'], 'DOMTypeinfo' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castTypeinfo'], 'DOMDomError' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castDomError'], 'DOMLocator' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLocator'], 'DOMDocumentType' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castDocumentType'], 'DOMNotation' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNotation'], 'DOMEntity' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castEntity'], 'DOMProcessingInstruction' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castProcessingInstruction'], 'DOMXPath' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castXPath'], 'XMLReader' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\XmlReaderCaster', 'castXmlReader'], 'ErrorException' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castErrorException'], 'Exception' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castException'], 'Error' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castError'], 'ConfigTransformer202106202\\Symfony\\Bridge\\Monolog\\Logger' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'ConfigTransformer202106202\\Symfony\\Component\\DependencyInjection\\ContainerInterface' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'ConfigTransformer202106202\\Symfony\\Component\\EventDispatcher\\EventDispatcherInterface' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'ConfigTransformer202106202\\Symfony\\Component\\HttpClient\\CurlHttpClient' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClient'], 'ConfigTransformer202106202\\Symfony\\Component\\HttpClient\\NativeHttpClient' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClient'], 'ConfigTransformer202106202\\Symfony\\Component\\HttpClient\\Response\\CurlResponse' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClientResponse'], 'ConfigTransformer202106202\\Symfony\\Component\\HttpClient\\Response\\NativeResponse' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClientResponse'], 'ConfigTransformer202106202\\Symfony\\Component\\HttpFoundation\\Request' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castRequest'], 'ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Exception\\ThrowingCasterException' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castThrowingCasterException'], 'ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\TraceStub' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castTraceStub'], 'ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\FrameStub' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castFrameStub'], 'ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Cloner\\AbstractCloner' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'ConfigTransformer202106202\\Symfony\\Component\\ErrorHandler\\Exception\\SilencedErrorContext' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castSilencedErrorContext'], 'ConfigTransformer202106202\\Imagine\\Image\\ImageInterface' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ImagineCaster', 'castImage'], 'ConfigTransformer202106202\\Ramsey\\Uuid\\UuidInterface' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\UuidCaster', 'castRamseyUuid'], 'ConfigTransformer202106202\\ProxyManager\\Proxy\\ProxyInterface' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ProxyManagerCaster', 'castProxy'], 'PHPUnit_Framework_MockObject_MockObject' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'ConfigTransformer202106202\\PHPUnit\\Framework\\MockObject\\MockObject' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'ConfigTransformer202106202\\PHPUnit\\Framework\\MockObject\\Stub' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'ConfigTransformer202106202\\Prophecy\\Prophecy\\ProphecySubjectInterface' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'ConfigTransformer202106202\\Mockery\\MockInterface' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'PDO' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\PdoCaster', 'castPdo'], 'PDOStatement' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\PdoCaster', 'castPdoStatement'], 'AMQPConnection' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castConnection'], 'AMQPChannel' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castChannel'], 'AMQPQueue' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castQueue'], 'AMQPExchange' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castExchange'], 'AMQPEnvelope' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castEnvelope'], 'ArrayObject' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castArrayObject'], 'ArrayIterator' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castArrayIterator'], 'SplDoublyLinkedList' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castDoublyLinkedList'], 'SplFileInfo' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castFileInfo'], 'SplFileObject' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castFileObject'], 'SplHeap' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castHeap'], 'SplObjectStorage' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castObjectStorage'], 'SplPriorityQueue' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castHeap'], 'OuterIterator' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castOuterIterator'], 'WeakReference' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castWeakReference'], 'Redis' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedis'], 'RedisArray' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedisArray'], 'RedisCluster' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedisCluster'], 'DateTimeInterface' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castDateTime'], 'DateInterval' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castInterval'], 'DateTimeZone' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castTimeZone'], 'DatePeriod' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castPeriod'], 'GMP' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\GmpCaster', 'castGmp'], 'MessageFormatter' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castMessageFormatter'], 'NumberFormatter' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castNumberFormatter'], 'IntlTimeZone' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlTimeZone'], 'IntlCalendar' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlCalendar'], 'IntlDateFormatter' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlDateFormatter'], 'Memcached' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\MemcachedCaster', 'castMemcached'], 'ConfigTransformer202106202\\Ds\\Collection' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castCollection'], 'ConfigTransformer202106202\\Ds\\Map' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castMap'], 'ConfigTransformer202106202\\Ds\\Pair' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castPair'], 'ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DsPairStub' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castPairStub'], 'CurlHandle' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castCurl'], ':curl' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castCurl'], ':dba' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castDba'], ':dba persistent' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castDba'], 'GdImage' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castGd'], ':gd' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castGd'], ':mysql link' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castMysqlLink'], ':pgsql large object' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLargeObject'], ':pgsql link' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLink'], ':pgsql link persistent' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLink'], ':pgsql result' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castResult'], ':process' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castProcess'], ':stream' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStream'], 'OpenSSLCertificate' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castOpensslX509'], ':OpenSSL X.509' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castOpensslX509'], ':persistent stream' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStream'], ':stream-context' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStreamContext'], 'XmlParser' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\XmlResourceCaster', 'castXml'], ':xml' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\XmlResourceCaster', 'castXml'], 'RdKafka' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castRdKafka'], 'ConfigTransformer202106202\\RdKafka\\Conf' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castConf'], 'ConfigTransformer202106202\\RdKafka\\KafkaConsumer' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castKafkaConsumer'], 'ConfigTransformer202106202\\RdKafka\\Metadata\\Broker' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castBrokerMetadata'], 'ConfigTransformer202106202\\RdKafka\\Metadata\\Collection' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castCollectionMetadata'], 'ConfigTransformer202106202\\RdKafka\\Metadata\\Partition' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castPartitionMetadata'], 'ConfigTransformer202106202\\RdKafka\\Metadata\\Topic' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopicMetadata'], 'ConfigTransformer202106202\\RdKafka\\Message' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castMessage'], 'ConfigTransformer202106202\\RdKafka\\Topic' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopic'], 'ConfigTransformer202106202\\RdKafka\\TopicPartition' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopicPartition'], 'ConfigTransformer202106202\\RdKafka\\TopicConf' => ['ConfigTransformer202106202\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopicConf']];
    protected $maxItems = 2500;
    protected $maxString = -1;
    protected $minDepth = 1;
    private $casters = [];
    private $prevErrorHandler;
    private $classInfo = [];
    private $filter = 0;
    /**
     * @param callable[]|null $casters A map of casters
     *
     * @see addCasters
     */
    public function __construct(array $casters = null)
    {
        if (null === $casters) {
            $casters = static::$defaultCasters;
        }
        $this->addCasters($casters);
    }
    /**
     * Adds casters for resources and objects.
     *
     * Maps resources or objects types to a callback.
     * Types are in the key, with a callable caster for value.
     * Resource types are to be prefixed with a `:`,
     * see e.g. static::$defaultCasters.
     *
     * @param callable[] $casters A map of casters
     */
    public function addCasters(array $casters)
    {
        foreach ($casters as $type => $callback) {
            $this->casters[$type][] = $callback;
        }
    }
    /**
     * Sets the maximum number of items to clone past the minimum depth in nested structures.
     */
    public function setMaxItems(int $maxItems)
    {
        $this->maxItems = $maxItems;
    }
    /**
     * Sets the maximum cloned length for strings.
     */
    public function setMaxString(int $maxString)
    {
        $this->maxString = $maxString;
    }
    /**
     * Sets the minimum tree depth where we are guaranteed to clone all the items.  After this
     * depth is reached, only setMaxItems items will be cloned.
     */
    public function setMinDepth(int $minDepth)
    {
        $this->minDepth = $minDepth;
    }
    /**
     * Clones a PHP variable.
     *
     * @param mixed $var    Any PHP variable
     * @param int   $filter A bit field of Caster::EXCLUDE_* constants
     *
     * @return Data The cloned variable represented by a Data object
     */
    public function cloneVar($var, $filter = 0)
    {
        $this->prevErrorHandler = \set_error_handler(function ($type, $msg, $file, $line, $context = []) {
            if (\E_RECOVERABLE_ERROR === $type || \E_USER_ERROR === $type) {
                // Cloner never dies
                throw new \ErrorException($msg, 0, $type, $file, $line);
            }
            if ($this->prevErrorHandler) {
                return ($this->prevErrorHandler)($type, $msg, $file, $line, $context);
            }
            return \false;
        });
        $this->filter = $filter;
        if ($gc = \gc_enabled()) {
            \gc_disable();
        }
        try {
            return new \ConfigTransformer202106202\Symfony\Component\VarDumper\Cloner\Data($this->doClone($var));
        } finally {
            if ($gc) {
                \gc_enable();
            }
            \restore_error_handler();
            $this->prevErrorHandler = null;
        }
    }
    /**
     * Effectively clones the PHP variable.
     *
     * @param mixed $var Any PHP variable
     *
     * @return array The cloned variable represented in an array
     */
    protected abstract function doClone($var);
    /**
     * Casts an object to an array representation.
     *
     * @param bool $isNested True if the object is nested in the dumped structure
     *
     * @return array The object casted as array
     */
    protected function castObject(\ConfigTransformer202106202\Symfony\Component\VarDumper\Cloner\Stub $stub, bool $isNested)
    {
        $obj = $stub->value;
        $class = $stub->class;
        if (\PHP_VERSION_ID < 80000 ? "\0" === ($class[15] ?? null) : \false !== \strpos($class, "@anonymous\0")) {
            $stub->class = \get_debug_type($obj);
        }
        if (isset($this->classInfo[$class])) {
            [$i, $parents, $hasDebugInfo, $fileInfo] = $this->classInfo[$class];
        } else {
            $i = 2;
            $parents = [$class];
            $hasDebugInfo = \method_exists($class, '__debugInfo');
            foreach (\class_parents($class) as $p) {
                $parents[] = $p;
                ++$i;
            }
            foreach (\class_implements($class) as $p) {
                $parents[] = $p;
                ++$i;
            }
            $parents[] = '*';
            $r = new \ReflectionClass($class);
            $fileInfo = $r->isInternal() || $r->isSubclassOf(\ConfigTransformer202106202\Symfony\Component\VarDumper\Cloner\Stub::class) ? [] : ['file' => $r->getFileName(), 'line' => $r->getStartLine()];
            $this->classInfo[$class] = [$i, $parents, $hasDebugInfo, $fileInfo];
        }
        $stub->attr += $fileInfo;
        $a = \ConfigTransformer202106202\Symfony\Component\VarDumper\Caster\Caster::castObject($obj, $class, $hasDebugInfo, $stub->class);
        try {
            while ($i--) {
                if (!empty($this->casters[$p = $parents[$i]])) {
                    foreach ($this->casters[$p] as $callback) {
                        $a = $callback($obj, $a, $stub, $isNested, $this->filter);
                    }
                }
            }
        } catch (\Exception $e) {
            $a = [(\ConfigTransformer202106202\Symfony\Component\VarDumper\Cloner\Stub::TYPE_OBJECT === $stub->type ? \ConfigTransformer202106202\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL : '') . '⚠' => new \ConfigTransformer202106202\Symfony\Component\VarDumper\Exception\ThrowingCasterException($e)] + $a;
        }
        return $a;
    }
    /**
     * Casts a resource to an array representation.
     *
     * @param bool $isNested True if the object is nested in the dumped structure
     *
     * @return array The resource casted as array
     */
    protected function castResource(\ConfigTransformer202106202\Symfony\Component\VarDumper\Cloner\Stub $stub, bool $isNested)
    {
        $a = [];
        $res = $stub->value;
        $type = $stub->class;
        try {
            if (!empty($this->casters[':' . $type])) {
                foreach ($this->casters[':' . $type] as $callback) {
                    $a = $callback($res, $a, $stub, $isNested, $this->filter);
                }
            }
        } catch (\Exception $e) {
            $a = [(\ConfigTransformer202106202\Symfony\Component\VarDumper\Cloner\Stub::TYPE_OBJECT === $stub->type ? \ConfigTransformer202106202\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL : '') . '⚠' => new \ConfigTransformer202106202\Symfony\Component\VarDumper\Exception\ThrowingCasterException($e)] + $a;
        }
        return $a;
    }
}