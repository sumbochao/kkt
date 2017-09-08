<?php
    $url = new Url();
    $type_cats = LoadConfig::$type_cat; 
    $arr_status = LoadConfig::$status;
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
        if($("#isSex_"+id).is(":checked")){
            isSex = 1;
        }
        var strUrl = "<?=$url->createUrl("category/ajaxQuickUpdate") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                status:status,
                isSex:isSex,
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
        var strUrl = "<?=$url->createUrl("category/ajaxDelete") ?>";
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
                <li class="clearfix"><label><strong>Loại Danh mục </strong>:</label>
                    <div class="filltext">       
                        <select style="width:203px;" name="type_cat">
                            <option value="0">- Tất cả -</option>
                            <?php foreach($type_cats as $key=>$value){?>
                                <option value="<?php echo $key;?>" <?php echo ($type_cat == $key ? 'selected="selected"':'' )?>><?php echo $value?></option>
                                <?php }?>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Từ khóa </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:196px;" value="<?php echo $keyword;?>" name="keyword">
                        <select style="width:203px;" name="type">
                            <option value="1" <?php echo ($type == 1 ? 'selected="selected"':'' )?>>ID</option>
                            <option value="2" <?php echo ($type == 2 ? 'selected="selected"':'' )?>>Tên</option>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Trạng thái</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="status">
                            <option value="2" >- Tất cả -</option> 
                            <?php foreach($arr_status as $key=>$value){?>
                                <option value="<?php echo $key;?>" <?php echo ($status == $key ? 'selected="selected"':'' )?>><?php echo $value?></option>
                                <?php }?>
                        </select>
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
                <a href="<?php echo $url->createUrl("category/create")?>"><input type="button" class="btn-bigblue" value=" Thêm mới "></a>
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
                        <td width="5%"><strong>Ảnh</strong></td>
                        <td width="20%"><strong>Tiêu đề</strong></td>
                        <td width="14%"><strong>Loại danh mục</strong></td>
                        <td width="13%"><strong>Trạng thái</strong></td>
                        <td width="13%"><strong>Thuộc kênh 18</strong></td>
                        <td width="8%"><strong>Người tạo</strong></td>
                        <td width="8%"><strong>Ngày tạo</strong></td>
                        <td width="16%"><strong>Hành động</strong><br></td>
                    </tr>
                    <?php foreach($data as $key=>$value){?>
                        <tr>
                            <td class="middle"><?php echo $value["id"]?></td>
                            <td>
                                <?php 
                                if(!empty($value['picture'])){
                                    echo '<img style="width: 100px; height: 100px;" src="'.Common::getImage($value['picture'],"category",$value['create_date'],0).'"'."/>";;
                                }
                                if(!empty($value['picture_240_320'])){
                                     echo '<img style="width: 100px; height: 100px;" src="'.Common::getImage($value['picture_240_320'],"category",$value['create_date'],0)."\"/>";;
                                }
                                if(!empty($value['picture_320_240'])){
                                    echo '<img style="width: 100px; height: 100px;" src="'.Common::getImage($value['picture_320_240'],"category",$value['create_date'],0)."\"/>";
                                }

                                ?>
                            </td>
                            <td><?php echo $value["name"]?></td>
                            <td><?php echo $type_cats[$value["type"]]?></td>
                            <td><input type="checkbox" value="1" id="status_<?php echo $value["id"]?>" <?php echo $value["status"]==1 ? 'checked="checked"':'';?>> Hiển thị </td>
                            <td><input type="checkbox" value="1" id="isSex_<?php echo $value["id"]?>" <?php echo $value["isSex"]==1 ? 'checked="checked"':'';?>> Có </td>
                            <td><?php echo $value["create_user"]?></td> 
                            <td><?php echo date("d-m-Y H:i:s",$value["create_date"])?></td> 
                            <td>
                                <a class="s14" href="javascript:void(0)" onclick="ajaxQuickUpdate('<?php echo $value["id"]?>')"> Lưu </a> | 
                                <a href="<?php echo $url->createUrl("category/edit",array("id"=>$value["id"]))?>"> Sửa </a> | 
                                <a href="javascript:void(0)" onclick="ajaxDelete('<?php echo $value["id"]?>');">  Xóa  </a> |
                                <a href="<?php echo $url->createUrl("seo/category",array("catId"=>$value["id"]))?>"> SEO </a> 
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