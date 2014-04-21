<?php

namespace Rascal;

use PhpParser\Parser;
use PhpParser\Lexer;

class AST2RascalTestOutput extends \PHPUnit_Framework_TestCase {

    protected $parser;

    const TEMP_FILE_NAME = "/tmp/ns.php";

    const SOURCE_CODE = <<<CODE
<?php
namespace Animal { class Ape {} }

namespace Animal { class Bear {} }
namespace Animal\Bear { class Panda extends \Animal\Bear {} }

namespace City { class Bear {} }

namespace Car { class Panda {} }

namespace {
    use Animal\Bear;
    use City\Bear as CityBear;

    use \Animal\Bear\Panda as PandaBear;
    use \Car\Panda;

    echo "Animal\\Bear = " . get_class(new Bear) . "\\n";
    echo "Animal\\Bear = " . get_class(new Animal\Bear) . "\\n";
    echo "Animal\\Bear = " . get_class(new \Animal\Bear) . "\\n";
    echo "-------------------\\n";
    echo "City\\Bear = " . get_class(new CityBear) . "\\n";
    echo "City\\Bear = " . get_class(new City\Bear) . "\\n";
    echo "City\\Bear = " . get_class(new \City\Bear) . "\\n";
    echo "-------------------\\n";
    echo "Animal\\Bear\\Panda = " . get_class(new PandaBear) . "\\n";
    echo "Animal\\Bear\\Panda = " . get_class(new Bear\Panda) . "\\n";
    echo "Animal\\Bear\\Panda = " . get_class(new Animal\Bear\Panda) . "\\n";
    echo "Animal\\Bear\\Panda = " . get_class(new \Animal\Bear\Panda) . "\\n";
    echo "-------------------\\n";
    echo "Car\\Panda = " . get_class(new Panda) . "\\n";
    echo "Car\\Panda = " . get_class(new Car\Panda) . "\\n";
    echo "Car\\Panda = " . get_class(new \Car\Panda) . "\\n";
}
CODE;

    const PARSED_RESULT_WITH_RESOLVED_NAMESPACES = 'script([namespace(someName(name("Animal")),[classDef(class("Ape",{},noName(),[],[]))]),
namespace(someName(name("Animal")),[classDef(class("Bear",{},noName(),[],[]))]),
namespace(someName(name("Animal::Bear")),[classDef(class("Panda",{},someName(name("Animal::Bear")),[],[]))]),
namespace(someName(name("City")),[classDef(class("Bear",{},noName(),[],[]))]),
namespace(someName(name("Car")),[classDef(class("Panda",{},noName(),[],[]))]),
namespace(noName(),[use([use(name("Animal::Bear"),someName(name("Bear")))]),use([use(name("City::Bear"),someName(name("CityBear")))]),use([use(name("Animal::Bear::Panda"),someName(name("PandaBear")))]),use([use(name("Car::Panda"),someName(name("Panda")))]),echo([binaryOperation(binaryOperation(scalar(string("Animal\\\\Bear = ")),call(name(name("get_class")),[actualParameter(new(name(name("Animal::Bear")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("Animal\\\\Bear = ")),call(name(name("get_class")),[actualParameter(new(name(name("Animal::Bear")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("Animal\\\\Bear = ")),call(name(name("get_class")),[actualParameter(new(name(name("Animal::Bear")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([scalar(string("-------------------\\n"))]),echo([binaryOperation(binaryOperation(scalar(string("City\\\\Bear = ")),call(name(name("get_class")),[actualParameter(new(name(name("City::Bear")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("City\\\\Bear = ")),call(name(name("get_class")),[actualParameter(new(name(name("City::Bear")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("City\\\\Bear = ")),call(name(name("get_class")),[actualParameter(new(name(name("City::Bear")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([scalar(string("-------------------\\n"))]),echo([binaryOperation(binaryOperation(scalar(string("Animal\\\\Bear\\\\Panda = ")),call(name(name("get_class")),[actualParameter(new(name(name("Animal::Bear::Panda")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("Animal\\\\Bear\\\\Panda = ")),call(name(name("get_class")),[actualParameter(new(name(name("Animal::Bear::Panda")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("Animal\\\\Bear\\\\Panda = ")),call(name(name("get_class")),[actualParameter(new(name(name("Animal::Bear::Panda")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("Animal\\\\Bear\\\\Panda = ")),call(name(name("get_class")),[actualParameter(new(name(name("Animal::Bear::Panda")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([scalar(string("-------------------\\n"))]),echo([binaryOperation(binaryOperation(scalar(string("Car\\\\Panda = ")),call(name(name("get_class")),[actualParameter(new(name(name("Car::Panda")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("Car\\\\Panda = ")),call(name(name("get_class")),[actualParameter(new(name(name("Car::Panda")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("Car\\\\Panda = ")),call(name(name("get_class")),[actualParameter(new(name(name("Car::Panda")),[]),false)]),concat()),scalar(string("\\n")),concat())])])])';

    const PARSED_RESULT_WITHOUT_RESOLVED_NAMESPACES = 'script([namespace(someName(name("Animal")),[classDef(class("Ape",{},noName(),[],[]))]),
namespace(someName(name("Animal")),[classDef(class("Bear",{},noName(),[],[]))]),
namespace(someName(name("Animal::Bear")),[classDef(class("Panda",{},someName(name("Animal::Bear")),[],[]))]),
namespace(someName(name("City")),[classDef(class("Bear",{},noName(),[],[]))]),
namespace(someName(name("Car")),[classDef(class("Panda",{},noName(),[],[]))]),
namespace(noName(),[use([use(name("Animal::Bear"),someName(name("Bear")))]),use([use(name("City::Bear"),someName(name("CityBear")))]),use([use(name("Animal::Bear::Panda"),someName(name("PandaBear")))]),use([use(name("Car::Panda"),someName(name("Panda")))]),echo([binaryOperation(binaryOperation(scalar(string("Animal\\\\Bear = ")),call(name(name("get_class")),[actualParameter(new(name(name("Bear")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("Animal\\\\Bear = ")),call(name(name("get_class")),[actualParameter(new(name(name("Animal::Bear")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("Animal\\\\Bear = ")),call(name(name("get_class")),[actualParameter(new(name(name("Animal::Bear")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([scalar(string("-------------------\\n"))]),echo([binaryOperation(binaryOperation(scalar(string("City\\\\Bear = ")),call(name(name("get_class")),[actualParameter(new(name(name("CityBear")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("City\\\\Bear = ")),call(name(name("get_class")),[actualParameter(new(name(name("City::Bear")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("City\\\\Bear = ")),call(name(name("get_class")),[actualParameter(new(name(name("City::Bear")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([scalar(string("-------------------\\n"))]),echo([binaryOperation(binaryOperation(scalar(string("Animal\\\\Bear\\\\Panda = ")),call(name(name("get_class")),[actualParameter(new(name(name("PandaBear")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("Animal\\\\Bear\\\\Panda = ")),call(name(name("get_class")),[actualParameter(new(name(name("Bear::Panda")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("Animal\\\\Bear\\\\Panda = ")),call(name(name("get_class")),[actualParameter(new(name(name("Animal::Bear::Panda")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("Animal\\\\Bear\\\\Panda = ")),call(name(name("get_class")),[actualParameter(new(name(name("Animal::Bear::Panda")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([scalar(string("-------------------\\n"))]),echo([binaryOperation(binaryOperation(scalar(string("Car\\\\Panda = ")),call(name(name("get_class")),[actualParameter(new(name(name("Panda")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("Car\\\\Panda = ")),call(name(name("get_class")),[actualParameter(new(name(name("Car::Panda")),[]),false)]),concat()),scalar(string("\\n")),concat())]),echo([binaryOperation(binaryOperation(scalar(string("Car\\\\Panda = ")),call(name(name("get_class")),[actualParameter(new(name(name("Car::Panda")),[]),false)]),concat()),scalar(string("\\n")),concat())])])])';

    public static function setUpBeforeClass() {
        if (!file_exists(self::TEMP_FILE_NAME))
            file_put_contents(self::TEMP_FILE_NAME, self::SOURCE_CODE);

        chmod(self::TEMP_FILE_NAME, "0777");
    }

    public static function tearDownAfterClass() {
        unlink(self::TEMP_FILE_NAME);
    }

    public function setUp()
    {
        $this->parser = new Parser(new Lexer\Emulative);
    }

    public function testAST2Rascal() {
        $output = $this->getOutput($opts = null);

        // assert the full file
        $this->assertEquals(self::PARSED_RESULT_WITHOUT_RESOLVED_NAMESPACES, $output);
    }

    public function testAST2RascalResolveNamespaces() {
        $opts = array(
            'resolveNames' => true,
        );
        $output = $this->getOutput($opts);
        $this->assertEquals(self::PARSED_RESULT_WITH_RESOLVED_NAMESPACES, $output);
    }

    /**
     * @dataProvider optionProvider
     */
    public function testAST2RascalParseOptions($opts, $partOfResult)
    {
        $output = $this->getOutput($opts);
        $this->assertTrue(strpos($output, $partOfResult) !== false);
    }

    public function optionProvider() {
        return array(
            array(
                array("enableLocations" => true),
                "@at=|file:///",
            ),
            array(
                array("addDecl" => true),
                "@decl=|php+",
            ),
            array(
                array("uniqueIds" => true),
                "@id=",
            ),
            array(
                array("uniqueIds" => true),
                "@id=",
            ),
            array(
                array("prefix" => "prefixXx", "uniqueIds" => true),
                "prefixXx",
            ),
            array(
                array("phpdocs" => true),
                "@phpdoc=",
            ),
        );
    }

    /**
     * @param array $opts
     * @return string
     */
    protected function getOutput($opts = null)
    {
        $argv = array(
            0 => __DIR__ . '/../../lib/Rascal/AST2Rascal.php',
            1 => self::TEMP_FILE_NAME,
        );

        if (is_null($opts))
            unset($opts);

        ob_start();
        require(__DIR__ . '/../../lib/Rascal/AST2Rascal.php');
        $output = ob_get_clean();
        unset($argv, $opts);
        return $output;
    }

}
