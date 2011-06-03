PHP Parser
==========

This is a PHP parser written in PHP. It's purpose is to simplify static code analysis and
manipulation.

***Note: This project is work in progress. It is known to not function perfectly correct yet (see
the "Known Issues" section at the end of this document).***

Components
==========

This package currently bundles several components:

 * The `Parser` itself
 * A `NodeDumper` to dump the nodes to a human readable string representation
 * A `PrettyPrinter` to translate the node tree back to PHP

Parser and ParserDebug
----------------------

Parsing is performed using `Parser->parse()`. This method accepts a `Lexer` as the only parameter
and returns an array of statement nodes. If an error occurs it throws a ParseErrorException.

    $code = '<?php // some code';

    try {
        $parser = new Parser;
        $stmts = $parser->parse(new Lexer($code));
    } catch (ParseErrorException $e) {
        echo 'Parse Error: ', $e->getMessage();
    }

The `ParserDebug` class also parses a PHP code, but outputs a debug trace while doing so.

Node Tree
---------

The output of the parser is an array of statement nodes. All nodes are instances of `NodeAbstract`.
Furthermore nodes are divided into three categories:

 * `Node_Stmt`: A statement
 * `Node_Expr`: An expression
 * `Node_Scalar`: A scalar (which is a string, a number, aso.)
   `Node_Scalar` inherits from `Node_Expr`.

Each node may have subnodes. For example `Node_Expr_Plus` has two subnodes, namely `left` and
`right`, which represend the left hand side and right hand side expressions of the plus operation.
Subnodes are accessed as normal properties:

    $node->left

The subnodes which a certain node can have are documented as `@property` doccomments in the
respective files.

NodeDumper
----------

Nodes can be dumped into a string representation using the `NodeDumper->dump()` method:

    $code = <<<'CODE'
    <?php
        function printLine($msg) {
            echo $msg, "\n";
        }

        printLine('Hallo World!!!');
    CODE;

    try {
        $parser = new Parser;
        $stmts = $parser->parse(new Lexer($code));

        $nodeDumper = new NodeDumper;
        echo '<pre>' . htmlspecialchars($nodeDumper->dump($stmts)) . '</pre>';
    } catch (ParseErrorException $e) {
        echo 'Parse Error: ', $e->getMessage();
    }

This script will have an output similar to the following:

    array(
        0: Stmt_Func(
            byRef: false
            name: printLine
            params: array(
                0: Stmt_FuncParam(
                    type: null
                    name: msg
                    byRef: false
                    default: null
                )
            )
            stmts: array(
                0: Stmt_Echo(
                    exprs: array(
                        0: Variable(
                            name: msg
                        )
                        1: Scalar_String(
                            value:

                            isBinary: false
                            type: 1
                        )
                    )
                )
            )
        )
        1: Expr_FuncCall(
            func: Name(
                parts: array(
                    0: printLine
                )
            )
            args: array(
                0: Expr_FuncCallArg(
                    value: Scalar_String(
                        value: Hallo World!!!
                        isBinary: false
                        type: 0
                    )
                    byRef: false
                )
            )
        )
    )

PrettyPrinter
-------------

The pretty printer compiles nodes back to PHP code. "Pretty printing" here is just the formal
name of the process and does not mean that the output is in any way pretty.

    $prettyPrinter = new PrettyPrinter_Zend;
    echo '<pre>' . htmlspecialchars($prettyPrinter->prettyPrint($stmts)) . '</pre>';

For the code mentioned in the above section this should create the output:

    function printLine($msg)
    {
        echo $msg, "\n";
    }
    printLine('Hallo World!!!');

Known Issues
============