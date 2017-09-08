<?php
  class ShopDOC
{
    private $functionName;
    public $url_api = "http://kenhkiemtien.com/kkt_api/shop/ShopAPI.php";
    public $url_api_ghn = "http://kenhkiemtien.com/kkt_api/shop/ghn/GiaoHangNhanhAPI.php";
    public $url_api_123pay = "http://kenhkiemtien.com/kkt_api/shop/123pay/createOrder.php";
    public $token = "TURJek1ERTNPREU0TXpBM09HSXpPR1kwTWpVek1URmpNemN6TldNMU9UVXg=";

    function __construct($functionName)
    {
       $this->functionName = $functionName;
       
    }
    
    function outLine(){
         switch ($this->functionName){
            case "getCategory":{
                $this->outLineGetCategory();
                break;
            }
            case "getCategoryAll":{
                $this->outLineGetCategoryAll();
                break;
            }
            case "getProductHome":{
                $this->outLineGetProductHome();
                break;
            }
            case "getProductCate":{
                $this->outLineGetProductCate();
                break;
            }
            case "getProductDetail":{
                $this->outLineGetProductDetail();
                break;
            }
            case "getTransactionByProduct":{
                $this->outLineGetTransactionByProduct();
                break;
            }
            case "getProductComment":{
                $this->outLineGetProductComment();
                break;
            }
            case "getProductSameCate":{
                $this->outLineGetProductSameCate();
                break;
            }
            case "getProductByIDs":{
                $this->outLineGetProductByIDs();
                break;
            }
            case "postProduct":{
                $this->outLinePostProduct();
                break;
            }
            case "updateProduct":{
                $this->outLineUpdateProduct();
                break;
            }
             case "postProductFavorite":{
                $this->outLinePostProductFavorite();
                break;
            }
            case "getProductByDistance":{
                $this->outLineGetProductByDistance();
                break;
            }
              case "getProductByDistanceFT":{
                $this->outLineGetProductByDistanceFT();
                break;
            }
            case "uploadImageProduct":{
                $this->outLineUploadImageProduct();
                break;
            }
            case "uploadAvatarUser":{
                $this->outLineUploadAvatarUser();
                break;
            }
            case "getAppHeaderShop":{
                $this->outLineGetAppHeaderShop();
                break;
            }
             case "registerMember":{
                $this->outLineRegisterMember();
                break;
            }
            case "getUserInfo":{
                $this->outLineGetUserInfo();
                break;
            }
            case "getSeller":{
                $this->outLineGetSeller();
                break;
            }
            case "updateUserInfo":{
                $this->outLineUpdateUserInfo();
                break;
            }
            case "getProductFollowing":{
                $this->outLineGetProductFormUserFollowing();
                break;
            }
            case "getProductFavorite":{
                $this->outLineGetProductFavorite();
                break;
            }
             case "getProductOfUser":{
                $this->outLineGetProductOfUser();
                break;
            }
            case "getProductSwap":{
                $this->outLineGetProductSwap();
                break;
            }
            case "postUserFollowing":{
                $this->outLinePostUserFollowing();
                break;
            }
             case "unFollowing":{
                $this->outLineUnFollowing();
                break;
            }
            case "getUserFollowing":{
                $this->outLineGetUserFollowing();
                break;
            }
            case "getUserFollower":{
                $this->outLineGetUserFollower();
                break;
            }
             case "getUserByIDs":{
                $this->outLineGetUserByIDs();
                break;
            }
            case "postProductComment":{
                $this->outLinePostProductComment();
                break;
            }
            case "postAddress":{
                $this->outLinePostAddress();
                break;
            }   
            case "updateAddress":{
                $this->outLineUpdateAddress();
                break;
            }
            case "deleteAddress":{
                $this->outLineDeleteAddress();
                break;
            }
            case "postPaymentMethodBank":{
                $this->outLinePostPaymentMethodBank();
                break;
            }
            case "postPaymentMethodCMT":{
                $this->outLinePostPaymentMethodCMT();
                break;
            }
             case "getAddress":{
                $this->outLineGetAddress();
                break;
            }
             case "getPaymentMethod":{
                $this->outLineGetPaymentMethod();
                break;
            }
            case "getBank":{
                $this->outLineGetBank();
                break;
            }
            case "get123Bank":{
                $this->outLineGet123Bank();
                break;
            }
            case "getProvince":{
                $this->outLineGetProvince();
                break;
            }
            case "postTransaction":{
                $this->outLinePostTransaction();
                break;
            }
            case "updateAddressBuyer":{
                $this->outLineUpdateAddressBuyer();
                break;
            }
            case "updateAddressSeller":{
                $this->outLineUpdateAddressSeller();
                break;
            }
             case "updatePaymentType":{
                $this->outLineUpdatePaymentType();
                break;
            }
            case "cancelTransaction":{
                $this->outLineCancelTransaction();
                break;
            }
            case "getListTransactionSell":{
                $this->outLineGetListTransactionSell();
                break;
            }
            case "getListTransactionBuy":{
                $this->outLineGetListTransactionBuy();
                break;
            }
            case "getListTransactionSwap":{
                $this->outLineGetListTransactionSwap();
                break;
            }
            case "postProductReport":{
                $this->outLinePostProductReport();
                break;
            }
            case "postRateUser":{
                $this->outLinePostRateUser();
                break;
            }
            case "updateTransportSeller":{
                $this->outLineUpdateTransportSeller();
                break;
            }
            case "updateTransportBuyer":{
                $this->outLineUpdateTransportBuyer();
                break;
            }
             case "getShipPartner":{
                $this->outLineGetShipPartner();
                break;
            }
             case "getFeeShip":{
                $this->outLineGetFeeShip();
                break;
            }
             case "getProductFilter":{
                $this->outLineGetProductFilter();
                break;
            }
            case "searchProduct":{
                $this->outLineSearchProduct();
                break;
            }
             case "searchProductNearest":{
                $this->outLineSearchProductNearest();
                break;
            }
             case "registryNotice":{
                $this->outLineRegistryNotice();
                break;
            }
             case "getActivity":{
                $this->outLineGetActivity();
                break;
            }
              case "getDistrict":{
                $this->outLineGetDistrict();
                break;
            }
             case "GetServiceList":{
                $this->outLineGetServiceList();
                break;
            }
            case "CalculateServiceFees":{
                $this->outLineCalculateServiceFees();
                break;
            }
             case "deleteProductFavorite":{
                $this->outLineDeleteProductFavorite();
                break;
            }
             case "getUserByFacebookIDs":{
                $this->outLineGetUserByFacebookIDs();
                break;
            }
             case "deleteProduct":{
                $this->outLineDeleteProduct();
                break;
            }
             case "getMyOfferSell":{
                $this->outLineGetMyOfferSell();
                break;
            }   
             case "getMyOfferBuy":{
                $this->outLineGetMyOfferBuy();
                break;
            }
             case "getMyOfferSwap":{
                $this->outLineGetMyOfferSwap();
                break;
            }
             case "createOrder123Pay":{
                $this->outLineCreateOrder123Pay();
                break;
            }
              case "updateMobileUser":{
                $this->outLineUpdateMobileUser();
                break;
            }
            case "getTransactionDetail":{
                $this->outLineGetTransactionDetail();
                break;
            }
             case "validateMobile":{
                $this->outLineValidateMobile();
                break;
            }  
             case "revalidateValidateMobile":{
                $this->outLineRevalidateValidateMobile();
                break;
            }
             case "getProductRecomment":{
                $this->outLineGetProductRecomment();
                break;
            }
             case "getProductInfo":{
                $this->outLineGetProductInfo();
                break;
            } 
            case "getProductSwapMatching":{
                $this->outLineGetProductSwapMatching();
                break;
            }     
            case "updateTagSwapProduct":{
                $this->outLineUpdateTagSwapProduct();
                break;
            }  
             case "getProductSwapMatchingNext":{
                $this->outLineGetProductSwapMatchingNext();
                break;
            }
             case "getEventTop":{
                $this->outLineGetEventTop();
                break;
            } 
             case "getInformDetail":{
                $this->outLineGetInformDetail();
                break;
            }
             case "getItemSwapMatching":{
                $this->outLineGetItemSwapMatching();
                break;
            }
            case "reSellProduct":{
                $this->outLineReSellProduct();
                break;
            }
            
        }
    }
    
    function outLineGetCategory(){
        echo "<h1>Function: getCategory</h1>";
        echo "<i>Lấy danh sách danh mục sản phẩm</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getCategory</LI>";
         echo "<LI>Tham số:<br/> 
        cate_parent_id: id category cha;<br/> 
        </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getCategory&app_client_id=1&cate_parent_id=0&token=".$this->token."' target='_blank'>getCategory</a></span>";
        
    }
    
    function outLineGetCategoryAll(){
        echo "<h1>Function: getCategoryAll</h1>";
        echo "<i>Lấy danh sách danh mục sản phẩm</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getCategoryAll</LI>";
        echo "<LI>Tham số:<br/> 
        </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getCategoryAll&app_client_id=1&token=".$this->token."' target='_blank'>getCategoryAll</a></span>";
        
    }
    
  
    
    function outLineGetProductHome(){
        echo "<h1>Function: getProductHome</h1>";
        echo "<i>Lấy danh sách Sản phẩm tại trang chủ </i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getProductHome</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProductHome&app_client_id=1&token=".$this->token."' target='_blank'>getProductHome</a></span>";
        
    }
    
     function outLineGetProductCate(){
        echo "<h1>Function: getProductCate</h1>";
        echo "<i>Lấy danh sách Sản phẩm tại danh mục</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getProductCate</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        cate_id: id danh mục đồ cho trao đổi;<br/> 
        page: số trang;<br/>
        </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProductCate&app_client_id=1&cate_id=1&page=1&token=".$this->token."' target='_blank'>getProductCate</a></span>";
        
    }
    
  
    
    function outLineGetProductFormUserFollowing(){
        echo "<h1>Function: getProductFollowing</h1>";
        echo "<i>Lấy danh sách sản phẩm từ người bạn theo dõi</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getProductFollowing</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/> 
        page: số trang;<br/>" ;
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProductFollowing&app_client_id=1&user_id=1&page=1&token=".$this->token."' target='_blank'>getProductFollowing</a></span>";
    }
    
    function outLineGetProductFavorite(){
        echo "<h1>Function: getProductFavorite</h1>";
        echo "<i>Lấy danh sách sản phẩm bạn yêu thích bookmark</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getProductFavorite</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/> 
        page: số trang;<br/>" ;
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProductFavorite&app_client_id=1&user_id=1&page=1&token=".$this->token."' target='_blank'>getProductFavorite</a></span>";
    }
    
    function outLineGetProductDetail(){
        echo "<h1>Function: getProductDetail</h1>";
        echo "<i>Thông tin chi tiết sản phẩm và transaction nếu có của người mua</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getProductDetail</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        product_id: id product;<br/> 
        user_id: id của member login;<br/> 
        </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProductDetail&app_client_id=1&product_id=1&token=".$this->token."' target='_blank'>getProductDetail</a></span>";
        
    }
    function outLineGetTransactionByProduct(){
        echo "<h1>Function: getTransactionByProduct</h1>";
        echo "<i>Danh sách giao dich hiện tại của sp</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getTransactionByProduct</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        product_id: id product;<br/> 
        user_id: id của member login;<br/> 
        </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getTransactionByProduct&app_client_id=1&product_id=1&user_id=1&token=".$this->token."' target='_blank'>getTransactionByProduct</a></span>";
        
    }
    
    function outLineGetTransactionDetail(){
        echo "<h1>Function: getTransactionDetail</h1>";
        echo "<i>Thông tin chi tiết giao dịch</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getTransactionDetail</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        transaction_id: id transaction;<br/> 
        </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getTransactionDetail&app_client_id=1&transaction_id=1&token=".$this->token."' target='_blank'>getTransactionDetail</a></span>";
        
    }
    
    function outLineGetProductComment(){
        echo "<h1>Function: getProductComment</h1>";
        echo "<i>Ds comment của sản phẩm</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getProductComment</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        product_id: id product;<br/> 
        page: số trang;<br/> 
        </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProductComment&app_client_id=1&product_id=1&page=1&token=".$this->token."' target='_blank'>getProductComment</a></span>";
        
    }
    
    
    function outLineGetProductSameCate(){
        echo "<h1>Function: getProductSameCate</h1>";
        echo "<i>Danh sách sản phẩm cùng chủng loại</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getProductSameCate</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        product_id: id product;<br/> 
        cate_id: id product;<br/> 
        </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProductSameCate&app_client_id=1&product_id=1&cate_id=1&token=".$this->token."' target='_blank'>getProductSameCate</a></span>";
        
    }
    
    function outLineGetProductByIDs(){
        echo "<h1>Function: getProductByIDs</h1>";
        echo "<i>Danh sách sản phẩm theo ids</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getProductByIDs</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        product_ids: id product;<br/> 
        </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProductByIDs&app_client_id=1&product_ids=1&token=".$this->token."' target='_blank'>getProductByIDs</a></span>";
        
    }
   
   
    function outLinePostProduct(){
        echo "<h1>Function: postProduct</h1>";
        echo "<i>Post đồ </i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: postProduct</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        title: Tiêu đề sp;<br/> 
        user_id: id của user;<br/> 
        cate_id: id product;<br/> 
        description: mô tả sản phẩm;<br/> 
        price: giá bán;<br/> 
        use_status: trạng thái sử dụng 1-Moi 2-Cu;<br/> 
        quantity: Số lượng sp;<br/>
        image: Danh sach image cach dau boi dau ',' ;<br/>
        lng: Kinh độ ;<br/>
        lat: Vĩ độ ;<br/>
        weight: Trọng lượng ;<br/>
        length: Độ dài ;<br/>
        width: Độ rộng ;<br/>
        height: Chiều cao ;<br/>
        create_user: Tên người post ;<br/>
        wish_swap: danh sách sản phâm muốn trao đổi cách dâu bởi dấu ','  vd: iphone,samsung ;<br/>
        address: Địa chỉ<br/>
        province_code: Mã tỉnh<br/>
        city_code: Mã thành phố<br/>
        type_sell: 1: Only sell, 2: Only Swap, 3: sell & swap<br/>    
        </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=postProduct&app_client_id=1&token=".$this->token."' target='_blank'>postProduct</a></span>";
        
    }
    
    function outLineUpdateProduct(){
        echo "<h1>Function: updateProduct</h1>";
        echo "<i>update thông tin đồ </i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: updateProduct</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        title: Tiêu đề sp;<br/> 
        id: id của product;<br/> 
        cate_id: id product;<br/> 
        description: mô tả sản phẩm;<br/> 
        price: giá bán;<br/> 
        use_status: trạng thái sử dụng 1-Moi 2-Cu;<br/> 
        quantity: Số lượng sp;<br/>
        image: Danh sach image cach dau boi dau ',' ;<br/>
        lng: Kinh độ ;<br/>
        lat: Vĩ độ ;<br/>
        weight: Trọng lượng ;<br/>
        length: Độ dài ;<br/>
        width: Độ rộng ;<br/>
        height: Chiều cao ;<br/>
        create_user: Tên người post ;<br/>
        wish_swap: danh sách sản phâm muốn trao đổi cách dâu bởi dấu ','  vd: iphone,samsung ;<br/>
        address: Địa chỉ<br/>
        province_code: Mã tỉnh<br/>
        city_code: Mã thành phố<br/>
        type_sell: 1: Only sell, 2: Only Swap, 3: sell & swap<br/>    
        </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=updateProduct&app_client_id=1&token=".$this->token."' target='_blank'>updateProduct</a></span>";
        
    }
    
     function outLinePostProductFavorite(){
        echo "<h1>Function: postProductFavorite</h1>";
        echo "<i>Post đồ yêu thích bookmark </i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: postProductFavorite</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id của user;<br/> 
        product_id: id product;<br/> 
        </LI>";
        echo "<LI>Kết quả:<br/> 
        0: Thành công<br/> 
        1: Thiếu tham số<br/> 
        2: Lỗi<br/> 
        </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=postProductFavorite&app_client_id=1&token=".$this->token."' target='_blank'>postProductFavorite</a></span>";
        
    }
    
       function outLineGetProductByDistance(){
        echo "<h1>Function: getProductByDistance</h1>";
        echo "<i>Lấy sản phẩm theo khoảng cách và vị trí</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getProductByDistance</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        lon: kinh độ<br/> 
        lat: vĩ độ<br/> 
        distance: khoảng cách theo KM<br/> 
        page: số trang<br/> 
        </LI>";
        echo "<LI>Kết quả:<br/> 
        Danh sách sản phẩm trong khoảng cách<br/> 
      </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProductByDistance&app_client_id=1&lon=105.7977287&lat=21.0349886&token=".$this->token."' target='_blank'>getProductByDistance</a></span>";
        
    }
    
    function outLineGetProductByDistanceFT(){
        echo "<h1>Function: getProductByDistanceFT</h1>";
        echo "<i>Lấy sản phẩm theo khoảng cách và vị trí</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getProductByDistanceFT</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        lon: kinh độ<br/> 
        lat: vĩ độ<br/> 
        distanceF: khoảng cách theo KM<br/> 
        distanceT: khoảng cách theo KM<br/> 
        page: số trang<br/> 
        </LI>";
        echo "<LI>Kết quả:<br/> 
        Danh sách sản phẩm trong khoảng cách<br/> 
      </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProductByDistanceFT&app_client_id=1&lon=105.7977287&lat=21.0349886&distanceF=5&distanceT=10&token=".$this->token."' target='_blank'>getProductByDistanceFT</a></span>";
        
    }
    
    
    function outLineUploadImageProduct(){
        echo "<h1>Function: uploadImageProduct</h1>";
        echo "<i>Upload 1 hình ảnh của sp</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: uploadImageProduct</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        upfile: file upload;<br/> 
        user_id: id người post<br/> 
        product_id: id của sản phẩm, băng 0 nếu là sản phẩm mới<br/> 
        </LI>";
         echo "<LI>Kêt quả mảng gồm: result:  0- Thành công,  1- Thiếu tham số, 2- File not found, 3- Size quá dung lượng, 4- File upload fail, 5- Sai loai file <br/> image: Tên file up lên</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=uploadImageProduct&app_client_id=1&token=".$this->token."' target='_blank'>uploadImageProduct</a></span>";
        
    }
    
     function outLineUploadAvatarUser(){
        echo "<h1>Function: uploadAvatarUser</h1>";
        echo "<i>Upload avatar của user</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: uploadAvatarUser</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        upfile: file upload;<br/> 
        user_id: id người post<br/> 
        </LI>";
         echo "<LI>Kêt quả mảng gồm: result:  0- Thành công,  1- Không thành công</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=uploadAvatarUser&app_client_id=1&token=".$this->token."' target='_blank'>uploadAvatarUser</a></span>";
        
    }
    
    function outLineGetAppHeaderShop(){
        echo "<h1>Function: getAppHeaderShop</h1>";
        echo "<i>Lấy app header của ứng dụng</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getAppHeaderShop</LI>";
        echo "<LI>method: get</LI>";
        echo "<LI>Tham số: app_header: Mã app header;<br/> app_client_id: id app clien, lần đầu vào app là 0, sau lây app_client_id API trả về;<br/> os_version: version hệ điều hành;<br/>imei: số imei máy client</LI>";
        echo "<LI>Kết quả: Lấy app header của ứng dụng</LI>";
        echo "</UL>";
        echo "<span>Ví dụ IOS: <a href='".$this->url_api."?action=getAppHeaderShop&app_header=SHOP-MARKET-IOS&app_client_id=1&os_version=3&imei=1&token=".$this->token."' target='_blank'>getAppHeaderShop</a></span>";
        echo "<span>Ví dụ APK: <a href='".$this->url_api."?action=getAppHeaderShop&app_header=SHOP-MARKET-APK&app_client_id=1&os_version=2&imei=1&token=".$this->token."' target='_blank'>getAppHeaderShop</a></span>";
    }
    
     function outLineRegisterMember(){
        echo "<h1>Function: registerMember</h1>";
        echo "<i>Đăng kí thành viên </i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: registerMember</LI>";
        echo "<LI>method: post</LI>";
        echo "<LI>Tham số:<br/> app_client_id: ID app client;<br/> 
        fullname: Họ và Tên thành viên;<br/> 
        email: Địa chỉ email;<br/>
        sex: Giới tính 1: Nam, 0: Nữ;<br/>
        birthday: Ngày sinh dạng dd/mm/yyyy;<br/>
        sso_id: ID Facebook hoặc ID Google Plus;<br/>
        mobile: Số điện thoại;<br/>
        lat: Vĩ độ;<br/>
        lng: Kinh độ;<br/>
        </LI>";
        echo "<LI>Kết quả:<br/> Kết quả đăng kí thành viên gồm 3 thuộc tính result: 0: thành công; 1: thiếu tham số, 2: đăng kí không thành công, 3: sai định dạng email <br/> isNewUser: 1: thành viên mới upload avatar lên; 0: không phải thành viên mới; <br/>
        user: Mảng thông tin user </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=registerMember&app_client_id=1&token=".$this->token."' target='_blank'>registerMember</a></span>";
    }
    
    function outLineGetUserInfo(){
        echo "<h1>Function: getUserInfo</h1>";
        echo "<i>Lấy thông tin người dùng</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getUserInfo</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/> 
        </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getUserInfo&app_client_id=1&user_id=1&token=".$this->token."' target='_blank'>getUserInfo</a></span>";
        
    }
    
     function outLineGetSeller(){
        echo "<h1>Function: getSeller</h1>";
        echo "<i>Lấy thông tin người bán</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getSeller</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user login;<br/> 
        seller_id: id người bán;<br/> 
        </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getSeller&app_client_id=1&user_id=1&seller_id=2&token=".$this->token."' target='_blank'>getUserInfo</a></span>";
        
    }
    
    function outLineUpdateUserInfo(){
        echo "<h1>Function: updateUserInfo</h1>";
        echo "<i>Cập nhật thông tin người dùng</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: updateUserInfo</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/> 
        fullname: id user;<br/> 
        birthday: Ngày sinh nhật yyyy-mm-dd;<br/> 
        city: Thành phố;<br/> 
        country: Quốc Gia;<br/> 
        address: Địa chỉ;<br/> 
        </LI>";
        echo "<LI>Kết Quả:<br/> 
        0: Thành công;<br/> 
        1: Thiếu tham số;<br/> 
        2: Lỗi update;<br/> 
        </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=updateUserInfo&app_client_id=1&token=".$this->token."' target='_blank'>updateUserInfo</a></span>";
        
    }
    
    function outLineGetProductOfUser(){
        echo "<h1>Function: getProductOfUser</h1>";
        echo "<i>Lấy danh sách Sản phẩm của user</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getProductOfUser</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/> 
        page: số trang;<br/>
        </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProductOfUser&app_client_id=1&user_id=1&page=1&token=".$this->token."' target='_blank'>getProductOfUser</a></span>";
        
    }
    
     function outLineGetProductSwap(){
        echo "<h1>Function: getProductSwap</h1>";
        echo "<i>Lấy danh sách Sản phẩm của user để trao đổi</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getProductSwap</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/> 
        <br/>
        </LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProductSwap&app_client_id=1&user_id=1&token=".$this->token."' target='_blank'>getProductSwap</a></span>";
        
    }
    
     function outLinePostUserFollowing(){
        echo "<h1>Function: postUserFollowing</h1>";
        echo "<i>Post User mình muốn theo dõi</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: postUserFollowing</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/> 
        user_following_id: id người cần theo dõi;<br/>" ;
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
        0: Thành công<br/> 
        1: Thiếu tham số;<br/>
        2: Lỗi<br/>" ;
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=postUserFollowing&app_client_id=1&token=".$this->token."' target='_blank'>postUserFollowing</a></span>";
    }
    
    function outLineUnFollowing(){
        echo "<h1>Function: unFollowing</h1>";
        echo "<i>Bỏ theo dõi 1 user</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: unFollowing</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/> 
        user_following_id: id người cần theo dõi;<br/>" ;
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
        0: Thành công<br/> 
        1: Thiếu tham số;<br/>
        2: Lỗi<br/>" ;
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=unFollowing&app_client_id=1&token=".$this->token."' target='_blank'>unFollowing</a></span>";
    }
    
     function outLineGetUserFollowing(){
        echo "<h1>Function: getUserFollowing</h1>";
        echo "<i>Lấy danh sách user mình đang theo dõi</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getUserFollowing</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/> 
        page: so trang;<br/> " ;
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getUserFollowing&app_client_id=1&user_id=1&token=".$this->token."' target='_blank'>getUserFollowing</a></span>";
    }
    
    function outLineGetUserFollower(){
        echo "<h1>Function: getUserFollower</h1>";
        echo "<i>Lấy danh sách user đanh theo dõi mình</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getUserFollowing</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/>
        page: so trang;<br/> " ;
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getUserFollower&app_client_id=1&user_id=1&token=".$this->token."' target='_blank'>getUserFollower</a></span>";
    }
    
     function outLineGetUserByIDs(){
        echo "<h1>Function: getUserByIDs</h1>";
        echo "<i>Lấy danh sách user theo ids</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getUserByIDs</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        user_ids: danh sách id user bằng dấu , <br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getUserByIDs&app_client_id=1&user_ids=1&token=".$this->token."' target='_blank'>getUserByIDs</a></span>";
    }
    
     function outLinePostProductComment(){
        echo "<h1>Function: postProductComment</h1>";
        echo "<i>Thêm 1 nhận sét về sản phẩm</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: postProductComment</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/> 
        product_id: id sản phẩm<br/>
        comment: Nôi dung comment<br/> 
        create_user: Tên người comment<br/> " ;
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
        0: Thành công<br/> 
        1: Thiếu tham số;<br/>
        2: Lỗi<br/>" ;
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=postProductComment&app_client_id=1&token=".$this->token."' target='_blank'>postProductComment</a></span>";
    }
     
    function outLinePostAddress(){
        echo "<h1>Function: postAddress</h1>";
        echo "<i>Thêm thông tin địa chỉ nhận hàng</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: postAddress</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/> 
        address_user: tên người nhận<br/>
        province:mã tỉnh<br/> 
        city:mã thành phố, quận huyện<br/> 
        address: số nhà đường số<br/> 
        tel: số điện thoại người nhận<br/> 
        create_user: người cập nhật<br/> " ;
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
        0: Thành công<br/> 
        1: Thiếu tham số;<br/>
        2: Lỗi<br/>" ;
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=postAddress&app_client_id=1&token=".$this->token."' target='_blank'>postAddress</a></span>";
    }
    function outLineUpdateAddress(){
        echo "<h1>Function: updateAddress</h1>";
        echo "<i>Cập nhật thông tin địa chỉ nhận hàng</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: updateAddress</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        address_id: id địa chỉ;<br/> 
        address_user: tên người nhận<br/>
        province:mã tỉnh<br/> 
        city:mã thành phố, quận huyện<br/> 
        address: số nhà đường số<br/> 
        tel: số điện thoại người nhận<br/> 
        create_user: người cập nhật<br/> " ;
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
        0: Thành công<br/> 
        1: Thiếu tham số;<br/>
        2: Lỗi<br/>" ;
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=updateAddress&app_client_id=1&token=".$this->token."' target='_blank'>updateAddress</a></span>";
    }
    
    function outLineDeleteAddress(){
        echo "<h1>Function: deleteAddress</h1>";
        echo "<i>Xóa thông tin địa chỉ nhận hàng</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: deleteAddress</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        address_id: id địa chỉ;<br/> 
        user_id: id user login<br/>";
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
        0: Thành công<br/> 
        1: Thiếu tham số;<br/>
        2: Lỗi<br/>" ;
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=deleteAddress&app_client_id=1&token=".$this->token."' target='_blank'>deleteAddress</a></span>";
    }
   
    function outLinePostPaymentMethodBank(){
        echo "<h1>Function: postPaymentMethodBank</h1>";
        echo "<i>Thêm phương thức thanh toán bằng thẻ ngân hàng</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: postPaymentMethodBank</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/> 
        bank_name: Tên ngân hàng<br/>
        bank_branch: Tên chi nhánh ngân hàng<br/> 
        account_name: Tên Chủ thẻ<br/> 
        account_id: Số tài khoản<br/> ";
        
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
        0: Thành công<br/> 
        1: Thiếu tham số;<br/>
        2: Lỗi<br/>" ;
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=postPaymentMethodBank&app_client_id=1&token=".$this->token."' target='_blank'>postPaymentMethodBank</a></span>";
    }
    
    //$user_id,$bank_name,$bank_branch,$receiver,$id_number,$id_date,$id_place
      function outLinePostPaymentMethodCMT(){
        echo "<h1>Function: postPaymentMethodCMT</h1>";
        echo "<i>Thêm thông tin địa chỉ nhận hàng</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: postPaymentMethodCMT</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/> 
        bank_name: Tên ngân hàng<br/>
        bank_branch: Tên chi nhánh<br/> 
        receiver: Người nhận<br/> 
        id_number: Số chứng minh thư người nhận<br/> 
        id_date: Ngày cấp CMT<br/> 
        id_place: Nơi cấp CMT<br/> " ;
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
        0: Thành công<br/> 
        1: Thiếu tham số;<br/>
        2: Lỗi<br/>" ;
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=postPaymentMethodCMT&app_client_id=1&token=".$this->token."' target='_blank'>postPaymentMethodCMT</a></span>";
    }
    
    function outLineGetAddress(){
        echo "<h1>Function: getAddress</h1>";
        echo "<i>Lấy thông tin địa chỉ khách hàng</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getAddress</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/> " ;
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
          Danh sách địa chỉ";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getAddress&user_id=6&app_client_id=1&token=".$this->token."' target='_blank'>getAddress</a></span>";
    }
    
     function outLineGetPaymentMethod(){
        echo "<h1>Function: getPaymentMethod</h1>";
        echo "<i>Lấy thông tin danh sách hình thức thanh toán, có 2 loại 1, và 2</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getPaymentMethod</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/> " ;
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
          Danh sách loại hình thanh toán:<br/>
          1-Qua tài khoản ngân hàng<br/>
          2-Qua chứng minh thư<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getPaymentMethod&user_id=6&app_client_id=1&token=".$this->token."' target='_blank'>getPaymentMethod</a></span>";
    }
    
    function outLineGetBank(){
        echo "<h1>Function: getBank</h1>";
        echo "<i>Lấy danh sách ngân hàng</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getBank</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/> " ;
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
          Danh sách ngân hàng<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getBank&user_id=6&app_client_id=1&token=".$this->token."' target='_blank'>getBank</a></span>";
    }
    
     function outLineGet123Bank(){
        echo "<h1>Function: get123Bank</h1>";
        echo "<i>Lấy danh sách ngân hàng theo 123Pay</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: get123Bank</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> ";
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
          Danh sách ngân hàng<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=get123Bank&app_client_id=1&token=".$this->token."' target='_blank'>get123Bank</a></span>";
    }
    
    function outLineGetProvince(){
        echo "<h1>Function: getProvince</h1>";
        echo "<i>Lấy danh sách tỉnh thành</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getProvince</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/> " ;
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
          Danh sách tỉnh thành<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProvince&user_id=6&app_client_id=1&token=".$this->token."' target='_blank'>getProvince</a></span>";
    }
    
    function outLineGetListTransactionSell(){
        echo "<h1>Function: getListTransactionSell</h1>";
        echo "<i>Lây danh sách transaction bán</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getListTransactionSell</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/>  
        page: số page;<br/> " ;
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
          Danh sách giao dịch<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getListTransactionSell&user_id=6&page=1&app_client_id=1&token=".$this->token."' target='_blank'>getListTransactionSell</a></span>";
    }
    
    function outLineGetListTransactionBuy(){
        echo "<h1>Function: getListTransactionBuy</h1>";
        echo "<i>Lây danh sách transaction mua</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getListTransactionBuy</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/>  
        page: số page;<br/> " ;
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
          Danh sách giao dịch<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getListTransactionBuy&user_id=6&page=1&app_client_id=1&token=".$this->token."' target='_blank'>getListTransactionBuy</a></span>";
    }
    
    
    function outLineGetListTransactionSwap(){
        echo "<h1>Function: getListTransactionSwap</h1>";
        echo "<i>Lây danh sách transaction trao đổi</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getListTransactionSwap</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>Tham số:<br/> 
        user_id: id user;<br/>  
        page: số page;<br/> " ;
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
          Danh sách giao dịch<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getListTransactionSwap&user_id=6&page=1&app_client_id=1&token=".$this->token."' target='_blank'>getListTransactionSwap</a></span>";
    }
    
     function outLineCancelTransaction(){
        echo "<h1>Function: cancelTransaction</h1>";
        echo "<i>Hủy 1 giao dich</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: cancelTransaction</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        transaction_id: id transaction;<br/>  
        user_id: id user;<br/> 
        note: ghi chú;<br/> " ;
        echo "</LI>";
        echo "<LI>Kết quả: đối tượng json với 2 thuộc tính<br/> 
         result: 0:Thành công; 1: Thiếu tham số;2: Lỗi<br/>
         error: thông báo lỗi<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=cancelTransaction&app_client_id=1&token=".$this->token."' target='_blank'>cancelTransaction</a></span>";
    }
    
    
    function outLineUpdateAddressSeller(){
        echo "<h1>Function: updateAddressSeller</h1>";
        echo "<i>Cập nhật lại địa chỉ người được đề nghị trao đổi</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: updateAddressSeller</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        transaction_id: id transaction;<br/>  
        user_id: id người thay đổi thông tin;<br/>  
        address_seller: địa chỉ người dc đề nghị trao đổi là base64 của chuỗi Json JSON như sau:<br/>
        {\"fullname\":\"Tran The Thang\",\"tel\":\"0974838181\",\"address\":\"10/51 Duong Bai TP Nam Dinh Tinh Nam Dinh\"}<br/> ";
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
         0:Thành công; 1: Thiếu tham số;2: Lỗi<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=updateAddressSeller&app_client_id=1&token=".$this->token."' target='_blank'>updateAddressSeller</a></span>";
    } 
    
    function outLineUpdateAddressBuyer(){
        echo "<h1>Function: updateAddressBuyer</h1>";
        echo "<i>Cập nhật lại địa chỉ người mua hay người muốn được trao đổi</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: updateAddressBuyer</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        transaction_id: id transaction;<br/>  
        user_id: id người thay đổi thông tin;<br/>  
        address_buyer: địa chỉ người dc đề nghị trao đổi là base64 của chuỗi Json  như sau:<br/>
        {\"fullname\":\"Tran The Thang\",\"tel\":\"0974838181\",\"address\":\"10/51 Duong Bai TP Nam Dinh Tinh Nam Dinh\"}<br/> ";
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
         0:Thành công; 1: Thiếu tham số;2: Lỗi<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=updateAddressBuyer&app_client_id=1&token=".$this->token."' target='_blank'>updateAddressBuyer</a></span>";
    }
    
    function outLineUpdatePaymentType(){
        echo "<h1>Function: updatePaymentType</h1>";
        echo "<i>Người mua hay người phải trả giáo chênh trong trao đổi Cập nhật hình thức thanh toán</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: updatePaymentType</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        transaction_id: id transaction;<br/>  
        user_id: id người thay đổi thông tin;<br/>  
        pay_type: 1: Truc Tiep 2 nguoi, 2: App COD, 3: App Bank<br/> 
        fee_transport: Phí vận chuyển;<br/>  
        transport_by: Đơn vị vận chuyển;<br/> 
        transport_service: Dich vụ vận chuyển;<br/>  ";
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
         0:Thành công; 1: Thiếu tham số;2: Lỗi<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=updatePaymentType&app_client_id=1&token=".$this->token."' target='_blank'>updatePaymentType</a></span>";
    }
    
    function outLinePostTransaction(){
        echo "<h1>Function: postTransaction</h1>";
        echo "<i>Tạo 1 giao dịch qua APP</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: postTransaction</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        seller_id: ID người bán, hoặc người được đề nghị trao đổi<br/>  
        buyer_id: ID người mua, hoặc người muốn trao đổi<br/>  
        address_seller: địa chi người bán,hoặc người được đề nghị trao đổi<br/> là base64 của chuỗi Json như sau: <br/>
        {\"fullname\":\"Tran The Thang\",\"tel\":\"0974838181\",\"address\":\"10/51 Duong Bai TP Nam Dinh Tinh Nam Dinh\"}<br/> 
        address_buyer: địa chỉ người mua, hoặc người muốn trao đổi<br/> là base64 của chuỗi Json như sau: <br/>
        {\"fullname\":\"Tran The Thang\",\"tel\":\"0974838181\",\"address\":\"10/51 Duong Bai TP Nam Dinh Tinh Nam Dinh\"}<br/> 
        transaction_type: loại giao dịch 1: bán, 2: trao đổi đồ<br/>  
        pay_type: hình thức thanh toán 1: Truc Tiep 2 nguoi, 2: App COD, 3: App Bank<br/> 
        fee_product: giá sản phẩm hoặc giá chênh lệch<br/>  
        fee_transport_seller: Phí vận chuyển người được đề nghị trao đôi phải chịu<br/>  
        fee_transport_buyer: Phí vận chuyên người mua hoặc người muốn trao đổi phải chịu<br/> 
        promotion_code: mã giảm giá<br/>
        products: danh sách sản phẩm là base64 của chuỗi json như sau<br/> [{\"product_id\":12,\"quantity\":1},{\"product_id\":122,\"quantity\":1}]<br/>product_offer_id
        quantity: Tổng số lượng sản phẩm của đơn hàng<br/>
        transport_buyer_by: Đơn vị vận chuyển<br/>
        transport_buyer_service: Dich vụ vận chuyển<br/>
        product_id: ID product phát sinh giao dịch (của người bán)<br/>";
        
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
         -kq: 0:Thành công; 1: Thiếu tham số; 2: Lỗi<br/>
         -message: thông báo<br/>
         -id: id của transaction tạo thành công<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=postTransaction&app_client_id=1&token=".$this->token."' target='_blank'>postTransaction</a></span>";
    }
    
    function outLinePostProductReport(){
        echo "<h1>Function: postProductReport</h1>";
        echo "<i>Post report sản phẩm</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: postProductReport</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        reason: 1: hình sản phẩm không dc rõ,2: Hình ảnh mang tính chính trị sexy,3: Không liên lạc dc với người đăng,4:Sản phẩm có dấu hiệu lừa đảo, 5: Người bán hay làm phiền tôi;<br/>  
        note: Ghi chú khác<br/>  
        create_user_id: ID người gửi <br/> 
        product_id: ID của sản phẩm <br/>";
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
         0:Thành công; 1: Thiếu tham số;2: Lỗi<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=postProductReport&app_client_id=1&token=".$this->token."' target='_blank'>postProductReport</a></span>";
    }
    
     function outLinePostRateUser(){
        echo "<h1>Function: postRateUser</h1>";
        echo "<i>Post đánh giá người bán, người mua</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: postRateUser</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        status: 1: Tôt,2: Bình Thường,3: Tồi;<br/>  
        comment: Ghi chú khác<br/>  
        user_id: ID người được đánh giá <br/>     
        valuer_id: ID người đánh giá <br/> 
        transaction_id: ID giao dich <br/> ";   
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
         0:Thành công; 1: Thiếu tham số;2: Lỗi<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=postRateUser&app_client_id=1&token=".$this->token."' target='_blank'>postRateUser</a></span>";
    }
    
    function outLineUpdateTransportSeller(){
        echo "<h1>Function: updateTransportSeller</h1>";
        echo "<i>Cập nhật thông tin đơn vị giao hàng và  chi phí giao hàng của người bán, người đc đề nghị trao đổi</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: updateTransportSeller</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        transaction_id: ID transaction<br/>  
        transport_seller_by: Đơn vị vận chuyển<br/>  
        user_id: ID người thay đổi <br/> 
        fee_transport_seller: Phí vận chuyển <br/> ";
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
         0:Thành công; 1: Thiếu tham số;2: Lỗi<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=updateTransportSeller&app_client_id=1&token=".$this->token."' target='_blank'>updateTransportSeller</a></span>";
    }
    
    function outLineUpdateTransportBuyer(){
        echo "<h1>Function: updateTransportBuyer</h1>";
        echo "<i>Cập nhật thông tin đơn vị giao hàng và  chi phí giao hàng của người mua</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: updateTransportSeller</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        transaction_id: ID transaction<br/>  
        transport_buyer_by: Đơn vị vận chuyển<br/>  
        user_id: ID người thay đổi <br/> 
        fee_transport_buyer: Phí vận chuyển <br/> ";
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
         0:Thành công; 1: Thiếu tham số;2: Lỗi<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=updateTransportBuyer&app_client_id=1&token=".$this->token."' target='_blank'>updateTransportBuyer</a></span>";
    }
    
     function outLineGetShipPartner(){
        echo "<h1>Function: updateTransportBuyer</h1>";
        echo "<i>Danh sach đơn vị vận chuyển hàng</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: outLineGetShipPartner</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> ";
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
         Danh sach đơn vị vận chuyên<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getShipPartner&app_client_id=1&token=".$this->token."' target='_blank'>getShipPartner</a></span>";
    }
    
     function outLineGetFeeShip(){
        echo "<h1>Function: getFeeShip</h1>";
        echo "<i>Lây giá tiên Ship</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getFeeShip</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
        spCode: Mã đơn vị partner ship<br/>";
        echo "</LI>";
        echo "<LI>Kết quả:<br/> 
         là một mảng với 2 giá trị:<br> result:1 thiếu tham số, 0 thành công 
         <br> fee: giá tiền tính được<br/>";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getFeeShip&app_client_id=1&token=".$this->token."' target='_blank'>getFeeShip</a></span>";
    }
    
    function outLineGetProductFilter(){
        echo "<h1>Function: getProductFilter</h1>";
        echo "<i>Lấy danh sách sp theo filter</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getProductFilter</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
            cat_id: id danh mục <br/>
            price_from: mức gia từ <br/>
            price_to: mức giá tới <br/>
            lon: kinh độ  <br/>
            lat: vĩ độ <br/>
            distance: khoảng cách <br/>
            order_by: 1: giá từ thấp tới cao, 2: giá từ cao xuống thấp, 3 Theo mới nhất <br/>
            page: số trang <br/>";
            echo "</LI>";
            echo "<LI>Kết quả:<br/> 
             Danh sách sản phẩm";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProductFilter&app_client_id=1&token=".$this->token."' target='_blank'>getProductFilter</a></span>";
    }
    
    function outLineSearchProduct(){
        echo "<h1>Function: searchProduct</h1>";
        echo "<i>Tìm kiếm sản phẩm</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: searchProduct</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
            keyword: Từ khóa tìm kiếm <br/>
            cat_id: id danh mục <br/>
            price_from: mức gia từ <br/>
            price_to: mức giá tới <br/>
            lon: kinh độ  <br/>
            lat: vĩ độ <br/>
            distance: khoảng cách <br/>
            order_by:0: Theo Trending, 1: giá từ thấp tới cao, 2: giá từ cao xuống thấp, 3 Theo mới nhất,4 Gần bạn nhất <br/>
            page: số trang <br/>";
            echo "</LI>";
            echo "<LI>Kết quả:<br/> 
             Danh sách sản phẩm";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=searchProduct&app_client_id=1&token=".$this->token."' target='_blank'>searchProduct</a></span>";
    }
    
    function outLineSearchProductNearest(){
        echo "<h1>Function: searchProductNearest</h1>";
        echo "<i>Tìm kiếm sản phẩm gần mình nhất</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: searchProductNearest</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>Tham số:<br/> 
            keyword: Từ khóa tìm kiếm <br/>
            cat_id: id danh mục <br/>
            price_from: mức gia từ <br/>
            price_to: mức giá tới <br/>
            lon: kinh độ  <br/>
            lat: vĩ độ <br/>
            distance: khoảng cách <br/>
            page: số trang <br/>";
            echo "</LI>";
            echo "<LI>Kết quả:<br/> 
             Danh sách sản phẩm";
        echo "</LI></UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=searchProductNearest&app_client_id=1&token=".$this->token."' target='_blank'>searchProductNearest</a></span>";
    }
    
     function outLineRegistryNotice(){
        echo "<h1>Function: registryNotice</h1>";
        echo "<i>Đăng kí toke notify </i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: registryNotice</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>device_token: token sinh ra từ apple google</LI>";
        echo "<LI>os_type: Loai he dieu hanh </LI>";
        echo "<LI>user_id: Id của user </LI>";
        echo "<LI>Kết quả: 0: thành công, 1 : thiếu tham số, 2 : có lỗi insert</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=registryNotice&app_client_id=1&token=".$this->token."' target='_blank'>registryNotice</a></span>";
    }
    
    function outLineGetActivity(){
        echo "<h1>Function: getActivity</h1>";
        echo "<i>Lấy danh sách hoạt động </i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getActivity</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>user_id: Id của user </LI>";
        echo "<LI>Danh sách hoạt động</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getActivity&user_id=1&app_client_id=1&token=".$this->token."' target='_blank'>getActivity</a></span>";
    }
    
    function outLineGetMyOfferSell(){
        echo "<h1>Function: getMyOfferSell</h1>";
        echo "<i>Lấy danh sách offer bán hàng </i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getMyOfferSell</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>user_id: Id của user </LI>";
        echo "<LI>Danh sách hoạt động</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getMyOfferSell&user_id=14&app_client_id=1&token=".$this->token."' target='_blank'>getMyOfferSell</a></span>";
    }
    
    function outLineGetMyOfferBuy(){
        echo "<h1>Function: getMyOfferBuy</h1>";
        echo "<i>Lấy danh sách offer mua hàng </i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getMyOfferBuy</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>user_id: Id của user </LI>";
        echo "<LI>Danh sách hoạt động</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getMyOfferBuy&user_id=8&app_client_id=1&token=".$this->token."' target='_blank'>getMyOfferBuy</a></span>";
    }
    
      function outLineGetMyOfferSwap(){
        echo "<h1>Function: getMyOfferSwap</h1>";
        echo "<i>Lấy danh sách offer trao đổi đồ </i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getMyOfferSwap</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>user_id: Id của user </LI>";
        echo "<LI>Danh sách hoạt động</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getMyOfferSwap&user_id=8&app_client_id=1&token=".$this->token."' target='_blank'>getMyOfferSwap</a></span>";
    }
    
    function outLineGetDistrict(){
        echo "<h1>Function: getDistrict</h1>";
        echo "<i>Lấy danh sách quận huyện </i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getDistrict</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>province_id: ID của tỉnh thành</LI>";
        echo "<LI>Danh sách hoạt động</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getDistrict&province_id=0350&user_id=1&app_client_id=1&token=".$this->token."' target='_blank'>getDistrict</a></span>";
    }
    
     function outLineGetServiceList(){
        echo "<h1>Function: GetServiceList</h1>";
        echo "<i>Lấy danh sách dịch vụ theo địa bàn </i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: GetServiceList</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>fromDistrictCode: Code của quận huyện</LI>";
        echo "<LI>toDistrictCode: Code của quận huyện</LI>";
        echo "<LI>Danh sách dịch vụ</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api_ghn."?action=GetServiceList&fromDistrictCode=0201&toDistrictCode=0202&user_id=1&app_client_id=1&token=".$this->token."' target='_blank'>GetServiceList</a></span>";
    }
    
    function outLineCalculateServiceFees(){
        echo "<h1>Function: CalculateServiceFees</h1>";
        echo "<i>Tính giá vận chuyển của danh sách sản phảm </i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: CalculateServiceFees</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>fromDistrictCode: Code của quận huyện</LI>";
        echo "<LI>toDistrictCode: Code của quận huyện</LI>";
        echo "<LI>serviceID: Code của quận huyện</LI>";
        echo "<LI>product_ids: danh sách sản phầm cách nhau dấu , vd: 1,2,</LI>";
        echo "<LI>Danh sách dịch vụ giá dịch vụ</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api_ghn."?action=CalculateServiceFees&fromDistrictCode=0201&toDistrictCode=0202&user_id=1&app_client_id=1&token=".$this->token."' target='_blank'>CalculateServiceFees</a></span>";
    }
    
    function outLineDeleteProductFavorite(){
        echo "<h1>Function: deleteProductFavorite</h1>";
        echo "<i>Xóa product yêu thích </i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: deleteProductFavorite</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>product_id: Code của quận huyện</LI>";
        echo "<LI>user_id: Code của quận huyện</LI>";
        echo "<LI>Kết quả: 0 Thành công, 1: Thiếu tham số, 2: có lỗi</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=deleteProductFavorite&user_id=1&app_client_id=1&token=".$this->token."' target='_blank'>deleteProductFavorite</a></span>";
    }
    
    function outLineGetUserByFacebookIDs(){
        echo "<h1>Function: getUserByFacebookIDs</h1>";
        echo "<i>Lây danh sách user qua facebook_ids </i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: getUserByFacebookIDs</LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>fb_ids: Danh sách facebook IDs cách nhau bởi dấu,</LI>";
        echo "<LI>user_id: ID User</LI>";
        echo "<LI>Danh sách user</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getUserByFacebookIDs&user_id=1&app_client_id=1&token=".$this->token."' target='_blank'>getUserByFacebookIDs</a></span>";
    }
    
     function outLineDeleteProduct(){
        echo "<h1>Function: deleteProduct</h1>";
        echo "<i>Xóa sản phẩm theo user </i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action: deleteProduct</LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>product_id: ID sản phẩm</LI>";
        echo "<LI>user_id: ID User</LI>";
        echo "<LI>0: Thành công<br/>1: Thiếu tham số<br/>2: Không xóa dc sản phẩm<br>3: Sản phẩm đã có giao dịch không thể xóa<br/><br/></LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=deleteProduct&app_client_id=1&token=".$this->token."' target='_blank'>deleteProduct</a></span>";
    }
    
    function outLineCreateOrder123Pay(){
        echo "<h1>Function:createOrder123Pay </h1>";
        echo "<i>Tao order thanh toán qua 123Pay</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action:createOrder123Pay </LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>transactionID: ID của đơn hàng</LI>";
        echo "<LI>totalAmount: Tổng số tiền thanh toán gồm hàng hóa không bao gồm phí vận chuyển</LI>";
        echo "<LI>custName: Họ và Tên khách hàng thanh toán</LI>";
        echo "<LI>custGender: Gioi Tinh M: Nam F: Nữ U: Không có thông tin khách hàng</LI>";
        echo "<LI>description: Mô tả ví du: Thanh toan cho don hang so: ID, tai Traodoidi</LI>";
        echo "<LI>bankCode: Ma ngan hang tren 123Pay</LI>";
        echo "<LI>Redirect sang 123Pay để khách hàng thanh toán, thất bại view report tại web</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api_123pay."?action=createOrder123Pay&app_client_id=1&token=".$this->token."' target='_blank'>createOrder123Pay</a></span>";
    }
    
    function outLineUpdateMobileUser(){
        echo "<h1>Function:updateMobileUser </h1>";
        echo "<i>Update số mobile của user</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action:updateMobileUser </LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>user_id: id user</LI>";
        echo "<LI>mobile: số điên thoại</LI>";
        echo "<LI>mobile_view: 1: view call, 0: ẩn</LI>";
        echo "<LI>Trả về 1 mảng kết quả</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=updateMobileUser&app_client_id=1&token=".$this->token."' target='_blank'>updateMobileUser</a></span>";
    }
    
      function outLineValidateMobile(){
        echo "<h1>Function:validateMobile </h1>";
        echo "<i>xác nhận số điện thoại của thành viên</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action:validateMobile </LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>user_id: id user</LI>";
        echo "<LI>code: Mã xác nhận</LI>";
        echo "<LI>Trả về 1 mảng kết quả</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=validateMobile&app_client_id=1&token=".$this->token."' target='_blank'>validateMobile</a></span>";
    }
                     
     function outLineRevalidateValidateMobile(){
        echo "<h1>Function:revalidateValidateMobile </h1>";
        echo "<i>Yêu cầu gửi lại mã xác nhận</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action:revalidateValidateMobile </LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>user_id: id user</LI>";
        echo "<LI>Trả về 1 mảng kết quả</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=revalidateValidateMobile&app_client_id=1&token=".$this->token."' target='_blank'>revalidateValidateMobile</a></span>";
    }
    
    
    function outLineGetProductRecomment(){
        echo "<h1>Function:getProductRecomment </h1>";
        echo "<i>Lấy danh sách sản phẩm trao đổi mà khách hàng mong muốn</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action:getProductRecomment </LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>keyword: danh sách từ khóa cách nhau bằng dấu ,</LI>";
        echo "<LI>lat: Vĩ độ của user,</LI>";     
        echo "<LI>long: Kinh độ của user</LI>"; 
        echo "<LI>price: Giá của sản phẩm</LI>";
        echo "<LI>user_id: ID của người login</LI>";         
        echo "<LI>page: Số trang </LI>";     
        echo "<LI>Trả về 1 mảng kết quả</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProductRecomment&app_client_id=1&token=".$this->token."' target='_blank'>getProductRecomment</a></span>";
    }
    
    function outLineGetProductInfo(){
        echo "<h1>Function:getProductInfo </h1>";
        echo "<i>Trả về thông tin của sản phẩm</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action:getProductInfo </LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>product_id: ID của sản phẩm</LI>";         
        echo "<LI>Trả về thông tin sản phẩm</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProductInfo&product_id=1&app_client_id=1&token=".$this->token."' target='_blank'>getProductInfo</a></span>";
    }
    
     function outLineGetProductSwapMatching(){
        echo "<h1>Function:getProductSwapMatching </h1>";
        echo "<i>Lấy danh sách sản phẩm trao đổi của user ở trang chủ và danh sách sp matching theo yêu cầu.</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action:getProductSwapMatching </LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>user_id: ID của sản phẩm</LI>";         
        echo "<LI>Danh sách sản phẩm và sản phẩm matching được.</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProductSwapMatching&user_id=1&app_client_id=1&token=".$this->token."' target='_blank'>getProductSwapMatching</a></span>";
    }
    
    function outLineUpdateTagSwapProduct(){
        echo "<h1>Function:updateTagSwapProduct </h1>";
        echo "<i>Cập nhật Tag đồ muốn trao đổi của sản phẩm.</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action:updateTagSwapProduct </LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>product_id: ID của sản phẩm</LI>";         
        echo "<LI>wish_swap: Tag đồ muốn trao đổi</LI>";         
        echo "<LI>Kết quả: 0 Thành công<br> 1: Thiếu tham số<br/> 2: Có lỗi <br/></LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=updateTagSwapProduct&app_client_id=1&token=".$this->token."' target='_blank'>updateTagSwapProduct</a></span>";
    }
    
     function outLineGetProductSwapMatchingNext(){
        echo "<h1>Function:getProductSwapMatchingNext </h1>";
        echo "<i>Lấy danh sách sản phẩm có thể trao đổi tiếp.</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action:getProductSwapMatchingNext </LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>product_id: ID của sản phẩm</LI>";         
        echo "<LI>page: số trang</LI>";         
        echo "<LI>Danh sách sản phẩm và sản phẩm matching được.</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getProductSwapMatchingNext&product_id=1&page=1&app_client_id=1&token=".$this->token."' target='_blank'>getProductSwapMatchingNext</a></span>";
    }
    
     function outLineGetEventTop(){
        echo "<h1>Function:getEventTop </h1>";
        echo "<i>Lây danh sách event tại trang chủ.</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action:getEventTop </LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI></LI>";         
        echo "<LI>Danh sách tối đa 3 event top.</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getEventTop&app_client_id=1&token=".$this->token."' target='_blank'>getEventTop</a></span>";
    }  
          
    function outLineGetInformDetail(){
        echo "<h1>Function:getInformDetail </h1>";
        echo "<i>Lấy thông tin chi tiết event hoặc thông báo .</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action:getEventTop </LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>inform_id: id thông báo event</LI>";         
        echo "<LI>Thông tin thông báo sự kiện.</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getInformDetail&inform_id=2&app_client_id=1&token=".$this->token."' target='_blank'>getInformDetail</a></span>";
    }
    
    function outLineGetItemSwapMatching(){
        echo "<h1>Function:getItemSwapMatching </h1>";
        echo "<i>Lấy danh sách sản phầm có thê trao đổi cùa 1 item.</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action:getItemSwapMatching </LI>";
        echo "<LI>method: GET</LI>";
        echo "<LI>user_id: id user</LI>";         
        echo "<LI>product_id: id sản phẩm</LI>";         
        echo "<LI>Sản phẩm info và danh sach items swap.</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=getItemSwapMatching&user_id=1&product_id=1&app_client_id=1&token=".$this->token."' target='_blank'>getItemSwapMatching</a></span>";
    }
    
    function outLineReSellProduct(){
        echo "<h1>Function:reSellProduct </h1>";
        echo "<i>Đăng bán lại sản phẩm đã bán hết .</i>";
        echo "<h3>Danh sách tham số:</h3>";
        echo "<UL>";
        echo "<LI>action:reSellProduct </LI>";
        echo "<LI>method: POST</LI>";
        echo "<LI>product_id: id sản phẩm</LI>";         
        echo "<LI>Đăng lại sản phẩm bán.</LI>";
        echo "</UL>";
        echo "<span>Ví dụ: <a href='".$this->url_api."?action=reSellProduct&product_id=2&app_client_id=1&token=".$this->token."' target='_blank'>reSellProduct</a></span>";
    }
    
   
    
}
?>
