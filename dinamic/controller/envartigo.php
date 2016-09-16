<?php
    include_once "../model/conn.php";
    $conn = new Conn();
    $conn = $conn->getConn();
    if(isset($_POST["title"])){
        $title = $_POST["title"];
        $textArt = $_POST["textArt"];
        $sqlGetTitle = "select idarticle from article where title = '$title'";
        $result = $conn->query($sqlGetTitle);
        if($result->num_rows <= 0 ) {
            $conn->autocommit(false);
            $sql = "insert into article values(null, '$title', '$textArt', DATE_FORMAT(now(),'%d-%m-%Y') )";
            if($conn->query($sql) === true){
                if(isset($_POST["tags"])){
                    $tags = $_POST["tags"];
                    $err = putTags($conn, $title, $tags);
                    if($err == 0) {
                        $conn->commit();
                        echo "Sucesso";
                    } else if($err == 1) {
                        echo "Falha ao cadastrar os dados";
                    } else {
                        echo "Falha ao salvar tag ";
                    }
                } else {
                    $conn->commit();
                    echo "Sucesso[no tags]";
                }
            }else{
                $conn->rollBack();
                echo "Falha ao cadastrar artigo";
            }
        } else {
            echo "Titulo já está em uso!";
        }
    }
    $conn->close();

    function putTags($conn, $title, $tags) {
        foreach($tags as $tag){
            $sqlGetTag = "select idtag from tag where nametag = '$tag'";
            $sqlInsertTag = "insert into tag values(null, '$tag')";
            $result = $conn->query($sqlGetTag);
            if($result->num_rows <= 0 ){
                if($conn->query($sqlInsertTag) == true){
                    $sqlGetTitle = "select idarticle from article where title = '$title' ";
                    $result = $conn->query($sqlGetTitle);
                    $row = $result->fetch_assoc();
                    $idArticle = $row["idarticle"];
                    $result = $conn->query($sqlGetTag);
                    $row = $result->fetch_assoc();
                    $idTag = $row["idtag"];
                    $sql = "insert into articletag values(null, $idArticle, $idTag)";
                    if($conn->query($sql) != true){
                        $conn->rollBack();
                        return 2;
                    }
                }else{
                    $conn->rollBack();
                    return 1;
                }
            }
        }
        return 0;
    }
?>