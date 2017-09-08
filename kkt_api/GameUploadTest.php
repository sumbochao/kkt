<html>
<head>
<title>File Upload Form</title>
</head>
<body>
This form allows you to upload a file to the server.<br>
<form action="http://kenhkiemtien.com/kkt_api/GameStoreAPI.php?action=postDiscussion&" method="post" enctype="multipart/form-data" ><br>
Type (or select) Filename: <input type="file" name="upfile"><br/>
<input type="hidden" name="app_client_id" value="123"/>
Game:<input type="text" name="game_id" value="1"/><br/>
UserID:<input type="text" name="user_id" value="1"/><br/>
Content<br/>
<textarea rows="4" cols="50" name="content">
At w3schools.com you will learn how to make a website. We offer free tutorials in all web development technologies. 
</textarea><br/>
<input type="text" name="create_user" value="thangtt"/><br/>
<input type="submit" value="Upload File">
</form>
</body>
</html>