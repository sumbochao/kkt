<?php
  
?>

<form name="input" action="http://kenhkiemtien.com/kkt_api/GameStoreAPI.php?action=updateUserInfo" method="post">
UserId: <input type="text" name="user_id" value="388"> <br/>
Username: <input type="text" name="username"> <br/>
Email: <input type="text" name="email"> <br/>
Mobile: <input type="text" name="mobile"> <br/>
Birthday: <input type="text" name="birthday"> <br/>
FacebookID: <input type="text" name="facebook_id"> <br/>
Sex: Nam <input type="radio" name="sex" value="1"/> Nu <input type="radio" name="sex" value="0"/><br/>
<input type="submit" value="Submit">
</form>

<br/>
------------------------------------------------------

<form name="input2" action="http://kenhkiemtien.com/kkt_api/GameStoreAPI.php?action=postReviewGame" method="post">
UserId: <input type="text" name="user_id" value="1"> <br/>
GameId: <input type="text" name="game_id" value="1"> <br/>
Mark: <input type="text" name="mark" value="5"> <br/>
Content: <input type="text" name="content" value="Dc hay"> <br/>
Create User: <input type="text" name="create_user" value="thangtt"> <br/>
<input type="submit" value="Submit">
</form>