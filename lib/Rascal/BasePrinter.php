<?php
namespace Rascal;

class BasePrinter implements IPrinter
{
	public function pprint(\PhpParser\Node $node)
	{
		if ($node instanceof \PhpParser\Node\Arg) {
			return $this->pprintArg($node);
		} elseif ($node instanceof \PhpParser\Node\Const_) {
			return $this->pprintConst($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Array_) {
			return $this->pprintArrayExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ArrayDimFetch) {
			return $this->pprintArrayDimFetchExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ArrayItem) {
			return $this->pprintArrayItemExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Assign) {
			return $this->pprintAssignExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\BitwiseAnd) {
			return $this->pprintBitwiseAndAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\BitwiseOr) {
			return $this->pprintBitwiseOrAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\BitwiseXor) {
			return $this->pprintBitwiseXorAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Concat) {
			return $this->pprintConcatAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Div) {
			return $this->pprintDivAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Minus) {
			return $this->pprintMinusAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Mod) {
			return $this->pprintModAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Mul) {
			return $this->pprintMulAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\Plus) {
			return $this->pprintPlusAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\ShiftLeft) {
			return $this->pprintShiftLeftAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp\ShiftRight) {
			return $this->pprintShiftRightAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignOp) {
			return $this->pprintAssignOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\AssignRef) {
			return $this->pprintAssignRefExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\BitwiseAnd) {
			return $this->pprintBitwiseAndBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\BitwiseOr) {
			return $this->pprintBitwiseOrBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\BitwiseXor) {
			return $this->pprintBitwiseXorBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\BooleanAnd) {
			return $this->pprintBooleanAndBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\BooleanOr) {
			return $this->pprintBooleanOrBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Concat) {
			return $this->pprintConcatBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Div) {
			return $this->pprintDivBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Equal) {
			return $this->pprintEqualBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Greater) {
			return $this->pprintGreaterBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\GreaterOrEqual) {
			return $this->pprintGreaterOrEqualBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Identical) {
			return $this->pprintIdenticalBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\LogicalAnd) {
			return $this->pprintLogicalAndBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\LogicalOr) {
			return $this->pprintLogicalOrBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\LogicalXor) {
			return $this->pprintLogicalXorBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Minus) {
			return $this->pprintMinusBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Mod) {
			return $this->pprintModBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Mul) {
			return $this->pprintMulBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\NotEqual) {
			return $this->pprintNotEqualBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\NotIdentical) {
			return $this->pprintNotIdenticalBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Plus) {
			return $this->pprintPlusBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\ShiftLeft) {
			return $this->pprintShiftLeftBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\ShiftRight) {
			return $this->pprintShiftRightBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\Smaller) {
			return $this->pprintSmallerBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp\SmallerOrEqual) {
			return $this->pprintSmallerOrEqualBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BinaryOp) {
			return $this->pprintBinaryOpExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BitwiseNot) {
			return $this->pprintBitwiseNotExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\BooleanNot) {
			return $this->pprintBooleanNotExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Array_) {
			return $this->pprintArrayCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Bool) {
			return $this->pprintBoolCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Double) {
			return $this->pprintDoubleCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Int) {
			return $this->pprintIntCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Object) {
			return $this->pprintObjectCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\String) {
			return $this->pprintStringCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast\Unset_) {
			return $this->pprintUnsetCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Cast) {
			return $this->pprintCastExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ClassConstFetch) {
			return $this->pprintClassConstFetchExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Clone_) {
			return $this->pprintCloneExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Closure) {
			return $this->pprintClosureExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ClosureUse) {
			return $this->pprintClosureUseExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ConstFetch) {
			return $this->pprintConstFetchExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Empty_) {
			return $this->pprintEmptyExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ErrorSuppress) {
			return $this->pprintErrorSuppressExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Eval_) {
			return $this->pprintEvalExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Exit_) {
			return $this->pprintExitExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\FuncCall) {
			return $this->pprintFuncCallExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Include_) {
			return $this->pprintIncludeExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Instanceof_) {
			return $this->pprintInstanceofExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Isset_) {
			return $this->pprintIssetExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\List_) {
			return $this->pprintListExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\MethodCall) {
			return $this->pprintMethodCallExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\New_) {
			return $this->pprintNewExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\PostDec) {
			return $this->pprintPostDecExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\PostInc) {
			return $this->pprintPostIncExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\PreDec) {
			return $this->pprintPreDecExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\PreInc) {
			return $this->pprintPreIncExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Print_) {
			return $this->pprintPrintExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\PropertyFetch) {
			return $this->pprintPropertyFetchExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\ShellExec) {
			return $this->pprintShellExecExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\StaticCall) {
			return $this->pprintStaticCallExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\StaticPropertyFetch) {
			return $this->pprintStaticPropertyFetchExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Ternary) {
			return $this->pprintTernaryExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\UnaryMinus) {
			return $this->pprintUnaryMinusExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\UnaryPlus) {
			return $this->pprintUnaryPlusExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Variable) {
			return $this->pprintVariableExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Expr\Yield_) {
			return $this->pprintYieldExpr($node);
		} elseif ($node instanceof \PhpParser\Node\Name\FullyQualified) {
			return $this->pprintFullyQualifiedName($node);
		} elseif ($node instanceof \PhpParser\Node\Name\Relative) {
			return $this->pprintRelativeName($node);
		} elseif ($node instanceof \PhpParser\Node\Name) {
			return $this->pprintName($node);
		} elseif ($node instanceof \PhpParser\Node\Param) {
			return $this->pprintParam($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\DNumber) {
			return $this->pprintDNumberScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\Encapsed) {
			return $this->pprintEncapsedScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\LNumber) {
			return $this->pprintLNumberScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Class_) {
			return $this->pprintClassMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Dir) {
			return $this->pprintDirMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\File) {
			return $this->pprintFileMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Function_) {
			return $this->pprintFunctionMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Line) {
			return $this->pprintLineMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Method) {
			return $this->pprintMethodMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Namespace_) {
			return $this->pprintNamespaceMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst\Trait_) {
			return $this->pprintTraitMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\MagicConst) {
			return $this->pprintMagicConstScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar\String) {
			return $this->pprintStringScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Scalar) {
			return $this->pprintScalar($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Break_) {
			return $this->pprintBreakStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Case_) {
			return $this->pprintCaseStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Catch_) {
			return $this->pprintCatchStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Class_) {
			return $this->pprintClassStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\ClassConst) {
			return $this->pprintClassConstStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\ClassMethod) {
			return $this->pprintClassMethodStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Const_) {
			return $this->pprintConstStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Continue_) {
			return $this->pprintContinueStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Declare_) {
			return $this->pprintDeclareStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\DeclareDeclare) {
			return $this->pprintDeclareDeclareStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Do_) {
			return $this->pprintDoStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Echo_) {
			return $this->pprintEchoStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Else_) {
			return $this->pprintElseStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\ElseIf_) {
			return $this->pprintElseIfStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\For_) {
			return $this->pprintForStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Foreach_) {
			return $this->pprintForeachStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Function_) {
			return $this->pprintFunctionStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Global_) {
			return $this->pprintGlobalStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Goto_) {
			return $this->pprintGotoStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\HaltCompiler) {
			return $this->pprintHaltCompilerStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\If_) {
			return $this->pprintIfStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\InlineHTML) {
			return $this->pprintInlineHTMLStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Interface_) {
			return $this->pprintInterfaceStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Label) {
			return $this->pprintLabelStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Namespace_) {
			return $this->pprintNamespaceStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Property) {
			return $this->pprintPropertyStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\PropertyProperty) {
			return $this->pprintPropertyPropertyStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Return_) {
			return $this->pprintReturnStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Static_) {
			return $this->pprintStaticStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\StaticVar) {
			return $this->pprintStaticVarStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Switch_) {
			return $this->pprintSwitchStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Throw_) {
			return $this->pprintThrowStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Trait_) {
			return $this->pprintTraitStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\TraitUse) {
			return $this->pprintTraitUseStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\TraitUseAdaptation\Alias) {
			return $this->pprintAliasTraitUseAdaptationStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\TraitUseAdaptation\Precedence) {
			return $this->pprintPrecedenceTraitUseAdaptationStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\TraitUseAdaptation) {
			return $this->pprintTraitUseAdaptationStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\TryCatch) {
			return $this->pprintTryCatchStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Unset_) {
			return $this->pprintUnsetStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\Use_) {
			return $this->pprintUseStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\UseUse) {
			return $this->pprintUseUseStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt\While_) {
			return $this->pprintWhileStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Stmt) {
			return $this->pprintStmt($node);
		} elseif ($node instanceof \PhpParser\Node\Expr) {
			return $this->pprintExpr($node);
		}
	}
	public function pprintArg(\PhpParser\Node\Arg $node)
	{
		return "";
	}
	public function pprintConst(\PhpParser\Node\Const_ $node)
	{
		return "";
	}
	public function pprintArrayExpr(\PhpParser\Node\Expr\Array_ $node)
	{
		return "";
	}
	public function pprintArrayDimFetchExpr(\PhpParser\Node\Expr\ArrayDimFetch $node)
	{
		return "";
	}
	public function pprintArrayItemExpr(\PhpParser\Node\Expr\ArrayItem $node)
	{
		return "";
	}
	public function pprintAssignExpr(\PhpParser\Node\Expr\Assign $node)
	{
		return "";
	}
	public function pprintBitwiseAndAssignOpExpr(\PhpParser\Node\Expr\AssignOp\BitwiseAnd $node)
	{
		return "";
	}
	public function pprintBitwiseOrAssignOpExpr(\PhpParser\Node\Expr\AssignOp\BitwiseOr $node)
	{
		return "";
	}
	public function pprintBitwiseXorAssignOpExpr(\PhpParser\Node\Expr\AssignOp\BitwiseXor $node)
	{
		return "";
	}
	public function pprintConcatAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Concat $node)
	{
		return "";
	}
	public function pprintDivAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Div $node)
	{
		return "";
	}
	public function pprintMinusAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Minus $node)
	{
		return "";
	}
	public function pprintModAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Mod $node)
	{
		return "";
	}
	public function pprintMulAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Mul $node)
	{
		return "";
	}
	public function pprintPlusAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Plus $node)
	{
		return "";
	}
	public function pprintShiftLeftAssignOpExpr(\PhpParser\Node\Expr\AssignOp\ShiftLeft $node)
	{
		return "";
	}
	public function pprintShiftRightAssignOpExpr(\PhpParser\Node\Expr\AssignOp\ShiftRight $node)
	{
		return "";
	}
	public function pprintAssignOpExpr(\PhpParser\Node\Expr\AssignOp $node)
	{
		return "";
	}
	public function pprintAssignRefExpr(\PhpParser\Node\Expr\AssignRef $node)
	{
		return "";
	}
	public function pprintBitwiseAndBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BitwiseAnd $node)
	{
		return "";
	}
	public function pprintBitwiseOrBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BitwiseOr $node)
	{
		return "";
	}
	public function pprintBitwiseXorBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BitwiseXor $node)
	{
		return "";
	}
	public function pprintBooleanAndBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BooleanAnd $node)
	{
		return "";
	}
	public function pprintBooleanOrBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BooleanOr $node)
	{
		return "";
	}
	public function pprintConcatBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Concat $node)
	{
		return "";
	}
	public function pprintDivBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Div $node)
	{
		return "";
	}
	public function pprintEqualBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Equal $node)
	{
		return "";
	}
	public function pprintGreaterBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Greater $node)
	{
		return "";
	}
	public function pprintGreaterOrEqualBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\GreaterOrEqual $node)
	{
		return "";
	}
	public function pprintIdenticalBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Identical $node)
	{
		return "";
	}
	public function pprintLogicalAndBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\LogicalAnd $node)
	{
		return "";
	}
	public function pprintLogicalOrBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\LogicalOr $node)
	{
		return "";
	}
	public function pprintLogicalXorBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\LogicalXor $node)
	{
		return "";
	}
	public function pprintMinusBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Minus $node)
	{
		return "";
	}
	public function pprintModBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Mod $node)
	{
		return "";
	}
	public function pprintMulBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Mul $node)
	{
		return "";
	}
	public function pprintNotEqualBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\NotEqual $node)
	{
		return "";
	}
	public function pprintNotIdenticalBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\NotIdentical $node)
	{
		return "";
	}
	public function pprintPlusBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Plus $node)
	{
		return "";
	}
	public function pprintShiftLeftBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\ShiftLeft $node)
	{
		return "";
	}
	public function pprintShiftRightBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\ShiftRight $node)
	{
		return "";
	}
	public function pprintSmallerBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Smaller $node)
	{
		return "";
	}
	public function pprintSmallerOrEqualBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\SmallerOrEqual $node)
	{
		return "";
	}
	public function pprintBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp $node)
	{
		return "";
	}
	public function pprintBitwiseNotExpr(\PhpParser\Node\Expr\BitwiseNot $node)
	{
		return "";
	}
	public function pprintBooleanNotExpr(\PhpParser\Node\Expr\BooleanNot $node)
	{
		return "";
	}
	public function pprintArrayCastExpr(\PhpParser\Node\Expr\Cast\Array_ $node)
	{
		return "";
	}
	public function pprintBoolCastExpr(\PhpParser\Node\Expr\Cast\Bool $node)
	{
		return "";
	}
	public function pprintDoubleCastExpr(\PhpParser\Node\Expr\Cast\Double $node)
	{
		return "";
	}
	public function pprintIntCastExpr(\PhpParser\Node\Expr\Cast\Int $node)
	{
		return "";
	}
	public function pprintObjectCastExpr(\PhpParser\Node\Expr\Cast\Object $node)
	{
		return "";
	}
	public function pprintStringCastExpr(\PhpParser\Node\Expr\Cast\String $node)
	{
		return "";
	}
	public function pprintUnsetCastExpr(\PhpParser\Node\Expr\Cast\Unset_ $node)
	{
		return "";
	}
	public function pprintCastExpr(\PhpParser\Node\Expr\Cast $node)
	{
		return "";
	}
	public function pprintClassConstFetchExpr(\PhpParser\Node\Expr\ClassConstFetch $node)
	{
		return "";
	}
	public function pprintCloneExpr(\PhpParser\Node\Expr\Clone_ $node)
	{
		return "";
	}
	public function pprintClosureExpr(\PhpParser\Node\Expr\Closure $node)
	{
		return "";
	}
	public function pprintClosureUseExpr(\PhpParser\Node\Expr\ClosureUse $node)
	{
		return "";
	}
	public function pprintConstFetchExpr(\PhpParser\Node\Expr\ConstFetch $node)
	{
		return "";
	}
	public function pprintEmptyExpr(\PhpParser\Node\Expr\Empty_ $node)
	{
		return "";
	}
	public function pprintErrorSuppressExpr(\PhpParser\Node\Expr\ErrorSuppress $node)
	{
		return "";
	}
	public function pprintEvalExpr(\PhpParser\Node\Expr\Eval_ $node)
	{
		return "";
	}
	public function pprintExitExpr(\PhpParser\Node\Expr\Exit_ $node)
	{
		return "";
	}
	public function pprintFuncCallExpr(\PhpParser\Node\Expr\FuncCall $node)
	{
		return "";
	}
	public function pprintIncludeExpr(\PhpParser\Node\Expr\Include_ $node)
	{
		return "";
	}
	public function pprintInstanceofExpr(\PhpParser\Node\Expr\Instanceof_ $node)
	{
		return "";
	}
	public function pprintIssetExpr(\PhpParser\Node\Expr\Isset_ $node)
	{
		return "";
	}
	public function pprintListExpr(\PhpParser\Node\Expr\List_ $node)
	{
		return "";
	}
	public function pprintMethodCallExpr(\PhpParser\Node\Expr\MethodCall $node)
	{
		return "";
	}
	public function pprintNewExpr(\PhpParser\Node\Expr\New_ $node)
	{
		return "";
	}
	public function pprintPostDecExpr(\PhpParser\Node\Expr\PostDec $node)
	{
		return "";
	}
	public function pprintPostIncExpr(\PhpParser\Node\Expr\PostInc $node)
	{
		return "";
	}
	public function pprintPreDecExpr(\PhpParser\Node\Expr\PreDec $node)
	{
		return "";
	}
	public function pprintPreIncExpr(\PhpParser\Node\Expr\PreInc $node)
	{
		return "";
	}
	public function pprintPrintExpr(\PhpParser\Node\Expr\Print_ $node)
	{
		return "";
	}
	public function pprintPropertyFetchExpr(\PhpParser\Node\Expr\PropertyFetch $node)
	{
		return "";
	}
	public function pprintShellExecExpr(\PhpParser\Node\Expr\ShellExec $node)
	{
		return "";
	}
	public function pprintStaticCallExpr(\PhpParser\Node\Expr\StaticCall $node)
	{
		return "";
	}
	public function pprintStaticPropertyFetchExpr(\PhpParser\Node\Expr\StaticPropertyFetch $node)
	{
		return "";
	}
	public function pprintTernaryExpr(\PhpParser\Node\Expr\Ternary $node)
	{
		return "";
	}
	public function pprintUnaryMinusExpr(\PhpParser\Node\Expr\UnaryMinus $node)
	{
		return "";
	}
	public function pprintUnaryPlusExpr(\PhpParser\Node\Expr\UnaryPlus $node)
	{
		return "";
	}
	public function pprintVariableExpr(\PhpParser\Node\Expr\Variable $node)
	{
		return "";
	}
	public function pprintYieldExpr(\PhpParser\Node\Expr\Yield_ $node)
	{
		return "";
	}
	public function pprintFullyQualifiedName(\PhpParser\Node\Name\FullyQualified $node)
	{
		return "";
	}
	public function pprintRelativeName(\PhpParser\Node\Name\Relative $node)
	{
		return "";
	}
	public function pprintName(\PhpParser\Node\Name $node)
	{
		return "";
	}
	public function pprintParam(\PhpParser\Node\Param $node)
	{
		return "";
	}
	public function pprintDNumberScalar(\PhpParser\Node\Scalar\DNumber $node)
	{
		return "";
	}
	public function pprintEncapsedScalar(\PhpParser\Node\Scalar\Encapsed $node)
	{
		return "";
	}
	public function pprintLNumberScalar(\PhpParser\Node\Scalar\LNumber $node)
	{
		return "";
	}
	public function pprintClassMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Class_ $node)
	{
		return "";
	}
	public function pprintDirMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Dir $node)
	{
		return "";
	}
	public function pprintFileMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\File $node)
	{
		return "";
	}
	public function pprintFunctionMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Function_ $node)
	{
		return "";
	}
	public function pprintLineMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Line $node)
	{
		return "";
	}
	public function pprintMethodMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Method $node)
	{
		return "";
	}
	public function pprintNamespaceMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Namespace_ $node)
	{
		return "";
	}
	public function pprintTraitMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Trait_ $node)
	{
		return "";
	}
	public function pprintMagicConstScalar(\PhpParser\Node\Scalar\MagicConst $node)
	{
		return "";
	}
	public function pprintStringScalar(\PhpParser\Node\Scalar\String $node)
	{
		return "";
	}
	public function pprintScalar(\PhpParser\Node\Scalar $node)
	{
		return "";
	}
	public function pprintBreakStmt(\PhpParser\Node\Stmt\Break_ $node)
	{
		return "";
	}
	public function pprintCaseStmt(\PhpParser\Node\Stmt\Case_ $node)
	{
		return "";
	}
	public function pprintCatchStmt(\PhpParser\Node\Stmt\Catch_ $node)
	{
		return "";
	}
	public function pprintClassStmt(\PhpParser\Node\Stmt\Class_ $node)
	{
		return "";
	}
	public function pprintClassConstStmt(\PhpParser\Node\Stmt\ClassConst $node)
	{
		return "";
	}
	public function pprintClassMethodStmt(\PhpParser\Node\Stmt\ClassMethod $node)
	{
		return "";
	}
	public function pprintConstStmt(\PhpParser\Node\Stmt\Const_ $node)
	{
		return "";
	}
	public function pprintContinueStmt(\PhpParser\Node\Stmt\Continue_ $node)
	{
		return "";
	}
	public function pprintDeclareStmt(\PhpParser\Node\Stmt\Declare_ $node)
	{
		return "";
	}
	public function pprintDeclareDeclareStmt(\PhpParser\Node\Stmt\DeclareDeclare $node)
	{
		return "";
	}
	public function pprintDoStmt(\PhpParser\Node\Stmt\Do_ $node)
	{
		return "";
	}
	public function pprintEchoStmt(\PhpParser\Node\Stmt\Echo_ $node)
	{
		return "";
	}
	public function pprintElseStmt(\PhpParser\Node\Stmt\Else_ $node)
	{
		return "";
	}
	public function pprintElseIfStmt(\PhpParser\Node\Stmt\ElseIf_ $node)
	{
		return "";
	}
	public function pprintForStmt(\PhpParser\Node\Stmt\For_ $node)
	{
		return "";
	}
	public function pprintForeachStmt(\PhpParser\Node\Stmt\Foreach_ $node)
	{
		return "";
	}
	public function pprintFunctionStmt(\PhpParser\Node\Stmt\Function_ $node)
	{
		return "";
	}
	public function pprintGlobalStmt(\PhpParser\Node\Stmt\Global_ $node)
	{
		return "";
	}
	public function pprintGotoStmt(\PhpParser\Node\Stmt\Goto_ $node)
	{
		return "";
	}
	public function pprintHaltCompilerStmt(\PhpParser\Node\Stmt\HaltCompiler $node)
	{
		return "";
	}
	public function pprintIfStmt(\PhpParser\Node\Stmt\If_ $node)
	{
		return "";
	}
	public function pprintInlineHTMLStmt(\PhpParser\Node\Stmt\InlineHTML $node)
	{
		return "";
	}
	public function pprintInterfaceStmt(\PhpParser\Node\Stmt\Interface_ $node)
	{
		return "";
	}
	public function pprintLabelStmt(\PhpParser\Node\Stmt\Label $node)
	{
		return "";
	}
	public function pprintNamespaceStmt(\PhpParser\Node\Stmt\Namespace_ $node)
	{
		return "";
	}
	public function pprintPropertyStmt(\PhpParser\Node\Stmt\Property $node)
	{
		return "";
	}
	public function pprintPropertyPropertyStmt(\PhpParser\Node\Stmt\PropertyProperty $node)
	{
		return "";
	}
	public function pprintReturnStmt(\PhpParser\Node\Stmt\Return_ $node)
	{
		return "";
	}
	public function pprintStaticStmt(\PhpParser\Node\Stmt\Static_ $node)
	{
		return "";
	}
	public function pprintStaticVarStmt(\PhpParser\Node\Stmt\StaticVar $node)
	{
		return "";
	}
	public function pprintSwitchStmt(\PhpParser\Node\Stmt\Switch_ $node)
	{
		return "";
	}
	public function pprintThrowStmt(\PhpParser\Node\Stmt\Throw_ $node)
	{
		return "";
	}
	public function pprintTraitStmt(\PhpParser\Node\Stmt\Trait_ $node)
	{
		return "";
	}
	public function pprintTraitUseStmt(\PhpParser\Node\Stmt\TraitUse $node)
	{
		return "";
	}
	public function pprintAliasTraitUseAdaptationStmt(\PhpParser\Node\Stmt\TraitUseAdaptation\Alias $node)
	{
		return "";
	}
	public function pprintPrecedenceTraitUseAdaptationStmt(\PhpParser\Node\Stmt\TraitUseAdaptation\Precedence $node)
	{
		return "";
	}
	public function pprintTraitUseAdaptationStmt(\PhpParser\Node\Stmt\TraitUseAdaptation $node)
	{
		return "";
	}
	public function pprintTryCatchStmt(\PhpParser\Node\Stmt\TryCatch $node)
	{
		return "";
	}
	public function pprintUnsetStmt(\PhpParser\Node\Stmt\Unset_ $node)
	{
		return "";
	}
	public function pprintUseStmt(\PhpParser\Node\Stmt\Use_ $node)
	{
		return "";
	}
	public function pprintUseUseStmt(\PhpParser\Node\Stmt\UseUse $node)
	{
		return "";
	}
	public function pprintWhileStmt(\PhpParser\Node\Stmt\While_ $node)
	{
		return "";
	}
	public function pprintStmt(\PhpParser\Node\Stmt $node)
	{
		return "";
	}
	public function pprintExpr(\PhpParser\Node\Expr $node)
	{
		return "";
	}

}
?>