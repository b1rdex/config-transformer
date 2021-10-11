<?php

declare (strict_types=1);
namespace ConfigTransformer202110110\Symplify\PhpConfigPrinter\HttpKernel;

use ConfigTransformer202110110\Symfony\Component\Config\Loader\LoaderInterface;
use ConfigTransformer202110110\Symfony\Component\HttpKernel\Bundle\BundleInterface;
use ConfigTransformer202110110\Symplify\PackageBuilder\Contract\HttpKernel\ExtraConfigAwareKernelInterface;
use ConfigTransformer202110110\Symplify\PhpConfigPrinter\Bundle\PhpConfigPrinterBundle;
use ConfigTransformer202110110\Symplify\SymplifyKernel\HttpKernel\AbstractSymplifyKernel;
final class PhpConfigPrinterKernel extends \ConfigTransformer202110110\Symplify\SymplifyKernel\HttpKernel\AbstractSymplifyKernel implements \ConfigTransformer202110110\Symplify\PackageBuilder\Contract\HttpKernel\ExtraConfigAwareKernelInterface
{
    /**
     * @var string[]
     */
    private $configs = [];
    /**
     * @param \Symfony\Component\Config\Loader\LoaderInterface $loader
     */
    public function registerContainerConfiguration($loader) : void
    {
        $loader->load(__DIR__ . '/../../config/config.php');
        foreach ($this->configs as $config) {
            $loader->load($config);
        }
    }
    /**
     * @return BundleInterface[]
     */
    public function registerBundles() : iterable
    {
        return [new \ConfigTransformer202110110\Symplify\PhpConfigPrinter\Bundle\PhpConfigPrinterBundle()];
    }
    /**
     * @param string[] $configs
     */
    public function setConfigs($configs) : void
    {
        $this->configs = $configs;
    }
}
