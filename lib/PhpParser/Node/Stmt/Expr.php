<?php

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

/**
 * @property Node\Expr $expr The expression wrapped in this statement.
 */
class Expr extends Node\Stmt
{
    /** @var null|Node\Expr The expr evaluated for this expr stmt */
    public $expr;

    /**
     * Constructs an expr node.
     *
     * @param Node\Expr $expr Expr wrapped in this statement
     * @param int $line Line
     * @param null|string $docComment Nearest doc comment
     */
    public function __construct(Node\Expr $expr, $attributes)
    {
        parent::__construct($attributes);
        $this->expr = $expr;
    }

    public function getSubNodeNames() {
        return array('expr');
    }
}

