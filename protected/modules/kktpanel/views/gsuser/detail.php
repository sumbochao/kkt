<?php

?>

<div class="main clearfix">

    <div clas = "box">
        <ul class="form">
            <li class="clearfix"><label><strong>Username </strong>:</label>
                <div class="filltext">
                    <strong><?php echo $data['username']?></strong>
                </div>
            </li>

            <li class="clearfix"><label><strong>Fullname </strong>:</label>
                <div class="filltext">
                    <strong><?php echo $data['fullname']?></strong>
                </div>
            </li>

            <li class="clearfix"><label><strong>Email </strong>:</label>
                <div class="filltext">
                    <strong><?php echo $data['email']?></strong>
                </div>
            </li>

            <li class="clearfix"><label><strong>Mobile </strong>:</label>
                <div class="filltext">
                    <strong><?php echo $data['mobile']?></strong>
                </div>
            </li>

            <li class="clearfix"><label><strong>Address </strong>:</label>
                <div class="filltext">
                    <strong><?php echo $data['address']?></strong>
                </div>
            </li>
            
            <li class="clearfix"><label><strong>Chat </strong>:</label>
                <div class="filltext">
                    <strong><?php if($data['is_ban_chat']==0){echo 'Cho phép';}else{echo 'Chặn';}?></strong>
                </div>
            </li>
            
            <li class="clearfix"><label><strong>Thảo luận </strong>:</label>
                <div class="filltext">
                    <strong><?php if($data['is_ban_comment_new']==0){echo 'Cho phép';}else{echo 'Chặn';}?></strong>
                </div>
            </li>
            
            <li class="clearfix"><label><strong>Ngày tạo</strong>:</label>
                <div class="filltext">
                    <strong><?php echo date('d/m/Y H:i:s',strtotime($data['create_date']))?></strong>
                </div>
            </li>

            <li>
                <label><strong>&nbsp; </strong></label>
                <div class="filltext">
                    <input onclick="history.go(-1)" type="button" value=" Quay lại " class="btn-bigblue">
                </div>
            </li>

        </ul>
    </div>

</div>