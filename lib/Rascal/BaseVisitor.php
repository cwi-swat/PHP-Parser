<?php
namespace Rascal;

class BaseVisitor implements IVisitor
{
	public function enterEnumCaseStmt(\PhpParser\Node\Stmt\EnumCase $node)
	{
		return null;
	}
	public function enterExpressionStmt(\PhpParser\Node\Stmt\Expression $node)
	{
		return null;
	}
	public function enterGlobalStmt(\PhpParser\Node\Stmt\Global_ $node)
	{
		return null;
	}
	public function enterNamespaceStmt(\PhpParser\Node\Stmt\Namespace_ $node)
	{
		return null;
	}
	public function enterTraitUseStmt(\PhpParser\Node\Stmt\TraitUse $node)
	{
		return null;
	}
	public function enterPrecedenceTraitUseAdaptationStmt(\PhpParser\Node\Stmt\TraitUseAdaptation\Precedence $node)
	{
		return null;
	}
	public function enterAliasTraitUseAdaptationStmt(\PhpParser\Node\Stmt\TraitUseAdaptation\Alias $node)
	{
		return null;
	}
	public function enterCatchStmt(\PhpParser\Node\Stmt\Catch_ $node)
	{
		return null;
	}
	public function enterClassStmt(\PhpParser\Node\Stmt\Class_ $node)
	{
		return null;
	}
	public function enterThrowStmt(\PhpParser\Node\Stmt\Throw_ $node)
	{
		return null;
	}
	public function enterLabelStmt(\PhpParser\Node\Stmt\Label $node)
	{
		return null;
	}
	public function enterCaseStmt(\PhpParser\Node\Stmt\Case_ $node)
	{
		return null;
	}
	public function enterContinueStmt(\PhpParser\Node\Stmt\Continue_ $node)
	{
		return null;
	}
	public function enterClassMethodStmt(\PhpParser\Node\Stmt\ClassMethod $node)
	{
		return null;
	}
	public function enterUnsetStmt(\PhpParser\Node\Stmt\Unset_ $node)
	{
		return null;
	}
	public function enterFinallyStmt(\PhpParser\Node\Stmt\Finally_ $node)
	{
		return null;
	}
	public function enterInterfaceStmt(\PhpParser\Node\Stmt\Interface_ $node)
	{
		return null;
	}
	public function enterElseStmt(\PhpParser\Node\Stmt\Else_ $node)
	{
		return null;
	}
	public function enterWhileStmt(\PhpParser\Node\Stmt\While_ $node)
	{
		return null;
	}
	public function enterHaltCompilerStmt(\PhpParser\Node\Stmt\HaltCompiler $node)
	{
		return null;
	}
	public function enterGotoStmt(\PhpParser\Node\Stmt\Goto_ $node)
	{
		return null;
	}
	public function enterStaticStmt(\PhpParser\Node\Stmt\Static_ $node)
	{
		return null;
	}
	public function enterExprStmt(\PhpParser\Node\Stmt\Expr $node)
	{
		return null;
	}
	public function enterReturnStmt(\PhpParser\Node\Stmt\Return_ $node)
	{
		return null;
	}
	public function enterTryCatchStmt(\PhpParser\Node\Stmt\TryCatch $node)
	{
		return null;
	}
	public function enterEchoStmt(\PhpParser\Node\Stmt\Echo_ $node)
	{
		return null;
	}
	public function enterDeclareStmt(\PhpParser\Node\Stmt\Declare_ $node)
	{
		return null;
	}
	public function enterPropertyStmt(\PhpParser\Node\Stmt\Property $node)
	{
		return null;
	}
	public function enterBreakStmt(\PhpParser\Node\Stmt\Break_ $node)
	{
		return null;
	}
	public function enterIfStmt(\PhpParser\Node\Stmt\If_ $node)
	{
		return null;
	}
	public function enterConstStmt(\PhpParser\Node\Stmt\Const_ $node)
	{
		return null;
	}
	public function enterFunctionStmt(\PhpParser\Node\Stmt\Function_ $node)
	{
		return null;
	}
	public function enterSwitchStmt(\PhpParser\Node\Stmt\Switch_ $node)
	{
		return null;
	}
	public function enterForeachStmt(\PhpParser\Node\Stmt\Foreach_ $node)
	{
		return null;
	}
	public function enterForStmt(\PhpParser\Node\Stmt\For_ $node)
	{
		return null;
	}
	public function enterDoStmt(\PhpParser\Node\Stmt\Do_ $node)
	{
		return null;
	}
	public function enterGroupUseStmt(\PhpParser\Node\Stmt\GroupUse $node)
	{
		return null;
	}
	public function enterUseStmt(\PhpParser\Node\Stmt\Use_ $node)
	{
		return null;
	}
	public function enterInlineHTMLStmt(\PhpParser\Node\Stmt\InlineHTML $node)
	{
		return null;
	}
	public function enterClassConstStmt(\PhpParser\Node\Stmt\ClassConst $node)
	{
		return null;
	}
	public function enterElseIfStmt(\PhpParser\Node\Stmt\ElseIf_ $node)
	{
		return null;
	}
	public function enterNopStmt(\PhpParser\Node\Stmt\Nop $node)
	{
		return null;
	}
	public function enterTraitStmt(\PhpParser\Node\Stmt\Trait_ $node)
	{
		return null;
	}
	public function enterEnumStmt(\PhpParser\Node\Stmt\Enum_ $node)
	{
		return null;
	}
	public function enterMatchArm(\PhpParser\Node\MatchArm $node)
	{
		return null;
	}
	public function enterNullableType(\PhpParser\Node\NullableType $node)
	{
		return null;
	}
	public function enterIdentifier(\PhpParser\Node\Identifier $node)
	{
		return null;
	}
	public function enterParam(\PhpParser\Node\Param $node)
	{
		return null;
	}
	public function enterStaticVar(\PhpParser\Node\StaticVar $node)
	{
		return null;
	}
	public function enterInterpolatedStringPart(\PhpParser\Node\InterpolatedStringPart $node)
	{
		return null;
	}
	public function enterAttribute(\PhpParser\Node\Attribute $node)
	{
		return null;
	}
	public function enterListExpr(\PhpParser\Node\Expr\List_ $node)
	{
		return null;
	}
	public function enterShellExecExpr(\PhpParser\Node\Expr\ShellExec $node)
	{
		return null;
	}
	public function enterConstFetchExpr(\PhpParser\Node\Expr\ConstFetch $node)
	{
		return null;
	}
	public function enterIncludeExpr(\PhpParser\Node\Expr\Include_ $node)
	{
		return null;
	}
	public function enterStaticPropertyFetchExpr(\PhpParser\Node\Expr\StaticPropertyFetch $node)
	{
		return null;
	}
	public function enterVariableExpr(\PhpParser\Node\Expr\Variable $node)
	{
		return null;
	}
	public function enterPrintExpr(\PhpParser\Node\Expr\Print_ $node)
	{
		return null;
	}
	public function enterPreIncExpr(\PhpParser\Node\Expr\PreInc $node)
	{
		return null;
	}
	public function enterStaticCallExpr(\PhpParser\Node\Expr\StaticCall $node)
	{
		return null;
	}
	public function enterYieldFromExpr(\PhpParser\Node\Expr\YieldFrom $node)
	{
		return null;
	}
	public function enterClosureExpr(\PhpParser\Node\Expr\Closure $node)
	{
		return null;
	}
	public function enterIntCastExpr(\PhpParser\Node\Expr\Cast\Int_ $node)
	{
		return null;
	}
	public function enterObjectCastExpr(\PhpParser\Node\Expr\Cast\Object_ $node)
	{
		return null;
	}
	public function enterDoubleCastExpr(\PhpParser\Node\Expr\Cast\Double $node)
	{
		return null;
	}
	public function enterStringCastExpr(\PhpParser\Node\Expr\Cast\String_ $node)
	{
		return null;
	}
	public function enterUnsetCastExpr(\PhpParser\Node\Expr\Cast\Unset_ $node)
	{
		return null;
	}
	public function enterBoolCastExpr(\PhpParser\Node\Expr\Cast\Bool_ $node)
	{
		return null;
	}
	public function enterArrayCastExpr(\PhpParser\Node\Expr\Cast\Array_ $node)
	{
		return null;
	}
	public function enterThrowExpr(\PhpParser\Node\Expr\Throw_ $node)
	{
		return null;
	}
	public function enterPostDecExpr(\PhpParser\Node\Expr\PostDec $node)
	{
		return null;
	}
	public function enterUnaryMinusExpr(\PhpParser\Node\Expr\UnaryMinus $node)
	{
		return null;
	}
	public function enterClassConstFetchExpr(\PhpParser\Node\Expr\ClassConstFetch $node)
	{
		return null;
	}
	public function enterBitwiseNotExpr(\PhpParser\Node\Expr\BitwiseNot $node)
	{
		return null;
	}
	public function enterErrorSuppressExpr(\PhpParser\Node\Expr\ErrorSuppress $node)
	{
		return null;
	}
	public function enterArrowFunctionExpr(\PhpParser\Node\Expr\ArrowFunction $node)
	{
		return null;
	}
	public function enterEvalExpr(\PhpParser\Node\Expr\Eval_ $node)
	{
		return null;
	}
	public function enterNullsafePropertyFetchExpr(\PhpParser\Node\Expr\NullsafePropertyFetch $node)
	{
		return null;
	}
	public function enterArrayDimFetchExpr(\PhpParser\Node\Expr\ArrayDimFetch $node)
	{
		return null;
	}
	public function enterMethodCallExpr(\PhpParser\Node\Expr\MethodCall $node)
	{
		return null;
	}
	public function enterPropertyFetchExpr(\PhpParser\Node\Expr\PropertyFetch $node)
	{
		return null;
	}
	public function enterPlusAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Plus $node)
	{
		return null;
	}
	public function enterShiftRightAssignOpExpr(\PhpParser\Node\Expr\AssignOp\ShiftRight $node)
	{
		return null;
	}
	public function enterDivAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Div $node)
	{
		return null;
	}
	public function enterModAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Mod $node)
	{
		return null;
	}
	public function enterBitwiseOrAssignOpExpr(\PhpParser\Node\Expr\AssignOp\BitwiseOr $node)
	{
		return null;
	}
	public function enterMinusAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Minus $node)
	{
		return null;
	}
	public function enterPowAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Pow $node)
	{
		return null;
	}
	public function enterMulAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Mul $node)
	{
		return null;
	}
	public function enterConcatAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Concat $node)
	{
		return null;
	}
	public function enterShiftLeftAssignOpExpr(\PhpParser\Node\Expr\AssignOp\ShiftLeft $node)
	{
		return null;
	}
	public function enterBitwiseXorAssignOpExpr(\PhpParser\Node\Expr\AssignOp\BitwiseXor $node)
	{
		return null;
	}
	public function enterCoalesceAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Coalesce $node)
	{
		return null;
	}
	public function enterBitwiseAndAssignOpExpr(\PhpParser\Node\Expr\AssignOp\BitwiseAnd $node)
	{
		return null;
	}
	public function enterPlusBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Plus $node)
	{
		return null;
	}
	public function enterGreaterBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Greater $node)
	{
		return null;
	}
	public function enterLogicalOrBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\LogicalOr $node)
	{
		return null;
	}
	public function enterSpaceshipBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Spaceship $node)
	{
		return null;
	}
	public function enterSmallerBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Smaller $node)
	{
		return null;
	}
	public function enterShiftRightBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\ShiftRight $node)
	{
		return null;
	}
	public function enterBooleanOrBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BooleanOr $node)
	{
		return null;
	}
	public function enterLogicalAndBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\LogicalAnd $node)
	{
		return null;
	}
	public function enterEqualBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Equal $node)
	{
		return null;
	}
	public function enterNotIdenticalBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\NotIdentical $node)
	{
		return null;
	}
	public function enterSmallerOrEqualBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\SmallerOrEqual $node)
	{
		return null;
	}
	public function enterBooleanAndBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BooleanAnd $node)
	{
		return null;
	}
	public function enterDivBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Div $node)
	{
		return null;
	}
	public function enterLogicalXorBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\LogicalXor $node)
	{
		return null;
	}
	public function enterModBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Mod $node)
	{
		return null;
	}
	public function enterBitwiseOrBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BitwiseOr $node)
	{
		return null;
	}
	public function enterMinusBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Minus $node)
	{
		return null;
	}
	public function enterIdenticalBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Identical $node)
	{
		return null;
	}
	public function enterGreaterOrEqualBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\GreaterOrEqual $node)
	{
		return null;
	}
	public function enterPowBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Pow $node)
	{
		return null;
	}
	public function enterMulBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Mul $node)
	{
		return null;
	}
	public function enterConcatBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Concat $node)
	{
		return null;
	}
	public function enterShiftLeftBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\ShiftLeft $node)
	{
		return null;
	}
	public function enterBitwiseXorBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BitwiseXor $node)
	{
		return null;
	}
	public function enterCoalesceBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Coalesce $node)
	{
		return null;
	}
	public function enterNotEqualBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\NotEqual $node)
	{
		return null;
	}
	public function enterBitwiseAndBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BitwiseAnd $node)
	{
		return null;
	}
	public function enterAssignExpr(\PhpParser\Node\Expr\Assign $node)
	{
		return null;
	}
	public function enterPostIncExpr(\PhpParser\Node\Expr\PostInc $node)
	{
		return null;
	}
	public function enterErrorExpr(\PhpParser\Node\Expr\Error $node)
	{
		return null;
	}
	public function enterUnaryPlusExpr(\PhpParser\Node\Expr\UnaryPlus $node)
	{
		return null;
	}
	public function enterTernaryExpr(\PhpParser\Node\Expr\Ternary $node)
	{
		return null;
	}
	public function enterEmptyExpr(\PhpParser\Node\Expr\Empty_ $node)
	{
		return null;
	}
	public function enterNewExpr(\PhpParser\Node\Expr\New_ $node)
	{
		return null;
	}
	public function enterYieldExpr(\PhpParser\Node\Expr\Yield_ $node)
	{
		return null;
	}
	public function enterExitExpr(\PhpParser\Node\Expr\Exit_ $node)
	{
		return null;
	}
	public function enterNullsafeMethodCallExpr(\PhpParser\Node\Expr\NullsafeMethodCall $node)
	{
		return null;
	}
	public function enterInstanceofExpr(\PhpParser\Node\Expr\Instanceof_ $node)
	{
		return null;
	}
	public function enterFuncCallExpr(\PhpParser\Node\Expr\FuncCall $node)
	{
		return null;
	}
	public function enterBooleanNotExpr(\PhpParser\Node\Expr\BooleanNot $node)
	{
		return null;
	}
	public function enterCloneExpr(\PhpParser\Node\Expr\Clone_ $node)
	{
		return null;
	}
	public function enterPreDecExpr(\PhpParser\Node\Expr\PreDec $node)
	{
		return null;
	}
	public function enterMatchExpr(\PhpParser\Node\Expr\Match_ $node)
	{
		return null;
	}
	public function enterArrayExpr(\PhpParser\Node\Expr\Array_ $node)
	{
		return null;
	}
	public function enterAssignRefExpr(\PhpParser\Node\Expr\AssignRef $node)
	{
		return null;
	}
	public function enterIssetExpr(\PhpParser\Node\Expr\Isset_ $node)
	{
		return null;
	}
	public function enterAttributeGroup(\PhpParser\Node\AttributeGroup $node)
	{
		return null;
	}
	public function enterUnionType(\PhpParser\Node\UnionType $node)
	{
		return null;
	}
	public function enterConst(\PhpParser\Node\Const_ $node)
	{
		return null;
	}
	public function enterPropertyItem(\PhpParser\Node\PropertyItem $node)
	{
		return null;
	}
	public function enterVariadicPlaceholder(\PhpParser\Node\VariadicPlaceholder $node)
	{
		return null;
	}
	public function enterRelativeName(\PhpParser\Node\Name\Relative $node)
	{
		return null;
	}
	public function enterFullyQualifiedName(\PhpParser\Node\Name\FullyQualified $node)
	{
		return null;
	}
	public function enterVarLikeIdentifier(\PhpParser\Node\VarLikeIdentifier $node)
	{
		return null;
	}
	public function enterIntersectionType(\PhpParser\Node\IntersectionType $node)
	{
		return null;
	}
	public function enterName(\PhpParser\Node\Name $node)
	{
		return null;
	}
	public function enterIntScalar(\PhpParser\Node\Scalar\Int_ $node)
	{
		return null;
	}
	public function enterFloatScalar(\PhpParser\Node\Scalar\Float_ $node)
	{
		return null;
	}
	public function enterStringScalar(\PhpParser\Node\Scalar\String_ $node)
	{
		return null;
	}
	public function enterInterpolatedStringScalar(\PhpParser\Node\Scalar\InterpolatedString $node)
	{
		return null;
	}
	public function enterNamespaceMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Namespace_ $node)
	{
		return null;
	}
	public function enterClassMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Class_ $node)
	{
		return null;
	}
	public function enterDirMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Dir $node)
	{
		return null;
	}
	public function enterFileMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\File $node)
	{
		return null;
	}
	public function enterMethodMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Method $node)
	{
		return null;
	}
	public function enterFunctionMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Function_ $node)
	{
		return null;
	}
	public function enterLineMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Line $node)
	{
		return null;
	}
	public function enterTraitMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Trait_ $node)
	{
		return null;
	}
	public function enterDeclareItem(\PhpParser\Node\DeclareItem $node)
	{
		return null;
	}
	public function enterUseItem(\PhpParser\Node\UseItem $node)
	{
		return null;
	}
	public function enterArrayItem(\PhpParser\Node\ArrayItem $node)
	{
		return null;
	}
	public function enterArg(\PhpParser\Node\Arg $node)
	{
		return null;
	}
	public function enterClosureUse(\PhpParser\Node\ClosureUse $node)
	{
		return null;
	}

	public function leaveEnumCaseStmt(\PhpParser\Node\Stmt\EnumCase $node)
	{
		return null;
	}
	public function leaveExpressionStmt(\PhpParser\Node\Stmt\Expression $node)
	{
		return null;
	}
	public function leaveGlobalStmt(\PhpParser\Node\Stmt\Global_ $node)
	{
		return null;
	}
	public function leaveNamespaceStmt(\PhpParser\Node\Stmt\Namespace_ $node)
	{
		return null;
	}
	public function leaveTraitUseStmt(\PhpParser\Node\Stmt\TraitUse $node)
	{
		return null;
	}
	public function leavePrecedenceTraitUseAdaptationStmt(\PhpParser\Node\Stmt\TraitUseAdaptation\Precedence $node)
	{
		return null;
	}
	public function leaveAliasTraitUseAdaptationStmt(\PhpParser\Node\Stmt\TraitUseAdaptation\Alias $node)
	{
		return null;
	}
	public function leaveCatchStmt(\PhpParser\Node\Stmt\Catch_ $node)
	{
		return null;
	}
	public function leaveClassStmt(\PhpParser\Node\Stmt\Class_ $node)
	{
		return null;
	}
	public function leaveThrowStmt(\PhpParser\Node\Stmt\Throw_ $node)
	{
		return null;
	}
	public function leaveLabelStmt(\PhpParser\Node\Stmt\Label $node)
	{
		return null;
	}
	public function leaveCaseStmt(\PhpParser\Node\Stmt\Case_ $node)
	{
		return null;
	}
	public function leaveContinueStmt(\PhpParser\Node\Stmt\Continue_ $node)
	{
		return null;
	}
	public function leaveClassMethodStmt(\PhpParser\Node\Stmt\ClassMethod $node)
	{
		return null;
	}
	public function leaveUnsetStmt(\PhpParser\Node\Stmt\Unset_ $node)
	{
		return null;
	}
	public function leaveFinallyStmt(\PhpParser\Node\Stmt\Finally_ $node)
	{
		return null;
	}
	public function leaveInterfaceStmt(\PhpParser\Node\Stmt\Interface_ $node)
	{
		return null;
	}
	public function leaveElseStmt(\PhpParser\Node\Stmt\Else_ $node)
	{
		return null;
	}
	public function leaveWhileStmt(\PhpParser\Node\Stmt\While_ $node)
	{
		return null;
	}
	public function leaveHaltCompilerStmt(\PhpParser\Node\Stmt\HaltCompiler $node)
	{
		return null;
	}
	public function leaveGotoStmt(\PhpParser\Node\Stmt\Goto_ $node)
	{
		return null;
	}
	public function leaveStaticStmt(\PhpParser\Node\Stmt\Static_ $node)
	{
		return null;
	}
	public function leaveExprStmt(\PhpParser\Node\Stmt\Expr $node)
	{
		return null;
	}
	public function leaveReturnStmt(\PhpParser\Node\Stmt\Return_ $node)
	{
		return null;
	}
	public function leaveTryCatchStmt(\PhpParser\Node\Stmt\TryCatch $node)
	{
		return null;
	}
	public function leaveEchoStmt(\PhpParser\Node\Stmt\Echo_ $node)
	{
		return null;
	}
	public function leaveDeclareStmt(\PhpParser\Node\Stmt\Declare_ $node)
	{
		return null;
	}
	public function leavePropertyStmt(\PhpParser\Node\Stmt\Property $node)
	{
		return null;
	}
	public function leaveBreakStmt(\PhpParser\Node\Stmt\Break_ $node)
	{
		return null;
	}
	public function leaveIfStmt(\PhpParser\Node\Stmt\If_ $node)
	{
		return null;
	}
	public function leaveConstStmt(\PhpParser\Node\Stmt\Const_ $node)
	{
		return null;
	}
	public function leaveFunctionStmt(\PhpParser\Node\Stmt\Function_ $node)
	{
		return null;
	}
	public function leaveSwitchStmt(\PhpParser\Node\Stmt\Switch_ $node)
	{
		return null;
	}
	public function leaveForeachStmt(\PhpParser\Node\Stmt\Foreach_ $node)
	{
		return null;
	}
	public function leaveForStmt(\PhpParser\Node\Stmt\For_ $node)
	{
		return null;
	}
	public function leaveDoStmt(\PhpParser\Node\Stmt\Do_ $node)
	{
		return null;
	}
	public function leaveGroupUseStmt(\PhpParser\Node\Stmt\GroupUse $node)
	{
		return null;
	}
	public function leaveUseStmt(\PhpParser\Node\Stmt\Use_ $node)
	{
		return null;
	}
	public function leaveInlineHTMLStmt(\PhpParser\Node\Stmt\InlineHTML $node)
	{
		return null;
	}
	public function leaveClassConstStmt(\PhpParser\Node\Stmt\ClassConst $node)
	{
		return null;
	}
	public function leaveElseIfStmt(\PhpParser\Node\Stmt\ElseIf_ $node)
	{
		return null;
	}
	public function leaveNopStmt(\PhpParser\Node\Stmt\Nop $node)
	{
		return null;
	}
	public function leaveTraitStmt(\PhpParser\Node\Stmt\Trait_ $node)
	{
		return null;
	}
	public function leaveEnumStmt(\PhpParser\Node\Stmt\Enum_ $node)
	{
		return null;
	}
	public function leaveMatchArm(\PhpParser\Node\MatchArm $node)
	{
		return null;
	}
	public function leaveNullableType(\PhpParser\Node\NullableType $node)
	{
		return null;
	}
	public function leaveIdentifier(\PhpParser\Node\Identifier $node)
	{
		return null;
	}
	public function leaveParam(\PhpParser\Node\Param $node)
	{
		return null;
	}
	public function leaveStaticVar(\PhpParser\Node\StaticVar $node)
	{
		return null;
	}
	public function leaveInterpolatedStringPart(\PhpParser\Node\InterpolatedStringPart $node)
	{
		return null;
	}
	public function leaveAttribute(\PhpParser\Node\Attribute $node)
	{
		return null;
	}
	public function leaveListExpr(\PhpParser\Node\Expr\List_ $node)
	{
		return null;
	}
	public function leaveShellExecExpr(\PhpParser\Node\Expr\ShellExec $node)
	{
		return null;
	}
	public function leaveConstFetchExpr(\PhpParser\Node\Expr\ConstFetch $node)
	{
		return null;
	}
	public function leaveIncludeExpr(\PhpParser\Node\Expr\Include_ $node)
	{
		return null;
	}
	public function leaveStaticPropertyFetchExpr(\PhpParser\Node\Expr\StaticPropertyFetch $node)
	{
		return null;
	}
	public function leaveVariableExpr(\PhpParser\Node\Expr\Variable $node)
	{
		return null;
	}
	public function leavePrintExpr(\PhpParser\Node\Expr\Print_ $node)
	{
		return null;
	}
	public function leavePreIncExpr(\PhpParser\Node\Expr\PreInc $node)
	{
		return null;
	}
	public function leaveStaticCallExpr(\PhpParser\Node\Expr\StaticCall $node)
	{
		return null;
	}
	public function leaveYieldFromExpr(\PhpParser\Node\Expr\YieldFrom $node)
	{
		return null;
	}
	public function leaveClosureExpr(\PhpParser\Node\Expr\Closure $node)
	{
		return null;
	}
	public function leaveIntCastExpr(\PhpParser\Node\Expr\Cast\Int_ $node)
	{
		return null;
	}
	public function leaveObjectCastExpr(\PhpParser\Node\Expr\Cast\Object_ $node)
	{
		return null;
	}
	public function leaveDoubleCastExpr(\PhpParser\Node\Expr\Cast\Double $node)
	{
		return null;
	}
	public function leaveStringCastExpr(\PhpParser\Node\Expr\Cast\String_ $node)
	{
		return null;
	}
	public function leaveUnsetCastExpr(\PhpParser\Node\Expr\Cast\Unset_ $node)
	{
		return null;
	}
	public function leaveBoolCastExpr(\PhpParser\Node\Expr\Cast\Bool_ $node)
	{
		return null;
	}
	public function leaveArrayCastExpr(\PhpParser\Node\Expr\Cast\Array_ $node)
	{
		return null;
	}
	public function leaveThrowExpr(\PhpParser\Node\Expr\Throw_ $node)
	{
		return null;
	}
	public function leavePostDecExpr(\PhpParser\Node\Expr\PostDec $node)
	{
		return null;
	}
	public function leaveUnaryMinusExpr(\PhpParser\Node\Expr\UnaryMinus $node)
	{
		return null;
	}
	public function leaveClassConstFetchExpr(\PhpParser\Node\Expr\ClassConstFetch $node)
	{
		return null;
	}
	public function leaveBitwiseNotExpr(\PhpParser\Node\Expr\BitwiseNot $node)
	{
		return null;
	}
	public function leaveErrorSuppressExpr(\PhpParser\Node\Expr\ErrorSuppress $node)
	{
		return null;
	}
	public function leaveArrowFunctionExpr(\PhpParser\Node\Expr\ArrowFunction $node)
	{
		return null;
	}
	public function leaveEvalExpr(\PhpParser\Node\Expr\Eval_ $node)
	{
		return null;
	}
	public function leaveNullsafePropertyFetchExpr(\PhpParser\Node\Expr\NullsafePropertyFetch $node)
	{
		return null;
	}
	public function leaveArrayDimFetchExpr(\PhpParser\Node\Expr\ArrayDimFetch $node)
	{
		return null;
	}
	public function leaveMethodCallExpr(\PhpParser\Node\Expr\MethodCall $node)
	{
		return null;
	}
	public function leavePropertyFetchExpr(\PhpParser\Node\Expr\PropertyFetch $node)
	{
		return null;
	}
	public function leavePlusAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Plus $node)
	{
		return null;
	}
	public function leaveShiftRightAssignOpExpr(\PhpParser\Node\Expr\AssignOp\ShiftRight $node)
	{
		return null;
	}
	public function leaveDivAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Div $node)
	{
		return null;
	}
	public function leaveModAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Mod $node)
	{
		return null;
	}
	public function leaveBitwiseOrAssignOpExpr(\PhpParser\Node\Expr\AssignOp\BitwiseOr $node)
	{
		return null;
	}
	public function leaveMinusAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Minus $node)
	{
		return null;
	}
	public function leavePowAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Pow $node)
	{
		return null;
	}
	public function leaveMulAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Mul $node)
	{
		return null;
	}
	public function leaveConcatAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Concat $node)
	{
		return null;
	}
	public function leaveShiftLeftAssignOpExpr(\PhpParser\Node\Expr\AssignOp\ShiftLeft $node)
	{
		return null;
	}
	public function leaveBitwiseXorAssignOpExpr(\PhpParser\Node\Expr\AssignOp\BitwiseXor $node)
	{
		return null;
	}
	public function leaveCoalesceAssignOpExpr(\PhpParser\Node\Expr\AssignOp\Coalesce $node)
	{
		return null;
	}
	public function leaveBitwiseAndAssignOpExpr(\PhpParser\Node\Expr\AssignOp\BitwiseAnd $node)
	{
		return null;
	}
	public function leavePlusBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Plus $node)
	{
		return null;
	}
	public function leaveGreaterBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Greater $node)
	{
		return null;
	}
	public function leaveLogicalOrBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\LogicalOr $node)
	{
		return null;
	}
	public function leaveSpaceshipBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Spaceship $node)
	{
		return null;
	}
	public function leaveSmallerBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Smaller $node)
	{
		return null;
	}
	public function leaveShiftRightBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\ShiftRight $node)
	{
		return null;
	}
	public function leaveBooleanOrBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BooleanOr $node)
	{
		return null;
	}
	public function leaveLogicalAndBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\LogicalAnd $node)
	{
		return null;
	}
	public function leaveEqualBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Equal $node)
	{
		return null;
	}
	public function leaveNotIdenticalBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\NotIdentical $node)
	{
		return null;
	}
	public function leaveSmallerOrEqualBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\SmallerOrEqual $node)
	{
		return null;
	}
	public function leaveBooleanAndBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BooleanAnd $node)
	{
		return null;
	}
	public function leaveDivBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Div $node)
	{
		return null;
	}
	public function leaveLogicalXorBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\LogicalXor $node)
	{
		return null;
	}
	public function leaveModBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Mod $node)
	{
		return null;
	}
	public function leaveBitwiseOrBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BitwiseOr $node)
	{
		return null;
	}
	public function leaveMinusBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Minus $node)
	{
		return null;
	}
	public function leaveIdenticalBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Identical $node)
	{
		return null;
	}
	public function leaveGreaterOrEqualBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\GreaterOrEqual $node)
	{
		return null;
	}
	public function leavePowBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Pow $node)
	{
		return null;
	}
	public function leaveMulBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Mul $node)
	{
		return null;
	}
	public function leaveConcatBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Concat $node)
	{
		return null;
	}
	public function leaveShiftLeftBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\ShiftLeft $node)
	{
		return null;
	}
	public function leaveBitwiseXorBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BitwiseXor $node)
	{
		return null;
	}
	public function leaveCoalesceBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\Coalesce $node)
	{
		return null;
	}
	public function leaveNotEqualBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\NotEqual $node)
	{
		return null;
	}
	public function leaveBitwiseAndBinaryOpExpr(\PhpParser\Node\Expr\BinaryOp\BitwiseAnd $node)
	{
		return null;
	}
	public function leaveAssignExpr(\PhpParser\Node\Expr\Assign $node)
	{
		return null;
	}
	public function leavePostIncExpr(\PhpParser\Node\Expr\PostInc $node)
	{
		return null;
	}
	public function leaveErrorExpr(\PhpParser\Node\Expr\Error $node)
	{
		return null;
	}
	public function leaveUnaryPlusExpr(\PhpParser\Node\Expr\UnaryPlus $node)
	{
		return null;
	}
	public function leaveTernaryExpr(\PhpParser\Node\Expr\Ternary $node)
	{
		return null;
	}
	public function leaveEmptyExpr(\PhpParser\Node\Expr\Empty_ $node)
	{
		return null;
	}
	public function leaveNewExpr(\PhpParser\Node\Expr\New_ $node)
	{
		return null;
	}
	public function leaveYieldExpr(\PhpParser\Node\Expr\Yield_ $node)
	{
		return null;
	}
	public function leaveExitExpr(\PhpParser\Node\Expr\Exit_ $node)
	{
		return null;
	}
	public function leaveNullsafeMethodCallExpr(\PhpParser\Node\Expr\NullsafeMethodCall $node)
	{
		return null;
	}
	public function leaveInstanceofExpr(\PhpParser\Node\Expr\Instanceof_ $node)
	{
		return null;
	}
	public function leaveFuncCallExpr(\PhpParser\Node\Expr\FuncCall $node)
	{
		return null;
	}
	public function leaveBooleanNotExpr(\PhpParser\Node\Expr\BooleanNot $node)
	{
		return null;
	}
	public function leaveCloneExpr(\PhpParser\Node\Expr\Clone_ $node)
	{
		return null;
	}
	public function leavePreDecExpr(\PhpParser\Node\Expr\PreDec $node)
	{
		return null;
	}
	public function leaveMatchExpr(\PhpParser\Node\Expr\Match_ $node)
	{
		return null;
	}
	public function leaveArrayExpr(\PhpParser\Node\Expr\Array_ $node)
	{
		return null;
	}
	public function leaveAssignRefExpr(\PhpParser\Node\Expr\AssignRef $node)
	{
		return null;
	}
	public function leaveIssetExpr(\PhpParser\Node\Expr\Isset_ $node)
	{
		return null;
	}
	public function leaveAttributeGroup(\PhpParser\Node\AttributeGroup $node)
	{
		return null;
	}
	public function leaveUnionType(\PhpParser\Node\UnionType $node)
	{
		return null;
	}
	public function leaveConst(\PhpParser\Node\Const_ $node)
	{
		return null;
	}
	public function leavePropertyItem(\PhpParser\Node\PropertyItem $node)
	{
		return null;
	}
	public function leaveVariadicPlaceholder(\PhpParser\Node\VariadicPlaceholder $node)
	{
		return null;
	}
	public function leaveRelativeName(\PhpParser\Node\Name\Relative $node)
	{
		return null;
	}
	public function leaveFullyQualifiedName(\PhpParser\Node\Name\FullyQualified $node)
	{
		return null;
	}
	public function leaveVarLikeIdentifier(\PhpParser\Node\VarLikeIdentifier $node)
	{
		return null;
	}
	public function leaveIntersectionType(\PhpParser\Node\IntersectionType $node)
	{
		return null;
	}
	public function leaveName(\PhpParser\Node\Name $node)
	{
		return null;
	}
	public function leaveIntScalar(\PhpParser\Node\Scalar\Int_ $node)
	{
		return null;
	}
	public function leaveFloatScalar(\PhpParser\Node\Scalar\Float_ $node)
	{
		return null;
	}
	public function leaveStringScalar(\PhpParser\Node\Scalar\String_ $node)
	{
		return null;
	}
	public function leaveInterpolatedStringScalar(\PhpParser\Node\Scalar\InterpolatedString $node)
	{
		return null;
	}
	public function leaveNamespaceMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Namespace_ $node)
	{
		return null;
	}
	public function leaveClassMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Class_ $node)
	{
		return null;
	}
	public function leaveDirMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Dir $node)
	{
		return null;
	}
	public function leaveFileMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\File $node)
	{
		return null;
	}
	public function leaveMethodMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Method $node)
	{
		return null;
	}
	public function leaveFunctionMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Function_ $node)
	{
		return null;
	}
	public function leaveLineMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Line $node)
	{
		return null;
	}
	public function leaveTraitMagicConstScalar(\PhpParser\Node\Scalar\MagicConst\Trait_ $node)
	{
		return null;
	}
	public function leaveDeclareItem(\PhpParser\Node\DeclareItem $node)
	{
		return null;
	}
	public function leaveUseItem(\PhpParser\Node\UseItem $node)
	{
		return null;
	}
	public function leaveArrayItem(\PhpParser\Node\ArrayItem $node)
	{
		return null;
	}
	public function leaveArg(\PhpParser\Node\Arg $node)
	{
		return null;
	}
	public function leaveClosureUse(\PhpParser\Node\ClosureUse $node)
	{
		return null;
	}

}
?>