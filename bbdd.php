
<?php 

try {
    $dsn = "mysql:host=localhost;dbname=raudio";
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ATTR_ERRMODE_EXCEPTION);
    $dbh = new PDO($dsn, 'root','');
}catch(PDOException $e){

    echo $e->getMessage();
}

?>