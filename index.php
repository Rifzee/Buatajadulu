<?php
if (isset($_POST["convert"])) {
    if ($_FILES['csv_file_input']['name']) {
        if ($_FILES['csv_file_input']["type"] == 'text/csv') {
            $jsonOutput = array();
            $csvFileContent= file_get_contents("datapribadi.csv");
            $csvLineArray = explode("\n", $csvFileContent);
            $result = array_map("str_getcsv", $csvLineArray);
            $jsonObject = json_encode($result);
            print_r($jsonObject);
            exit();
        } else {
            $error = 'Invalid CSV uploaded';
        }
    } else {
        $error = 'Invalid CSV uploaded';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Convert CSV to JSON</title>
    <style>
        body {
            font-family: arial;
        }

        input[type="file"] {
            padding: 5px 10px;
            margin: 30px 0px;
            border: #666 1px solid;
            border-radius: 3px;
        }

        input[type="submit"] {
            padding: 8px 20px;
            border: #232323 1px solid;
            border-radius: 3px;
            background: #232323;
            color: #FFF;
        }

        .validation-message {
            color: #e20900;
        }
    </style>
</head>
<body>
    <form name="frmUpload" method="post" enctype="multipart/form-data">
        <input type="file" name="csv_file_input" accept=".csv" /> 
        <input type="submit" name="convert" value="Convert">
        <?php
        if (!empty($error)) 
        { 
        ?>
            <span class="validation-message"><?php echo $error; ?></span>
        <?php 
        } 
        ?>
    </form>
</body>
</html>
