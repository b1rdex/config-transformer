<?php

declare (strict_types=1);
namespace ConfigTransformerPrefix202302\PhpParser\Builder;

use ConfigTransformerPrefix202302\PhpParser;
use ConfigTransformerPrefix202302\PhpParser\BuilderHelpers;
use ConfigTransformerPrefix202302\PhpParser\Node;
use ConfigTransformerPrefix202302\PhpParser\Node\Stmt;
class Namespace_ extends Declaration
{
    private $name;
    private $stmts = [];
    /**
     * Creates a namespace builder.
     *
     * @param Node\Name|string|null $name Name of the namespace
     */
    public function __construct($name)
    {
        $this->name = null !== $name ? BuilderHelpers::normalizeName($name) : null;
    }
    /**
     * Adds a statement.
     *
     * @param Node|PhpParser\Builder $stmt The statement to add
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function addStmt($stmt)
    {
        $this->stmts[] = BuilderHelpers::normalizeStmt($stmt);
        return $this;
    }
    /**
     * Returns the built node.
     *
     * @return Stmt\Namespace_ The built node
     */
    public function getNode() : Node
    {
        return new Stmt\Namespace_($this->name, $this->stmts, $this->attributes);
    }
}
