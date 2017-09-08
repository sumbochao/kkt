<?php
class LoadConfig{
    static public $type_cat = array(
        1=>"Game",2=>"Video",3=>"Hình ảnh",4=>"Tin tức",5=>"Audio",6=>"Truyện tranh",7=>"Tin nhắn Kute",
        8=>"Game Lào"
    );
    static public $status = array(
        1=>"Hiển thị",0=>"Không hiển thị"
    );
    static public $status_comic = array(
        1=>"Đã hoàn thành",0=>"Đang tiến hành"
    );
    static public $arr_tip_icon = array(
        0=>"Không icon",
        1=>"icon_new2.png",
        2=>"icon_hot.gif",
    );
    static public $business_name = array(
        "Thanh Vân","Mai Phương"
    );
    static public $arr_tip_color = array(
        "clred"=>"Màu đỏ",
        "clblue"=>"Màu xanh dương",
        "clorage"=>"Màu da cam",
        "clpink"=>"Màu hồng",
        "clgreen2"=>"Màu xanh lá cây"
    );
    static public $box = array(
        1=>"Box Game",2=>"Box Video",3=>"Box Album",
    );
    static public $dynamic = array(
        0=>"Link tĩnh",1=>"Link động"
    );
    static public $type_content = array(
        1=>"Game Online",2=>"Video",3=>"Image",
    );
    // nha cug cap
    static public $supplier = array(
        1=>"Vina",2=>"Mobile",3=>"Vietel",4=>"Beline"
    );
    
    static public $blackList = array(
        "diendan", "fuck", "suck", "www", "iachay", "vaidai", "diia", "taoviec", "sex", "sexshow", "sex-show", "sex_show", "showsex", "s3x"
    );  
    static public $page_seo = array(
        0=>"Trang chủ",1=>"Trang game online",2=>"Trang video",3=>"Trang hình ảnh",4=>"Trang tin",5=>"Trang game offline"
    );
    
    
    static public $appId = array(1=>"Video The Voice",2=>"Video The Thao");
    static public $price_content = array(0,500,1000,2000,3000,4000,5000,10000,15000);
    static public $arr_page = array(
        1=>"Game86",2=>"Temphepthuat",4=>"Kiemhiep3d",8=>"Gamesatthu",16=>"Iwin86",32=>"Game bài QKA",64=>"Tin nhắn Kute",128=>"Hero Dota",256=>"Dota Card",512=>"Audition" ,1024=>"Bom Bom" ,2048=>"Bất bại" ,4096=>"Nhiệt huyết bang chủ",8192=>"Anh Hùng Xạ Điêu",16384=>"Phá Đảo",32768=>"Tam Quốc VTC",65536=>"Liên Minh Huyền Bí",131072=>"Tiên Duyên Kỳ Hiệp",262144=>'Đại Hải Chiến',524288=>'Sát Thần',1048576=>'Đao Kiếm Giang Hồ'
    );
    static public $arr_partner = array(
        1=>"App Quang",
    );
}
