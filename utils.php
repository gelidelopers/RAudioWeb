<?php


function translate($tag)
{
    $result = $tag;

    if(isset($_SESSION['lang'])){
        
    }

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

function showDataTable($query, $countQuery, $queryParameters, $columns, $table)
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

            ?>
            <td>
                <div class="uk-margin-small">
                    <div class="uk-button-group">
                        <a class="uk-button uk-button-secondary uk-button-small" >View</a>
                        <a class="uk-button uk-button-primary uk-button-small">Edit</a>
                        <a class="uk-button uk-button-danger uk-button-small" href="delete.php?<?php echo http_build_query(array('table'=>$table,
              'id'=>$row['id'],
              'name'=>$row['id']))?>">Delete</a>
                    </div>
                </div>
            </td>
            </tr>
<?php
        }
        echo '</tbody>';
        echo '</table>';
    } catch (Exception $e) { }
}
?>