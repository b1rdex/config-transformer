<?php

declare (strict_types=1);
namespace ConfigTransformer2021061910\Symplify\Astral\HttpKernel;

use ConfigTransformer2021061910\Symfony\Component\Config\Loader\LoaderInterface;
use ConfigTransformer2021061910\Symplify\SymplifyKernel\HttpKernel\AbstractSymplifyKernel;
final class AstralKernel extends \ConfigTransformer2021061910\Symplify\SymplifyKernel\HttpKernel\AbstractSymplifyKernel
{
    public function registerContainerConfiguration(\ConfigTransformer2021061910\Symfony\Component\Config\Loader\LoaderInterface $loader) : void
    {
        $loader->load(__DIR__ . '/../../config/config.php');
    }
}
