<?php

namespace Rascal;

use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use Rascal\NodeVisitor\NameResolver as NameResolverRascal;
use PhpParser\Parser;
use PhpParser\Lexer;
use PhpParser\ParserFactory;

if (!class_exists('Autoloader'))
    require_once __DIR__ . '/vendor/autoload.php';

ini_set('xdebug.max_nesting_level', 10000);

if (count($argv) < 2) {
    echo "Expected at least 1 argument\n";
    exit(-1);
}

if (!isset($opts))
    $opts = getopt("f:lslirp:n:d:", array(
        "file:",
        "enableLocations",
        "addDecl",
        "uniqueIds",
        "relativeLocations",
        "prefix:",
        "phpdocs",
        "resolveNames",
        "projectName:",
        "projectDir:",
    ));

if (isset($opts["f"]))
    $file = $opts["f"];
else
    if (isset($opts["file"]))
        $file = $opts["file"];
    else
        if (count($argv) == 2) {
            $file = $argv[1];
        } else {
            echo "errscript(\"The file must be provided using either -f or --file\")";
            exit(-1);
        }

$usesProjectLoc = false;
if (isset($opts["projectName"]) && isset($opts["projectDir"])) {
    $projectName = $opts["projectName"];
    $projectDir = $opts["projectDir"];
    $usesProjectLoc = true;
} elseif (isset($opts["n"]) && isset($opts["d"])) {
    $projectName = $opts["n"];
    $projectDir = $opts["d"];
    $usesProjectLoc = true;
} else {
    $projectName = "";
    $projectDir = "";
}

$enableLocations = false;
if (isset($opts["l"]) || isset($opts["enableLocations"]))
    $enableLocations = true;

$addDeclarations = false;
if (isset($opts["addDecl"]))
    $addDeclarations = true;

$uniqueIds = false;
if (isset($opts["i"]) || isset($opts["uniqueIds"]))
    $uniqueIds = true;

if (isset($opts["p"]))
    $prefix = $opts["p"] . '.';
else
    if (isset($opts["prefix"]))
        $prefix = $opts["prefix"] . '.';
    else {
        $prefix = "";
    }

$relativeLocations = false;
if (isset($opts["r"]) || isset($opts["relativeLocations"]))
    $relativeLocations = true;

if ($usesProjectLoc && $relativeLocations) {
    echo "errscript(\"Cannot use a project location and relative locations at the same time\")";
    exit(-1);
}

$addPHPDocs = false;
if (isset($opts["phpdocs"]))
  $addPHPDocs = true;

if (isset($_SERVER['HOME'])) {
    $homedir = $_SERVER['HOME'];
} else {
    $homedir = $_SERVER['HOMEDRIVE'] . $_SERVER['HOMEPATH'];
}

$inputCode = '';
if (! $relativeLocations && ! $usesProjectLoc && file_exists($file)) {
    $inputCode = file_get_contents($file);
} elseif ($usesProjectLoc && file_exists($projectDir . $file)) {
    $inputCode = file_get_contents($projectDir . $file);    
} elseif ($relativeLocations && file_exists($homedir . $file)) {
    $inputCode = file_get_contents($homedir . $file);
} else {
    echo "errscript(\"The given file, $file, does not exist, 1 is $projectDir and 2 is $projectName and 3 is $usesProjectLoc\")";
    exit(-1);
}

$resolveNames = isset($opts['resolveNames']) ? true : false;

$parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
$printer = new RascalPrinter($file, $enableLocations, $relativeLocations, $uniqueIds, $prefix, $projectName, $addPHPDocs, $addDeclarations);

// First try parsing with the newest supported version of the parser
$fallback = false;
$parseTree = null;
try {
    $parseTree = $parser->parse($inputCode);
} catch (\PhpParser\Error $e) {
    $fallback = true;
}

// If that does not work, fall back to PHP version 5.4
if ($fallback) {
    try {
        $parser = (new ParserFactory())->createForVersion(\PhpParser\PhpVersion::fromComponents(5,4));
        $parseTree = $parser->parse($inputCode);
    } catch (\PhpParser\Error $e) {
        echo "errscript(\"" . $printer->rascalizeString($e->getMessage()) . "\")";
    }
}

if (null !== $parseTree) {
    try {
        if ($resolveNames) {
            $traverser = new NodeTraverser;
            $traverser->addVisitor(new NameResolver);
            $traverser->addVisitor(new NameResolverRascal);
            $traverser->traverse($parseTree);
        }
    
        $stmts = array();
    
        if (count($parseTree) == 1 && $parseTree[0] instanceof \PhpParser\Node\Stmt\Nop) {
            $script = "";
        } else {
            foreach ($parseTree as $stmt) {
                $stmts[] = $printer->pprint($stmt);
            }
    
            if (count($stmts) > 1) {
                $script = implode(",\n", $stmts);
            } elseif (count($stmts) === 1) {
                $script = $stmts[0];
            } else {
                $script = "";
            }
        }
    
        echo sprintf("script([%s])", $script);
    
    } catch (\Exception $e) {
        echo "errscript(\"" . $printer->rascalizeString($e->getMessage()) . "\")";
    }    
}
