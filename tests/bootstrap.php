<?php
require __DIR__."/../vendor/autoload.php";

date_default_timezone_set('Europe/Bratislava');

class MockPDOHelper extends PDO { public function __construct () {} }

/**
* Runs test case
*
* @param \Tester\TestCase $testCase
*/
function run(Tester\TestCase $testCase) {
	$testCase->run(isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : NULL);
}