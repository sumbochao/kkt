<?php
  
?>

<div class="main clearfix">

    <div clas = "box">
     
        <ul class="form">
            <li class="clearfix"><label><strong>Username </strong>:</label>
                <div class="filltext">
                    <strong><?php echo $user['username']?></strong>
                </div>
            </li>

            <li class="clearfix"><label><strong>Fullname </strong>:</label>
                <div class="filltext">
                    <strong><?php echo $user['fullname']?></strong>
                </div>
            </li>

            <li class="clearfix"><label><strong>Email </strong>:</label>
                <div class="filltext">
                    <strong><?php echo $user['email']?></strong>
                </div>
            </li>

            <li class="clearfix"><label><strong>Ngày hết hạn</strong>:</label>
                <div class="filltext">
                    <?php echo $data_ban['date_expire']?>
                </div>
            </li>

            <li class="clearfix"><label><strong>Lý do </strong>:</label>
                <div class="filltext">
                    <strong><?php echo $data_ban['reason']?></strong>
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