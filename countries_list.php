<?php
    require_once __DIR__ . '/vendor/autoload.php';
    use CSVLoader\CSVLoader;

    $csvLoader = new CSVLoader();


    $result = $csvLoader->getAllCountries();
    if (! empty($result)) {
        ?>
    <table id='coutries_tbl'>
        <thead>
            <tr>
                <th>Common Name</th>
                <th>Official Name</th>
                <th>Continent Code</th>
                <th>ISO 2 Code</th>
                <th>ISO 3 Code</th>
            </tr>
        </thead>
    <?php
        foreach ($result as $row) {
            ?>
                    <tbody>
            <tr>
                <td><?php  echo $row['common_name']; ?></td>
                <td><?php  echo $row['official_name']; ?></td>
                <td><?php  echo $row['continent_code']; ?></td>
                <td><?php  echo $row['iso2_code']; ?></td>
                <td><?php  echo $row['iso3_code']; ?></td>
            </tr>
                        <?php
        }
        ?>
                    </tbody>
    </table>

<?php } ?>