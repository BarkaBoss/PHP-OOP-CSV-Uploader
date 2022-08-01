<?php

    require_once __DIR__ . '/vendor/autoload.php';
    use CSVLoader\CSVLoader;

    $csvLoader = new CSVLoader();
        
    $csvLoader->getAllCountriesJson();

?>