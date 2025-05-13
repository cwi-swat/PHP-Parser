<?php

namespace Rascal;

require __DIR__ . '/../../vendor/autoload.php';
ini_set('xdebug.max_nesting_level', 2000);

use PhpParser\ParserFactory;

$classNames = array();
$abstractClassNames = array();

class GenerateCode extends \PhpParser\NodeVisitorAbstract
{
    private $namespace = "";

    public function enterNode(\PhpParser\Node $node)
    {
        global $classNames;
        global $abstractClassNames;
        if ($node instanceof \PhpParser\Node\Stmt\Namespace_) {
            $this->namespace = '\\' . $node->name;
        } else if ($node instanceof \PhpParser\Node\Stmt\Class_) {
            if ($node->isAbstract()) {
                array_push($abstractClassNames, $node->name);
            } else if ($this->namespace . '\\' . $node->name !== "\\PhpParser\\Node\\Expr") {
                array_push($classNames, $this->namespace . '\\' . $node->name);
            }
        }
    }

    public function exitNode(\PhpParser\Node $node)
    {
        if ($node instanceof \PhpParser\Node\Stmt\Namespace_) {
            $this->namespace = "";
        }
    }
}

$parser = (new ParserFactory())->createForHostVersion();
$visitor = new \PhpParser\NodeTraverser;
$rvis = new GenerateCode;
$visitor->addVisitor($rvis);

$startDir = '../PhpParser/Node';

foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($startDir), \RecursiveIteratorIterator::CHILD_FIRST & \RecursiveIteratorIterator::LEAVES_ONLY) as $file) {
    if (!preg_match('~\.php$~', $file)) {
        continue;
    }

    $inputCode = file_get_contents($file);

    try {
        $stmts = $parser->parse($inputCode);
        $visitor->traverse($stmts);
    } catch (\PhpParser\Error $e) {
        echo 'Parse Error: ', $e->getMessage();
    }
}

$enterNodeCalls = "\tpublic function enterNode(\PhpParser\Node \$node)\n\t{\n";
$leaveNodeCalls = "\tpublic function leaveNode(\PhpParser\Node \$node)\n\t{\n";
$printNodeCalls = "\tpublic function pprint(\PhpParser\Node \$node)\n\t{\n";
$defaultEnters = "";
$defaultLeaves = "";
$defaultPrints = "";
$ifcEnters = "";
$ifcLeaves = "";
$ifcPrints = "\tpublic function pprint(\PhpParser\Node \$node);\n";

$firstPass = true;

foreach ($classNames as $className) {
    $callName = preg_replace('/(.*)_$/', '\\1', $className); // remove underscore (_) at the end of line
    if (!(FALSE === strpos($callName, '\PhpParser\Node\\'))) {
        $callName = substr($callName, strlen('PhpParser\Node\\'));
        if (!(FALSE === strpos($callName, '\\'))) {
            $nameParts = strtok(strrev($callName), "\\");
            $callName = "";
            while ($nameParts != FALSE) {
                $callName .= strrev($nameParts);
                $nameParts = strtok("\\");
            }
        }
    }
    if ($firstPass) {
        $enterNodeCalls .= "\t\tif (\$node instanceof {$className}) {\n\t\t\treturn \$this->visitor->enter{$callName}(\$node);\n\t\t}";
        $leaveNodeCalls .= "\t\tif (\$node instanceof {$className}) {\n\t\t\treturn \$this->visitor->leave{$callName}(\$node);\n\t\t}";
        $printNodeCalls .= "\t\tif (\$node instanceof {$className}) {\n\t\t\treturn \$this->pprint{$callName}(\$node);\n\t\t}";
        $firstPass = false;
    } else {
        $enterNodeCalls .= " elseif (\$node instanceof {$className}) {\n\t\t\treturn \$this->visitor->enter{$callName}(\$node);\n\t\t}";
        $leaveNodeCalls .= " elseif (\$node instanceof {$className}) {\n\t\t\treturn \$this->visitor->leave{$callName}(\$node);\n\t\t}";
        $printNodeCalls .= " elseif (\$node instanceof {$className}) {\n\t\t\treturn \$this->pprint{$callName}(\$node);\n\t\t}";
    }

    $ifcEnters .= "\tpublic function enter{$callName}({$className} \$node);\n";
    $ifcLeaves .= "\tpublic function leave{$callName}({$className} \$node);\n";
    $ifcPrints .= "\tpublic function pprint{$callName}({$className} \$node);\n";

    $defaultEnters .= "\tpublic function enter{$callName}({$className} \$node)\n\t{\n\t\treturn null;\n\t}\n";
    $defaultLeaves .= "\tpublic function leave{$callName}({$className} \$node)\n\t{\n\t\treturn null;\n\t}\n";
    $defaultPrints .= "\tpublic function pprint{$callName}({$className} \$node)\n\t{\n\t\treturn \"\";\n\t}\n";
}

$enterNodeCalls .= "\n\t}";
$leaveNodeCalls .= "\n\t}";
$printNodeCalls .= "\n\t}";

$usefulProp = "\tprivate \$visitor = null;\n";
$usefulConstructor = "\tpublic function UsefulVisitor(IVisitor \$v)\n\t{\n\t\t\$this->visitor = \$v;\n\t}\n";
$baseVisitorCode = "<?php\nnamespace Rascal;\n\nclass UsefulVisitor extends \PhpParser\NodeVisitorAbstract\n{\n{$usefulProp}\n{$usefulConstructor}\n{$enterNodeCalls}\n{$leaveNodeCalls}\n}\n?>";
$usefulVisitorInterface = "<?php\nnamespace Rascal;\n\ninterface IVisitor\n{\n{$ifcEnters}\n{$ifcLeaves}\n}\n?>";
$usefulPrinterInterface = "<?php\nnamespace Rascal;\n\ninterface IPrinter\n{\n{$ifcPrints}\n}\n?>";
$usefulBaseVisitor = "<?php\nnamespace Rascal;\n\nclass BaseVisitor implements IVisitor\n{\n{$defaultEnters}\n{$defaultLeaves}\n}\n?>";
$usefulBasePrinter = "<?php\nnamespace Rascal;\n\nclass BasePrinter implements IPrinter\n{\n{$printNodeCalls}\n{$defaultPrints}\n}\n?>";

file_put_contents("UsefulVisitor.php", $baseVisitorCode);
file_put_contents("IVisitor.php", $usefulVisitorInterface);
file_put_contents("IPrinter.php", $usefulPrinterInterface);
file_put_contents("BaseVisitor.php", $usefulBaseVisitor);
file_put_contents("BasePrinter.php", $usefulBasePrinter);