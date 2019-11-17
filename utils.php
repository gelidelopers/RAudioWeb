<?php


function translate($tag, $lang)
{
    $result = $tag;

    try {

        require('bbdd.php');
        $stmt = $dbh->prepare("SELECT value FROM ra_translations WHERE tag = :tag AND lang = :lang");
        $stmt->bindParam(':tag', $tag);
        $stmt->bindParam(':lang', $lang);
        $stmt->execute();
        while ($row = $stmt->fetchColumn(0)) {
            return $row;
        }
    } catch (Exception $e) { }
    return $result;
}

function encryptPasswd($plainPasswd)
{
    return password_hash($plainPasswd, PASSWORD_DEFAULT);;
}

function showDataTable($query, $countQuery, $queryParameters, $columns)
{

    try {
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno - 1) * $no_of_records_per_page;


        require('bbdd.php');
        $stmt = $dbh->prepare($countQuery);
        foreach ($queryParameters as $param) {
            $stmt->bindParam($param['key'], $param['value']);
        }
        $stmt->execute();
        $total_rows = $stmt->fetchColumn(0);
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "$query LIMIT $offset, $no_of_records_per_page";

        $stmt = $dbh->prepare($sql);
        foreach ($queryParameters as $param) {
            $stmt->bindParam($param['key'], $param['value']);
        }
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        echo '<table class="uk-table uk-table-striped">';
        echo '<thead>';
        echo '<tr>';
        foreach ($columns as $col) {
            echo '<th>' . $col . '</th>';
        }
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            foreach ($row as $ceil) {
                echo '<td>' . $ceil . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } catch (Exception $e) { }
}
