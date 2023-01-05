<?php

declare (strict_types=1);
namespace ConfigTransformer202301\Symplify\MonorepoBuilder\Release\ReleaseWorker;

use ConfigTransformer202301\PharIo\Version\Version;
use ConfigTransformer202301\Symplify\MonorepoBuilder\DependencyUpdater;
use ConfigTransformer202301\Symplify\MonorepoBuilder\FileSystem\ComposerJsonProvider;
use ConfigTransformer202301\Symplify\MonorepoBuilder\Package\PackageNamesProvider;
use ConfigTransformer202301\Symplify\MonorepoBuilder\Release\Contract\ReleaseWorker\ReleaseWorkerInterface;
use ConfigTransformer202301\Symplify\MonorepoBuilder\Utils\VersionUtils;
final class SetCurrentMutualDependenciesReleaseWorker implements ReleaseWorkerInterface
{
    /**
     * @var \Symplify\MonorepoBuilder\Utils\VersionUtils
     */
    private $versionUtils;
    /**
     * @var \Symplify\MonorepoBuilder\DependencyUpdater
     */
    private $dependencyUpdater;
    /**
     * @var \Symplify\MonorepoBuilder\FileSystem\ComposerJsonProvider
     */
    private $composerJsonProvider;
    /**
     * @var \Symplify\MonorepoBuilder\Package\PackageNamesProvider
     */
    private $packageNamesProvider;
    public function __construct(VersionUtils $versionUtils, DependencyUpdater $dependencyUpdater, ComposerJsonProvider $composerJsonProvider, PackageNamesProvider $packageNamesProvider)
    {
        $this->versionUtils = $versionUtils;
        $this->dependencyUpdater = $dependencyUpdater;
        $this->composerJsonProvider = $composerJsonProvider;
        $this->packageNamesProvider = $packageNamesProvider;
    }
    public function work(Version $version) : void
    {
        $versionInString = $this->versionUtils->getRequiredFormat($version);
        $this->dependencyUpdater->updateFileInfosWithPackagesAndVersion($this->composerJsonProvider->getPackagesComposerFileInfos(), $this->packageNamesProvider->provide(), $versionInString);
        // give time to propagate values before commit
        \sleep(1);
    }
    public function getDescription(Version $version) : string
    {
        $versionInString = $this->versionUtils->getRequiredFormat($version);
        return \sprintf('Set packages mutual dependencies to "%s" version', $versionInString);
    }
}
