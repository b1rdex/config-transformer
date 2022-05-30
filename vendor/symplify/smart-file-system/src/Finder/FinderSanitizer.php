<?php

declare (strict_types=1);
namespace ConfigTransformer2022053010\Symplify\SmartFileSystem\Finder;

use ConfigTransformer2022053010\Nette\Utils\Finder as NetteFinder;
use SplFileInfo;
use ConfigTransformer2022053010\Symfony\Component\Finder\Finder as SymfonyFinder;
use ConfigTransformer2022053010\Symfony\Component\Finder\SplFileInfo as SymfonySplFileInfo;
use ConfigTransformer2022053010\Symplify\SmartFileSystem\SmartFileInfo;
/**
 * @see \Symplify\SmartFileSystem\Tests\Finder\FinderSanitizer\FinderSanitizerTest
 */
final class FinderSanitizer
{
    /**
     * @param NetteFinder|SymfonyFinder|mixed[] $files
     * @return SmartFileInfo[]
     */
    public function sanitize($files) : array
    {
        $smartFileInfos = [];
        foreach ($files as $file) {
            $fileInfo = \is_string($file) ? new \SplFileInfo($file) : $file;
            if (!$this->isFileInfoValid($fileInfo)) {
                continue;
            }
            /** @var string $realPath */
            $realPath = $fileInfo->getRealPath();
            $smartFileInfos[] = new \ConfigTransformer2022053010\Symplify\SmartFileSystem\SmartFileInfo($realPath);
        }
        return $smartFileInfos;
    }
    private function isFileInfoValid(\SplFileInfo $fileInfo) : bool
    {
        return (bool) $fileInfo->getRealPath();
    }
}
