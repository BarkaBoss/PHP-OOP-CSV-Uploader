<?php

namespace CSVLoader;
use PDO;

require_once('dbconfig.php');


class CSVLoader{

    private $connection;

    public function __construct()
    {
        $database = new Database();
        $database = $database->dbConnection();
        $this->connection = $database;
    }

    function printStuff(){
        echo "Submitting";
    }
    function storeCountriesCSV()
    {
        $file = $_FILES["file"]["tmp_name"];
        if($_FILES["file"]["size"] > 0)
        {
            $fileHandle = fopen($file, "r");
            $rowCount = 0;
            $output = "";
            fgetcsv($fileHandle);

            while(($column = fgetcsv($fileHandle, 1000, ",")) !== false)
            {
                
                if(!empty($column) && is_array($column))
                {

                    if($this->checkBlankRow($column))
                    {
                        continue;
                    }
                    if(isset($column[0], $column[1], $column[2], $column[3], $column[4], 
                        $column[5], $column[6], $column[7], $column[8], $column[9], $column[10]))
                    {
                        $continent_code	= $column[0];
                        $currency_code	= $column[1];
                        $iso2_code = $column[2];
                        $iso3_code = $column[3];
                        $iso_numeric_code = $column[4];	
                        $fips_code = $column[5];
                        $calling_code = $column[6];
                        $common_name = $column[7];
                        $official_name = $column[8];
                        $endonym = $column[9];
                        $demonym = $column[10];
                        //echo ">";

                        $insertData = $this->insertCountryRecord($continent_code, $currency_code, $iso2_code, $iso3_code, $iso_numeric_code, $fips_code,
                                                                $calling_code, $common_name, $official_name, $endonym, $demonym);

                        if(!empty($insertData))
                        {
                            $output = "success";
                            $rowCount++;
                        }
                        else{
                            $output = "failed";
                        }
                    }
                }
            }
            echo $output;
            return $output;
        }
    }

    function checkBlankRow(array $column)
    {
        $columnCount = count($column);
        $isBlank = true;

        for($i = 0; $i < $columnCount; $i++)
        {
            if(!empty($column[$i]) || $column[$i] !== "")
            {
                $isBlank = false;
            }
        }
        return $isBlank;
    }

    function insertCountryRecord($continent_code, $currency_code, $iso2_code, $iso3_code, $iso_numeric_code, $fips_code,
        $calling_code, $common_name, $official_name, $endonym, $demonym)
    {
        try
        {
            $stmt = $this->connection->prepare("INSERT INTO countries(continent_code, currency_code, iso2_code, iso3_code, iso_numeric_code, fips_code, calling_code, common_name, official_name, endonym, demonym)
                        VALUES(:continent_code, :currency_code, :iso2_code, :iso3_code, :iso_numeric_code, :fips_code, :calling_code, :common_name, :official_name, :endonym, :demonym)");

            $stmt->bindparam(":continent_code", $continent_code);
            $stmt->bindparam(":currency_code", $currency_code);
            $stmt->bindparam(":iso2_code", $iso2_code);
            $stmt->bindparam(":iso3_code", $iso3_code);
            $stmt->bindparam(":iso_numeric_code", $iso_numeric_code);
            $stmt->bindparam(":fips_code", $fips_code);
            $stmt->bindparam(":calling_code", $calling_code);
            $stmt->bindparam(":common_name", $common_name);
            $stmt->bindparam(":official_name", $official_name);
            $stmt->bindparam(":endonym", $endonym);
            $stmt->bindparam(":demonym", $demonym);

            $stmt->execute();
            return $stmt;

        }catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    function getAllCountriesCount(){
        try{
            $stmt = $this->connection->prepare("SELECT * FROM countries");
            $stmt->execute();
            
            return $stmt->rowCount();
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    function getAllCountries(){
        try{
            $stmt = $this->connection->prepare("SELECT * FROM countries LIMIT 5, 5");
            $stmt->execute();
            //$countries = $stmt->fetch(PDO::FETCH_ASSOC);
            //echo $stmt->rowCount();
            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    function getAllCountriesJson(){
        try{
            $stmt = $this->connection->prepare("SELECT * FROM countries LIMIT 100");
            $stmt->execute();
            $countryList = array();
            
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $countryList['countries_data'][] = $row;
            }
            header('Content-Type: application/json');
            echo json_encode($countryList, JSON_PRETTY_PRINT);
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }
}