<?php

declare (strict_types=1);
namespace ConfigTransformer202110018\Symplify\ConfigTransformer\Configuration;

use ConfigTransformer202110018\Symfony\Component\Console\Input\InputInterface;
use ConfigTransformer202110018\Symplify\ConfigTransformer\ValueObject\Configuration;
use ConfigTransformer202110018\Symplify\ConfigTransformer\ValueObject\Option;
final class ConfigurationFactory
{
    public function createFromInput(\ConfigTransformer202110018\Symfony\Component\Console\Input\InputInterface $input) : \ConfigTransformer202110018\Symplify\ConfigTransformer\ValueObject\Configuration
    {
        $source = (array) $input->getArgument(\ConfigTransformer202110018\Symplify\ConfigTransformer\ValueObject\Option::SOURCES);
        $targetSymfonyVersion = \floatval($input->getOption(\ConfigTransformer202110018\Symplify\ConfigTransformer\ValueObject\Option::TARGET_SYMFONY_VERSION));
        $isDryRun = \boolval($input->getOption(\ConfigTransformer202110018\Symplify\ConfigTransformer\ValueObject\Option::DRY_RUN));
        return new \ConfigTransformer202110018\Symplify\ConfigTransformer\ValueObject\Configuration($source, $targetSymfonyVersion, $isDryRun);
    }
}
