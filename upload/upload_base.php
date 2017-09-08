<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $output = array();    
    $error = array();
    $fileInfo = array();
    $forder_upload = isset($_GET["forder_upload"]) ? $_GET["forder_upload"] :"default";
    $file_location = getcwd();       
    $file_location .= "/".$forder_upload."/";
    if(isset($_POST["create_date"]) && intval($_POST["create_date"]) >0){
        $path = date("Y/md", intval($_POST["create_date"]));
    }else{
        $path = date("Y/md", time());  
    }      
    $file_location .= $path . "/";    
    $water_mark = isset($_GET["water_mark"]) ? intval($_GET["water_mark"]):1;
    require_once("lib_upload/lib/UploadFile.php");
    $objectUpload = new UploadFile($file_location);

    /*
    * Kiểm tra file có tồn tại hay ko?
    * Tạo tên file mới 
    */
    if(isset($_FILES["Filedata"])){
        $ufile = $_FILES["Filedata"];   

        if($ufile["size"] > 30240000000000 ) {
            $error = array("code"=>102,"msg"=>"Dung lượng file không được vượt quá 3Megabyte.");
        } else if($ufile['size'] < 10) {
                $error = array("code"=>404,"msg"=>"File không tồn tại!");
            } else {            
                $fileInfo = $objectUpload->getFileInfo($ufile);
        }

    } else if(isset($_GET["urlFile"])) {
            $ufile = $_GET["urlFile"];
            $fileInfo = $objectUpload->getImageInfo($ufile);       
        } else {
            $output["message"] = "file không tồn tại";
            $output["code"] = 404;
    }
    
    /* Upload file */
    if(!empty($_FILES["Filedata"])){
        
        $tmp_name = $_FILES["Filedata"]["tmp_name"];
        $filename = $fileInfo["filename"] . "." . $fileInfo["extension"];
        $file_info = pathinfo($filename);
        $upload_dir = $file_location.$filename;
        @move_uploaded_file($tmp_name, "$upload_dir");        
        $output["filename"] = $filename;
        $output["tmp_name"] = $tmp_name;
        $output["path"] = $path;
        $output["extension"] = $file_info["extension"];       
        $output["filesize"] = $_FILES["Filedata"]["size"];
        $output["message"] = "Tải File thành công";
        $output["code"] = 105;
    }else{
        $output["message"] = "File không tồn tại";
        $output["code"] = 404;
    }

    /* Dữ liệu trả về */    
    if(isset($_GET["jsoncallback"])) {
        echo $_GET["jsoncallback"] . "(" . json_encode($output) . ")"; 
    } else {
        echo json_encode($output);  
    }            
    exit();
?>
