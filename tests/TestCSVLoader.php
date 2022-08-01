<?php

require_once __DIR__ . '/../vendor/autoload.php';

use CSVLoader\CSVLoader;
use PHPUnit\Framework\TestCase;

final class TestCSVLoader extends TestCase
{
    public function testGetetAllCountriesCount()
    {
        $csvLoader = new CSVLoader();
        $this->assertEquals(250, $csvLoader->getAllCountriesCount());
    }
}
