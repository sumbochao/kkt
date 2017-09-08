<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    /*
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
    */
?>

<script type="text/javascript" src="<?php echo Yii::app()->params['static_url_cp']?>js/jquery.tablednd.js"></script>
<script type="text/javascript">
     $(document).ready(function(){
    	$("#table-1").tableDnD({
    		onDrop: function(table,row){
        		console.log(row);
        		var position = "";
                       
        		var rows = table.tBodies[0].rows;
                        
                        
        		for (var i=1; i<rows.length; i++) {
        			position += rows[i].id + ",";
                       
                }
                         
        		ajaxUpdatePosition(position,'0');
        		console.log(position);
    		},
    	});
    });
    function ajaxUpdatePosition(position,parent)
    {

        var strUrl = "<?=$url->createUrl("gsgame/ajaxUpdatePosition")?>";
        $.ajax({
        	url: strUrl,
        	type: 'POST',
        	data:{
            	position: position,
                parent: parent,
            },
            success: function(msg){

            }
        });
    }

    function ajaxDelete(id){
        
        var strUrl = "<?=$url->createUrl("gsgame/ajaxDeleteViewNew") ?>";
        if(confirm('Bạn có chắc chắn muốn xóa không ?')){
            $.ajax({
                type: "POST",
                url: strUrl,
                data: {
                    id:id
                },
                success: function(msg){
                    if(msg == 1){
                        alert('Xóa thành công');
                        location.reload();
                    }else{
                        alert(msg);
                    }
                }   
            });
        }
    }

    

</script>
<div class="main clearfix">
    <div class="table clearfix">
            <table width="100%" cellspacing="0" cellpadding="0" border="0" id="table-1">
                <tbody>
                    <tr class="bg-grey">
                        <td width="5%"><strong>Mã</strong></td>
                        <td width="14%"><strong>Ảnh hiển thị</strong></td>
                        <td width="5%"><strong>Name Game</strong></td>
                        <td width="5%"><strong>Order_view</strong></td>                      
                        <td width="11%"><strong>Hành động</strong><br></td>
                    </tr>
                    <?php foreach($data as $key=>$value){$key+=1;?>
                        <tr id="<?php echo $value['id']//$key ;?>">
                            <?php $name = GGView::getName($value["game_id"])?>
                            <td class="middle"><?php echo $value["id"]?></td>
                            <td><img style="width: 75px; height: 75px;" src="<?php echo Yii::app()->params['urlImages']?>gamestore/game/<?php echo date('Y/md',strtotime($name['create_date']))?>/<?php echo $name['icon']?>" /></td>
                            <td>
                                <b> <?php echo $name['name'] ?></b>
                           
                            </td>

                            <td>
                                <?php $name = GGView::getName($value["game_id"])?> <?php echo $value['order_view'] ?></b>
                            </td>
                           
                            <td>
                                <a href="<?php echo $url->createUrl("gsgame/edit",array("id"=>$value["game_id"]))?>"> Sửa </a> - 
                                <a href="javascript:void(0)" onclick="ajaxDelete('<?php echo $value["id"]?>')">  Xóa  </a>        
                            </td>
                        </tr>     
                        <?php }?>

                </tbody>
            </table>
        </div>

</div>