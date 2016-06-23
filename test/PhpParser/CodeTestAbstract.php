<?php

namespace PhpParser;

abstract class CodeTestAbstract extends \PHPUnit_Framework_TestCase
{
    protected function getTests($directory, $fileExtension) {
        $directory = realpath($directory);
        $it = new \RecursiveDirectoryIterator($directory);
        $it = new \RecursiveIteratorIterator($it, \RecursiveIteratorIterator::LEAVES_ONLY);
        $it = new \RegexIterator($it, '(\.' . preg_quote($fileExtension) . '$)');

        $tests = array();
        foreach ($it as $file) {
            $fileName = $file->getPathname();
            $fileContents = file_get_contents($fileName);
            $fileContents = canonicalize($fileContents);

            // evaluate @@{expr}@@ expressions
            $fileContents = preg_replace_callback(
                '/@@\{(.*?)\}@@/',
                function($matches) {
                    return eval('return ' . $matches[1] . ';');
                },
                $fileContents
            );

            // parse sections
            $parts = preg_split("/\n-----(?:\n|$)/", $fileContents);

            // first part is the name
            $name = array_shift($parts) . ' (' . $fileName . ')';
            $shortName = ltrim(str_replace($directory, '', $fileName), '/\\');

            // multiple sections possible with always two forming a pair
            $chunks = array_chunk($parts, 2);
            foreach ($chunks as $i => $chunk) {
                $dataSetName = $shortName . (count($chunks) > 1 ? '#' . $i : '');
                list($expected, $mode) = $this->extractMode($chunk[1]);
                $tests[$dataSetName] = array($name, $chunk[0], $expected, $mode);
            }

            //$this->generateRascalTestsNoParams($file, $name, $parts);
            //$this->generateRascalTestsWithLocations($file, $name, $parts);
        }

        return $tests;
    }

    private function extractMode($expected) {
        $firstNewLine = strpos($expected, "\n");
        if (false === $firstNewLine) {
            $firstNewLine = strlen($expected);
        }

        $firstLine = substr($expected, 0, $firstNewLine);
        if (0 !== strpos($firstLine, '!!')) {
            return [$expected, null];
        }

        $expected = (string) substr($expected, $firstNewLine + 1);
        return [$expected, substr($firstLine, 2)];
    }

    protected function generateRascalTestsWithLocations($file, $name, $parts)
    {
        $this->generateRascalTests($file, $name, $parts, 'locations');
    }

    protected function generateRascalTestsNoParams($file, $name, $parts)
    {
        $this->generateRascalTests($file, $name, $parts, 'no_params');
    }

    /**
     * @param $file
     * @param $name
     * @param $parts
     * @return mixed
     */
    protected function generateRascalTests($file, $name, $parts, $type)
    {
            // create test files for ast 2 rascal
            $rascalFileName = str_replace("/parser/", "/rascal/{$type}/", $file);
            $glue = "\n-----\n";
            $rascalFileContent = $name . $glue;
            $first = true;
            foreach (array_chunk($parts, 2) as $chunk) {
                if (!$first)
                    $rascalFileContent .= $glue;

                $first = false;

                $rascalFileContent .= $chunk[0] . $glue;
                $rascalFileContent .= $this->getResultOfParsedPhpCode($chunk[0], $name, $type);

            }
            file_put_contents($rascalFileName, $rascalFileContent);
    }

    /**
     * @param $code
     * @param $name
     * @return string
     */
    protected function getResultOfParsedPhpCode($code, $name, $type) {
        // create a temp file.
        $rscName = $this->normalizeText($name);

        $tempFileName = $this->getFileName($name);
        $tempResultFile = "/tmp/{$rscName}.rsc";

        file_put_contents($tempFileName, $code);
        chmod($tempFileName, "0777");

        $params = ($type === "locations") ? "-l" : "";
        $parserExec = "/usr/local/php5/bin/php -d memory_limit=1024M /Users/ruud/git/PHP-Parser-cwi/lib/Rascal/AST2Rascal.php {$params}";
        $command = sprintf("%s -f%s > %s", $parserExec, $tempFileName, $tempResultFile);
        exec($command);

        $result = file_get_contents($tempResultFile);

        echo "Command: {$command}\n";
        echo "Output: \n{$result}\n\n";

        // remove temp file
        unlink($tempFileName);
        unlink($tempResultFile);

        return $result;

    }

    /**
     * These names were used during the test code generation
     *
     * @param $name
     * @return string
     */
    public function getFileName($name)
    {
        return sprintf("/tmp/%s.php", $this->normalizeText($name));
    }

    /**
     * @param $name
     * @return mixed
     */
    protected function normalizeText($name)
    {
        $name = preg_replace('/[^a-z0-9 ]/i', ' ', $name);
        $name = ucwords(strtolower($name));
        $name = preg_replace('/\s+/', '', $name);
        return $name;
    }

}
