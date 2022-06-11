<?php

declare (strict_types=1);
namespace ConfigTransformer20220611;

use ConfigTransformer20220611\PhpParser\ConstExprEvaluator;
use ConfigTransformer20220611\PhpParser\NodeFinder;
use ConfigTransformer20220611\PHPStan\PhpDocParser\Lexer\Lexer;
use ConfigTransformer20220611\PHPStan\PhpDocParser\Parser\ConstExprParser;
use ConfigTransformer20220611\PHPStan\PhpDocParser\Parser\PhpDocParser;
use ConfigTransformer20220611\PHPStan\PhpDocParser\Parser\TypeParser;
use ConfigTransformer20220611\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use ConfigTransformer20220611\Symplify\Astral\PhpParser\SmartPhpParser;
use ConfigTransformer20220611\Symplify\Astral\PhpParser\SmartPhpParserFactory;
use ConfigTransformer20220611\Symplify\PackageBuilder\Php\TypeChecker;
use function ConfigTransformer20220611\Symfony\Component\DependencyInjection\Loader\Configurator\service;
return static function (ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->autowire()->public();
    $services->load('Symplify\\Astral\\', __DIR__ . '/../src')->exclude([__DIR__ . '/../src/StaticFactory', __DIR__ . '/../src/ValueObject', __DIR__ . '/../src/NodeVisitor', __DIR__ . '/../src/PhpParser/SmartPhpParser.php', __DIR__ . '/../src/PhpDocParser/PhpDocNodeVisitor/CallablePhpDocNodeVisitor.php']);
    $services->set(SmartPhpParser::class)->factory([service(SmartPhpParserFactory::class), 'create']);
    $services->set(ConstExprEvaluator::class);
    $services->set(TypeChecker::class);
    $services->set(NodeFinder::class);
    // phpdoc parser
    $services->set(PhpDocParser::class);
    $services->set(Lexer::class);
    $services->set(TypeParser::class);
    $services->set(ConstExprParser::class);
};
