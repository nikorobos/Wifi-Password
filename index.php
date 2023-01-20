<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<title>Προβολή κωδικού Wi-Fi</title>
</head>
<body>

    <div class="container" style="margin-top: 200px;">
        <div class="row">
            <div class="col-md-4 offset-md-4 center-block text-center">
            <?php
                    if(isset($_POST["submit"])){
                        if ($_POST["wifi"] != "") {
                            $name = $_POST["wifi"];
                            exec('netsh wlan show profile '."$name".' key=clear', $output);
                            for ($x = 0; $x < count($output); $x++){
                                if(preg_match("/Key Content/i", $output[$x])){
                                    $pass = str_replace("Key Content", "", $output[$x]);
                                    $pass = str_replace(":", "", $pass);
                                    echo "<h5 style='color:green;text-align:center;'>Κωδικός για $name :".$pass."</h5>";
                                }
                            }
                        }
                    }
                ?>
                <h2>Προβολή κωδικού Wi-Fi</h2>
                <form method="POST" action="" id="forma">
                    <div class="form-group">
                        <label>Εισαγωγή ονόματος Wi-Fi από λίστα</label>
                        <input type="text" name="wifi" class="form-control">
                    </div>
                    <input type="submit" name="submit" class="btn btn-info" value="Επιλογή">
                    <?php
                        echo "<br>";
                        exec("netsh wlan show profiles",$results);
                        for ($i = 0; $i < count($results); $i++){
                            $wifi = $results[$i];
                            $wifi = str_replace("Profiles on interface Wi-Fi:", "", $wifi);
                            $wifi = str_replace("Group policy profiles","",$wifi);
                            $wifi = str_replace(" (read only)", "", $wifi);
                            $wifi = str_replace("---------------------------------", "", $wifi);
                            $wifi = str_replace("    ", "", $wifi);
                            $wifi = str_replace("User profiles", "", $wifi);
                            $wifi = str_replace("-------------", "", $wifi);
                            $wifi = str_replace("All User Profile", "", $wifi);
                            $wifi = str_replace(":", "•", $wifi);
                            echo "<p style='text-align:center'>".$wifi."</p>";
                        }
                    ?>
                </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>


