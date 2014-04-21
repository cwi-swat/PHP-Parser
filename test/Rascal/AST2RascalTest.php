<?php

namespace Rascal;

use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use Rascal\NodeVisitor\NameResolver as NameResolverRascal;
use PhpParser\Parser;
use PhpParser\Lexer;

class AST2RascalTest extends \PHPUnit_Framework_TestCase {
    protected $baseFolder;
    protected $parser;
    protected $traverser;


    public function setUp() {
        $this->baseFolder = __DIR__ . "/../code/rascal/name_resolver/";

        $this->parser = new Parser(new Lexer\Emulative);

        $this->traverser = new NodeTraverser;
        $this->traverser->addVisitor(new NameResolver);
        $this->traverser->addVisitor(new NameResolverRascal);
    }

    public function testParserNameSpace1() {
        $fileName = "names_1.php";
        $parseTree = $this->parserFile($fileName);

        $printer = $this->getPrinter($fileName);

        $this->assertSame("PhpParser\\Node\\Stmt\\Namespace_", get_class($parseTree[0]), "Namespace object-type check");
        $this->assertSame("PhpParser\\Node\\Stmt\\Use_", get_class($parseTree[0]->stmts[0]), "Class object-type check");
        $this->assertSame("PhpParser\\Node\\Stmt\\Use_", get_class($parseTree[0]->stmts[1]), "Class object-type check");
        $this->assertSame("PhpParser\\Node\\Stmt\\Class_", get_class($parseTree[0]->stmts[2]), "Class object-type check");

        // pre traverse check
        $namePartsDummy  = $parseTree[0]->stmts[2]->stmts[0]->stmts[0]->expr->expr->class->parts;
        $namePartsDummy2 = $parseTree[0]->stmts[2]->stmts[0]->stmts[2]->expr->expr->class->parts;
        $this->assertSame(array(0 => "Dummy"),  $namePartsDummy);
        $this->assertSame(array(0 => "Dummy2"), $namePartsDummy2);

        $prePrint = $printer->pprint($parseTree[0]);
        $this->traverser->traverse($parseTree);
        $postPrint = $printer->pprint($parseTree[0]);

        // post traverse check
        $namePartsDummy  = $parseTree[0]->stmts[2]->stmts[0]->stmts[0]->expr->expr->class->parts;
        $namePartsDummy2 = $parseTree[0]->stmts[2]->stmts[0]->stmts[2]->expr->expr->class->parts;
        $this->assertSame(array(0 => "Test", "Dummy"),  $namePartsDummy);
        $this->assertSame(array(0 => "Test2", "Dummy"), $namePartsDummy2);

        // test printer output
        $this->assertTrue(1 === substr_count($prePrint, "Test2::Dummy"));
        $this->assertTrue(2 === substr_count($postPrint, "Test2::Dummy"));

        $this->assertTrue(2 === substr_count($prePrint, "Dummy2"));
        $this->assertTrue(1 === substr_count($postPrint, "Dummy2"));


    }

    public function parserFile($fileName) {
        $inputCode = file_get_contents($this->baseFolder.$fileName);

        return $this->parser->parse($inputCode);
    }

    private function getPrinter($fileName) {
        return new RascalPrinter(
            $fileName,
            $enableLocations = true,
            $relativeLocations = false,
            $uniqueIds = true,
            $prefix = true,
            $addPHPDocs = true,
            $enableLocationInfo = true
        );
    }

    public function provideTestFiles()
    {
        $baseFolder = __DIR__ . "/../code/rascal/name_resolver/";
        return $this->readDirectory($baseFolder);
    }

    private function readDirectory($dir)
    {
        $files = array();
        if ($handle = opendir($dir)) {
            while (false !== ($entry = readdir($handle)))
                if (preg_match('/\.php$/', $entry))
                    $files[] = array($entry);

            closedir($handle);
        }
        return $files;
    }
}
 