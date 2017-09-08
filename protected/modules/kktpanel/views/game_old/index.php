<?php
    $url = new Url();
    $type_cats = LoadConfig::$type_cat; 
    $arr_status = LoadConfig::$status;
    $data_partner = APartner::getArrNamePartner();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
?>
<script type="text/javascript">
    function ajaxQuickUpdate(id){
        var status = 0;var isHot = 0;var isHome = 0;var isHotApp =0;
        if($("#status_"+id).is(":checked")){ status = 1; }
        if($("#isHot_"+id).is(":checked")){isHot = 1;}
        if($("#isHome_"+id).is(":checked")){ isHome = 1;}
        if($("#isHotApp_"+id).is(":checked")){ isHotApp = 1;}
        var strUrl = "<?=$url->createUrl("game/ajaxQuickUpdate") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                download : $("#download_"+id).val(),
                hit : $("#hit_"+id).val(),
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
        var strUrl = "<?=$url->createUrl("game/ajaxDelete") ?>";
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
                        <input type="text" style="width:196px;margin-right:28px" value="<?php echo $keyword?>" name="keyword"> &nbsp; Trong
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
                        Nổi bật &nbsp;
                        <select style="width:203px;" name="isHot">
                            <option value="2">- Tất cả -</option> 
                            <option value="1" <?php echo ($isHot == 1 ? 'selected="selected"':'' )?>>Có</option>
                            <option value="0" <?php echo ($isHot == 0 ? 'selected="selected"':'' )?>>Không</option>
                        </select>
                        Show home &nbsp;
                        <select style="width:203px;" name="isHome">
                            <option value="2">- Tất cả -</option> 
                            <option value="1" <?php echo ($isHome == 1 ? 'selected="selected"':'' )?>>Có</option>
                            <option value="0" <?php echo ($isHome == 0 ? 'selected="selected"':'' )?>>Không</option>
                        </select>
                        Hot app &nbsp;
                        <select style="width:203px;" name="isHotApp">
                            <option value="2">- Tất cả -</option> 
                            <option value="1" <?php echo ($isHotApp == 1 ? 'selected="selected"':'' )?>>Có</option>
                            <option value="0" <?php echo ($isHotApp == 0 ? 'selected="selected"':'' )?>>Không</option>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Nhà cung cấp </strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="partnerId">
                            <option value="">--Tất cả--</option>
                            <?php foreach($data_partner as $key=>$value){?>
                                <option value="<?php echo $key;?>" <?php echo ($key == $partnerId ? 'selected="selected"':'' )?>><?php echo $value;?></option>
                                <?php }?>
                        </select>
                        &nbsp;
                        Chiết khấu:
                        <input type="text" style="width:150px;" value="<?php echo $percent_partner >0 ? $percent_partner :''?>" name="percent_partner"> %
                    </div>
                </li>
                <li class="clearfix"><label><strong>Chiết khấu wapmaster </strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:150px;" value="<?php echo $percent_wapmaster >0 ? $percent_wapmaster :''?>" name="percent_wapmaster"> %
                        <select style="width:203px;" name="order_download">
                            <option value="0">- Lượt download -</option> 
                            <option value="1" <?php echo ($order_download == 1 ? 'selected="selected"':'' )?>>Tăng dần</option>
                            <option value="2" <?php echo ($order_download == 2 ? 'selected="selected"':'' )?>>Giảm dần</option>
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
                <a href="<?php echo $url->createUrl("game/create")?>"><input type="button" class="btn-bigblue" value=" Thêm mới "></a>
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
                        <td width="3%"><strong>Mã</strong></td>
                        <td width="10%"><strong>Ảnh</strong></td>
                        <td width="16%"><strong>Thông Tin Game</strong></td>
                        <td width="7%"><strong>Danh mục</strong></td>
                        <td width="5%"><strong>Lượt tải</strong></td>                        
                        <td width="5%"><strong>Lượt Xem</strong></td>                        
                        <td width="5%"><strong>Trạng thái</strong></td>
                        <td width="5%"><strong>Nổi bật</strong></td>
                        <td width="5%"><strong>Show home</strong></td>
                        <td width="5%"><strong>Hot App</strong></td>
                        <td width="8%"><strong>NVKD/Ngày tạo</strong></td>
                        <td width="10%"><strong>Nhà cung cấp/ chiết khấu</strong></td>
                        <td width="5%"><strong>% Cho Wap</strong></td>
                        <td width="16%"><strong>Hành động</strong></td>
                    </tr>
                    <?php foreach($data as $key=>$value){?>
                        <tr>
                            <td><?php echo $value["id"]?></td>
                            <td><img style="width: 100px; height: 100px;" src="<?php echo Common::getImage($value["picture"],"game",$value["create_date"])?>" /></td>
                            <td>
                                <p>Tên:<strong><?php echo $value["title"]?></strong></p>
                                <p>Loại Game:<strong><?php echo $value["isOnline"]==1 ? "Game online": "Game offline"?></strong></p>
                                <p>Game SMS:<strong><?php echo $value["isSms"]==1 ? "Có": "Không"?></strong></p>
                                <p>Số file:<a href="<?php echo $url->createUrl("game/gameFile",array("gameId"=>$value["id"]))?>"> (<?php echo $value["count_file"]?>) file</a></p>
                            </td>
                            <td><?php echo $data_cat[$value["categoryId"]] ?></td>
                            <td><input type="text" id="download_<?php echo $value["id"]?>" value="<?php echo $value["download"]?>" style="width: 50px;"/></td>
                            <td><input type="text" id="hit_<?php echo $value["id"]?>" value="<?php echo $value["hit"]?>" style="width: 50px;"/></td>

                            <td><input type="checkbox" value="1" id="status_<?php echo $value["id"]?>" <?php echo $value["status"]==1 ? 'checked="checked"':'';?>> Hiển thị</td>
                            <td><input type="checkbox" value="1" id="isHot_<?php echo $value["id"]?>" <?php echo $value["isHot"]==1 ? 'checked="checked"':'';?>> Có</td>
                            <td><input type="checkbox" value="1" id="isHome_<?php echo $value["id"]?>" <?php echo $value["isHome"]==1 ? 'checked="checked"':'';?>> Có</td>
                            <td><input type="checkbox" value="1" id="isHotApp_<?php echo $value["id"]?>" <?php echo $value["isHotApp"]==1 ? 'checked="checked"':'';?>> Có</td>
                            <td>
                                <p><?php echo date("d-m-Y",$value["create_date"])?></p>
                            </td>
                            <td>
                                <p><strong><?php echo isset($data_partner[$value["partnerId"]]) ? $data_partner[$value["partnerId"]]:''?></strong></p> 
                                <p><strong><?php echo $value["percent_partner"];?> %</strong></p>
                            </td>
                            <td><strong><?php echo $value["percent_wapmaster"];?> %</strong></td>
                            <td>
                                <a href="javascript:void(0)" onclick="ajaxQuickUpdate('<?php echo $value["id"]?>')" class="s14"> Lưu </a> | 
                                <a href="<?php echo $url->createUrl("game/edit",array("id"=>$value["id"]))?>"> Sửa </a> | 
                                <a href="javascript:void(0)" onclick="ajaxDelete('<?php echo $value["id"]?>')">  Xóa  </a>  |
                                <a href="<?php echo $url->createUrl("seo/detail",array("id"=>$value["id"],"type"=>1))?>"> SEO </a>
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