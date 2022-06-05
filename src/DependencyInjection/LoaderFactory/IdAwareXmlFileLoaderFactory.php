<?php

declare (strict_types=1);
namespace ConfigTransformer202206055\Symplify\ConfigTransformer\DependencyInjection\LoaderFactory;

use ConfigTransformer202206055\Symfony\Component\Config\FileLocator;
use ConfigTransformer202206055\Symfony\Component\DependencyInjection\ContainerBuilder;
use ConfigTransformer202206055\Symplify\ConfigTransformer\Collector\XmlImportCollector;
use ConfigTransformer202206055\Symplify\ConfigTransformer\DependencyInjection\Loader\IdAwareXmlFileLoader;
use ConfigTransformer202206055\Symplify\ConfigTransformer\Naming\UniqueNaming;
final class IdAwareXmlFileLoaderFactory
{
    /**
     * @var \Symplify\ConfigTransformer\Naming\UniqueNaming
     */
    private $uniqueNaming;
    /**
     * @var \Symplify\ConfigTransformer\Collector\XmlImportCollector
     */
    private $xmlImportCollector;
    public function __construct(\ConfigTransformer202206055\Symplify\ConfigTransformer\Naming\UniqueNaming $uniqueNaming, \ConfigTransformer202206055\Symplify\ConfigTransformer\Collector\XmlImportCollector $xmlImportCollector)
    {
        $this->uniqueNaming = $uniqueNaming;
        $this->xmlImportCollector = $xmlImportCollector;
    }
    public function createFromContainerBuilder(\ConfigTransformer202206055\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : \ConfigTransformer202206055\Symplify\ConfigTransformer\DependencyInjection\Loader\IdAwareXmlFileLoader
    {
        return new \ConfigTransformer202206055\Symplify\ConfigTransformer\DependencyInjection\Loader\IdAwareXmlFileLoader($containerBuilder, new \ConfigTransformer202206055\Symfony\Component\Config\FileLocator(), $this->uniqueNaming, $this->xmlImportCollector);
    }
}
