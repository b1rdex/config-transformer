<?php

declare (strict_types=1);
namespace ConfigTransformer202301\Symplify\MonorepoBuilder\Merge\ComposerKeyMerger;

use ConfigTransformer202301\Symplify\MonorepoBuilder\ComposerJsonManipulator\ValueObject\ComposerJson;
use ConfigTransformer202301\Symplify\MonorepoBuilder\Merge\Arrays\SortedParameterMerger;
use ConfigTransformer202301\Symplify\MonorepoBuilder\Merge\Cleaner\RequireRequireDevDuplicateCleaner;
use ConfigTransformer202301\Symplify\MonorepoBuilder\Merge\Contract\ComposerKeyMergerInterface;
final class RequireDevComposerKeyMerger implements ComposerKeyMergerInterface
{
    /**
     * @var \Symplify\MonorepoBuilder\Merge\Arrays\SortedParameterMerger
     */
    private $sortedParameterMerger;
    /**
     * @var \Symplify\MonorepoBuilder\Merge\Cleaner\RequireRequireDevDuplicateCleaner
     */
    private $requireRequireDevDuplicateCleaner;
    public function __construct(SortedParameterMerger $sortedParameterMerger, RequireRequireDevDuplicateCleaner $requireRequireDevDuplicateCleaner)
    {
        $this->sortedParameterMerger = $sortedParameterMerger;
        $this->requireRequireDevDuplicateCleaner = $requireRequireDevDuplicateCleaner;
    }
    public function merge(ComposerJson $mainComposerJson, ComposerJson $newComposerJson) : void
    {
        if ($newComposerJson->getRequireDev() === []) {
            return;
        }
        $requireDev = $this->sortedParameterMerger->mergeAndSort($newComposerJson->getRequireDev(), $mainComposerJson->getRequireDev());
        $requireDev = $this->requireRequireDevDuplicateCleaner->unsetPackageFromRequire($mainComposerJson, $requireDev);
        $mainComposerJson->setRequireDev($requireDev);
    }
}
