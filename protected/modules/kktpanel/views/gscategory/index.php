<?php
    
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
  
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging); 
?>
 
<script type="text/javascript">
    function ajaxQuickUpdate(id){
        var strUrl = "<?=$url->createUrl("gscategory/ajaxQuickUpdate") ?>";
        var order_view = $("#order_view_"+id).val();
    
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                id:id,
                order_view_new:order_view
            },
            success: function(msg){
                if(msg == 1){
                    alert('Sửa thành công');
                    location.reload();
                }else{
                    alert("thatbai");
                }
            }          
        });
    }
    
    
    function ajaxDelete(id){
        var strUrl = "<?=$url->createUrl("gscategory/ajaxDelete") ?>";
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
   
    <div class="box clearfix bottom30">
        <form name="SearchForm" method="GET">
            <ul class="form4">
                <li class="clearfix"><label><strong>Tên danh mục </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:196px;" value="<?php //echo $keyword;?>" name="keyword">
                    </div>
                </li>
                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext">
                        <input type="submit" value=" Tìm kiếm" class="btn-bigblue"> 
                    </div>
                </li>
            </ul>
        </form>
    </div>

    <div class="box">

        <div class="fillter clearfix">
            <div class="fl">
                <!--<strong>Tác vụ : </strong><select style="width:203px;"><option></option></select> 
                <input type="submit" class="btn-bigblue" value=" Thực hiện ">-->
                <a href="<?php echo $url->createUrl("gscategory/create")?>"><input type="button" class="btn-bigblue" value=" Thêm mới "></a>
            </div>
            <div class="fr">
                <ul class="paging">
                    <?php
                        echo Paging::show_paging_cp($max_page,$page,$path_paging);
                    ?>
                </ul>
            </div>
            
        </div>

        <div class="table clearfix">
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>

                    <tr class="bg-grey">
                         
                        <td width="6%">
                            <strong>Mã</strong>
                        </td>
                        <td width="5%"><strong>Sắp xếp</strong></td>
                        <td width="5%"><strong>Ảnh</strong></td>
                        <td width="20%"><strong>Tiêu đề</strong></td>
                        <td width="10%"><strong>Số game</strong></td>
                        <td width="8%"><strong>Người tạo</strong></td>
                        <td width="8%"><strong>Ngày tạo</strong></td>
                        <td width="16%"><strong>Hành động</strong><br></td>
                    </tr>

                    <?php foreach($data as $key=>$value){?>
                        <tr>
                            
                            <td class="middle"><?php echo $value["id"]?></td>
                            <td><input type="text" value="<?php echo $value["order_view"]?> "  id="order_view_<?php echo $value["id"]?>" size="2"</td>
                            <td>
                                <img src="<?php echo Yii::app()->params['urlImages'];?>/gamestore/category/<?php echo date('Y/md',strtotime($value['create_date']))?>/<?php echo $value['image'];?>" style="width: 100px;">
                            </td>
                            <td><?php echo $value["name"]?></td>
                            <td><?php echo $value["count_game"]?></td>
                            <td><?php echo $value["create_user"]?></td>
                            <td><?php echo $value["create_date"]?></td>
                            <td>
                                <a href="javascript:void(0)" onclick="ajaxQuickUpdate(<?php echo $value["id"]?>)">Lưu </a> |
                                <a href="<?php echo $url->createUrl("gscategory/edit",array("id"=>$value["id"]))?>"> Sửa </a> | 
                                <a href="javascript:void(0)" onclick="ajaxDelete('<?php echo $value["id"]?>');">  Xóa  </a> 
                            </td>
                        </tr>
                        <?php }?>

                </tbody>
            </table>
        </div>

    </div>
</div>
