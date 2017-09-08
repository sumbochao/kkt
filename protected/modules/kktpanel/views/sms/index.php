<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
    //var_dump($max_page);
    //var_dump($path_paging); 
    //var_dump($page);
?>
<script type="text/javascript">
    function ajaxDelete(id){
        var strUrl = "<?=$url->createUrl("Sms/ajaxDelete") ?>";
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

    function ajaxQuick(id){

        var status = 0;
        if($("#status_"+id).is(":checked")){ status = 1; }
        var hot = 0;
        if($("#hot_"+id).is(":checked")){ hot = 1; }
        var strUrl = "<?=$url->createUrl("sms/ajaxQuick") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                status:status,
                hot: hot,
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

</script>

<div id="container">
    <div class="main clearfix">

        <!--Tìm kiếm-->
        <div class="box clearfix bottom30">
            <form method="GET">
                <ul class="form4">

                    <li class="clearfix">
                        <label>
                            <strong>Category </strong>
                            :
                        </label>
                        <div class="filltext">
                            <select id="category" name="category">
                                <option value="0">--Tất cả--</option>
                                <?php foreach($data_cat as $key=>$value){?>
                                    <option value="<?php echo $key;?>" <?php echo ($category == $key ? 'selected="selected"':'' )?>><?php echo $value;?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </li>

                    <li class="clearfix">
                        <label style="width: 10%;"></label>
                        <div class="filltext">
                            <input class="btn-bigblue" type="submit" value=" Tìm kiếm">
                        </div>
                    </li>
                </ul>
            </form>
        </div>



        <!--Bảng dữ liệu-->
        <div class="box">

            <div class="fillter clearfix">
                <div class="fl">
                    Tìm thấy
                    <strong class="clred"><?php echo $count; ?></strong>
                    kết quả -
                    <a href="<?php echo $url->createUrl('sms/create');?>">
                        <input class="btn-bigblue" type="button" value=" Thêm mới ">
                    </a>
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
                            <td width="5%">
                                <strong>Mã</strong>
                            </td>
                            <td width="20%">
                                <strong>Nội dung tin nhắn</strong>
                            </td>
                            <td width="20%">
                                <strong>Ảnh minh họa</strong>
                            </td>
                            <td width="5%">
                                <strong>Lượt tải</strong>
                            </td>
                            <td width="5%">
                                <strong>Trạng thái</strong>
                            </td>
                            <td width="5%">
                                <strong>Hot</strong>
                            </td>
                            <td width="5%">
                                <strong>Người tạo</strong>
                            </td>
                            <td width="5%">
                                <strong>Ngày tạo</strong>
                            </td>
                            <td width="5%">
                                <strong>Hành động</strong>
                            </td>
                        </tr>

                        <!--Xuất dữ liệu-->

                        <?php for($i=0;$i<count($row);$i++){?>
                            <tr>
                                <td>
                                    <?php echo $row[$i]['id'];?>
                                </td>
                                <td width="20%">
                                    <textarea style="width: 200px;height: 300px;"><?php echo $row[$i]['description']?></textarea>
                                </td>
                                <td width="20%">
                                    <img src="http://kenhkiemtien.com/<?php echo $row[$i]['image'];?>" width="100%" />
                                </td>
                                <td width="5%">
                                    <?php echo $row[$i]['count_sms']?>
                                </td>
                                <td><input type="checkbox" value="1" id="status_<?php echo $row[$i]['id']?>" <?php echo $row[$i]["status"]==1 ? 'checked="checked"':'';?>> Hiển thị</td>
                                <td><input type="checkbox" value="1" id="hot_<?php echo $row[$i]['id']?>" <?php echo $row[$i]["isHot"]==1 ? 'checked="checked"':'';?>> Hot</td>
                                <td width="5%">
                                    <?php echo $row[$i]['create_user']?>
                                </td>
                                <td width="5%">
                                    <?php echo date('d-m-Y H:i:s',$row[$i]["create_date"])?>
                                </td>
                                <td>
                                    <a class="" onclick="ajaxQuick(<?php echo $row[$i]['id'];?>);" href="javascript:void(0)"> Lưu </a>
                                    |
                                    <a href="<?php echo $url->createUrl('sms/update',array('id'=>$row[$i]['id']))?>"> Sửa </a>
                                    |
                                    <a onclick="ajaxDelete(<?php echo $row[$i]['id'];?>);" href="javascript:void(0)"> Xóa </a>
                                    |
                                </td>
                            </tr>

                            <?php }?> 

                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>