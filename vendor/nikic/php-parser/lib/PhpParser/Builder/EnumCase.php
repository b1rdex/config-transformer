<?php

declare (strict_types=1);
namespace ConfigTransformer2022053010\PhpParser\Builder;

use ConfigTransformer2022053010\PhpParser;
use ConfigTransformer2022053010\PhpParser\BuilderHelpers;
use ConfigTransformer2022053010\PhpParser\Node;
use ConfigTransformer2022053010\PhpParser\Node\Identifier;
use ConfigTransformer2022053010\PhpParser\Node\Stmt;
class EnumCase implements \ConfigTransformer2022053010\PhpParser\Builder
{
    protected $name;
    protected $value = null;
    protected $attributes = [];
    /** @var Node\AttributeGroup[] */
    protected $attributeGroups = [];
    /**
     * Creates an enum case builder.
     *
     * @param string|Identifier $name  Name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }
    /**
     * Sets the value.
     *
     * @param Node\Expr|string|int $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = \ConfigTransformer2022053010\PhpParser\BuilderHelpers::normalizeValue($value);
        return $this;
    }
    /**
     * Sets doc comment for the constant.
     *
     * @param PhpParser\Comment\Doc|string $docComment Doc comment to set
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function setDocComment($docComment)
    {
        $this->attributes = ['comments' => [\ConfigTransformer2022053010\PhpParser\BuilderHelpers::normalizeDocComment($docComment)]];
        return $this;
    }
    /**
     * Adds an attribute group.
     *
     * @param Node\Attribute|Node\AttributeGroup $attribute
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function addAttribute($attribute)
    {
        $this->attributeGroups[] = \ConfigTransformer2022053010\PhpParser\BuilderHelpers::normalizeAttribute($attribute);
        return $this;
    }
    /**
     * Returns the built enum case node.
     *
     * @return Stmt\EnumCase The built constant node
     */
    public function getNode() : \ConfigTransformer2022053010\PhpParser\Node
    {
        return new \ConfigTransformer2022053010\PhpParser\Node\Stmt\EnumCase($this->name, $this->value, $this->attributes, $this->attributeGroups);
    }
}
