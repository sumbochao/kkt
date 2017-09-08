<?php
  $url = new Url();
?>

<script>
    function onsubmitBanCommentFrm1()
    {
       alert(parseInt(($('input[name="reason"]:checked').val())));
       
    }
    
    function onsubmitBanCommentFrm() {
        var radios = document.getElementsByName("reason");
        var found = 1;
        for (var i = 0; i < radios.length; i++) {       
            if (radios[i].checked) {
                
                found = 0;
                break;
            }
        }
           if(found == 1)
           {
             alert("Phải chọn lý ro Ban.");
             return false;
           }    
           
          
}
</script>

 
<div class="main clearfix">

    <div clas = "box">
      <form name="banCharFrm" id="banCommentFrm" name="banCommentFrm" action="<?php echo $url->createUrl("gsuser/excBanComment",array());?>" method="post">
         <input type="hidden" name="user_id" value="<?php echo $data["id"]?>">
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

            <li class="clearfix"><label><strong>Số ngày</strong>:</label>
                <div class="filltext">
                    <select name="songay" id="songay">
                        <option value="1">1 ngày</option>
                        <option value="3">3 ngày</option>
                        <option value="5">5 ngày</option>
                        <option value="7">7 ngày</option>
                    </select>
                </div>
            </li>

            <li class="clearfix"><label><strong>Lý do </strong>:</label>
                <div class="filltext">
                    <input type="radio" value="1" name="reason"> &nbsp; Spam
                    <input type="radio" value="2" name="reason"> &nbsp; Nội dung comment không phù hợp
                </div>
            </li>
            
            <li>
                <label><strong>&nbsp; </strong></label>
                <div class="filltext">
                    <input type="submit" value="Save" class="btn-bigblue" onclick="javascript:return onsubmitBanCommentFrm() "/>
                    <input onclick="history.go(-1)" type="button" value=" Quay lại " class="btn-bigblue">
                </div>
            </li>

        </ul>
        </form>
    </div>

</div>