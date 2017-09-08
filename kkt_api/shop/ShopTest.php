<?php 
    require_once("ShopDAO.php");
    require_once("ShopDOC.php");
    require_once("ShopBANK.php");
    require_once("ShopProvince.php");
    require_once("ShopNotify.php");
    require_once("../function/utils.php");
    
    
    $date= "0000-00-00";
    if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date))
    {
        echo 1;
    }else{
        echo 0;
    }

    
    $price_sell = "0";
    
    /*list($width, $height) = getimagesize('http://traodoidi.vn/upload/shop/product/2016/0530/1464591636-255.png');
    
    echo  $width."</br>";
    echo  $height;      */
    
    
    
    $string =  "Màu đen  \r\nChạy tốt\r\nĐiện cơ thống nhất<br/>";
  //  
    //$string = mysql_escape_string(trim($string));  
    
    echo  $string ;
    
   
   /* $pattern = '/\r/i';
    $replacement = '';
    echo str_replace($pattern, $replacement, $string);
    echo  $string;  */
    
      echo "Vi tri"."<br/>";
        if(!sstrpos("thangtt@gmail.com","@shop.mobi")) echo 1   ;
      
      $string = str_replace("\r","",$string);
      $string = mysql_escape_string(trim($string));
      echo $string ;
     
    $str = 'foo \r   o';
$str = preg_replace('/\r+/', ' ', $str);
// This will be 'foo o' now
echo $str;
    
   // echo stripslashes("Màu đen  \r\nChạy tốt\r\nĐiện cơ thống nhất");
    $input_lines = "\\\\n trang the thang";
    //echo  $input_lines;
    $input_lines = preg_replace("/(\\)+/", "\\", $input_lines);
    //echo  $input_lines."fdldl";
    
    $string = 'April 15, 2003';
    $pattern = '/(\w+) (\d+), (\d+)/i';
    $replacement = '${1}1,$3';
    echo preg_replace($pattern, $replacement, $string);

    $string = "\\n \r tran the thang";
    $pattern = '/\\+n/';
    $replacement = '\\';
//echo preg_replace($pattern, $replacement, $string);

//echo str_replace('/(\\{1,}n)/','',$string);



$newelement=preg_replace("/[\\n]/","\n",$string);
echo   $newelement;
    
    echo "<br> lafdlfdl";
    if(strcmp("",$price_sell)==0) echo "rong roi1";
    
    $price_sell = "";  
    if(strcmp("",$price_sell)==0) echo "rong roi2";
    
    
    echo $price_sell =  doubleval($price_sell);
    
    $districtName = getDistrictByCode($districts,"5101");
                $provinceName = getProvinceByCode($provinces,"29");
                
                echo "<br>".$districtName.$provinceName."<br>";
                
     function cleanFileName($string) {        
            $string = preg_replace('/[^A-Za-z0-9_\-\.]/', '', $string);
            return $string;
        }
        
        echo cleanFileName("sohagame-2-0-5_1421399306 f  &  _117.apk")."<br/>";
        $domain_api = "http://traodoidi.vn/swap_api/shop/ShopAPI.php";
        
        echo $_SERVER['DOCUMENT_ROOT']."<br>";
        echo $_SERVER['SERVER_NAME']."<br/>";
        echo $_SERVER['HTTP_HOST']."<br/>";
        
        echo  $ck_token = base64_encode(base64_encode( "0230178183078b38f425311c3735c595"."1"));
        echo "<br>";
?>
Upload File Image Product.<br>
<form action="<?php echo $domain_api?>?action=uploadImageProduct&app_client_id=1&token=<?php echo $ck_token?>" method="post" enctype="multipart/form-data" ><br>
Type (or select) Filename: <input type="file" name="upfile">
<input type="submit" value="Upload File">
<input type="hidden" name="user_id" value="8"/>
<input type="hidden" name="product_id" value="1239"/>
</form>

<br>
Post Product Sell<br>
<form action="<?php echo $domain_api?>?action=postProduct&app_client_id=1&token=<?php echo $ck_token?>" method="post" >
Title: <input type="text" name="title" value=""/> <br>
Description: <input type="text" name="description" value=""/> <br>
Cate_id: <input type="text" name="cate_id" value="1" /> <br>
User_id: <input type="text" name="user_id" value="1" /> <br>
price: <input type="text" name="price" value="100000" /> <br>
use_status: <input type="text" name="use_status" value="1" /> <br>
quantity: <input type="text" name="quantity" value="1" /> <br>
transport_fee: <input type="text" name="transport_fee" value="1" /> <br>
lat: <input type="text" name="lat" value="21.033333" /> <br>
lng: <input type="text" name="lng" value="105.849998" /> <br>
image: <input type="text" name="image" value="1.jpg,2.jpg" /> <br>
create_user: <input type="text" name="create_user" value="thangtt" /> <br>
<input type="submit" value="Save">
</form>

<br>
Register User<br>
<form action="<?php echo $domain_api?>?action=registerMember&app_client_id=1&token=<?php echo $ck_token?>" method="post" ><br>
FullName: <input type="text" name="fullname" value="thangtt"/> <br>
email: <input type="text" name="email" value="thang24011983@gmail.com"/> <br>
sex: <input type="text" name="sex" value="1" /> <br>
birthday: <input type="text" name="birthday" value="" /> <br>
sso_id: <input type="text" name="sso_id" value="1"/> <br>
mobile: <input type="text" name="mobile" value=""/> <br>
lat: <input type="text" name="lat" value="21.033333"/> <br>
lng: <input type="text" name="lng" value="105.849998"/> <br>
<input type="submit" value="Save">
</form>

<br>
Un Following<br>
<form action="<?php echo $domain_api?>?action=unFollowing&app_client_id=1&token=<?php echo $ck_token?>" method="post" ><br>
FullName: <input type="text" name="user_id" value=""/> <br>
email: <input type="text" name="user_following_id" value=""/> <br>
<input type="submit" value="Save">
</form>

Upload File.<br>
<form action="<?php echo $domain_api?>?action=uploadAvatarUser&app_client_id=1" method="post" enctype="multipart/form-data" ><br>
User_ID: <input type="text" name="user_id" value="1"/> <br>
Type (or select) Filename: <input type="file" name="upfile">
<input type="submit" value="Upload File">

</form>


<br>
Add Payment<br>
<form action="<?php echo $domain_api?>?action=postPaymentMethodBank&app_client_id=1&token=<?php echo $ck_token?>" method="post" ><br>
user_id: <input type="text" name="user_id" value="1"/> <br>
bank_name: <input type="text" name="bank_name" value="VietCombank"/> <br>
bank_branch: <input type="text" name="bank_branch" value="Ha Noi"/> <br>
account_name: <input type="text" name="account_name" value="Tran The Thang"/> <br>
account_id: <input type="text" name="account_id" value="123"/> <br>
<input type="submit" value="Save">
</form>

<br>
Add Payment<br>
<form action="<?php echo $domain_api?>?action=postPaymentMethodCMT&app_client_id=1&token=<?php echo $ck_token?>" method="post" ><br>
user_id: <input type="text" name="user_id" value="1"/> <br>
bank_name: <input type="text" name="bank_name" value="VietCombank"/> <br>
bank_branch: <input type="text" name="bank_branch" value="Ha Noi"/> <br>
receiver: <input type="text" name="receiver" value="Tran The Thang"/> <br>
id_number: <input type="text" name="id_number" value="123"/> <br>
id_place: <input type="text" name="id_place" value="Nam dinh"/> <br>
id_date: <input type="text" name="id_date" value="2010-08-09"/> <br>
<input type="submit" value="Save">
</form>

<br>
Add Transaction<br>
<?php $address_buyer=base64_encode('{"fullname":"Tran The Thang","tel":"0974838181","address":"10/51 Duong Bai TP Nam Dinh Tinh Nam Dinh"}');

$products=base64_encode('[{"product_id":1,"quantity":1},{"product_id":2,"quantity":1}]');

?>
<form action="<?php echo $domain_api?>?action=postTransaction&app_client_id=1&token=<?php echo $ck_token?>" method="post" ><br>
seller_id: <input type="text" name="seller_id" value="1"/> <br>
buyer_id: <input type="text" name="buyer_id" value="2"/> <br>
address_seller: <input type="text" name="address_seller" value=''/> <br>
address_buyer: <textarea name="address_buyer" cols="45" rows="15" ><?php echo $address_buyer;?></textarea> <br>
transaction_type: <input type="text" name="transaction_type" value="1"/> <br>
pay_type: <input type="text" name="pay_type" value="2"/> <br>
fee_product: <input type="text" name="fee_product" value="150000"/> <br>
fee_transport_seller: <input type="text" name="fee_transport_seller" value="0"/> <br>
fee_transport_buyer: <input type="text" name="fee_transport_buyer" value="20000"/> <br>
promotion_code: <input type="text" name="promotion_code" value="KM123"/> <br>
products: <textarea name="products" cols="45" rows="15"><?php echo $products;?></textarea><br>
quantity: <input type="text" name="quantity" value="2"/> <br>
transport_by: <input type="text" name="transport_by" value="Giao Hang Tiet Kiem"/> <br>
<input type="submit" value="Save">
</form>


<br>
Add Report<br>
<form action="<?php echo $domain_api?>?action=postProductReport&app_client_id=1&token=<?php echo $ck_token?>" method="post" ><br>
reason: <input type="text" name="reason" value="1"/> <br>
create_user_id: <input type="text" name="create_user_id" value="1"/> <br>
note: <input type="text" name="note" value="ok"/> <br>

<input type="submit" value="Save">
</form>

<br>
Update Address<br>
<form action="<?php echo $domain_api?>?action=updateAddressBuyer&app_client_id=1&token=<?php echo $ck_token?>" method="post" ><br>
transaction_id: <input type="text" name="transaction_id" value="1"/> <br>
user_id: <input type="text" name="user_id" value="1"/> <br>
address_seller: <input type="text" name="address_buyer" value="<?php echo $address_buyer;?>"/> <br>


<input type="submit" value="Save">
</form>
