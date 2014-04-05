<?php

namespace Rascal\NodeVisitor;

use \PhpParser\Node;
use \PhpParser\Node\Stmt;

class NameResolver extends \PhpParser\NodeVisitorAbstract
{
    public function leaveNode(Node $node) {
        if ($node instanceof Node\Name) {
            return new Node\Name($node->toString());
        } elseif ($node instanceof Stmt\Class_
            || $node instanceof Stmt\Interface_
            || $node instanceof Stmt\Function_) {
            $node->name = $node->namespacedName->toString();
        } elseif ($node instanceof Stmt\Const_) {
            foreach ($node->consts as $const) {
                $const->name = $const->namespacedName->toString();
            }
        } elseif ($node instanceof Stmt\Namespace_) {
            // returning an array merges is into the parent array
            return $node->stmts;
        } elseif ($node instanceof Stmt\Use_) {
            // returning false removed the node altogether
            return false;
        }
    }
}
