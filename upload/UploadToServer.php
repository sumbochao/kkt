<?php

    $file_path = "avatarxs/".date('Y',time())."/".date('md',time())."/";
    if (!file_exists($file_path)) {
        mkdir($file_path, 0777, true);
    }
    error_log("Upload File >>" . $file_path . $_FILES['error'] . " \r\n", 3,
        "Log.log");

    error_log("Upload File >>" . basename($_FILES['uploaded_file']['name']) . " \r\n",
        3, "Log.log");

    $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
        echo "success";
    } else{
        echo "fail";
    }
?>