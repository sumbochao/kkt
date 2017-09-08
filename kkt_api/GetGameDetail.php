<?php
    require_once("config.php");
    require_once("functions.php");
    $output = array();
    if(isset($_GET["gameId"]) && isset($_GET["refCode"])){
        $gameId = intval($_GET["gameId"]);
        $refCode = mysql_escape_string($_GET["refCode"]);
        $data_game = getGameById($gameId);
        if($data_game){
            $data_user = getUser($refCode);    
            if($data_user){
                $output["gameID"] = $data_game["id"];
                $output["title"] = $data_game["title"];

                $data_file = getFileGameByGameId($gameId);
                foreach($data_file as $key=>$value){
                    $output[$value["extension"]] = getApp($data_user["username"],$value["filename"]);
                }
            }
        }
    }
    echo json_encode($output);
?>
