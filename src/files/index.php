<?php

require_once __DIR__ . '/vendor/autoload.php';
use CSVLoader\CSVLoader;

$entry = new CSVLoader();
echo($entry->loadCSV());