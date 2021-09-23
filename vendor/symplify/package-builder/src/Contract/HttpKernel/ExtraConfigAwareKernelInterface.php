<?php

declare (strict_types=1);
namespace ConfigTransformer202109235\Symplify\PackageBuilder\Contract\HttpKernel;

use ConfigTransformer202109235\Symfony\Component\HttpKernel\KernelInterface;
use ConfigTransformer202109235\Symplify\SmartFileSystem\SmartFileInfo;
interface ExtraConfigAwareKernelInterface extends \ConfigTransformer202109235\Symfony\Component\HttpKernel\KernelInterface
{
    /**
     * @param string[]|SmartFileInfo[] $configs
     */
    public function setConfigs($configs) : void;
}
