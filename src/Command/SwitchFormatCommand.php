<?php

declare (strict_types=1);
namespace ConfigTransformer202106181\Symplify\ConfigTransformer\Command;

use ConfigTransformer202106181\Symfony\Component\Console\Input\InputArgument;
use ConfigTransformer202106181\Symfony\Component\Console\Input\InputInterface;
use ConfigTransformer202106181\Symfony\Component\Console\Input\InputOption;
use ConfigTransformer202106181\Symfony\Component\Console\Output\OutputInterface;
use ConfigTransformer202106181\Symplify\ConfigTransformer\Configuration\Configuration;
use ConfigTransformer202106181\Symplify\ConfigTransformer\Converter\ConvertedContentFactory;
use ConfigTransformer202106181\Symplify\ConfigTransformer\FileSystem\ConfigFileDumper;
use ConfigTransformer202106181\Symplify\ConfigTransformer\ValueObject\Option;
use ConfigTransformer202106181\Symplify\PackageBuilder\Console\Command\AbstractSymplifyCommand;
use ConfigTransformer202106181\Symplify\PackageBuilder\Console\ShellCode;
final class SwitchFormatCommand extends \ConfigTransformer202106181\Symplify\PackageBuilder\Console\Command\AbstractSymplifyCommand
{
    /**
     * @var \Symplify\ConfigTransformer\Configuration\Configuration
     */
    private $configuration;
    /**
     * @var \Symplify\ConfigTransformer\FileSystem\ConfigFileDumper
     */
    private $configFileDumper;
    /**
     * @var \Symplify\ConfigTransformer\Converter\ConvertedContentFactory
     */
    private $convertedContentFactory;
    public function __construct(\ConfigTransformer202106181\Symplify\ConfigTransformer\Configuration\Configuration $configuration, \ConfigTransformer202106181\Symplify\ConfigTransformer\FileSystem\ConfigFileDumper $configFileDumper, \ConfigTransformer202106181\Symplify\ConfigTransformer\Converter\ConvertedContentFactory $convertedContentFactory)
    {
        $this->configuration = $configuration;
        $this->configFileDumper = $configFileDumper;
        $this->convertedContentFactory = $convertedContentFactory;
        parent::__construct();
    }
    protected function configure() : void
    {
        $this->setDescription('Converts XML/YAML configs to PHP format');
        $this->addArgument(\ConfigTransformer202106181\Symplify\ConfigTransformer\ValueObject\Option::SOURCES, \ConfigTransformer202106181\Symfony\Component\Console\Input\InputArgument::REQUIRED | \ConfigTransformer202106181\Symfony\Component\Console\Input\InputArgument::IS_ARRAY, 'Path to directory with configs');
        $this->addOption(\ConfigTransformer202106181\Symplify\ConfigTransformer\ValueObject\Option::TARGET_SYMFONY_VERSION, 's', \ConfigTransformer202106181\Symfony\Component\Console\Input\InputOption::VALUE_REQUIRED, 'Symfony version to migrate config to', '3.2');
        $this->addOption(\ConfigTransformer202106181\Symplify\ConfigTransformer\ValueObject\Option::DRY_RUN, null, \ConfigTransformer202106181\Symfony\Component\Console\Input\InputOption::VALUE_NONE, 'Dry run - no removal or config change');
    }
    protected function execute(\ConfigTransformer202106181\Symfony\Component\Console\Input\InputInterface $input, \ConfigTransformer202106181\Symfony\Component\Console\Output\OutputInterface $output) : int
    {
        $this->configuration->populateFromInput($input);
        $suffixes = $this->configuration->getInputSuffixes();
        $suffixesRegex = '#\\.' . \implode('|', $suffixes) . '$#';
        $fileInfos = $this->smartFinder->find($this->configuration->getSource(), $suffixesRegex);
        $convertedContents = $this->convertedContentFactory->createFromFileInfos($fileInfos);
        foreach ($convertedContents as $convertedContent) {
            $this->configFileDumper->dumpFile($convertedContent);
        }
        if (!$this->configuration->isDryRun()) {
            $this->smartFileSystem->remove($fileInfos);
        }
        $successMessage = \sprintf('Processed %d file(s) to "PHP" format', \count($fileInfos));
        $this->symfonyStyle->success($successMessage);
        return \ConfigTransformer202106181\Symplify\PackageBuilder\Console\ShellCode::SUCCESS;
    }
}
