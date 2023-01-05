<?php

declare (strict_types=1);
namespace ConfigTransformer202301\Symplify\MonorepoBuilder\Propagate;

use ConfigTransformer202301\Symplify\MonorepoBuilder\ComposerJsonManipulator\ValueObject\ComposerJson;
final class VersionPropagator
{
    public function propagate(ComposerJson $mainComposerJson, ComposerJson $otherComposerJson) : void
    {
        $packagesToVersions = \array_merge($mainComposerJson->getRequire(), $mainComposerJson->getRequireDev());
        foreach ($packagesToVersions as $packageName => $packageVersion) {
            if (!$otherComposerJson->hasPackage($packageName)) {
                continue;
            }
            $otherComposerJson->changePackageVersion($packageName, $packageVersion);
        }
    }
}
