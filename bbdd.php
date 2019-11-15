
<?php 

try {
    $dsn = "mysql:host=localhost;dbname=raudio";
    $dbh = new PDO($dsn, 'root','');
}catch(PDOException $e){

    echo $e->getMessage();
}

?>