<?php

declare (strict_types=1);
namespace ConfigTransformer2021061910\Symplify\PackageBuilder\Contract\HttpKernel;

use ConfigTransformer2021061910\Symfony\Component\HttpKernel\KernelInterface;
use ConfigTransformer2021061910\Symplify\SmartFileSystem\SmartFileInfo;
interface ExtraConfigAwareKernelInterface extends \ConfigTransformer2021061910\Symfony\Component\HttpKernel\KernelInterface
{
    /**
     * @param string[]|SmartFileInfo[] $configs
     */
    public function setConfigs(array $configs) : void;
}
