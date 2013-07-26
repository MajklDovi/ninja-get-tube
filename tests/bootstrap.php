<?php
require "../vendor/autoload.php";
require "../index.php";

date_default_timezone_set('Europe/Bratislava');

/**
* Runs test case
*
* @param \Tester\TestCase $testCase
*/
function run(Tester\TestCase $testCase) {
	$testCase->run(isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : NULL);
}