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
    } catch (Exception $e) {

        
    }
    return $result;
}
