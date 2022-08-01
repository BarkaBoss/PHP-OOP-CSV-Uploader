<?php

    require_once __DIR__ . '/vendor/autoload.php';
    use CSVLoader\CSVLoader;

    $csvLoader = new CSVLoader();

    if(isset($_POST["submit"]))
    {
        
        $result = $csvLoader->storeCountriesCSV();
    }
?>

<!--!doctype html-->
<html lang="en">
 
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 
  <title>AGPAY CSV Loader</title>
 
  <style>
    .custom-file-input.selected:lang(en)::after {
      content: "" !important;
    }
 
    .custom-file {
      overflow: hidden;
    }
 
    .custom-file-input {
      white-space: nowrap;
    }
  </style>
</head>
 
<body>
 
  <div class="container">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="input-group">
        <div class="custom-file">
        <input type="file" name="file" id="file" class="file" accept=".csv">
          <label class="file" for="file">Select file</label>
        </div>
        </br>
        <div class="input-group-append">
           <input type="submit" name="submit" value="Upload" class="btn btn-primary">
        </div>
      </div>
  </form>
  </div>
  <?php  require_once __DIR__ . '/countries_list.php';?></div>
 
</body>
 
</html>