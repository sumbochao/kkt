<html>
<head>
<title>File Upload Form</title>
</head>
<body>
This form allows you to upload a file to the server.<br>
<form action="http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=uploadAvatar&" method="post" enctype="multipart/form-data" ><br>
Type (or select) Filename: <input type="file" name="upfile">
<input type="submit" value="Upload File">
<input type="hidden" name="app_client_id" value="123"/>
</form>
</body>
</html>