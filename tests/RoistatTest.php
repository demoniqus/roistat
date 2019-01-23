<?php


$cwd = explode(DIRECTORY_SEPARATOR, getcwd());

while (count($cwd)) {
    $pathToDir = implode(DIRECTORY_SEPARATOR, $cwd) . DIRECTORY_SEPARATOR . 'tests';
    $pathToIndexFile = implode(DIRECTORY_SEPARATOR, $cwd) . DIRECTORY_SEPARATOR . 'index.php';
    if (file_exists($pathToDir) && file_exists($pathToIndexFile)) {
        require_once  $pathToIndexFile;
        break;
    }
    array_pop($cwd);
}


use PHPUnit\Framework\TestCase;

class RoistatTest extends TestCase {

    private static $testString = 'c,sdf/fgfd-ffsd&\\fgdhgft344<df{фывыф=%аврап%`~tytr45';

    public function testRevertPunctuationMarks() {
        $testString = '';
        $actual = revertPunctuationMarks($testString);
        self::assertSame($testString, $actual);

        $testString = 'dhfgfewr747dsffdjпварав44';
        $actual = revertPunctuationMarks($testString);
        self::assertSame($testString, $actual);

        $actual = revertPunctuationMarks(self::$testString);
        $positions = array(
            1 => -7,
            5 => -8,
            10 => -9,
            15 => -15,
            16 => -16,
            27 => -22,
            30 => -25,
            36 => -36,
            37 => -37,
            43 => -42,
            44 => -47,
            45 => -51

        );
        foreach ($positions as $fromBegin => $fromEnd) {

            self::assertSame(
                mb_substr(self::$testString, $fromBegin, 1),
                mb_substr($actual, mb_strlen($actual) + $fromEnd, 1)
            );
        }


    }
}