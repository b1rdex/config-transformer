<?php

declare (strict_types=1);
namespace Symplify\ConfigTransformer\FileSystem;

use ConfigTransformer202208\Symfony\Component\Console\Style\SymfonyStyle;
use Symplify\ConfigTransformer\ValueObject\Configuration;
use Symplify\ConfigTransformer\ValueObject\ConvertedContent;
use ConfigTransformer202208\Symplify\PackageBuilder\Console\Output\ConsoleDiffer;
use ConfigTransformer202208\Symplify\SmartFileSystem\SmartFileSystem;
final class ConfigFileDumper
{
    /**
     * @var \Symfony\Component\Console\Style\SymfonyStyle
     */
    private $symfonyStyle;
    /**
     * @var \Symplify\SmartFileSystem\SmartFileSystem
     */
    private $smartFileSystem;
    /**
     * @var \Symplify\PackageBuilder\Console\Output\ConsoleDiffer
     */
    private $consoleDiffer;
    public function __construct(SymfonyStyle $symfonyStyle, SmartFileSystem $smartFileSystem, ConsoleDiffer $consoleDiffer)
    {
        $this->symfonyStyle = $symfonyStyle;
        $this->smartFileSystem = $smartFileSystem;
        $this->consoleDiffer = $consoleDiffer;
    }
    public function dumpFile(ConvertedContent $convertedContent, Configuration $configuration) : void
    {
        $originalFilePathWithoutSuffix = $convertedContent->getOriginalFilePathWithoutSuffix();
        $newFileRealPath = $originalFilePathWithoutSuffix . '.php';
        if ($configuration->isDryRun()) {
            $fileTitle = \sprintf('File "%s" would be renamed to "%s"', $convertedContent->getOriginalRelativeFilePath(), $convertedContent->getNewRelativeFilePath());
            $this->symfonyStyle->title($fileTitle);
            $consoleDiff = $this->consoleDiffer->diff($convertedContent->getOriginalContent(), $convertedContent->getConvertedContent());
            $this->symfonyStyle->writeln($consoleDiff);
            return;
        }
        // wet run - change the contents
        $fileTitle = \sprintf('File "%s" was renamed to "%s"', $convertedContent->getOriginalRelativeFilePath(), $convertedContent->getNewRelativeFilePath());
        $this->symfonyStyle->title($fileTitle);
        $this->smartFileSystem->dumpFile($newFileRealPath, $convertedContent->getConvertedContent());
    }
}
