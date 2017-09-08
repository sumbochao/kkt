<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
	  $url_api = "http://kenhkiemtien.com/kkt_api/shop/ShopAPI.php"; 
	  $arrAPIProducts =  array();
	  $arrAPIProducts[0] = array("api"=>"getCategory", "des"=>"Lấy danh sách danh mục con theo danh mục cha", "ex"=>$url_api."?function=getCategory");
	  $arrAPIProducts[1] = array("api"=>"getCategoryAll", "des"=>"Lấy tất cả danh mục", "ex"=>$url_api."?function=getCategoryAll");
	  $arrAPIProducts[2] = array("api"=>"getProductCate", "des"=>"Lấy danh sách sản phẩm theo category", "ex"=>$url_api."?function=getProductCate");
	  $arrAPIProducts[3] = array("api"=>"getProductFollowing", "des"=>"Lấy danh sách sản phẩm từ người bạn theo dõi", "ex"=>$url_api."?function=getProductFollowing");
	  $arrAPIProducts[4] = array("api"=>"getProductFavorite", "des"=>"Lấy danh sách sản phẩm bạn yêu thích bookmark", "ex"=>$url_api."?function=getProductFavorite");
	  $arrAPIProducts[5] = array("api"=>"getProductByDistance", "des"=>"Lấy sản phẩm theo khoảng cách và vị trí", "ex"=>$url_api."?function=getProductByDistance");
	  $arrAPIProducts[6] = array("api"=>"getProductByDistanceFT", "des"=>"Lấy sản phẩm theo khoảng cách trong khoảng và vị trí", "ex"=>$url_api."?function=getProductByDistanceFT");
	  $arrAPIProducts[7] = array("api"=>"getProductSameCate", "des"=>"Lấy danh sách sản phẩm cùng danh mục", "ex"=>$url_api."?function=getProductSameCate");
	  
	  $arrAPIProducts[8] = array("api"=>"getProductOfUser", "des"=>"Lấy danh sách sản phẩm của 1 user", "ex"=>$url_api."?function=getProductOfUser");
	  $arrAPIProducts[9] = array("api"=>"getProductByIDs", "des"=>"Danh sách sản phẩm theo ids", "ex"=>$url_api."?function=getProductByIDs");
	  $arrAPIProducts[10] = array("api"=>"getProductFilter", "des"=>"Lấy danh sách sản phẩm theo bộ lọc", "ex"=>$url_api."?function=getProductFilter");
	  $arrAPIProducts[11] = array("api"=>"getProductSwap", "des"=>"Lấy danh sách sản phẩm trao đổi của 1 user", "ex"=>$url_api."?function=getProductSwap");
	  $arrAPIProducts[12] = array("api"=>"getProductRecomment", "des"=>"Lấy danh sách sản phẩm trao đổi mà khách hàng mong muốn", "ex"=>$url_api."?function=getProductRecomment");
	  $arrAPIProducts[13] = array("api"=>"getProductSwapMatching", "des"=>"Lấy danh sách sản phẩm trao đổi của user ở trang chủ và danh sách sp matching theo yêu cầu.", "ex"=>$url_api."?function=getProductSwapMatching");
	  $arrAPIProducts[14] = array("api"=>"getProductSwapMatchingNext", "des"=>"Lấy danh sách sản phẩm có thể trao đổi tiếp..", "ex"=>$url_api."?function=getProductSwapMatchingNext");
	  $arrAPIProducts[15] = array("api"=>"getProductInfo", "des"=>"Lấy thông tin duy nhất của sản phẩm.", "ex"=>$url_api."?function=getProductInfo");
	  $arrAPIProducts[16] = array("api"=>"getProductDetail", "des"=>"Lấy thông tin ở trang chi tiết sản phảm gồm : sản phẩm, user.", "ex"=>$url_api."?function=getProductDetail");
	  $arrAPIProducts[17] = array("api"=>"getItemSwapMatching", "des"=>"Lấy danh sách sản phầm có thê trao đổi của 1 item.", "ex"=>$url_api."?function=getItemSwapMatching");
	  
	  $arrAPIProducts[18] = array("api"=>"postProduct", "des"=>"Post sản phẩm.", "ex"=>$url_api."?function=postProduct");
	  $arrAPIProducts[19] = array("api"=>"updateProduct", "des"=>"Cập nhật thông tin sản phẩm.", "ex"=>$url_api."?function=updateProduct");
	  $arrAPIProducts[20] = array("api"=>"deleteProduct", "des"=>"Xóa thông tin sản phẩm.", "ex"=>$url_api."?function=deleteProduct");
	  $arrAPIProducts[21] = array("api"=>"postProductFavorite", "des"=>"Post đồ yêu thích bookmark.", "ex"=>$url_api."?function=postProductFavorite");
	  $arrAPIProducts[22] = array("api"=>"deleteProductFavorite", "des"=>"Remove sản phẩm yêu thích.", "ex"=>$url_api."?function=deleteProductFavorite");
	  
	  $arrAPIProducts[23] = array("api"=>"uploadImageProduct", "des"=>"Upload 1 hình ảnh của sp.", "ex"=>$url_api."?function=uploadImageProduct");
	  $arrAPIProducts[24] = array("api"=>"postProductReport", "des"=>"Report một sản phẩm.", "ex"=>$url_api."?function=postProductReport");
	  $arrAPIProducts[25] = array("api"=>"updateTagSwapProduct", "des"=>"Cập nhật Tag đồ muốn trao đổi của sản phẩm.", "ex"=>$url_api."?function=updateTagSwapProduct");
	  $arrAPIProducts[26] = array("api"=>"getProductComment", "des"=>"Lấy danh sách comment của sản phẩm.", "ex"=>$url_api."?function=getProductComment");
	  $arrAPIProducts[27] = array("api"=>"postProductComment", "des"=>"Thêm nhận xét cho 1 sản phẩm.", "ex"=>$url_api."?function=postProductComment");
	  $arrAPIProducts[28] = array("api"=>"searchProduct", "des"=>"Tìm kiếm sản phẩm.", "ex"=>$url_api."?function=searchProduct");
	  $arrAPIProducts[29] = array("api"=>"searchProductNearest", "des"=>"Tìm kiếm sản phầm và sắp xếp theo vị trí gần nhất.", "ex"=>$url_api."?function=searchProductNearest");
      $arrAPIProducts[29] = array("api"=>"reSellProduct", "des"=>"Đăng bán lại sản phẩm.", "ex"=>$url_api."?function=reSellProduct"); 
	  
	  
	  $arrAPIUser =  array();
	  $arrAPIUser[0] = array("api"=>"registerMember", "des"=>"Đăng kí thành viên", "ex"=>$url_api."?function=registerMember");
	  $arrAPIUser[1] = array("api"=>"getUserInfo", "des"=>"Lấy thông tin user", "ex"=>$url_api."?function=getUserInfo");
	  $arrAPIUser[2] = array("api"=>"getUserByIDs", "des"=>"Lấy danh sách user theo ids", "ex"=>$url_api."?function=getProductCate");
	  $arrAPIUser[3] = array("api"=>"getUserByFacebookIDs", "des"=>"Lây danh sách user qua facebook_ids", "ex"=>$url_api."?function=getUserByFacebookIDs");
	  $arrAPIUser[4] = array("api"=>"getUserFollowing", "des"=>"Lấy danh sách user mình đang theo dõi", "ex"=>$url_api."?function=getUserFollowing");
	  $arrAPIUser[5] = array("api"=>"getUserFollower", "des"=>"Lấy danh sách user đanh theo dõi mình", "ex"=>$url_api."?function=getUserFollower");
	  $arrAPIUser[6] = array("api"=>"updateUserInfo", "des"=>"Cập nhật thông tin người dùng.", "ex"=>$url_api."?function=updateUserInfo");
	  $arrAPIUser[7] = array("api"=>"uploadAvatarUser", "des"=>"Upload avatar của user", "ex"=>$url_api."?function=uploadAvatarUser");
	  $arrAPIUser[8] = array("api"=>"updateMobileUser", "des"=>"Update mobile của user", "ex"=>$url_api."?function=updateMobileUser");
	  $arrAPIUser[9] = array("api"=>"validateMobile", "des"=>"Validate mobile user", "ex"=>$url_api."?function=validateMobile");
	  $arrAPIUser[10] = array("api"=>"revalidateValidateMobile", "des"=>"Yêu cầu gửi lại code xác nhật mobile", "ex"=>$url_api."?function=revalidateValidateMobile");
	  $arrAPIUser[11] = array("api"=>"getAddress", "des"=>"Lấy địa chỉ của user", "ex"=>$url_api."?function=getAddress");
	  $arrAPIUser[12] = array("api"=>"getPaymentMethod", "des"=>"Lấy thông tin danh sách hình thức thanh toán, có 2 loại 1, và 2 của user", "ex"=>$url_api."?function=getPaymentMethod");
	  $arrAPIUser[13] = array("api"=>"postAddress", "des"=>"Thêm thông tin địa chỉ nhận hàng
", "ex"=>$url_api."?function=postAddress");
	  $arrAPIUser[14] = array("api"=>"postPaymentMethodBank", "des"=>"Thêm phương thức thanh toán bằng thẻ ngân hàng", "ex"=>$url_api."?function=postPaymentMethodBank");
	  $arrAPIUser[15] = array("api"=>"postPaymentMethodCMT", "des"=>"Thêm phương thức thanh toán bằng bằng chứng minh thư", "ex"=>$url_api."?function=postPaymentMethodCMT");
	  $arrAPIUser[16] = array("api"=>"updateAddress", "des"=>"Cập nhật địa chỉ nhận hàng", "ex"=>$url_api."?function=updateAddress");
	  $arrAPIUser[17] = array("api"=>"deleteAddress", "des"=>"Xóa địa chỉ nhận hàng", "ex"=>$url_api."?function=deleteAddress");
      $arrAPIUser[18] = array("api"=>"getSeller", "des"=>"Lấy thông tin người bán", "ex"=>$url_api."?function=getSeller"); 
      $arrAPIUser[19] = array("api"=>"getMyOfferSell", "des"=>"Lấy danh sách offer bán hàng", "ex"=>$url_api."?function=getMyOfferSell"); 
      $arrAPIUser[20] = array("api"=>"getMyOfferBuy", "des"=>"Lấy danh sách offer mua hàng", "ex"=>$url_api."?function=getMyOfferBuy"); 
      $arrAPIUser[21] = array("api"=>"unFollowing", "des"=>"Bỏ theo dõi 1 user", "ex"=>$url_api."?function=unFollowing"); 
      $arrAPIUser[22] = array("api"=>"postUserFollowing", "des"=>"Post User mình muốn theo dõi", "ex"=>$url_api."?function=postUserFollowing"); 
	  
	  
	  
	  $arrAPIAppHeader =  array();
	  $arrAPIAppHeader[0] = array("api"=>"getAppHeaderShop", "des"=>"Lấy thông tin app header và các thông tin danh mục, event", "ex"=>$url_api."?function=getAppHeaderShop");
	  $arrAPIAppHeader[1] = array("api"=>"getEventTop", "des"=>"Lấy danh sách sự kiện mới nhất.", "ex"=>$url_api."?function=getEventTop");
	  $arrAPIAppHeader[2] = array("api"=>"getInformDetail", "des"=>"Lấy thông tin chi tiết event hoặc thông báo .", "ex"=>$url_api."?function=getInformDetail");
	  $arrAPIAppHeader[3] = array("api"=>"registryNotice", "des"=>"Đăng kí token notice", "ex"=>$url_api."?function=registryNotice");
	  $arrAPIAppHeader[4] = array("api"=>"getActivity", "des"=>"Lấy danh sách hoạt động được gửi notice", "ex"=>$url_api."?function=getActivity");
	  
	  $arrAPIGHN =  array();
	  $arrAPIGHN[0] = array("api"=>"getProvince", "des"=>"Lấy danh sách tỉnh thành", "ex"=>$url_api."?function=getProvince");
	  $arrAPIGHN[1] = array("api"=>"getDistrict", "des"=>"Lấy danh sách quận huyện.", "ex"=>$url_api."?function=getDistrict");
	  $arrAPIGHN[2] = array("api"=>"getShipPartner", "des"=>"Lấy danh sách đối tác giao hàng.", "ex"=>$url_api."?function=getShipPartner");
	  $arrAPIGHN[3] = array("api"=>"GetServiceList", "des"=>"Lấy danh sách dịch vụ ship của Giao Hàng Nhanh theo địa bàn", "ex"=>$url_api."?function=GetServiceList");
	  $arrAPIGHN[4] = array("api"=>"CalculateServiceFees", "des"=>"Tính giá vận chuyển của danh sách sản phảm", "ex"=>$url_api."?function=CalculateServiceFees");
	  
	  
	  $arrAPI123Pay =  array();
	  $arrAPI123Pay[0] = array("api"=>"get123Bank", "des"=>"Lấy danh sách ngân hàng theo 123Pay", "ex"=>$url_api."?function=get123Bank");
	  $arrAPI123Pay[1] = array("api"=>"createOrder123Pay", "des"=>"Tao order thanh toán qua 123Pay.", "ex"=>$url_api."?function=createOrder123Pay");
	  
      $arrAPITransaction =  array();     
      $arrAPITransaction[0] = array("api"=>"getListTransactionSell", "des"=>"Danh sách giao dịch bán", "ex"=>$url_api."?function=getListTransactionSell");
      $arrAPITransaction[1] = array("api"=>"getListTransactionBuy", "des"=>"Danh sách giao dịch mua.", "ex"=>$url_api."?function=getListTransactionBuy");
      $arrAPITransaction[2] = array("api"=>"getListTransactionSwap", "des"=>"Danh sách giao dịch trao đổi", "ex"=>$url_api."?=getListTransactionSwap");
      $arrAPITransaction[3] = array("api"=>"getTransactionDetail", "des"=>"Chi tiêt thông tin giao dịch.", "ex"=>$url_api."?function=getTransactionDetail");
      $arrAPITransaction[4] = array("api"=>"postTransaction", "des"=>"Tạo giao dịch", "ex"=>$url_api."?function=postTransaction");
      $arrAPITransaction[5] = array("api"=>"updateAddressBuyer", "des"=>"Cập nhật địa chỉ người mua.", "ex"=>$url_api."?function=updateAddressBuyer");
      $arrAPITransaction[6] = array("api"=>"updateAddressSeller", "des"=>"Cập nhật địa chỉ người bán dành cho giao dịch trao đổi", "ex"=>$url_api."?function=updatePaymentType");
      $arrAPITransaction[7] = array("api"=>"updatePaymentType", "des"=>"Cập nhật hình thức thanh toán.", "ex"=>$url_api."?function=updatePaymentType");
      $arrAPITransaction[8] = array("api"=>"updateTransportSeller", "des"=>"Cập nhật thông tin đơn vị giao hàng và chi phí giao hàng của người bán, người đc đề nghị trao đổi", "ex"=>$url_api."?function=updateTransportSeller");
      $arrAPITransaction[9] = array("api"=>"updateTransportBuyer", "des"=>"Cập nhật thông tin đơn vị giao hàng và chi phí giao hàng của người mua.", "ex"=>$url_api."?function=updateTransportBuyer");
      $arrAPITransaction[10] = array("api"=>"cancelTransaction", "des"=>"Hủy bỏ 1 giao dịch", "ex"=>$url_api."?function=cancelTransaction");
      $arrAPITransaction[11] = array("api"=>"postRateUser", "des"=>"Rate user sau giao dịch hoàn thành.", "ex"=>$url_api."?function=postRateUser");
      $arrAPITransaction[12] = array("api"=>"getTransactionByProduct", "des"=>"Danh sách giao dich hiện tại của sp.", "ex"=>$url_api."?function=getTransactionByProduct");
      

?>
<div class="container">
<h1>API TraoDoiDi V1.0 <?=count($arrAPIProducts)+count($arrAPIUser)+count($arrAPIAppHeader)
+count($arrAPIGHN)+count($arrAPI123Pay)+count($arrAPITransaction)?></h1>
<p>
<nav>
<a href="#product">API Product</a>    |
<a href="#user">API User</a>        | 
<a href="#header">API Header</a>       | 
<a href="#ghn">API Giao Hàng Nhanh</a>   | 
<a href="#123pay">API 123Pay</a>      | 
<a href="#transaction">API Transaction</a> 
</nav>
</p>
</div>
<div class="container">  <a name="product"></a> 
  <h2 name="product">API Danh mục và Sản phẩm</h2>
  <p></p>
  <div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>API</th>
        <th>Description</th>
		<th>Example</th>
      </tr>
    </thead>
    <tbody>
	<?php 
	$i=1;
	foreach($arrAPIProducts as $item) {?>
      <tr>
		<td><?=$i++;?></td>
        <td><span style="color: #0000BB"><strong><?=$item["api"]?></strong></span></td>
        <td><i><?=$item["des"]?></i></td>
        <td>
			<a href='<?=$item["ex"]?>' target='_blank'>ex</a>
		</td>
      </tr>
	 <?php }?>
    </tbody>
  </table>
  </div>
</div>

<div class="container">   <a name="user"></a> 
  <h2>API Thông tin user</h2>
 
  <p></p>
  <div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>API</th>
        <th>Description</th>
		<th>Example</th>
      </tr>
    </thead>
    <tbody>
	<?php 
	$i=1;
	foreach($arrAPIUser as $item) {?>
      <tr>
		<td><?=$i++;?></td>
        <td><span style="color: #0000BB"><strong><?=$item["api"]?></strong></span></td>
        <td><i><?=$item["des"]?></i></td>
        <td>
			<a href='<?=$item["ex"]?>' target='_blank'>ex</a>
		</td>
      </tr>
	 <?php }?>
    </tbody>
  </table>
  </div>
</div>


<div class="container">     <a name="header"></a>    
  <h2 name="header">API Thông tin App Header & Thông báo & Event</h2>
  <p></p>
 
  <div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>API</th>
        <th>Description</th>
		<th>Example</th>
      </tr>
    </thead>
    <tbody>
	<?php 
	$i=1;
	foreach($arrAPIAppHeader as $item) {?>
      <tr>
		<td><?=$i++;?></td>
        <td><span style="color: #0000BB"><strong><?=$item["api"]?></strong></span></td>
        <td><i><?=$item["des"]?></i></td>
        <td>
			<a href='<?=$item["ex"]?>' target='_blank'>ex</a>
		</td>
      </tr>
	 <?php }?>
    </tbody>
  </table>
  </div>
</div>


<div class="container">  <a name="ghn"></a>   
  <h2 name="ghn">API Giao Hàng Nhanh</h2>
  <p></p>
  
  <div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>API</th>
        <th>Description</th>
		<th>Example</th>
      </tr>
    </thead>
    <tbody>
	<?php 
	$i=1;
	foreach($arrAPIGHN as $item) {?>
      <tr>
		<td><?=$i++;?></td>
        <td><span style="color: #0000BB"><strong><?=$item["api"]?></strong></span></td>
        <td><i><?=$item["des"]?></i></td>
        <td>
			<a href='<?=$item["ex"]?>' target='_blank'>ex</a>
		</td>
      </tr>
	 <?php }?>
    </tbody>
  </table>
  </div>
</div>


<div class="container"> <a name="123pay"></a> 
  <h2 name="123pay">API 123Pay</h2>
  <p></p>
 
  <div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>API</th>
        <th>Description</th>
		<th>Example</th>
      </tr>
    </thead>
    <tbody>
	<?php 
	$i=1;
	foreach($arrAPI123Pay as $item) {?>
      <tr>
		<td><?=$i++;?></td>
        <td><span style="color: #0000BB"><strong><?=$item["api"]?></strong></span></td>
        <td><i><?=$item["des"]?></i></td>
        <td>
			<a href='<?=$item["ex"]?>' target='_blank'>ex</a>
		</td>
      </tr>
	 <?php }?>
    </tbody>
  </table>
  </div>
</div>

<div class="container">
 <a name="transaction"></a>    
  <h2 name="transaction">API Transaction</h2>
  <p></p>
 
  <div class="table-responsive" >
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>API</th>
        <th>Description</th>
        <th>Example</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $i=1;
    foreach($arrAPITransaction as $item) {?>
      <tr>
        <td><?=$i++;?></td>
        <td><span style="color: #0000BB"><strong><?=$item["api"]?></strong></span></td>
        <td><i><?=$item["des"]?></i></td>
        <td>
            <a href='<?=$item["ex"]?>' target='_blank'>ex</a>
        </td>
      </tr>
     <?php }?>
    </tbody>
  </table>
  </div>
</div>
</body>
</html>

