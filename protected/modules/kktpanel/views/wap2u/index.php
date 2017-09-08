<?php
    $url = new Url();
    $type_cats = LoadConfig::$type_cat; 
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);    
?>
<script type="text/javascript">
    function ajaxQuickUpdate(id){
        var status = 0;
        var isSex = 0;
        if($("#status_"+id).is(":checked")){
            status = 1;
        }
        var strUrl = "<?=$url->createUrl("wap2u/ajaxQuickUpdate") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                status:status,
                id:id
            },
            success: function(msg){
                if(msg == 1){
                    alert('Sửa thành công');
                    location.reload();
                }else{
                    alert(msg);
                }
            }          
        });
    }
    function ajaxDelete(id){
        var strUrl = "<?=$url->createUrl("wap2u/ajaxDelete") ?>";
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
                <li class="clearfix"><label><strong>Từ khóa </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:196px;" value="<?php echo $keyword;?>" name="keyword">
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
                <a href="<?php echo $url->createUrl("wap2u/create")?>"><input type="button" class="btn-bigblue" value=" Thêm mới "></a>
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
                        <td width="2%">
                            <strong>Mã</strong>
                        </td>
                        <td width="5%"><strong>Ảnh</strong></td>
                        <td width="5%"><strong>Tiêu đề</strong></td>
                        <td width="5%"><strong>Loại danh mục</strong></td>
                        <td width="5%"><strong>Version</strong></td>
                        <td width="5%"><strong>Hiển thị</strong></td>
                        <td width="13%"><strong>Tóm tắt</strong></td>
                        <td width="13%"><strong>Link Download</strong></td>
                        <td width="3%"><strong>App Values</strong></td>
                        <td width="6%"><strong>Hành động</strong></td>
                    </tr>
                    <?php foreach($data as $key=>$value){?>
                        <tr>
                            <td class="middle"><?php echo $value["id"]?></td>
                            <td>
                                <?php 
                                    if(!empty($value['picture'])){
                                        echo '<img style="width: 100px; height: 100px;" src="'.Common::getImage($value['picture'],"wap2u",$value['create_date'],0).'"';
                                    }
                                ?>
                            </td>
                            <td><?php echo $value["title"]?></td>
                            <td><?php echo $type_cats[$value["type"]]?></td>
                            <td><?php echo $value["version"]?></td>
                            <td><input type="checkbox" value="1" id="status_<?php echo $value["id"]?>" <?php echo $value["status"]==1 ? 'checked="checked"':'';?>> Hiển thị </td>
                            <td><?php echo $value["description"]?></td>
                            <td style="text-align: left;">
                            Link IOS : <a href="<?php echo $value["link_ios"]?>"><?php echo $value["link_ios"]?> </a></br>
                            Link Android : <a href="<?php echo $value["link_android"]?>"><?php echo $value["link_android"]?> </a> </br>
                            Link Java : <a href="<?php echo $value["link_java"]?>"><?php echo $value["link_java"]?> </a> </br>
                            Link Window : <a href="<?php echo $value["link_window"]?>"><?php echo $value["link_window"]?> </a> </br>
                            </td>
                            <td><?php echo $value["app_value"]?></td> 
                            <td>
                            <a class="s14" href="javascript:void(0)" onclick="ajaxQuickUpdate('<?php echo $value["id"]?>')"> Lưu </a> | 
                                <a href="<?php echo $url->createUrl("wap2u/edit",array("id"=>$value["id"]))?>"> Sửa </a> | 
                                <a href="javascript:void(0)" onclick="ajaxDelete('<?php echo $value["id"]?>');">  Xóa  </a> |
                            </td>
                        </tr>
                        <?php }?>
                </tbody>
            </table>
        </div>
        <div class="fillter clearfix">
            <div class="fr">
                <ul class="paging">
                    <?php
                        echo Paging::show_paging_cp($max_page,$page,$path_paging);
                    ?>
                </ul>
            </div>
        </div>

    </div>
        </div>