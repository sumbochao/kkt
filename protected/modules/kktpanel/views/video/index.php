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
        var status = 0;var isHot = 0;var isHome = 0;var isHotApp = 0;
        if($("#status_"+id).is(":checked")){ status = 1; }
        if($("#isHot_"+id).is(":checked")){isHot = 1;}
        if($("#isHome_"+id).is(":checked")){ isHome = 1;}
        if($("#isHotApp_"+id).is(":checked")){ isHotApp = 1;}
        var strUrl = "<?=$url->createUrl("video/ajaxQuickUpdate") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                status:status,
                isHot:isHot,
                isHome:isHome,
                isHotApp:isHotApp,
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
        var strUrl = "<?=$url->createUrl("video/ajaxDelete") ?>";
        if(confirm('Xóa game này thì tất cả các dữ liệu liên quan sẽ mất hết! Bạn có muốn tiếp tục không ?')){
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
        <form method="GET">
            <ul class="form4">
                <li class="clearfix"><label><strong>Từ ngày </strong>:</label>
                    <div class="filltext">
                        <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'from_date',
                            'id' => 'from_date',
                            'value' => $from_date,
                            // additional javascript options for the date picker plugin
                            'options' => array(
                            'showAnim' => 'fold',
                            'dateFormat' => 'dd-mm-yy',
                            'changeYear' => 'true',
                            'changeMonth' => 'true',
                            'showOn' => 'both',
                            'buttonText' => '...'
                            ),
                            'htmlOptions' => array(
                            'style' => 'width:170px',
                            'class' => 'form',
                            ),
                            ));
                        ?> 
                        &nbsp;đến ngày &nbsp; 
                        <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'to_date',
                            'id' => 'to_date',
                            'value' => $to_date,
                            // additional javascript options for the date picker plugin
                            'options' => array(
                            'showAnim' => 'fold',
                            'dateFormat' => 'dd-mm-yy',
                            'changeYear' => 'true',
                            'changeMonth' => 'true',
                            'showOn' => 'both',
                            'buttonText' => '...'
                            ),
                            'htmlOptions' => array(
                            'style' => 'width:170px',
                            'class' => 'form',
                            ),
                            ));
                        ?> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Từ khóa </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:196px" value="<?php echo $keyword?>" name="keyword"> &nbsp; Trong &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
                        <select style="width:203px;" name="type">
                            <option value="1" <?php echo ($type == 1 ? 'selected="selected"':'' )?>>ID</option>
                            <option value="2" <?php echo ($type == 2 ? 'selected="selected"':'' )?>>Tên</option>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Category </strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="categoryId">
                            <option value="0">--Tất cả--</option>
                            <?php foreach($data_cat as $key=>$value){?>
                                <option value="<?php echo $key;?>" <?php echo ($categoryId == $key ? 'selected="selected"':'' )?>><?php echo $value;?></option>
                                <?php }?>
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
                        &nbsp; Nổi bật &nbsp;&nbsp;&nbsp;&nbsp; 
                        <select style="width:203px;" name="isHot">
                            <option value="2">- Tất cả -</option> 
                            <option value="1" <?php echo ($isHot == 1 ? 'selected="selected"':'' )?>>Có</option>
                            <option value="0" <?php echo ($isHot == 0 ? 'selected="selected"':'' )?>>Không</option>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Tìm kiếm theo</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="orderBy">
                            <option value="0" <?php echo ($orderBy == 0 ? 'selected="selected"':'' )?>>Thời gian</option>
                            <option value="1" <?php echo ($orderBy == 1 ? 'selected="selected"':'' )?>>Số lượt view</option>
                        </select>
                       &nbsp; Sắp xếp &nbsp;&nbsp;&nbsp;
                        <select style="width:203px;" name="compare">
                            
                            <option value="1" <?php echo ($compare == 1 ? 'selected="selected"':'' )?>>Giảm dần</option>
                            <option value="0" <?php echo ($compare == 0 ? 'selected="selected"':'' )?>>Tăng dần</option>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Lọc theo số view </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:196px;" value="<?php if($view!=0){echo $view ;} ?>" name="view"> 
                        &nbsp; Điều kiện &nbsp;
                        <select style="width:203px;" name="condition">
                            <option value="2">-Tất cả-</option>
                            <option value="1" <?php echo ($condition == 1 ? 'selected="selected"':'' )?>>Lớn hơn hoặc bằng</option>
                            <option value="0" <?php echo ($condition == 0 ? 'selected="selected"':'' )?>>Nhỏ hơn hoặc bằng</option>
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
                Tìm thấy <strong class="clred"><?php echo $count; ?></strong> kết quả - 
                <a href="<?php echo $url->createUrl("video/create")?>"><input type="button" class="btn-bigblue" value=" Thêm mới "></a>
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
                        <td width="5%"><strong>Mã</strong></td>
                        <td width="14%"><strong>Ảnh hiển thị</strong></td>
                        <td width="10%"><strong>Danh mục</strong></td>
                        <td width="11%"><strong>Tiêu đề</strong></td>
                        <td width="5%"><strong>Lượt xem</strong></td>
                        <td width="5%"><strong>Download</strong></td>
                        <td width="8%"><strong>Trạng thái</strong></td>
                        <td width="5%"><strong>Nổi bật</strong></td>
                        <td width="5%"><strong>Show Home</strong></td>
                        <td width="5%"><strong>Hot App</strong></td>
                        <td width="8%"><strong>Người tạo</strong></td>
                        <td width="8%"><strong>Ngày tạo</strong></td>                        
                        <td width="11%"><strong>Hành động</strong><br></td>
                    </tr>
                    <?php foreach($data as $key=>$value){ $key +=1;?>
                        <tr>
                            <td class="middle"><?php echo $key."</br>_</br>".$value["id"]?></td>
                            <td><img style="width: 100px; height: 100px;" src="<?php echo Common::getImage($value["picture"],"video",$value["create_date"])?>" /></td>
                            <td><?php echo $data_cat[$value["categoryId"]] ?></td>
                            <td><?php echo $value["title"]?></td>
                            <td><?php echo $value["hit"]?></td> 
                            <td><?php echo $value["download"]?></td> 
                            <td><input type="checkbox" value="1" id="status_<?php echo $value["id"]?>" <?php echo $value["status"]==1 ? 'checked="checked"':'';?>> Hiển thị</td>
                            <td><input type="checkbox" value="1" id="isHot_<?php echo $value["id"]?>" <?php echo $value["isHot"]==1 ? 'checked="checked"':'';?>> Có</td>
                            <td><input type="checkbox" value="1" id="isHome_<?php echo $value["id"]?>" <?php echo $value["isHome"]==1 ? 'checked="checked"':'';?>> Có</td>
                            <td><input type="checkbox" value="1" id="isHotApp_<?php echo $value["id"]?>" <?php echo $value["isHotApp"]==1 ? 'checked="checked"':'';?>> Có</td>                           
                            <td><?php echo $value["create_user"]?></td>
                            <td><?php echo date('d-m-Y H:i:s',$value["create_date"])?></td>
                            <td>
                                <a class="s14" href="javascript:void(0)" onclick="ajaxQuickUpdate('<?php echo $value["id"]?>')"> Lưu </a> | 
                                <a href="<?php echo $url->createUrl("video/edit",array("id"=>$value["id"]))?>"> Sửa </a> | 
                                <a href="javascript:void(0)" onclick="ajaxDelete('<?php echo $value["id"]?>')">  Xóa  </a> |
                                <a href="<?php echo $url->createUrl("seo/detail",array("id"=>$value["id"],"type"=>2))?>"> SEO </a>
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