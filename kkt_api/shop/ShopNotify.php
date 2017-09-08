<?php
  /* Khi khach hang like san pham
   $1: Tên người like
  $2:  Tiêu đề của sản phẩm
  */
  $notify_content_1 = "$1 thích sản phẩm \"$2\" của bạn."; 
  
  /*  Khi khách hàng comment 1 sản phẩm
  $1: Tên người comment
  $2: Tiêu đề rút gọn của chủ đề
  $3: Nội dung nhận xét
  */
  
  $notify_content_2 = "$1 nhận xét sản phẩm \"$2\" của bạn:$3."; 
  
  /* Khi có một người following 
  $1: Tên người following
  */
  $notify_content_3 = "$1 bắt đầu following bạn."; 
  
  /* Khi khách hàng mình following bán 1 sản phẩm
  $1: Tên người bán sản phẩm
  $2: Tiêu đề sản phẩm
  */
  $notify_content_4= "$1 đã bán sản phẩm \"$2\"."; 
  
   /*Khi khách hàng feeadback một sản phẩm mình đã bán
    $1: Tên người gửi feedback
  $2: Trạng thái đánh giá
  */
  $notify_content_5= "$1 đánh giá giao dịch với bạn: $2."; 
  
  /*Khi khách hàng hủy 1 giao dich
    $1: Tên người gửi hủy giao dich
  $2: Tên sản phẩm
  */
  $notify_content_6= "$1 đã hủy giao dich với sản phẩm: $2."; 
  
  /*Khi người bán có 1 giao dich
  $1: Tên sản phẩm
  */
  $notify_content_7= "Sản phẩm: '$1' của bạn, có 1 giao dịch"; 
  
    /*Khi thanh toan 123Pay thanh cong
  $1: Tên sản phẩm
  */
  $notify_content_8= "Bạn đã thanh toán thành công số tiền:$1."; 
  $notify_content_9= "Thanh toán qua 123Pay không thành công."; 
  
  define("NOTIFY_TYPE_PRODUCT","1");
  define("NOTIFY_TYPE_USER","2");
  define("NOTIFY_TYPE_TRANSACTION","3");
  
  define("NOTIFY_CONTENT_LIKE",$notify_content_1);
  define("NOTIFY_CONTENT_COMMENT",$notify_content_2);
  define("NOTIFY_CONTENT_FOLLOWING",$notify_content_3);
  define("NOTIFY_CONTENT_SOLD",$notify_content_4);
  define("NOTIFY_CONTENT_FEEDBACK_TRANSACTION",$notify_content_5);
  define("NOTIFY_CONTENT_CANCEL_TRANSACTION",$notify_content_6);
  define("NOTIFY_CONTENT_HAD_TRANSACTION",$notify_content_7);
  define("NOTIFY_CONTENT_123PAY_SUCCESS",$notify_content_8);
  define("NOTIFY_CONTENT_123PAY_FAIL",$notify_content_9);
  
   function pushNotifyLikeProduct($object_id, $from_user){
      $userNotify = getUserShop($from_user);
      $product = getProductDetail($object_id);
      $like_user = $userNotify["fullname"];
      $title =  $product["title"];
      $object_type = NOTIFY_TYPE_PRODUCT;
      
      $content = NOTIFY_CONTENT_LIKE;
      $content = str_replace("$1",$like_user,$content);
      $content = str_replace("$2",$title,$content);
      $to_user = $product["user_id"];
      if($from_user!=$product["user_id"])
      insertNoticeShop($object_id, $to_user, $from_user, $content, $product['image'][0], "", $object_type, $like_user);
  }
  
  function pushNotifyCommentProduct($object_id, $from_user,$comment){
      $userNotify = getUserShop($from_user);
      $product = getProductDetail($object_id);
      $comment_user = $userNotify["fullname"];
      $title =  $product["title"];
      $object_type = NOTIFY_TYPE_PRODUCT;
      
      $content = NOTIFY_CONTENT_COMMENT;
      $content = str_replace("$1",$comment_user,$content);
      $content = str_replace("$2",$title,$content);
      $content = str_replace("$3",$comment,$content);
      $to_user = $product["user_id"];
      if($from_user!=$to_user)
      insertNoticeShop($object_id, $to_user, $from_user, $content, $product['image'][0], "", $object_type, $comment_user);
  }
  
   function pushNotifyFollowing($object_id, $to_user, $from_user){
      $userNotify = getUserShop($from_user);
      $following_user = $userNotify["fullname"];
      $object_type = NOTIFY_TYPE_USER;
      
      $content = NOTIFY_CONTENT_FOLLOWING;
      $content = str_replace("$1",$following_user,$content);
      if($from_user!=$to_user)
      insertNoticeShop($object_id, $to_user, $from_user, $content, "", "", $object_type, $following_user);
  }
  
  function pushNotifySold($object_id,$buyer_id){
    
      $product = getProductDetail($object_id);
      $from_user = $product["user_id"];
      
      $userNotify = getUserShop($from_user);
      
      $like_user = $userNotify["fullname"];
      $title =  $product["title"];
      $object_type = NOTIFY_TYPE_PRODUCT;
      
      $content = NOTIFY_CONTENT_SOLD;
      $content = str_replace("$1",$like_user,$content);
      $content = str_replace("$2",$title,$content);
      // Send notify to user follower
      $arrUserFollower = getUserFollowerSendNotify($from_user);
      $strUserId = "";
      foreach($arrUserFollower as $item){
          $strUserId .=  $item["user_id"].",";
          insertNoticeShop($object_id, $item["user_id"], $from_user, $content, "", "", $object_type, $like_user);
      }
      if(strlen($strUserId)>1)
      $strUserId = substr($strUserId,0,strlen($strUserId)-1);
      // Send notify to user like product
      $arrUserFollower = getUserLikeProduct($object_id,$strUserId);
      foreach($arrUserFollower as $item){
          insertNoticeShop($object_id, $item["user_id"], $from_user, $content, "", "", $object_type, $like_user);
      }
      // Send notify tới chủ shop
      $userBuyer = getUserShop($buyer_id);
      $content =  NOTIFY_CONTENT_HAD_TRANSACTION;
      $content = str_replace("$1",$title,$content);
      insertNoticeShop($object_id, $product["user_id"], $buyer_id, $content, "", "", $object_type, $userBuyer["fullname"]);
  }
  
  function pushNotifyFeedBack($object_id, $to_user, $from_user,$status){
      $userNotify = getUserShop($from_user);
      $like_user = $userNotify["fullname"];
      $object_type = NOTIFY_TYPE_TRANSACTION;
      
      $rate = "";
      if($status==1) $rate="Tốt";
      if($status==2) $rate="Bình thường";
      if($status==3) $rate="Tệ";
      
      $content = NOTIFY_CONTENT_FEEDBACK_TRANSACTION;
      $content = str_replace("$1",$like_user,$content);
      $content = str_replace("$2",$rate,$content);
      if($to_user!=$from_user)
      insertNoticeShop($object_id, $to_user, $from_user, $content, "", "", $object_type, $like_user);
  }
  
  function pushNotify123PaySuccess($object_id, $to_user){
      $object_type = NOTIFY_TYPE_TRANSACTION;
      $content = NOTIFY_CONTENT_123PAY_SUCCESS;
      $transaction = getTransaction($object_id);
      $fee = $transaction["fee_product"]<0?$transaction["fee_product"]*(-1):$transaction["fee_product"];
      $content = str_replace("$1",$fee,$content);
      return insertNoticeShop($object_id, $to_user, 0, $content, "", "", $object_type, "");
  }
  
  function pushNotify123PayFail($object_id, $to_user){
      $object_type = NOTIFY_TYPE_TRANSACTION;
      $content = NOTIFY_CONTENT_123PAY_FAIL;
      return insertNoticeShop($object_id, $to_user, 0, $content, "", "", $object_type, "");
  }
  
  function pushNotifyCancelTransaction($object_id, $from_user){
      $userNotify = getUserShop($from_user);
      $transaction = getTransaction($object_id);
      $product =  getProductDetail($transaction["product_id"]);
      $like_user = $userNotify["fullname"];
      $object_type = NOTIFY_TYPE_TRANSACTION;
      
      if($transaction["seller_id"]==$from_user) $to_user= $transaction["buyer_id"];
      else $to_user= $transaction["seller_id"];
      
      $productName = $product["title"];
      
      $content = NOTIFY_CONTENT_CANCEL_TRANSACTION;
      $content = str_replace("$1",$like_user,$content);
      $content = str_replace("$2",$productName,$content);
      if($to_user!=$from_user)
      insertNoticeShop($object_id, $to_user, $from_user, $content, "", "", $object_type, $like_user);
  }
  
?>
