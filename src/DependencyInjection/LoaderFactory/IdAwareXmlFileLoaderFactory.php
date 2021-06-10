<?php

declare (strict_types=1);
namespace ConfigTransformer202106107\Symplify\ConfigTransformer\DependencyInjection\LoaderFactory;

use ConfigTransformer202106107\Symfony\Component\Config\FileLocator;
use ConfigTransformer202106107\Symfony\Component\DependencyInjection\ContainerBuilder;
use ConfigTransformer202106107\Symplify\ConfigTransformer\Collector\XmlImportCollector;
use ConfigTransformer202106107\Symplify\ConfigTransformer\Configuration\Configuration;
use ConfigTransformer202106107\Symplify\ConfigTransformer\DependencyInjection\Loader\IdAwareXmlFileLoader;
use ConfigTransformer202106107\Symplify\ConfigTransformer\Naming\UniqueNaming;
final class IdAwareXmlFileLoaderFactory
{
    /**
     * @var Configuration
     */
    private $configuration;
    /**
     * @var UniqueNaming
     */
    private $uniqueNaming;
    /**
     * @var XmlImportCollector
     */
    private $xmlImportCollector;
    public function __construct(\ConfigTransformer202106107\Symplify\ConfigTransformer\Configuration\Configuration $configuration, \ConfigTransformer202106107\Symplify\ConfigTransformer\Naming\UniqueNaming $uniqueNaming, \ConfigTransformer202106107\Symplify\ConfigTransformer\Collector\XmlImportCollector $xmlImportCollector)
    {
        $this->configuration = $configuration;
        $this->uniqueNaming = $uniqueNaming;
        $this->xmlImportCollector = $xmlImportCollector;
    }
    public function createFromContainerBuilder(\ConfigTransformer202106107\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : \ConfigTransformer202106107\Symplify\ConfigTransformer\DependencyInjection\Loader\IdAwareXmlFileLoader
    {
        return new \ConfigTransformer202106107\Symplify\ConfigTransformer\DependencyInjection\Loader\IdAwareXmlFileLoader($containerBuilder, new \ConfigTransformer202106107\Symfony\Component\Config\FileLocator(), $this->configuration, $this->uniqueNaming, $this->xmlImportCollector);
    }
}
