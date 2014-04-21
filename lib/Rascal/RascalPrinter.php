<?php

namespace Rascal;

class RascalPrinter extends BasePrinter
{

    private $filename = "";

    private $addLocations = false;

    private $addDeclarations = false;

    private $relativeLocations = false;

    private $addIds = false;

    private $addPhpDocs = false;

    private $idPrefix = "";

    private $insideTrait = false;

    private $insideFunction = false;

    private $currentFunction = "";

    private $currentClass = "";

    private $currentTrait = "";

    private $currentInterface = "";

    private $currentMethod = "";

    private $currentNamespace = "";

    private $inAssignExpr = false;

    /**
     *
     * @param string $str
     * @param bool $locs
     * @param bool $rel
     * @param bool $ids
     * @param string $prefix
     * @param bool $docs
     */
    public function __construct($str, $locs, $rel, $ids, $prefix, $docs = false, $addDecl = false)
    {
        $this->filename = $str;
        $this->addLocations = $locs;
        $this->addDeclarations = $addDecl;
        $this->relativeLocations = $rel;
        $this->addIds = $ids;
        $this->idPrefix = $prefix;
        $this->addPhpDocs = $docs;
    }

    public function rascalizeString($str)
    {
        return addcslashes($str, "<>'\n\t\r\\\"");
    }

    private function addUniqueId()
    {
        $idToAdd = uniqid($this->idPrefix, true);
        return "@id=\"{$this->rascalizeString($idToAdd)}\"";
    }

    private function addScopeInformation()
    {
        $ns = $this->currentNamespace;
        $cl = $this->currentClass;
        $cl = empty($this->currentInterface) ? $cl : $this->currentInterface;
        $cl = empty($this->currentTrait)     ? $cl : $this->currentTrait;
        $mt = $this->currentMethod;
        $fn = $this->currentFunction;
        return sprintf("@scope=scope(\"%s\",\"%s\",\"%s\",\"%s\")",
            $this->rascalizeString($ns),
            $this->rascalizeString($cl),
            $this->rascalizeString($mt),
            $this->rascalizeString($fn)
        );

    }
    private function addDeclaration(\PhpParser\Node $node)
    {
        $namespace = $this->currentNamespace;
        $class = $this->currentClass;
        $trait = $this->currentTrait;
        $interface = $this->currentInterface;
        $method = $this->currentMethod;
        $function = $this->currentFunction;

        // define the namespace name with a trailing slash, or leave empty for global namespace
        $ns = empty($namespace) ? '' : $namespace . "/";

        if (empty($class) && (!empty($trait) || !empty($interface))) {
            // use trait or interface as className when there is a currentTrait or currentInterface but no currentClass
            $class = !empty($trait) ? $trait : $interface;
        }

        $decl = "@decl=|php+%s:///%s|";
        if ($node instanceof \PhpParser\Node\Stmt\Namespace_)
            return $this->rascalizeString(sprintf($decl, "namespace", $namespace));
        else if ($node instanceof \PhpParser\Node\Stmt\Class_)
            return $this->rascalizeString(sprintf($decl, "class", $ns . $class));
        else if ($node instanceof \PhpParser\Node\Stmt\Interface_)
            return $this->rascalizeString(sprintf($decl, "interface", $ns . $class));
        else if ($node instanceof \PhpParser\Node\Stmt\Trait_)
            return $this->rascalizeString(sprintf($decl, "trait", $ns . $class));
        else if ($node instanceof \PhpParser\Node\Stmt\PropertyProperty)
            return $this->rascalizeString(sprintf($decl, "field", $ns . $class . "/" . $node->name));
        else if ($node instanceof \PhpParser\Node\Const_)
            return $this->rascalizeString(sprintf($decl, "constant", $ns . $class . "/" . $node->name));
        else if ($node instanceof \PhpParser\Node\Stmt\ClassMethod)
            return $this->rascalizeString(sprintf($decl, "method", $ns . $class . "/" . $method));
        else if ($node instanceof \PhpParser\Node\Stmt\Function_)
            return $this->rascalizeString(sprintf($decl, "function", $ns . $function));
        else if ($node instanceof \PhpParser\Node\Expr\Variable && $this->inAssignExpr && !$node->name instanceof \PhpParser\Node\Expr) {
            // only declare variables that are inside an assign expression, and the name must not be an expression
            // (we are not able to handle this, atleast for now)
            if ($this->insideFunction) // function variable
                return $this->rascalizeString(sprintf($decl, "variable", $ns . $function . "/" . $node->name));
            else if ($this->currentMethod) // method variable
                return $this->rascalizeString(sprintf($decl, "variable", $ns . $class . "/" . $method . "/" . $node->name));
            else // global var
                return $this->rascalizeString(sprintf($decl, "variable", $ns . $node->name));
        }
        else if ($node instanceof \PhpParser\Node\Param) {
            if ($this->insideFunction) // function parameter
                return $this->rascalizeString(sprintf($decl, "parameter", $ns . $function . "/" . $node->name));
            if ($this->currentMethod) // method parameter
                return $this->rascalizeString(sprintf($decl, "parameter", $ns . $class . "/" . $method . "/" . $node->name));
        }
    }

    private function addLocationTag(\PhpParser\Node $node)
    {
        if ($this->relativeLocations) {
            return "@at=|home://{$this->filename}|({$node->getOffset()},{$node->getLength()},<{$node->getLine()},0>,<{$node->getLine()},0>)";
        } else {
            return "@at=|file://{$this->filename}|({$node->getOffset()},{$node->getLength()},<{$node->getLine()},0>,<{$node->getLine()},0>)";
        }
    }

    /**
     * Try to extract data from PHPDoc.
     * If no PHPDoc found, return NULL
     *
     * Restriction: only for Class, Interface and Variable.
     *
     * @return string
     */
    private function addPhpDocForNode(\PHPParser\Node $node)
    {
        $docString = "@phpdoc=\"%s\"";
        if ($node instanceof \PhpParser\Node\Stmt\Class_ ||
            $node instanceof \PhpParser\Node\Stmt\Interface_ ||
            $node instanceof \PhpParser\Node\Expr\Variable
        )
            if ($doc = $node->getDocComment())
                return sprintf($docString, $this->rascalizeString($doc));
        return sprintf($docString, null);
    }

    private function annotateASTNode(\PhpParser\Node $node)
    {
        $tagsToAdd = array();
        if ($this->addLocations)
            $tagsToAdd[] = $this->addLocationTag($node);
        if ($this->addDeclarations) {
            $tagsToAdd[] = $this->addScopeInformation();
            if ($decl = $this->addDeclaration($node)) {
            $tagsToAdd[] = $decl;
            }
        }
        if ($this->addIds)
            $tagsToAdd[] = $this->addUniqueId();
        if ($this->addPhpDocs)
            $tagsToAdd[] = $this->addPhpDocForNode($node);

        if (count($tagsToAdd) > 0)
            return "[" . implode(",", $tagsToAdd) . "]";
        return "";
    }

    public function pprintArg(\PhpParser\Node\Arg $node)
    {
        $argValue = $this->pprint($node->value);

        if ($node->byRef)
            $byRef = "true";
        else
            $byRef = "false";

        $fragment = "actualParameter(" . $argValue . "," . $byRef . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintConst(\PhpParser\Node\Const_ $node)
    {
        $fragment = "const(\"" . $node->name . "\"," . $this->pprint($node->value) . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintArrayExpr(\PhpParser\Node\Expr\Array_ $node)
    {
        $items = array();
        foreach ($node->items as $item)
            $items[] = $this->pprint($item);

        $fragment = "array([" . implode(",", $items) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintArrayDimFetchExpr(\PhpParser\Node\Expr\ArrayDimFetch $node)
    {
        if (null != $node->dim)
            $dim = "someExpr(" . $this->pprint($node->dim) . ")";
        else
            $dim = "noExpr()";

        $fragment = "fetchArrayDim(" . $this->pprint($node->var) . "," . $dim . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintArrayItemExpr(\PhpParser\Node\Expr\ArrayItem $node)
    {
        $nodeValue = $this->pprint($node->value);

        if (null == $node->key)
            $key = "noExpr()";
        else
            $key = "someExpr(" . $this->pprint($node->key) . ")";

        if ($node->byRef)
            $byRef = "true";
        else
            $byRef = "false";

        $fragment = "arrayElement(" . $key . "," . $nodeValue . "," . $byRef . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintAssignExpr(\PhpParser\Node\Expr\Assign $node)
    {
        $assignExpr = $this->pprint($node->expr);
        $this->inAssignExpr = true;
        $assignVar = $this->pprint($node->var);
        $this->inAssignExpr = false;

        $fragment = "assign(" . $assignVar . "," . $assignExpr . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintBitwiseAndAssignOpExpr(\PhpParser\Node\Expr\AssignOp\BitwiseAnd $node)
    {
        return $this->handleAssignOpExpression($node, "bitwiseAnd");
    }

    public function pprintBitwiseOrAssignOpExpr(\PhpParser\Node\Expr\AssignOp\BitwiseOr $node)
    {
        return $this->handleAssignOpExpression($node, "bitwiseOr");
    }

    public function pprintBitwiseXorAssignOpExpr(\PhpParser\Node\Expr\AssignOp\BitwiseXor $node)
    {
        return $this->handleAssignOpExpression($node, "bitwiseXor");
    }

    public function pprintConcatAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Concat $node)
    {
        return $this->handleAssignOpExpression($node, "concat");
    }

    public function pprintDivAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Div $node)
    {
        return $this->handleAssignOpExpression($node, "div");
    }

    public function pprintMinusAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Minus $node)
    {
        return $this->handleAssignOpExpression($node, "minus");
    }

    public function pprintModAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Mod $node)
    {
        return $this->handleAssignOpExpression($node, "\\mod");
    }

    public function pprintMulAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Mul $node)
    {
        return $this->handleAssignOpExpression($node, "mul");
    }

    public function pprintPlusAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Plus $node)
    {
        return $this->handleAssignOpExpression($node, "plus");
    }

    public function pprintShiftLeftAssignOpExpr(\PhpParser\Node\Expr\AssignOp\ShiftLeft $node)
    {
        return $this->handleAssignOpExpression($node, "leftShift");
    }

    public function pprintShiftRightAssignOpExpr(\PhpParser\Node\Expr\AssignOp\ShiftRight $node)
    {
        return $this->handleAssignOpExpression($node, "rightShift");
    }

    /**
     * @param \PhpParser\Node\Expr\AssignOp $node
     * @param string $operation
     * @return string
     */
    private function handleAssignOpExpression(\PhpParser\Node\Expr\AssignOp $node, $operation)
    {
        $assignExpr = $this->pprint($node->expr);
        $this->inAssignExpr = true;
        $assignVar = $this->pprint($node->var);
        $this->inAssignExpr = false;

        $fragment = "assignWOp(" . $assignVar . "," . $assignExpr . "," . $operation . "())";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintAssignRefExpr(\PhpParser\Node\Expr\AssignRef $node)
    {
        $assignExpr = $this->pprint($node->expr);
        $assignVar = $this->pprint($node->var);

        $fragment = "refAssign(" . $assignVar . "," . $assignExpr . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintBitwiseAndBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BitwiseAnd $node)
    {
        return $this->handleBinaryOpExpression($node, "bitwiseAnd");
    }

    public function pprintBitwiseOrBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BitwiseOr $node)
    {
        return $this->handleBinaryOpExpression($node, "bitwiseOr");
    }

    public function pprintBitwiseXorBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BitwiseXor $node)
    {
        return $this->handleBinaryOpExpression($node, "bitwiseXor");
    }

    public function pprintBooleanAndBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BooleanAnd $node)
    {
        return $this->handleBinaryOpExpression($node, "booleanAnd");
    }

    public function pprintBooleanOrBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BooleanOr $node)
    {
        return $this->handleBinaryOpExpression($node, "booleanOr");
    }

    public function pprintConcatBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Concat $node)
    {
        return $this->handleBinaryOpExpression($node, "concat");
    }

    public function pprintDivBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Div $node)
    {
        return $this->handleBinaryOpExpression($node, "div");
    }

    public function pprintEqualBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Equal $node)
    {
        return $this->handleBinaryOpExpression($node, "equal");
    }

    public function pprintGreaterBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Greater $node)
    {
        return $this->handleBinaryOpExpression($node, "gt");
    }

    public function pprintGreaterOrEqualBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\GreaterOrEqual $node)
    {
        return $this->handleBinaryOpExpression($node, "geq");
    }

    public function pprintLogicalAndBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\LogicalAnd $node)
    {
        return $this->handleBinaryOpExpression($node, "logicalAnd");
    }

    public function pprintLogicalOrBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\LogicalOr $node)
    {
        return $this->handleBinaryOpExpression($node, "logicalOr");
    }

    public function pprintLogicalXorBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\LogicalXor $node)
    {
        return $this->handleBinaryOpExpression($node, "logicalXor");
    }

    public function pprintIdenticalBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Identical $node)
    {
        return $this->handleBinaryOpExpression($node, "identical");
    }

    public function pprintMinusBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Minus $node)
    {
        return $this->handleBinaryOpExpression($node, "minus");
    }

    public function pprintModBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Mod $node)
    {
        return $this->handleBinaryOpExpression($node, "\\mod");
    }

    public function pprintMulBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Mul $node)
    {
        return $this->handleBinaryOpExpression($node, "mul");
    }

    public function pprintShiftLeftBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\ShiftLeft $node)
    {
        return $this->handleBinaryOpExpression($node, "leftShift");
    }

    public function pprintShiftRightBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\ShiftRight $node)
    {
        return $this->handleBinaryOpExpression($node, "rightShift");
    }

    public function pprintSmallerBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Smaller $node)
    {
        return $this->handleBinaryOpExpression($node, "lt");
    }

    public function pprintSmallerOrEqualBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\SmallerOrEqual $node)
    {
        return $this->handleBinaryOpExpression($node, "leq");
    }

    public function pprintNotEqualBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\NotEqual $node)
    {
        return $this->handleBinaryOpExpression($node, "notEqual");
    }

    public function pprintNotIdenticalBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\NotIdentical $node)
    {
        return $this->handleBinaryOpExpression($node, "notIdentical");
    }

    public function pprintPlusBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Plus $node)
    {
        return $this->handleBinaryOpExpression($node, "plus");
    }

    /**
     * @param \PhpParser\Node\Expr\BinaryOp $node
     * @param string $operation
     * @return string
     */
    private function handleBinaryOpExpression(\PhpParser\Node\Expr\BinaryOp $node, $operation)
    {
        $right = $this->pprint($node->right);
        $left = $this->pprint($node->left);

        $fragment = "binaryOperation(" . $left . "," . $right . "," . $operation . "())";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintBooleanNotExpr(\PhpParser\Node\Expr\BooleanNot $node)
    {
        return $this->handleUnaryOpExpression($node, "booleanNot");
    }

    public function pprintBitwiseNotExpr(\PhpParser\Node\Expr\BitwiseNot $node)
    {
        return $this->handleUnaryOpExpression($node, "bitwiseNot");
    }

    private function handleUnaryOpExpression(\PhpParser\Node\Expr $node, $operation)
    {
        $expr = $this->pprint($node->expr);

        $fragment = "unaryOperation(" . $expr . "," . $operation . "())";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintArrayCastExpr(\PhpParser\Node\Expr\Cast\Array_ $node)
    {
        return $this->handleCastExpression($node, "array");
    }

    public function pprintBoolCastExpr(\PhpParser\Node\Expr\Cast\Bool $node)
    {
        return $this->handleCastExpression($node, "\\bool");
    }

    public function pprintDoubleCastExpr(\PhpParser\Node\Expr\Cast\Double $node)
    {
        return $this->handleCastExpression($node, "float");
    }

    public function pprintIntCastExpr(\PhpParser\Node\Expr\Cast\Int $node)
    {
        return $this->handleCastExpression($node, "\\int");
    }

    public function pprintObjectCastExpr(\PhpParser\Node\Expr\Cast\Object $node)
    {
        return $this->handleCastExpression($node, "object");
    }

    public function pprintStringCastExpr(\PhpParser\Node\Expr\Cast\String $node)
    {
        return $this->handleCastExpression($node, "string");
    }

    public function pprintUnsetCastExpr(\PhpParser\Node\Expr\Cast\Unset_ $node)
    {
        return $this->handleCastExpression($node, "unset");
    }

    /**
     * @param \PhpParser\Node\Expr\Cast $node
     * @param string $type
     * @return string
     */
    private function handleCastExpression(\PhpParser\Node\Expr\Cast $node, $type)
    {
        $toCast = $this->pprint($node->expr);
        $fragment = "cast(" . $type . "()," . $toCast . ")";
        $fragment .= $this->annotateASTNode($node);
        return $fragment;
    }
    public function pprintClassConstFetchExpr(\PhpParser\Node\Expr\ClassConstFetch $node)
    {
        $name = $this->pprint($node->class);
        if ($node->class instanceof \PhpParser\Node\Name)
            $name = "name({$name})";
        else
            $name = "expr({$name})";

        $fragment = "fetchClassConst(" . $name . ",\"" . $node->name . "\")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }
    public function pprintCloneExpr(\PhpParser\Node\Expr\Clone_ $node)
    {
        $fragment = "clone(" . $this->pprint($node->expr) . ")";
        $fragment .= $this->annotateASTNode($node);
        return $fragment;
    }

    public function pprintClosureExpr(\PhpParser\Node\Expr\Closure $node)
    {
        $body = array();
        $params = array();
        $uses = array();

        foreach ($node->uses as $use)
            $uses[] = $this->pprint($use);
        foreach ($node->params as $param)
            $params[] = $this->pprint($param);
        foreach ($node->stmts as $stmt)
            $body[] = $this->pprint($stmt);

        $fragment = "closure([" . implode(",", $body) . "],[";
        $fragment .= implode(",", $params) . "],[";
        $fragment .= implode(",", $uses) . "],";
        if ($node->byRef)
            $fragment .= "true,";
        else
            $fragment .= "false,";
        if ($node->static)
            $fragment .= "true";
        else
            $fragment .= "false";
        $fragment .= ")";

        $fragment .= $this->annotateASTNode($node);
        return $fragment;
    }

    public function pprintClosureUseExpr(\PhpParser\Node\Expr\ClosureUse $node)
    {
        $fragment = "closureUse(\"" . $node->var . "\",";
        if ($node->byRef)
            $fragment .= "true";
        else
            $fragment .= "false";
        $fragment .= ")";
        $fragment .= $this->annotateASTNode($node);
        return $fragment;
    }

    public function pprintConstFetchExpr(\PhpParser\Node\Expr\ConstFetch $node)
    {
        $fragment = "fetchConst(" . $this->pprint($node->name) . ")";
        $fragment .= $this->annotateASTNode($node);
        return $fragment;
    }

    public function pprintEmptyExpr(\PhpParser\Node\Expr\Empty_ $node)
    {
        $fragment = "empty(" . $this->pprint($node->expr) . ")";
        $fragment .= $this->annotateASTNode($node);
        return $fragment;
    }

    public function pprintErrorSuppressExpr(\PhpParser\Node\Expr\ErrorSuppress $node)
    {
        $fragment = "suppress(" . $this->pprint($node->expr) . ")";
        $fragment .= $this->annotateASTNode($node);
        return $fragment;
    }
    public function pprintEvalExpr(\PhpParser\Node\Expr\Eval_ $node)
    {
        $fragment = "eval(" . $this->pprint($node->expr) . ")";
        $fragment .= $this->annotateASTNode($node);
        return $fragment;
    }

    public function pprintExitExpr(\PhpParser\Node\Expr\Exit_ $node)
    {
        if (null != $node->expr)
            $fragment = "someExpr(" . $this->pprint($node->expr) . ")";
        else
            $fragment = "noExpr()";
        $fragment = "exit(" . $fragment . ")";
        $fragment .= $this->annotateASTNode($node);
        return $fragment;
    }

    public function pprintFuncCallExpr(\PhpParser\Node\Expr\FuncCall $node)
    {
        $args = array();
        foreach ($node->args as $arg)
            $args[] = $this->pprint($arg);

        $name = $this->pprint($node->name);
        if ($node->name instanceof \PhpParser\Node\Name)
            $name = "name({$name})";
        else
            $name = "expr({$name})";

        $fragment = "call(" . $name . ",[" . implode(",", $args) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintIncludeExpr(\PhpParser\Node\Expr\Include_ $node)
    {
        $fragment = "include(" . $this->pprint($node->expr) . ",";
        if (\PhpParser\Node\Expr\Include_::TYPE_INCLUDE == $node->type)
            $fragment .= "include()";
        elseif (\PhpParser\Node\Expr\Include_::TYPE_INCLUDE_ONCE == $node->type)
            $fragment .= "includeOnce()";
        elseif (\PhpParser\Node\Expr\Include_::TYPE_REQUIRE == $node->type)
            $fragment .= "require()";
        else
            $fragment .= "requireOnce()";
        $fragment .= ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintInstanceofExpr(\PhpParser\Node\Expr\Instanceof_ $node)
    {
        $right = $this->pprint($node->class);
        if ($node->class instanceof \PhpParser\Node\Name)
            $right = "name({$right})";
        else
            $right = "expr({$right})";

        $left = $this->pprint($node->expr);

        $fragment = "instanceOf(" . $left . "," . $right . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }
    public function pprintIssetExpr(\PhpParser\Node\Expr\Isset_ $node)
    {
        $exprs = array();
        foreach ($node->vars as $var)
            $exprs[] = $this->pprint($var);

        $fragment = "isSet([" . implode(",", $exprs) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintListExpr(\PhpParser\Node\Expr\List_ $node)
    {
        $exprs = array();
        foreach ($node->vars as $var)
            if (null != $var)
                $exprs[] = "someExpr(" . $this->pprint($var) . ")";
            else
                $exprs[] = "noExpr()";

        $fragment = "listExpr([" . implode(",", $exprs) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintMethodCallExpr(\PhpParser\Node\Expr\MethodCall $node)
    {
        $args = array();
        foreach ($node->args as $arg)
            $args[] = $this->pprint($arg);

        if ($node->name instanceof \PhpParser\Node\Expr) {
            $name = $this->pprint($node->name);
            $name = "expr({$name})";
        } else {
            $name = "name(name(\"" . $node->name . "\"))";
        }

        $target = $this->pprint($node->var);

        $fragment = "methodCall(" . $target . "," . $name . ",[" . implode(",", $args) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }
    public function pprintNewExpr(\PhpParser\Node\Expr\New_ $node)
    {
        $args = array();
        foreach ($node->args as $arg)
            $args[] = $this->pprint($arg);

        $name = $this->pprint($node->class);

        if ($node->class instanceof \PhpParser\Node\Expr)
            $name = "expr({$name})";
        else
            $name = "name({$name})";

        $fragment = "new(" . $name . ",[" . implode(",", $args) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintPostDecExpr(\PhpParser\Node\Expr\PostDec $node)
    {
        return $this->handleIncreaseDecreaseVarExpression($node, "postDec");
    }

    public function pprintPostIncExpr(\PhpParser\Node\Expr\PostInc $node)
    {
        return $this->handleIncreaseDecreaseVarExpression($node, "postInc");
    }

    public function pprintPreDecExpr(\PhpParser\Node\Expr\PreDec $node)
    {
        return $this->handleIncreaseDecreaseVarExpression($node, "preDec");
    }

    public function pprintPreIncExpr(\PhpParser\Node\Expr\PreInc $node)
    {
        return $this->handleIncreaseDecreaseVarExpression($node, "preInc");
    }

    /**
     * @param \PhpParser\Node\Expr\PostDec $node
     * @return string
     */
    private function handleIncreaseDecreaseVarExpression(\PhpParser\Node\Expr $node, $operation)
    {
        $this->inAssignExpr = true;
        $operand = $this->pprint($node->var);
        $this->inAssignExpr = false;
        $fragment = "unaryOperation(" . $operand . ",".$operation."())";
        $fragment .= $this->annotateASTNode($node);
        return $fragment;
    }

    public function pprintPrintExpr(\PhpParser\Node\Expr\Print_ $node)
    {
        $operand = $this->pprint($node->expr);
        $fragment = "print(" . $operand . ")";
        $fragment .= $this->annotateASTNode($node);
        return $fragment;
    }

    public function pprintPropertyFetchExpr(\PhpParser\Node\Expr\PropertyFetch $node)
    {
        if ($node->name instanceof \PhpParser\Node\Expr) {
            $fragment = "expr(" . $this->pprint($node->name) . ")";
        } else {
            $fragment = "name(name(\"" . $node->name . "\"))";
        }

        $fragment = "propertyFetch(" . $this->pprint($node->var) . "," . $fragment . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintShellExecExpr(\PhpParser\Node\Expr\ShellExec $node)
    {
        $parts = array();
        foreach ($node->parts as $item) {
            if ($item instanceof \PhpParser\Node\Expr) {
                $parts[] = $this->pprint($item);
            } else {
                $parts[] = "scalar(string(\"" . $this->rascalizeString($item) . "\"))";
            }
        }

        $fragment = "shellExec([" . implode(",", $parts) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintStaticCallExpr(\PhpParser\Node\Expr\StaticCall $node)
    {
        $args = array();
        foreach ($node->args as $arg)
            $args[] = $this->pprint($arg);

        if ($node->name instanceof \PhpParser\Node\Expr)
            $name = "expr(" . $this->pprint($node->name) . ")";
        else
            $name = "name(name(\"" . $node->name . "\"))";

        if ($node->class instanceof \PhpParser\Node\Expr) {
            $class = "expr(" . $this->pprint($node->class) . ")";
        } else {
            $class = "name(" . $this->pprint($node->class) . ")";
        }

        $fragment = "staticCall({$class},{$name},[" . implode(",", $args) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintStaticPropertyFetchExpr(\PhpParser\Node\Expr\StaticPropertyFetch $node)
    {
        if ($node->name instanceof \PhpParser\Node\Expr) {
            $name = "expr(" . $this->pprint($node->name) . ")";
        } else {
            $name = "name(name(\"" . $node->name . "\"))";
        }

        if ($node->class instanceof \PhpParser\Node\Expr) {
            $class = "expr(" . $this->pprint($node->class) . ")";
        } else {
            $class = "name(" . $this->pprint($node->class) . ")";
        }

        $fragment = "staticPropertyFetch({$class},{$name})";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintTernaryExpr(\PhpParser\Node\Expr\Ternary $node)
    {
        $else = $this->pprint($node->else);
        if (null != $node->if)
            $if = "someExpr(" . $this->pprint($node->if) . ")";
        else
            $if = "noExpr()";
        $cond = $this->pprint($node->cond);

        $fragment = "ternary({$cond},{$if},{$else})";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintUnaryMinusExpr(\PhpParser\Node\Expr\UnaryMinus $node)
    {
        $operand = $this->pprint($node->expr);
        $fragment = "unaryOperation(" . $operand . ",unaryMinus())";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintUnaryPlusExpr(\PhpParser\Node\Expr\UnaryPlus $node)
    {
        $operand = $this->pprint($node->expr);
        $fragment = "unaryOperation(" . $operand . ",unaryPlus())";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintVariableExpr(\PhpParser\Node\Expr\Variable $node)
    {
        if ($node->name instanceof \PhpParser\Node\Expr) {
            $fragment = "expr(" . $this->pprint($node->name) . ")";
        } else {
            $fragment = "name(name(\"" . $node->name . "\"))";
        }
        $fragment = "var(" . $fragment . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintYieldExpr(\PhpParser\Node\Expr\Yield_ $node)
    {
        if (null != $node->value)
            $valuePart = "someExpr(" . $this->pprint($node->value) . ")";
        else
            $valuePart = "noExpr()";

        if (null != $node->key)
            $keyPart = "someExpr(" . $this->pprint($node->key) . ")";
        else
            $keyPart = "noExpr()";

        $fragment = "yield({$keyPart},{$valuePart})";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintFullyQualifiedName(\PhpParser\Node\Name\FullyQualified $node)
    {
        return $this->pprintName($node);
    }

    public function pprintRelativeName(\PhpParser\Node\Name\Relative $node)
    {
        return $this->pprintName($node);
    }

    public function pprintName(\PhpParser\Node\Name $node)
    {
        $fragment = $this->implodeName($node);
        $fragment = "name(\"" . $fragment . "\")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintParam(\PhpParser\Node\Param $node)
    {
        if (null == $node->type) {
            $type = "noName()";
        } else {
            if ($node->type instanceof \PhpParser\Node\Name) {
                $type = "someName(" . $this->pprint($node->type) . ")";
            } else {
                $type = "someName(name(\"" . $node->type . "\"))";
            }
        }

        if (null == $node->default) {
            $default = "noExpr()";
        } else {
            $default = "someExpr(" . $this->pprint($node->default) . ")";
        }

        $fragment = "param(\"" . $node->name . "\"," . $default . "," . $type . ",";
        if (false == $node->byRef)
            $fragment .= "false";
        else
            $fragment .= "true";
        $fragment .= ")";

        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintDNumberScalar(\PhpParser\Node\Scalar\DNumber $node)
    {
        $fragment = "float(" . sprintf('%f', $node->value) . ")";
        $fragment = "scalar(" . $fragment . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintEncapsedScalar(\PhpParser\Node\Scalar\Encapsed $node)
    {
        $parts = array();
        foreach ($node->parts as $item) {
            if ($item instanceof \PhpParser\Node\Expr) {
                $parts[] = $this->pprint($item);
            } else {
                $parts[] = "scalar(string(\"" . $this->rascalizeString($item) . "\"))";
            }
        }
        $fragment = "scalar(encapsed([" . implode(",", $parts) . "]))";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintLNumberScalar(\PhpParser\Node\Scalar\LNumber $node)
    {
        $fragment = "integer(" . sprintf('%d', $node->value) . ")";
        $fragment = "scalar(" . $fragment . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintClassMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Class_ $node)
    {
        // If we are inside a trait and find __CLASS__, we have no clue what it should
        // be, so leave it unresolved for now; else tag it with the class we are actually
        // inside at the moment.
        if ($this->insideTrait) {
            $fragment = "classConstant()";
        } else {
            $ns = $this->currentNamespace;
            $currentClass = strlen($ns) > 0 ? $ns . "\\" . $this->currentClass : $this->currentClass;
            $fragment = "classConstant()[@actualValue=\"{$currentClass}\"]";
        }
        $fragment = "scalar(" . $fragment . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintDirMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Dir $node)
    {
        return $this->handleMagicConstExpression($node, "dirConstant", dirname($this->filename));
    }

    public function pprintFileMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\File $node)
    {
        return $this->handleMagicConstExpression($node, "fileConstant", $this->filename);
    }

    public function pprintFunctionMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Function_ $node)
    {
        return $this->handleMagicConstExpression($node, "funcConstant", $this->currentFunction);
    }

    public function pprintLineMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Line $node)
    {
        return $this->handleMagicConstExpression($node, "lineConstant", $node->getLine());
    }

    public function pprintMethodMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Method $node)
    {
        return $this->handleMagicConstExpression($node, "methodConstant",
            $this->currentMethod ? $this->currentClass . "::" . $this->currentMethod : "");
    }

    public function pprintNamespaceMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Namespace_ $node)
    {
        return $this->handleMagicConstExpression($node, "namespaceConstant", $this->currentNamespace);
    }

    public function pprintTraitMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Trait_ $node)
    {
        return $this->handleMagicConstExpression($node, "traitConstant", $this->currentTrait);
    }

    /**
     * @param \PhpParser\Node\Scalar\MagicConst $node
     * @param $name
     * @param $value
     * @return string
     */
    private function handleMagicConstExpression(\PhpParser\Node\Scalar\MagicConst $node, $name, $value)
    {
        $fragment = "{$name}()[@actualValue=\"{$value}\"]";
        $fragment = "scalar(" . $fragment . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintStringScalar(\PhpParser\Node\Scalar\String $node)
    {
        $fragment = "string(\"" . $this->rascalizeString($node->value) . "\")";
        $fragment = "scalar(" . $fragment . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintBreakStmt(\PhpParser\Node\Stmt\Break_ $node)
    {
        if (null != $node->num)
            $fragment = "someExpr(" . $this->pprint($node->num) . ")";
        else
            $fragment = "noExpr()";

        $fragment = "\\break(" . $fragment . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintCaseStmt(\PhpParser\Node\Stmt\Case_ $node)
    {
        if (null != $node->cond)
            $cond = "someExpr(" . $this->pprint($node->cond) . ")";
        else
            $cond = "noExpr()";

        $body = array();
        foreach ($node->stmts as $stmt)
            $body[] = $this->pprint($stmt);

        $fragment = "\\case(" . $cond . ",[" . implode(",", $body) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintCatchStmt(\PhpParser\Node\Stmt\Catch_ $node)
    {
        $body = array();
        foreach ($node->stmts as $stmt)
            $body[] = $this->pprint($stmt);

        $xtype = $this->pprint($node->type);

        $fragment = "\\catch(" . $xtype . ",\"" . $node->var . "\",[" . implode(",", $body) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintClassStmt(\PhpParser\Node\Stmt\Class_ $node)
    {
        $priorClass = $this->currentClass;
        $this->currentClass = $node->name;

        $stmts = array();
        foreach ($node->stmts as $stmt)
            $stmts[] = $this->pprint($stmt);

        $implements = array();
        foreach ($node->implements as $implemented)
            $implements[] = $this->pprint($implemented);

        if (null != $node->extends)
            $extends = "someName(" . $this->pprint($node->extends) . ")";
        else
            $extends = "noName()";

        $modifiers = array();
        if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_ABSTRACT)
            $modifiers[] = "abstract()";
        if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_FINAL)
            $modifiers[] = "final()";

        $fragment = "class(\"" . $node->name . "\",{" . implode(",", $modifiers) . "}," . $extends . ",";
        $fragment .= "[" . implode(",", $implements) . "],[";
        $fragment .= implode(",", $stmts) . "])";
        $fragment .= $this->annotateASTNode($node);

        $fragment = "classDef(" . $fragment . ")";
        $priorDecl = $this->addDeclarations;
        $this->addDeclarations = false;
        $fragment .= $this->annotateASTNode($node);
        $this->addDeclarations =  $priorDecl;

        $this->currentClass = $priorClass;

        return $fragment;
    }

    public function pprintClassConstStmt(\PhpParser\Node\Stmt\ClassConst $node)
    {
        $consts = array();
        foreach ($node->consts as $const)
            $consts[] = $this->pprint($const);

        $fragment = "constCI([" . implode(",", $consts) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintClassMethodStmt(\PhpParser\Node\Stmt\ClassMethod $node)
    {
        $priorMethod = $this->currentMethod;
        $this->currentMethod = $node->name;

        $priorInsideFunction = $this->insideFunction;
        $this->insideFunction = false;

        $body = array();
        if (null != $node->stmts)
            foreach ($node->stmts as $thestmt)
                $body[] = $this->pprint($thestmt);

        $params = array();
        foreach ($node->params as $param)
            $params[] = $this->pprint($param);

        $modifiers = array();
        if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_PUBLIC)
            $modifiers[] = "\\public()";
        if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_PROTECTED)
            $modifiers[] = "protected()";
        if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_PRIVATE)
            $modifiers[] = "\\private()";
        if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_ABSTRACT)
            $modifiers[] = "abstract()";
        if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_FINAL)
            $modifiers[] = "final()";
        if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_STATIC)
            $modifiers[] = "static()";

        $byRef = "false";
        if ($node->byRef)
            $byRef = "true";

        $fragment = "method(\"" . $node->name . "\",{" . implode(",", $modifiers) . "}," . $byRef . ",[" . implode(",", $params) . "],[" . implode(",", $body) . "])";
        $fragment .= $this->annotateASTNode($node);

        $this->currentMethod = $priorMethod;
        $this->insideFunction = $priorInsideFunction;

        return $fragment;
    }

    public function pprintConstStmt(\PhpParser\Node\Stmt\Const_ $node)
    {
        $consts = array();
        foreach ($node->consts as $const)
            $consts[] = $this->pprint($const);

        $fragment = "const([" . implode(",", $consts) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintContinueStmt(\PhpParser\Node\Stmt\Continue_ $node)
    {
        if (null != $node->num)
            $fragment = "someExpr(" . $this->pprint($node->num) . ")";
        else
            $fragment = "noExpr()";

        $fragment = "\\continue(" . $fragment . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintDeclareStmt(\PhpParser\Node\Stmt\Declare_ $node)
    {
        $body = array();
        foreach ($node->stmts as $stmt)
            $body[] = $this->pprint($stmt);

        $decls = array();
        foreach ($node->declares as $decl)
            $decls[] = $this->pprint($decl);

        $fragment = "declare([" . implode(",", $decls) . "],[" . implode(",", $body) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintDeclareDeclareStmt(\PhpParser\Node\Stmt\DeclareDeclare $node)
    {
        $fragment = "declaration(\"" . $node->key . "\", " . $this->pprint($node->value) . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintDoStmt(\PhpParser\Node\Stmt\Do_ $node)
    {
        $stmts = array();
        foreach ($node->stmts as $stmt)
            $stmts[] = $this->pprint($stmt);

        $fragment = "\\do(" . $this->pprint($node->cond) . ",[" . implode(",", $stmts) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintEchoStmt(\PhpParser\Node\Stmt\Echo_ $node)
    {
        $parts = array();
        foreach ($node->exprs as $expr)
            $parts[] = $this->pprint($expr);

        $fragment = "echo([" . implode(",", $parts) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintElseStmt(\PhpParser\Node\Stmt\Else_ $node)
    {
        $body = array();
        foreach ($node->stmts as $stmt)
            $body[] = $this->pprint($stmt);

        $fragment = "\\else([" . implode(",", $body) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintElseIfStmt(\PhpParser\Node\Stmt\ElseIf_ $node)
    {
        $body = array();
        foreach ($node->stmts as $stmt)
            $body[] = $this->pprint($stmt);

        $fragment = "elseIf(" . $this->pprint($node->cond) . ",[" . implode(",", $body) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintExprStmt(\PhpParser\Node\Stmt\Expr $node)
    {
        $fragment = "exprstmt(" . $this->pprint($node->expr) . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintForStmt(\PhpParser\Node\Stmt\For_ $node)
    {
        $stmts = array();
        foreach ($node->stmts as $stmt)
            $stmts[] = $this->pprint($stmt);

        $loops = array();
        foreach ($node->loop as $loop)
            $loops[] = $this->pprint($loop);

        $conds = array();
        foreach ($node->cond as $cond)
            $conds[] = $this->pprint($cond);

        $inits = array();
        foreach ($node->init as $init)
            $inits[] = $this->pprint($init);

        $fragment = "\\for([" . implode(",", $inits) . "],[" . implode(",", $conds) . "],[" . implode(",", $loops) . "],[" . implode(",", $stmts) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintForeachStmt(\PhpParser\Node\Stmt\Foreach_ $node)
    {
        $valueVar = $this->pprint($node->valueVar);
        $expr = $this->pprint($node->expr);
        $byRef = "false";
        if ($node->byRef)
            $byRef = "true";

        $stmts = array();
        foreach ($node->stmts as $stmt)
            $stmts[] = $this->pprint($stmt);

        $keyvar = "noExpr()";
        if (null != $node->keyVar)
            $keyvar = "someExpr(" . $this->pprint($node->keyVar) . ")";

        $fragment = "foreach(" . $expr . "," . $keyvar . "," . $byRef . "," . $valueVar . ",[" . implode(",", $stmts) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintFunctionStmt(\PhpParser\Node\Stmt\Function_ $node)
    {
        $priorFunction = $this->currentFunction;
        $this->currentFunction = $node->name;

        $priorInsideFunction = $this->insideFunction;
        $this->insideFunction = true;

        $body = array();
        foreach ($node->stmts as $stmt)
            $body[] = $this->pprint($stmt);

        $params = array();
        foreach ($node->params as $param)
            $params[] = $this->pprint($param);

        $byRef = "false";
        if ($node->byRef)
            $byRef = "true";

        $fragment = "function(\"" . $node->name . "\"," . $byRef . ",[" . implode(",", $params) . "],[" . implode(",", $body) . "])";
        $fragment .= $this->annotateASTNode($node);

        $this->currentFunction = $priorFunction;
        $this->insideFunction = $priorInsideFunction;

        return $fragment;
    }

    public function pprintGlobalStmt(\PhpParser\Node\Stmt\Global_ $node)
    {
        $vars = array();
        foreach ($node->vars as $var)
            $vars[] = $this->pprint($var);

        $fragment = "global([" . implode(",", $vars) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintGotoStmt(\PhpParser\Node\Stmt\Goto_ $node)
    {
        $fragment = "goto(\"" . $node->name . "\")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintHaltCompilerStmt(\PhpParser\Node\Stmt\HaltCompiler $node)
    {
        $fragment = "haltCompiler(\"" . $this->rascalizeString($node->remaining) . "\")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintIfStmt(\PhpParser\Node\Stmt\If_ $node)
    {
        $cond = $this->pprint($node->cond);

        if (null != $node->else)
            $elseNode = "someElse(" . $this->pprint($node->else) . ")";
        else
            $elseNode = "noElse()";

        $elseIfs = array();
        foreach ($node->elseifs as $elseif)
            $elseIfs[] = $this->pprint($elseif);

        $body = array();
        foreach ($node->stmts as $stmt)
            $body[] = $this->pprint($stmt);

        $fragment = "\\if(" . $cond . ",[" . implode(",", $body) . "],[" . implode(",", $elseIfs) . "]," . $elseNode . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintInlineHTMLStmt(\PhpParser\Node\Stmt\InlineHTML $node)
    {
        $fragment = "inlineHTML(\"" . $this->rascalizeString($node->value) . "\")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintInterfaceStmt(\PhpParser\Node\Stmt\Interface_ $node)
    {
        $priorInterface = $this->currentInterface;
        $this->currentInterface = $node->name;

        $stmts = array();
        foreach ($node->stmts as $stmt)
            $stmts[] = $this->pprint($stmt);

        $extends = array();
        foreach ($node->extends as $extended)
            $extends[] = $this->pprint($extended);

        $fragment = "interface(\"" . $node->name . "\",[";
        $fragment .= implode(",", $extends) . "],[";
        $fragment .= implode(",", $stmts) . "])";
        $fragment .= $this->annotateASTNode($node);

        $fragment = "interfaceDef(" . $fragment . ")";
        $priorDecl = $this->addDeclarations;
        $this->addDeclarations = false;
        $fragment .= $this->annotateASTNode($node);
        $this->addDeclarations =  $priorDecl;

        $this->currentInterface = $priorInterface;

        return $fragment;
    }

    public function pprintLabelStmt(\PhpParser\Node\Stmt\Label $node)
    {
        $fragment = "label(\"" . $node->name . "\")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintNamespaceStmt(\PhpParser\Node\Stmt\Namespace_ $node)
    {
// If we have a non-null name, set this to the namespace name; if we
// don't, this is a global namespace declaration, like
// namespace { global stuff }
        $priorNamespace = $this->currentNamespace;
        if (null != $node->name)
            $this->currentNamespace = $this->implodeName($node->name);
        else
            $this->currentNamespace = "";

        $body = array();
        foreach ($node->stmts as $stmt)
            $body[] = $this->pprint($stmt);

// Again check the name -- since it is optional, we return an OptionName
// here, which could be noName() if this is a global namespace
        if (null != $node->name) {
            $headerName = $this->pprint($node->name);
            $name = "someName({$headerName})";
        } else {
            $name = "noName()";
        }

// The third option shouldn't occur, but is put in just in case; the first
// option is the case where we have a body, the second is where we have
// a namespace header, like namespace DB; that opens a new block but doesn't
// enclose it in braces
        if (null != $node->stmts)
            $fragment = "namespace(" . $name . ",[" . implode(",", $body) . "])";
        else
            if (null != $node->name)
                $fragment = "namespaceHeader({$this->pprint($node->name)})";
            else
                $fragment = "namespaceHeader(noName())";

        $fragment .= $this->annotateASTNode($node);

// If we had a statement body, then we reset the namespace at the end; if
// we didn't, it means that we just had a namespace declaration like
// namespace DB; which had no body, but then is still active at the end
// in which case we don't want to reset it
        if (null != $node->stmts)
            $this->currentNamespace = $priorNamespace;

        return $fragment;
    }

    public function pprintPropertyStmt(\PhpParser\Node\Stmt\Property $node)
    {
        $props = array();
        foreach ($node->props as $prop)
            $props[] = $this->pprint($prop);

        $modifiers = array();
        if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_PUBLIC)
            $modifiers[] = "\\public()";
        if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_PROTECTED)
            $modifiers[] = "protected()";
        if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_PRIVATE)
            $modifiers[] = "\\private()";
        if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_ABSTRACT)
            $modifiers[] = "abstract()";
        if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_FINAL)
            $modifiers[] = "final()";
        if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_STATIC)
            $modifiers[] = "static()";

        $fragment = "property({" . implode(",", $modifiers) . "},[" . implode(",", $props) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintPropertyPropertyStmt(\PhpParser\Node\Stmt\PropertyProperty $node)
    {
        if (null != $node->default) {
            $fragment = "someExpr(" . $this->pprint($node->default) . ")";
        } else {
            $fragment = "noExpr()";
        }

        $fragment = "property(\"" . $node->name . "\"," . $fragment . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintReturnStmt(\PhpParser\Node\Stmt\Return_ $node)
    {
        if (null != $node->expr)
            $fragment = "someExpr(" . $this->pprint($node->expr) . ")";
        else
            $fragment = "noExpr()";
        $fragment = "\\return(" . $fragment . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintStaticStmt(\PhpParser\Node\Stmt\Static_ $node)
    {
        $staticVars = array();
        foreach ($node->vars as $var)
            $staticVars[] = $this->pprint($var);

        $fragment = "static([" . implode(",", $staticVars) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintStaticVarStmt(\PhpParser\Node\Stmt\StaticVar $node)
    {
        $default = "noExpr()";
        if (null != $node->default)
            $default = "someExpr(" . $this->pprint($node->default) . ")";

        $fragment = "staticVar(\"" . $node->name . "\"," . $default . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintSwitchStmt(\PhpParser\Node\Stmt\Switch_ $node)
    {
        $cases = array();
        foreach ($node->cases as $case)
            $cases[] = $this->pprint($case);

        $fragment = "\\switch(" . $this->pprint($node->cond) . ",[" . implode(",", $cases) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintThrowStmt(\PhpParser\Node\Stmt\Throw_ $node)
    {
        $fragment = "\\throw(" . $this->pprint($node->expr) . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintTraitStmt(\PhpParser\Node\Stmt\Trait_ $node)
    {
        $body = array();

        $priorTrait = $this->currentTrait;
        $this->currentTrait = $node->name;
        $this->insideTrait = true;

        foreach ($node->stmts as $stmt)
            $body[] = $this->pprint($stmt);

        $fragment = "trait(\"" . $node->name . "\",[" . implode(",", $body) . "])";
        $fragment .= $this->annotateASTNode($node);

        $fragment = "traitDef(" . $fragment . ")";
        $priorDecl = $this->addDeclarations;
        $this->addDeclarations = false;
        $fragment .= $this->annotateASTNode($node);
        $this->addDeclarations =  $priorDecl;

        $this->currentTrait = $priorTrait;
        $this->insideTrait = false;

        return $fragment;
    }

    public function pprintTraitUseStmt(\PhpParser\Node\Stmt\TraitUse $node)
    {
        $adaptations = array();
        foreach ($node->adaptations as $adaptation)
            $adaptations[] = $this->pprint($adaptation);

        $traits = array();
        foreach ($node->traits as $trait)
            $traits[] = $this->pprint($trait);

        $fragment = "traitUse([" . implode(",", $traits) . "],[" . implode(",", $adaptations) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintAliasTraitUseAdaptationStmt(\PhpParser\Node\Stmt\TraitUseAdaptation\Alias $node)
    {
        if (null != $node->newName) {
            $newName = "someName(name(\"" . $node->newName . "\"))";
        } else {
            $newName = "noName()";
        }

        if (null != $node->newModifier) {
            $modifiers = array();
            if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_PUBLIC)
                $modifiers[] = "\\public()";
            if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_PROTECTED)
                $modifiers[] = "protected()";
            if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_PRIVATE)
                $modifiers[] = "\\private()";
            if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_ABSTRACT)
                $modifiers[] = "abstract()";
            if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_FINAL)
                $modifiers[] = "final()";
            if ($node->type & \PhpParser\Node\Stmt\Class_::MODIFIER_STATIC)
                $modifiers[] = "static()";
            $newModifier = "{ " . implode(",", $modifiers) . " }";
        } else {
            $newModifier = "{ }";
        }

        $newMethod = "\"" . $node->method . "\"";

        if (null != $node->trait) {
            $trait = "someName(" . $this->pprint($node->trait) . ")";
        } else {
            $trait = "noName()";
        }

        $fragment = "traitAlias(" . $trait . "," . $newMethod . "," . $newModifier . "," . $newName . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintPrecedenceTraitUseAdaptationStmt(\PhpParser\Node\Stmt\TraitUseAdaptation\Precedence $node)
    {
        $insteadOf = array();
        foreach ($node->insteadof as $item)
            $insteadOf[] = $this->pprint($item);

        if (null != $node->trait) {
            $trait = "someName(" . $this->pprint($node->trait) . ")";
        } else {
            $trait = "noName()";
        }

        $fragment = "traitPrecedence(" . $trait . ",\"" . $node->method . "\",{" . implode(",", $insteadOf) . "})";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintTryCatchStmt(\PhpParser\Node\Stmt\TryCatch $node)
    {
        $finallyBody = array();
        if (null != $node->finallyStmts)
            foreach ($node->finallyStmts as $fstmt)
                $finallyBody[] = $this->pprint($fstmt);

        $catches = array();
        foreach ($node->catches as $toCatch)
            $catches[] = $this->pprint($toCatch);

        $body = array();
        foreach ($node->stmts as $stmt)
            $body[] = $this->pprint($stmt);

        if (null != $node->finallyStmts)
            $fragment = "tryCatchFinally([" . implode(",", $body) . "],[" . implode(",", $catches) . "],[" . implode(",", $finallyBody) . "])";
        else
            $fragment = "tryCatch([" . implode(",", $body) . "],[" . implode(",", $catches) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }
    public function pprintUnsetStmt(\PhpParser\Node\Stmt\Unset_ $node)
    {
        $vars = array();
        foreach ($node->vars as $var)
            $vars[] = $this->pprint($var);

        $fragment = "unset([" . implode(",", $vars) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintUseStmt(\PhpParser\Node\Stmt\Use_ $node)
    {
        $uses = array();
        foreach ($node->uses as $use)
            $uses[] = $this->pprint($use);

        $fragment = "use([" . implode(",", $uses) . "])";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }


    public function pprintUseUseStmt(\PhpParser\Node\Stmt\UseUse $node)
    {
        $name = $this->pprint($node->name);
        if (null != $node->alias)
            $alias = "someName(name(\"" . $node->alias . "\"))";
        else
            $alias = "noName()";

        $fragment = "use(" . $name . "," . $alias . ")";
        $fragment .= $this->annotateASTNode($node);

        return $fragment;
    }

    public function pprintWhileStmt(\PhpParser\Node\Stmt\While_ $node)
    {
        $stmts = array();
        foreach ($node->stmts as $stmt)
            $stmts[] = $this->pprint($stmt);

        $fragment = "\\while(" . $this->pprint($node->cond) . ",[" . implode(",", $stmts) . "])";
        $fragment .= $this->annotateAstNode($node);

        return $fragment;
    }
    /**
     * @param string|\PhpParser\Node\Name $node
     * @return string
     */
    public function implodeName($node)
    {
        if (is_string($node))
            $fragment = $node;
        else if (is_array($node->parts))
            $fragment = implode("::", $node->parts);
        else
            $fragment = $node->parts;

        return $fragment;
    }
}