<?php
  $custAddress="196 Cau Giay - Ha Noi";
?>
<form action="http://kenhkiemtien.com/kkt_api/shop/123pay/createOrder.php" method="post" ><br>
transactionID: <input type="text" name="transactionID" value="1"/> <br>
totalAmount: <input type="text" name="totalAmount" value="20002"/> <br>
custName: <input type="text" name="custName" value='Tran The Thang'/> <br>
custAddress: <textarea name="custAddress" cols="45" rows="15" ><?php echo $custAddress;?></textarea> <br>
custGender: <input type="text" name="custGender" value="M"/> <br>
custDOB: <input type="text" name="custDOB" value="24/01/1983"/> <br>
custPhone: <input type="text" name="custPhone" value="0974838181"/> <br>
custMail: <input type="text" name="custMail" value="thangttnd@gmail.com"/> <br>
description: <input type="text" name="description" value="Tra tien cho don hang"/> <br>
bankCode: <input type="text" name="bankCode" value="123PAY"/> <br>
<input type="submit" value="Save">
</form>