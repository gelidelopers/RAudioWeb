<?php


function translate($tag, $lang)
{
    $result = $tag;

    try {

        require('bbdd.php');
        $stmt = $dbh->prepare("SELECT translated FROM ra_translations WHERE tag = :tag AND lang = :lang");
        $stmt->bindParam(':tag', $tag);
        $stmt->bindParam(':lang', $lang);
        $stmt->execute();
        while ($row = $stmt->fetchColumn(1)) {
            return $row;
        }
    } catch (Exception $e) {

        return $result;
    }
}
