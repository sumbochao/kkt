<?php
$url = new Url();

?>

<form id="form1" name="form1" method="post"
	action="<?php echo $url->createUrl("facebookApp/add")?>">

	<input type="submit" style="height: 20px; width: 100px" name="1" id="1"
		value="Thêm dữ liệu" />
</form>

<?php
$url = new Url();
$current_url = Common::getCurrentUrl();
$path_paging = strpos($current_url, '?') !== false ? $current_url . '&' : $current_url . '?';
$path_paging = str_replace("?page=" . $page . "&", "?", $path_paging);
$path_paging = str_replace("&page=" . $page . "&", "&", $path_paging);
?>
<script type="text/javascript">
    function ajaxDeleteAccount(app_id)
    {
        var strUrl = "<?=$url->createUrl("facebookApp/ajaxDeleteAccount") ?>";
       
        if(confirm('Bạn có chắc chắn muốn xóa không ?')){
            $.ajax({
                type: "POST",
                url: strUrl,
                data: {
                	app_id:app_id
                },
                success: function(msg){
                    if(msg == 1){
                        alert('Xóa thành công');
                        location.reload();
                    }else{s
                        alert(msg);
                    }
                }   
            });
        }
    }
</script>
<div class="main clearfix">
	<div class="box clearfix bottom30">

		<form method="GET">
			<ul class="form4">
				<li class="clearfix"><label><strong>Từ khóa </strong>:</label>
					<div class="filltext"></div></li>
                  
					<div class="filltext">
					  <input type="text" style="width: 195px; margin-right: 15px"
					value="<?php echo $keyword?>" name="keyword">
				<li class="clearfix"><label>&nbsp;</label>
						<input type="submit" value=" Tìm kiếm" class="btn-bigblue">
					</div></li>

			</ul>
		</form>


	</div>

	<div class="box">
		<div class="fillter clearfix">
			<div class="fl">
				Tìm thấy <strong class="clred"><?php echo $count; ?></strong> kết
				quả
			</div>
			<div class="themmoi">
				 <a href="<?php echo $url->createUrl("facebookApp/add")?>"><input type="button" class="btn-bigblue" value=" Thêm mới "></a>
			</div>
			<div class="fr">
				<ul class="paging">
                    <?php
                    echo Paging::show_paging_cp($max_page, $page, $path_paging);
                    // var_dump(1);die;
                    ?>
                </ul>
			</div>
		</div>

		<div class="table clearfix">
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
				<tbody>

					<tr class="bg-grey">
						<td><strong>ID</strong></td>
						<td><strong>App Id</strong></td>
						<td><strong>App Secret</strong></td>
						<td><strong>Title</strong></td>
						<td><strong>Status</strong></td>
						<td><strong>Hành động</strong></td>
					</tr>

                    <?php foreach($data as $key=>$value){$key+=1;?>
                        <tr>
						<td class="middle"><?php echo $key?></td>
						<td><?php echo $value["fb_app_id"]?></td>
						<td><?php echo $value["app_secret"]?></td>
						<td><?php echo $value["title"]?></td>
						<td><?php echo $value["status"]==0?"Inactive":"Active"?></td>
						<td><a
							href="<?php echo $url->createUrl("facebookApp/edit",array("id"=>$value["id"]))?>">
								Edit </a>- <a href="javascript:void(0)"
							onclick="ajaxDeleteAccount('<?php echo $value["fb_app_id"]?>')"> Xóa
								 </a></td>
					</tr>
                    <?php }?>

                </tbody>
			</table>
		</div>

	</div>
</div>

