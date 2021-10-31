<?php

declare (strict_types=1);
namespace ConfigTransformer202110315\Symplify\ConfigTransformer\Converter;

use ConfigTransformer202110315\Symfony\Component\Yaml\Parser;
use ConfigTransformer202110315\Symfony\Component\Yaml\Yaml;
use ConfigTransformer202110315\Symplify\PhpConfigPrinter\Contract\YamlFileContentProviderInterface;
use ConfigTransformer202110315\Symplify\PhpConfigPrinter\NodeFactory\ContainerConfiguratorReturnClosureFactory;
use ConfigTransformer202110315\Symplify\PhpConfigPrinter\NodeFactory\RoutingConfiguratorReturnClosureFactory;
use ConfigTransformer202110315\Symplify\PhpConfigPrinter\Printer\PhpParserPhpConfigPrinter;
use ConfigTransformer202110315\Symplify\PhpConfigPrinter\Yaml\CheckerServiceParametersShifter;
/**
 * @api
 * @source https://raw.githubusercontent.com/archeoprog/maker-bundle/make-convert-services/src/Util/PhpServicesCreator.php
 *
 * @see \Symplify\ConfigTransformer\Tests\Converter\YamlToPhpConverter\YamlToPhpConverterTest
 */
final class YamlToPhpConverter
{
    /**
     * @var string[]
     */
    private const ROUTING_KEYS = ['resource', 'prefix', 'path', 'controller'];
    /**
     * @var \Symfony\Component\Yaml\Parser
     */
    private $parser;
    /**
     * @var \Symplify\PhpConfigPrinter\Printer\PhpParserPhpConfigPrinter
     */
    private $phpParserPhpConfigPrinter;
    /**
     * @var \Symplify\PhpConfigPrinter\NodeFactory\ContainerConfiguratorReturnClosureFactory
     */
    private $containerConfiguratorReturnClosureFactory;
    /**
     * @var \Symplify\PhpConfigPrinter\NodeFactory\RoutingConfiguratorReturnClosureFactory
     */
    private $routingConfiguratorReturnClosureFactory;
    /**
     * @var \Symplify\PhpConfigPrinter\Contract\YamlFileContentProviderInterface
     */
    private $yamlFileContentProvider;
    /**
     * @var \Symplify\PhpConfigPrinter\Yaml\CheckerServiceParametersShifter
     */
    private $checkerServiceParametersShifter;
    public function __construct(\ConfigTransformer202110315\Symfony\Component\Yaml\Parser $parser, \ConfigTransformer202110315\Symplify\PhpConfigPrinter\Printer\PhpParserPhpConfigPrinter $phpParserPhpConfigPrinter, \ConfigTransformer202110315\Symplify\PhpConfigPrinter\NodeFactory\ContainerConfiguratorReturnClosureFactory $containerConfiguratorReturnClosureFactory, \ConfigTransformer202110315\Symplify\PhpConfigPrinter\NodeFactory\RoutingConfiguratorReturnClosureFactory $routingConfiguratorReturnClosureFactory, \ConfigTransformer202110315\Symplify\PhpConfigPrinter\Contract\YamlFileContentProviderInterface $yamlFileContentProvider, \ConfigTransformer202110315\Symplify\PhpConfigPrinter\Yaml\CheckerServiceParametersShifter $checkerServiceParametersShifter)
    {
        $this->parser = $parser;
        $this->phpParserPhpConfigPrinter = $phpParserPhpConfigPrinter;
        $this->containerConfiguratorReturnClosureFactory = $containerConfiguratorReturnClosureFactory;
        $this->routingConfiguratorReturnClosureFactory = $routingConfiguratorReturnClosureFactory;
        $this->yamlFileContentProvider = $yamlFileContentProvider;
        $this->checkerServiceParametersShifter = $checkerServiceParametersShifter;
    }
    public function convert(string $yaml) : string
    {
        $this->yamlFileContentProvider->setContent($yaml);
        /** @var mixed[]|null $yamlArray */
        $yamlArray = $this->parser->parse($yaml, \ConfigTransformer202110315\Symfony\Component\Yaml\Yaml::PARSE_CUSTOM_TAGS | \ConfigTransformer202110315\Symfony\Component\Yaml\Yaml::PARSE_CONSTANT);
        if ($yamlArray === null) {
            return '';
        }
        return $this->convertYamlArray($yamlArray);
    }
    public function convertYamlArray(array $yamlArray) : string
    {
        if ($this->isRouteYaml($yamlArray)) {
            $return = $this->routingConfiguratorReturnClosureFactory->createFromArrayData($yamlArray);
        } else {
            $yamlArray = $this->checkerServiceParametersShifter->process($yamlArray);
            $return = $this->containerConfiguratorReturnClosureFactory->createFromYamlArray($yamlArray);
        }
        return $this->phpParserPhpConfigPrinter->prettyPrintFile([$return]);
    }
    /**
     * @param array<string, mixed> $yamlLines
     */
    private function isRouteYaml(array $yamlLines) : bool
    {
        foreach ($yamlLines as $yamlLine) {
            foreach (self::ROUTING_KEYS as $routeKey) {
                if (isset($yamlLine[$routeKey])) {
                    return \true;
                }
            }
        }
        return \false;
    }
}