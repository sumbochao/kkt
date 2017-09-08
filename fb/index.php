<?php
    include_once "fbaccess.php";
    $limit = 5000;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Publish to Multiple wall or timeline using Facebook batch request | 25 labs</title>
<style type="text/css">
	html,body { margin:0; padding:0; font-family:tahoma,verdana,arial,sans-serif; text-align:center;}
	#top-bar { position:fixed; top:0; left:0; z-index:999; width:100%; height:65px; }
	#topbar-inner { height:65px; background:#2C2C2C; text-align:center; }
	#topbar-inner a { color:#FFFFFF; font-size:20px; text-decoration:none; vertical-align:bottom; }
	.input { border:1px solid #006; background:#ffc; width:300px; font-size:small; font-family:courier; }
	img {border: none;}
	p { text-align:left; }
</style>
<script language='JavaScript'>
	function checkedAll () {
		var argv = checkedAll.arguments;
		checked = document.getElementById('myform').elements[argv[0]-1].checked;
		for (var i = argv[0]; i < document.getElementById('myform').elements.length && i < argv[1]; i++) {
			document.getElementById('myform').elements[i].checked = checked;
		}
	}
</script>
</head>
<body style="padding-top:70px;" >
<div id="top-bar"> 
	<div id="topbar-inner">
	<center><table style="width:750px;" >
		<tr>
			<td><a href="index.php" ><img src="images/logo.png" /></a></td>
			<td><a href="http://25labs.com/tutorial-post-to-multiple-facebook-wall-or-timeline-in-one-go-using-graph-api-batch-request/" >Click here to read the tutorial on 25labs.com</a></td>
			<td><?php if ($user) echo '<a href="'.$logoutUrl.'">Logout</a>'; else echo '<a href="'.$loginUrl.'">Login</a>'; ?></td></tr>
		</table></center>
	</div>
</div>
<h2>Post to Multiple Walls / Timelines (Pages, Groups or Friends)</h2>
</br>

<?php if(!$user) { ?><div style="padding-top:150px;" ><a href="<?=$loginUrl?>"><img src="images/f-connect.png" alt="Connect to your Facebook Account"/></a><br/>This website will <b>NOT</b> post anything to your wall or like any page automatically.</div><?php } else {?>

<form id="myform" action="" method="post">
<center><table>
	<tr><td>Message</td><td><textarea class="input" name="message" >A Technology Laboratory..</textarea></td>
		<td rowspan="6"><input type="image" name="submit" src="images/submitbutton.jpg" ></td></tr>
	<tr><td>Link</td><td><input class="input" type="text" name="link" value="http://25labs.com" /></td></tr>
	<tr><td>Picture</td><td><input class="input" type="text" name="picture" value="http://25labs.com/25-labs.jpg" /></td></tr>
	<tr><td>Name</td><td><input class="input" type="text" name="name" value="25 labs" /></td></tr>
	<tr><td>Caption</td><td><input class="input" type="text" name="caption" value="25labs.com" /></td></tr>
	<tr><td>Description</td><td><textarea class="input" name="description" rows="6" >25 labs is a Technology blog that covers the tech stuffs happening around the globe. 25 labs publishes various tutorials and articles on web designing, Facebook API, Google API etc.</textarea></td></tr>
</table>

<?php
	if(isset($flag) && $flag==1) { echo "<div style='border:2px solid red;width:600px;background:#f99' >Please select atleast one Page, Group, or Friend</div>"; $flag=0; }
	elseif(isset($flag) && $flag==2) { echo "<div style='border:2px solid red;width:600px;background:#f99' >Please enter a message, Link, or Picture</div>"; $flag=0; }
	elseif(isset($multiPostResponse)) echo "<div style='border:2px solid green;width:600px;background:#cfc' >Successfully posted to the selected walls</div>"; ?>
</br></br>

<table>

<?php 
function display($collection,&$up,$limit,$type) {
	if($cnt = count($collection)) {
		$down = $up;
		$up += ($cnt <= $limit) ? $cnt : $limit;
		?>
		<tr><th colspan="2"><?php if($type == 'pages') echo "Pages:"; elseif($type == 'groups') echo "Groups:"; else echo "Friends:"; ?></th><td><input type='checkbox' name='checkall' onclick='checkedAll(<?php echo $down.','.$up++; ?>);'>Select All</td></tr>
		<tr><td><br/></td></tr>
		<?php $i=1;
		foreach($collection as $page) {
			$name = $page['name'];
			$id = $page['id'];
			if(!($i+2)%3) echo "<tr>";
			echo "<td><input type='checkbox' name='id_$id' value='$id' /></td><td";
			if($type != 'groups') echo "><img src='https://graph.facebook.com/$id/picture' /></td><td ";			
			else echo " colspan='2' ";
			echo "width='200' ><p>$name</p></td>";
			
			if(!($i%3)) echo "</tr>";
			if($i++ == $limit) break;			
		}
	} ?>
	<tr><td><br/><br/></td></tr>
	<?php
}

$up=7;
display($pages['data'],$up,$limit,'pages');
display($groups['data'],$up,$limit,'groups');
display($friends_list['data'],$up,$limit,'friends');
?>

</table></center>
</form>
<br/><br/><br/>
<?php } ?>
</body>
</html>