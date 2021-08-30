<?php

declare (strict_types=1);
namespace ConfigTransformer2021083010\Symplify\PhpConfigPrinter\Dummy;

use ConfigTransformer2021083010\Symplify\PhpConfigPrinter\Contract\YamlFileContentProviderInterface;
final class DummyYamlFileContentProvider implements \ConfigTransformer2021083010\Symplify\PhpConfigPrinter\Contract\YamlFileContentProviderInterface
{
    /**
     * @param string $yamlContent
     */
    public function setContent($yamlContent) : void
    {
    }
    public function getYamlContent() : string
    {
        return '';
    }
}
