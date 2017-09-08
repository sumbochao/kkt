<?php
    $url = new Url();
    /*$current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);*/
?>

<div class="main clearfix">

<div class="box">
    <div class="fillter clearfix">
        <div class="fl">
            Tìm thấy <strong class="clred"><?php //echo $count; ?></strong> kết quả - 
        </div>
        <div class="fr">
            <ul class="paging">
                <?php
                    //echo Paging::show_paging_cp($max_page,$page,$path_paging);
                    //var_dump(1);die;
                ?>
            </ul>
        </div>
    </div>
    
    <div class="table clearfix">
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr class="bg-grey">
                    <td><strong>Mã</strong></td>
                    <td><strong>Mã Friend</strong></td>
                </tr>
                
                <?php foreach($data as $key=>$value){$key+=1;?>
                    <tr>
                        <td class="middle"><?php echo $key?></td>
                        <td><?php echo $value["facebook_user_id"]?></td>
                    </tr>
                <?php }?>
                
            </tbody>
        </table>
    </div>

</div>
