
<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
  
?>
<script type="text/javascript">
    function deleteCommentApp(id){
        if(confirm('Bạn có chắc chắn muốn xóa không ?')){
            $.ajax({
                type: "POST",
                url: "<?=$url->createUrl("gsCommentApp/ajaxDeleteCommentApp");?>",
                data:{
                    id: id,
                },
                success: function(msg){
                    if(msg == 1){
                        alert('Xóa thành công!');
                        location.reload();
                    }
                    else{
                        alert('Có lỗi');
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
                <li class="clearfix"><label><strong>Loại Lỗi</strong>:</label>
                    <div class="filltext">
                       <select name="type" id="type">
                            <option value="0" <?php echo $type==0?"selected=\"selected\"":"" ?> >Loại lỗi</option>
                            <option value="1" <?php echo $type==1?"selected=\"selected\"":"" ?> >Lỗi tải game</option>
                            <option value="2" <?php echo $type==2?"selected=\"selected\"":"" ?> >Lỗi giftcode</option>
                            <option value="3" <?php echo $type==3?"selected=\"selected\"":"" ?> >Lỗi chat</option>
                            <option value="4" <?php echo $type==4?"selected=\"selected\"":"" ?> >Lỗi thỏa luận</option>
                            <option value="5" <?php echo $type==5?"selected=\"selected\"":"" ?> >Lỗi giao diện</option>
                            <option value="6" <?php echo $type==6?"selected=\"selected\"":"" ?> >Lỗi đăng nhập</option>
                            <option value="7" <?php echo $type==7?"selected=\"selected\"":"" ?> >Lỗi xung đột</option>
                            <option value="8" <?php echo $type==8?"selected=\"selected\"":"" ?> >Lỗi khác</option>
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
                Tìm thấy <strong class="clred"><?php echo $count; ?></strong> kết quả
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
                        <td><strong>STT</strong></td>
                        <td><strong>Người gửi</strong></td>
                        <td><strong>Email</strong></td>
                        <td><strong>Nội dung</strong></td>
                        <td><strong>Ngày</strong></td>
                        <td><strong>Loại</strong></td>
                        <td><strong>Hành Động</strong></td>
                    </tr>

                    <?php foreach($data as $key=>$value){$key+=1;
                    
                            //1: Lỗi Tải game; 2: Lỗi Giftcode; 3: Lỗi Chat; 4: Lỗi Thảo luận; 5 Lỗi giao diện; 6: Lỗi Đăng nhập; 7 Lỗi xung đột; 8: Lỗi khác
                            $type="";
                            switch($value["type"]){
                                case 1:$type="Lỗi Tải game";
                                break;
                                 case 2:$type="Lỗi Giftcode";
                                break;
                                 case 3:$type="Lỗi Chat";
                                break;
                                 case 4:$type="Lỗi Thảo luận";
                                break;
                                 case 5:$type="Lỗi giao diện";
                                break;
                                 case 6:$type="Lỗi Đăng nhập";
                                break;
                                 case 7:$type="Lỗi xung đột";
                                break;
                                 case 8:$type="Lỗi khác";
                                break;
                            }
                    ?>
                        <tr>
                            <td><?php echo $key;?></td>
                            <td>
                             <?php echo $value['fullname'];?>    
                            </td>
                            <td>
                             <?php echo $value['email'];?>    
                            </td>
                            <td>
                             <?php echo $value['comment'];?>    
                            </td>
                            <td>
                             <?php echo $value['create_date'];?>    
                            </td>
                            <td>
                             <?php echo $type;?>    
                            </td>
                            <td>
                                <a href="javascript:void(0);" onclick="deleteCommentApp(<?php echo $value['id'];?>)">Xóa</a> <br>
                            
                            </td>
                        </tr>
                        <?php }?>

                </tbody>
            </table>
        </div>     
    </div>

</div>