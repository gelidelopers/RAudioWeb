<?php


function translate($tag, $params)
{
    if (substr($tag, 0, 2) == "@@") {

        if (isset($_SESSION['lang'])) {
            $lang = $_SESSION['lang'];
        } else {
            $lang = 'ca-ES';
        }

        try {

            require('bbdd.php');
            $stmt = $dbh->prepare("SELECT tr.value FROM ra_translations tr 
        INNER JOIN ra_tag tag on (tag.id = tr.id_tag) 
        INNER JOIN ra_lang lan on (lan.id = tr.id_lang) 
        WHERE tag.code = :tag and lan.code = :lang ");
            $stmt->bindParam(':tag', $tag);
            $stmt->bindParam(':lang', $lang);
            $stmt->execute();
            $row = $stmt->fetchColumn(0);
            if (is_array($params)) {
                return strtr($row, $params);
            } else {
                return $row;
            }
        } catch (Exception $e) {
            return $tag;
        }
    } else {
        return $tag;
    }
}

function encryptPasswd($plainPasswd)
{
    return password_hash($plainPasswd, PASSWORD_DEFAULT);;
}
function loggedUserMayDoThis($entity,$action)
{
if(isset($_SESSION['iduser'])){
if($_SESSION['iduser'] == 1){
    return true;
}else{
    require('bbdd.php');
    $countQuery = "SELECT COUNT(*) 
    FROM ra_user_role ru 
    INNER JOIN ra_roles r on (ru.id_role = r.id) 
    WHERE ru.id_user = :user 
    AND a.name";
    $stmt = $dbh->prepare($countQuery);
    foreach ($queryParameters as $param) {
        $stmt->bindParam($param['key'], $param['value']);
    }
    $stmt->execute();
    $total_rows = $stmt->fetchColumn(0);
    
}
}else{
    return false;
}
}

function showDataTable($query, $countQuery, $queryParameters, $columns, $table, $returnPage)
{

    try {
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 7;
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

        //table header
        echo '<table class="uk-table uk-table-striped">';
        echo '<thead>';
        echo '<tr>';
        foreach ($columns as $col) {
            echo '<th>' . $col . '</th>';
        }
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        //table rows
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            foreach ($row as $key => $ceil) {
                if ($key == 'audio') {
                    echo '<td><audio src="' . $ceil . '"></audio></td>';
                }else if($key == 'id'){
                   echo '<td><input class="uk-checkbox" name="ids[]" value="'.$ceil.'" type="checkbox"></td>';
                    
                } else {
                    echo '<td>' . $ceil . '</td>';
                }
            }

            //row buttons
            ?>

            <td>
                <div class="uk-margin-small">
                    <div class="uk-button-group">
                        <a class="uk-button uk-button-secondary uk-button-small">View</a>
                        <a class="uk-button uk-button-primary uk-button-small">Edit</a>
                        <a class="uk-button uk-button-danger uk-button-small uk-link" href="delete.php?<?php echo http_build_query(array(
                                                                                                                        'table' => $table,
                                                                                                                        'id' => $row['id'],
                                                                                                                        'name' => $row['id'],
                                                                                                                        'return' => $returnPage
                                                                                                                    )) ?>">Delete</a>
                    </div>
                </div>
            </td>
            </tr>
<?php
        }
        echo '</tbody>';
        echo '</table>';

        $num2 = $offset + $no_of_records_per_page;

        echo '<p>' . $offset . '-' . $num2 . '</p>';

        //pagination numbers
        if ($total_pages > 1) {
            echo '<ul class="uk-pagination" uk-margin>';


            $prevpage = $pageno - 1;
            $nextpage = $pageno + 1;
            if ($prevpage > 0) {

                echo '<li><a href="?pageno=' . $prevpage . '"><span uk-pagination-previous></span></a></li>';
            }
            if ($pageno != 1) {
                echo '<li><a href="?pageno=1">1</span></a></li>';
                echo '<li class="uk-disabled"><span>...</span></li>';
            }
            echo '<li class="uk-active"><a href="?pageno=' . $pageno . '">' . $pageno . '</span></a></li>';
            if ($pageno != $total_pages) {
                echo '<li class="uk-disabled"><span>...</span></li>';
                echo '<li><a href="?pageno=' . $total_pages . '">' . $total_pages . '</span></a></li>';
            }

            //actualpage




            if ($nextpage <= $total_pages) {
                echo '<li><a href="?pageno=' . $nextpage . '"><span uk-pagination-next></span></a></li>';
            }
        }
    } catch (Exception $e) { }
}
?>