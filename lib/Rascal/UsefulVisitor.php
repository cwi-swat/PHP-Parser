<?php
namespace Rascal;

class UsefulVisitor extends \PhpParser\NodeVisitorAbstract
{
	private $visitor = null;

	public function UsefulVisitor(IVisitor $v)
	{
		$this->visitor = $v;
	}

	public function enterNode(\PhpParser\Node $node)
	{
		if ($node instanceof \PhpParser\Node\Arg) {
			return $this->visitor->enterArg($node);
		} elseif ($node instanceof \PhpParser\Node\Const_) {
			return $this->visitor->enterConst($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Array_) {
			return $this->visitor->enterArrayExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ArrayDimFetch) {
			return $this->visitor->enterArrayDimFetchExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ArrayItem) {
			return $this->visitor->enterArrayItemExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Assign) {
			return $this->visitor->enterAssignExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\BitwiseAnd) {
			return $this->visitor->enterBitwiseAndAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\BitwiseOr) {
			return $this->visitor->enterBitwiseOrAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\BitwiseXor) {
			return $this->visitor->enterBitwiseXorAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Concat) {
			return $this->visitor->enterConcatAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Div) {
			return $this->visitor->enterDivAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Minus) {
			return $this->visitor->enterMinusAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Mod) {
			return $this->visitor->enterModAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Mul) {
			return $this->visitor->enterMulAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Plus) {
			return $this->visitor->enterPlusAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\ShiftLeft) {
			return $this->visitor->enterShiftLeftAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\ShiftRight) {
			return $this->visitor->enterShiftRightAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp) {
			return $this->visitor->enterAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignRef) {
			return $this->visitor->enterAssignRefExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\BitwiseAnd) {
			return $this->visitor->enterBitwiseAndBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\BitwiseOr) {
			return $this->visitor->enterBitwiseOrBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\BitwiseXor) {
			return $this->visitor->enterBitwiseXorBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\BooleanAnd) {
			return $this->visitor->enterBooleanAndBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\BooleanOr) {
			return $this->visitor->enterBooleanOrBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Concat) {
			return $this->visitor->enterConcatBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Div) {
			return $this->visitor->enterDivBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Equal) {
			return $this->visitor->enterEqualBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Greater) {
			return $this->visitor->enterGreaterBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\GreaterOrEqual) {
			return $this->visitor->enterGreaterOrEqualBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Identical) {
			return $this->visitor->enterIdenticalBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\LogicalAnd) {
			return $this->visitor->enterLogicalAndBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\LogicalOr) {
			return $this->visitor->enterLogicalOrBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\LogicalXor) {
			return $this->visitor->enterLogicalXorBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Minus) {
			return $this->visitor->enterMinusBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Mod) {
			return $this->visitor->enterModBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Mul) {
			return $this->visitor->enterMulBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\NotEqual) {
			return $this->visitor->enterNotEqualBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\NotIdentical) {
			return $this->visitor->enterNotIdenticalBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Plus) {
			return $this->visitor->enterPlusBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\ShiftLeft) {
			return $this->visitor->enterShiftLeftBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\ShiftRight) {
			return $this->visitor->enterShiftRightBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Smaller) {
			return $this->visitor->enterSmallerBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\SmallerOrEqual) {
			return $this->visitor->enterSmallerOrEqualBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp) {
			return $this->visitor->enterBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BitwiseNot) {
			return $this->visitor->enterBitwiseNotExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BooleanNot) {
			return $this->visitor->enterBooleanNotExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Array_) {
			return $this->visitor->enterArrayCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Bool) {
			return $this->visitor->enterBoolCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Double) {
			return $this->visitor->enterDoubleCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Int) {
			return $this->visitor->enterIntCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Object) {
			return $this->visitor->enterObjectCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\String) {
			return $this->visitor->enterStringCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Unset_) {
			return $this->visitor->enterUnsetCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast) {
			return $this->visitor->enterCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ClassConstFetch) {
			return $this->visitor->enterClassConstFetchExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Clone_) {
			return $this->visitor->enterCloneExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Closure) {
			return $this->visitor->enterClosureExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ClosureUse) {
			return $this->visitor->enterClosureUseExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ConstFetch) {
			return $this->visitor->enterConstFetchExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Empty_) {
			return $this->visitor->enterEmptyExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ErrorSuppress) {
			return $this->visitor->enterErrorSuppressExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Eval_) {
			return $this->visitor->enterEvalExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Exit_) {
			return $this->visitor->enterExitExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\FuncCall) {
			return $this->visitor->enterFuncCallExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Include_) {
			return $this->visitor->enterIncludeExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Instanceof_) {
			return $this->visitor->enterInstanceofExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Isset_) {
			return $this->visitor->enterIssetExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\List_) {
			return $this->visitor->enterListExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\MethodCall) {
			return $this->visitor->enterMethodCallExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\New_) {
			return $this->visitor->enterNewExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\PostDec) {
			return $this->visitor->enterPostDecExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\PostInc) {
			return $this->visitor->enterPostIncExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\PreDec) {
			return $this->visitor->enterPreDecExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\PreInc) {
			return $this->visitor->enterPreIncExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Print_) {
			return $this->visitor->enterPrintExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\PropertyFetch) {
			return $this->visitor->enterPropertyFetchExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ShellExec) {
			return $this->visitor->enterShellExecExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\StaticCall) {
			return $this->visitor->enterStaticCallExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\StaticPropertyFetch) {
			return $this->visitor->enterStaticPropertyFetchExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Ternary) {
			return $this->visitor->enterTernaryExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\UnaryMinus) {
			return $this->visitor->enterUnaryMinusExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\UnaryPlus) {
			return $this->visitor->enterUnaryPlusExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Variable) {
			return $this->visitor->enterVariableExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Yield_) {
			return $this->visitor->enterYieldExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Name\FullyQualified) {
			return $this->visitor->enterFullyQualifiedName($node);
		} elseif ($node instanceof \PhpParser\Node\Name\Relative) {
			return $this->visitor->enterRelativeName($node);
		} elseif ($node instanceof \PhpParser\Node\Name) {
			return $this->visitor->enterName($node);
		} elseif ($node instanceof \PhpParser\Node\Param) {
			return $this->visitor->enterParam($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\DNumber) {
			return $this->visitor->enterDNumberScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\Encapsed) {
			return $this->visitor->enterEncapsedScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\LNumber) {
			return $this->visitor->enterLNumberScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Class_) {
			return $this->visitor->enterClassMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Dir) {
			return $this->visitor->enterDirMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\File) {
			return $this->visitor->enterFileMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Function_) {
			return $this->visitor->enterFunctionMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Line) {
			return $this->visitor->enterLineMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Method) {
			return $this->visitor->enterMethodMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Namespace_) {
			return $this->visitor->enterNamespaceMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Trait_) {
			return $this->visitor->enterTraitMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst) {
			return $this->visitor->enterMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\String) {
			return $this->visitor->enterStringScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar) {
			return $this->visitor->enterScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Break_) {
			return $this->visitor->enterBreakStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Case_) {
			return $this->visitor->enterCaseStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Catch_) {
			return $this->visitor->enterCatchStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Class_) {
			return $this->visitor->enterClassStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\ClassConst) {
			return $this->visitor->enterClassConstStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\ClassMethod) {
			return $this->visitor->enterClassMethodStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Const_) {
			return $this->visitor->enterConstStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Continue_) {
			return $this->visitor->enterContinueStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Declare_) {
			return $this->visitor->enterDeclareStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\DeclareDeclare) {
			return $this->visitor->enterDeclareDeclareStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Do_) {
			return $this->visitor->enterDoStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Echo_) {
			return $this->visitor->enterEchoStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Else_) {
			return $this->visitor->enterElseStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\ElseIf_) {
			return $this->visitor->enterElseIfStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Expr) {
			return $this->visitor->enterExprStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\For_) {
			return $this->visitor->enterForStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Foreach_) {
			return $this->visitor->enterForeachStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Function_) {
			return $this->visitor->enterFunctionStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Global_) {
			return $this->visitor->enterGlobalStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Goto_) {
			return $this->visitor->enterGotoStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\HaltCompiler) {
			return $this->visitor->enterHaltCompilerStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\If_) {
			return $this->visitor->enterIfStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\InlineHTML) {
			return $this->visitor->enterInlineHTMLStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Interface_) {
			return $this->visitor->enterInterfaceStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Label) {
			return $this->visitor->enterLabelStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Namespace_) {
			return $this->visitor->enterNamespaceStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Property) {
			return $this->visitor->enterPropertyStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\PropertyProperty) {
			return $this->visitor->enterPropertyPropertyStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Return_) {
			return $this->visitor->enterReturnStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Static_) {
			return $this->visitor->enterStaticStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\StaticVar) {
			return $this->visitor->enterStaticVarStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Switch_) {
			return $this->visitor->enterSwitchStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Throw_) {
			return $this->visitor->enterThrowStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Trait_) {
			return $this->visitor->enterTraitStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\TraitUse) {
			return $this->visitor->enterTraitUseStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\TraitUseAdaptation\Alias) {
			return $this->visitor->enterAliasTraitUseAdaptationStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\TraitUseAdaptation\Precedence) {
			return $this->visitor->enterPrecedenceTraitUseAdaptationStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\TraitUseAdaptation) {
			return $this->visitor->enterTraitUseAdaptationStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\TryCatch) {
			return $this->visitor->enterTryCatchStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Unset_) {
			return $this->visitor->enterUnsetStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Use_) {
			return $this->visitor->enterUseStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\UseUse) {
			return $this->visitor->enterUseUseStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\While_) {
			return $this->visitor->enterWhileStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt) {
			return $this->visitor->enterStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Expr) {
			return $this->visitor->enterExpr($node);
		}
	}
	public function leaveNode(\PhpParser\Node $node)
	{
		if ($node instanceof \PhpParser\Node\Arg) {
			return $this->visitor->leaveArg($node);
		} elseif ($node instanceof \PhpParser\Node\Const_) {
			return $this->visitor->leaveConst($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Array_) {
			return $this->visitor->leaveArrayExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ArrayDimFetch) {
			return $this->visitor->leaveArrayDimFetchExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ArrayItem) {
			return $this->visitor->leaveArrayItemExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Assign) {
			return $this->visitor->leaveAssignExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\BitwiseAnd) {
			return $this->visitor->leaveBitwiseAndAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\BitwiseOr) {
			return $this->visitor->leaveBitwiseOrAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\BitwiseXor) {
			return $this->visitor->leaveBitwiseXorAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Concat) {
			return $this->visitor->leaveConcatAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Div) {
			return $this->visitor->leaveDivAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Minus) {
			return $this->visitor->leaveMinusAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Mod) {
			return $this->visitor->leaveModAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Mul) {
			return $this->visitor->leaveMulAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Plus) {
			return $this->visitor->leavePlusAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\ShiftLeft) {
			return $this->visitor->leaveShiftLeftAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\ShiftRight) {
			return $this->visitor->leaveShiftRightAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp) {
			return $this->visitor->leaveAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignRef) {
			return $this->visitor->leaveAssignRefExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\BitwiseAnd) {
			return $this->visitor->leaveBitwiseAndBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\BitwiseOr) {
			return $this->visitor->leaveBitwiseOrBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\BitwiseXor) {
			return $this->visitor->leaveBitwiseXorBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\BooleanAnd) {
			return $this->visitor->leaveBooleanAndBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\BooleanOr) {
			return $this->visitor->leaveBooleanOrBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Concat) {
			return $this->visitor->leaveConcatBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Div) {
			return $this->visitor->leaveDivBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Equal) {
			return $this->visitor->leaveEqualBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Greater) {
			return $this->visitor->leaveGreaterBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\GreaterOrEqual) {
			return $this->visitor->leaveGreaterOrEqualBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Identical) {
			return $this->visitor->leaveIdenticalBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\LogicalAnd) {
			return $this->visitor->leaveLogicalAndBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\LogicalOr) {
			return $this->visitor->leaveLogicalOrBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\LogicalXor) {
			return $this->visitor->leaveLogicalXorBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Minus) {
			return $this->visitor->leaveMinusBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Mod) {
			return $this->visitor->leaveModBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Mul) {
			return $this->visitor->leaveMulBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\NotEqual) {
			return $this->visitor->leaveNotEqualBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\NotIdentical) {
			return $this->visitor->leaveNotIdenticalBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Plus) {
			return $this->visitor->leavePlusBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\ShiftLeft) {
			return $this->visitor->leaveShiftLeftBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\ShiftRight) {
			return $this->visitor->leaveShiftRightBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Smaller) {
			return $this->visitor->leaveSmallerBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\SmallerOrEqual) {
			return $this->visitor->leaveSmallerOrEqualBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp) {
			return $this->visitor->leaveBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BitwiseNot) {
			return $this->visitor->leaveBitwiseNotExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BooleanNot) {
			return $this->visitor->leaveBooleanNotExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Array_) {
			return $this->visitor->leaveArrayCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Bool) {
			return $this->visitor->leaveBoolCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Double) {
			return $this->visitor->leaveDoubleCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Int) {
			return $this->visitor->leaveIntCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Object) {
			return $this->visitor->leaveObjectCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\String) {
			return $this->visitor->leaveStringCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Unset_) {
			return $this->visitor->leaveUnsetCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast) {
			return $this->visitor->leaveCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ClassConstFetch) {
			return $this->visitor->leaveClassConstFetchExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Clone_) {
			return $this->visitor->leaveCloneExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Closure) {
			return $this->visitor->leaveClosureExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ClosureUse) {
			return $this->visitor->leaveClosureUseExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ConstFetch) {
			return $this->visitor->leaveConstFetchExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Empty_) {
			return $this->visitor->leaveEmptyExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ErrorSuppress) {
			return $this->visitor->leaveErrorSuppressExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Eval_) {
			return $this->visitor->leaveEvalExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Exit_) {
			return $this->visitor->leaveExitExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\FuncCall) {
			return $this->visitor->leaveFuncCallExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Include_) {
			return $this->visitor->leaveIncludeExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Instanceof_) {
			return $this->visitor->leaveInstanceofExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Isset_) {
			return $this->visitor->leaveIssetExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\List_) {
			return $this->visitor->leaveListExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\MethodCall) {
			return $this->visitor->leaveMethodCallExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\New_) {
			return $this->visitor->leaveNewExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\PostDec) {
			return $this->visitor->leavePostDecExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\PostInc) {
			return $this->visitor->leavePostIncExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\PreDec) {
			return $this->visitor->leavePreDecExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\PreInc) {
			return $this->visitor->leavePreIncExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Print_) {
			return $this->visitor->leavePrintExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\PropertyFetch) {
			return $this->visitor->leavePropertyFetchExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ShellExec) {
			return $this->visitor->leaveShellExecExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\StaticCall) {
			return $this->visitor->leaveStaticCallExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\StaticPropertyFetch) {
			return $this->visitor->leaveStaticPropertyFetchExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Ternary) {
			return $this->visitor->leaveTernaryExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\UnaryMinus) {
			return $this->visitor->leaveUnaryMinusExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\UnaryPlus) {
			return $this->visitor->leaveUnaryPlusExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Variable) {
			return $this->visitor->leaveVariableExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Yield_) {
			return $this->visitor->leaveYieldExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Name\FullyQualified) {
			return $this->visitor->leaveFullyQualifiedName($node);
		} elseif ($node instanceof \PhpParser\Node\Name\Relative) {
			return $this->visitor->leaveRelativeName($node);
		} elseif ($node instanceof \PhpParser\Node\Name) {
			return $this->visitor->leaveName($node);
		} elseif ($node instanceof \PhpParser\Node\Param) {
			return $this->visitor->leaveParam($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\DNumber) {
			return $this->visitor->leaveDNumberScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\Encapsed) {
			return $this->visitor->leaveEncapsedScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\LNumber) {
			return $this->visitor->leaveLNumberScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Class_) {
			return $this->visitor->leaveClassMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Dir) {
			return $this->visitor->leaveDirMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\File) {
			return $this->visitor->leaveFileMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Function_) {
			return $this->visitor->leaveFunctionMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Line) {
			return $this->visitor->leaveLineMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Method) {
			return $this->visitor->leaveMethodMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Namespace_) {
			return $this->visitor->leaveNamespaceMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Trait_) {
			return $this->visitor->leaveTraitMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst) {
			return $this->visitor->leaveMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\String) {
			return $this->visitor->leaveStringScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar) {
			return $this->visitor->leaveScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Break_) {
			return $this->visitor->leaveBreakStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Case_) {
			return $this->visitor->leaveCaseStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Catch_) {
			return $this->visitor->leaveCatchStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Class_) {
			return $this->visitor->leaveClassStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\ClassConst) {
			return $this->visitor->leaveClassConstStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\ClassMethod) {
			return $this->visitor->leaveClassMethodStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Const_) {
			return $this->visitor->leaveConstStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Continue_) {
			return $this->visitor->leaveContinueStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Declare_) {
			return $this->visitor->leaveDeclareStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\DeclareDeclare) {
			return $this->visitor->leaveDeclareDeclareStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Do_) {
			return $this->visitor->leaveDoStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Echo_) {
			return $this->visitor->leaveEchoStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Else_) {
			return $this->visitor->leaveElseStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\ElseIf_) {
			return $this->visitor->leaveElseIfStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Expr) {
			return $this->visitor->leaveExprStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\For_) {
			return $this->visitor->leaveForStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Foreach_) {
			return $this->visitor->leaveForeachStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Function_) {
			return $this->visitor->leaveFunctionStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Global_) {
			return $this->visitor->leaveGlobalStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Goto_) {
			return $this->visitor->leaveGotoStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\HaltCompiler) {
			return $this->visitor->leaveHaltCompilerStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\If_) {
			return $this->visitor->leaveIfStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\InlineHTML) {
			return $this->visitor->leaveInlineHTMLStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Interface_) {
			return $this->visitor->leaveInterfaceStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Label) {
			return $this->visitor->leaveLabelStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Namespace_) {
			return $this->visitor->leaveNamespaceStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Property) {
			return $this->visitor->leavePropertyStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\PropertyProperty) {
			return $this->visitor->leavePropertyPropertyStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Return_) {
			return $this->visitor->leaveReturnStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Static_) {
			return $this->visitor->leaveStaticStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\StaticVar) {
			return $this->visitor->leaveStaticVarStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Switch_) {
			return $this->visitor->leaveSwitchStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Throw_) {
			return $this->visitor->leaveThrowStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Trait_) {
			return $this->visitor->leaveTraitStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\TraitUse) {
			return $this->visitor->leaveTraitUseStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\TraitUseAdaptation\Alias) {
			return $this->visitor->leaveAliasTraitUseAdaptationStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\TraitUseAdaptation\Precedence) {
			return $this->visitor->leavePrecedenceTraitUseAdaptationStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\TraitUseAdaptation) {
			return $this->visitor->leaveTraitUseAdaptationStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\TryCatch) {
			return $this->visitor->leaveTryCatchStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Unset_) {
			return $this->visitor->leaveUnsetStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Use_) {
			return $this->visitor->leaveUseStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\UseUse) {
			return $this->visitor->leaveUseUseStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\While_) {
			return $this->visitor->leaveWhileStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt) {
			return $this->visitor->leaveStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Expr) {
			return $this->visitor->leaveExpr($node);
		}
	}
}
?>