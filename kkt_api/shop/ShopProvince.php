<?php
 /*$provinces = Array(
    'HANOI' => 'Hà Nội',
    'HOCHIMINH' => 'Hồ Chí Minh',
    'HAIPHONG' => 'Hải Phòng',
    'DANANG' => 'Đà Nẵng',
    'HAGIANG' => 'Hà Giang',
    'CAOBANG' => 'Cao Bằng',
    'LAICHAU' => 'Lai Châu',
    'LAOCAI' => 'Lào Cai',
    'TUYENQUANG' => 'Tuyên Quang',
    'LANGSON' => 'Lạng Sơn',
    'BACKAN' => 'Bắc Kạn',
    'THAINGUYEN' => 'Thái Nguyên',
    'YENBAI' => 'Yên Bái',
    'SONLA' => 'Sơn La',
    'PHUTHO' => 'Phú Thọ',
    'VINHPHUC' => 'Vĩnh Phúc',
    'QUANGNINH' => 'Quảng Ninh',
    'BACGIANG' => 'Bắc Giang',
    'BACNINH' => 'Bắc Ninh',
    'HAIDUONG' => 'Hải Dương',
    'HUNGYEN' => 'Hưng Yên',
    'HOABINH' => 'Hòa Bình',
    'HANAM' => 'Hà Nam',
    'NAMDINH' => 'Nam Định',
    'THAIBINH' => 'Thái Bình',
    'NINHBINH' => 'Ninh Bình',
    'THANHHOA' => 'Thanh Hóa',
    'NGHEAN' => 'Nghệ An',
    'HATINH' => 'Hà Tĩnh',
    'QUANGBINH' => 'Quảng Bình',
    'QUANGTRI' => 'Quảng Trị',
    'THUATHIENHUE' => 'Thừa Thiên Huế',
    'QUANGNAM' => 'Quảng Nam',
    'QUANGNGAI' => 'Quảng Ngãi',
    'KONTUM' => 'Kon Tum',
    'BINHDINH' => 'Bình Định',
    'GIALAI' => 'Gia Lai',
    'PHUYEN' => 'Phú Yên',
    'DAKLAK' => 'Đăk Lăk',
    'KHANHHOA' => 'Khánh Hòa',
    'LAMDONG' => 'Lâm Đồng',
    'BINHPHUOC' => 'Bình Phước',
    'BINHDUONG' => 'Bình Dương',
    'NINHTHUAN' => 'Ninh Thuận',
    'TAYNINH' => 'Tây Ninh',
    'BINHTHUAN' => 'Bình Thuận',
    'DONGNAI' => 'Đồng Nai',
    'LONGAN' => 'Long An',
    'DONGTHAP' => 'Đồng Tháp',
    'ANGIANG' => 'An Giang',
    'BARIAVUNGTAU' => 'Bà Rịa Vũng Tàu',
    'TIENGIANG' => 'Tiền Giang',
    'KIENGIANG' => 'Kiên Giang',
    'TRAVINH' => 'Trà Vinh',
    'BENTRE' => 'Bến Tre',
    'VINHLONG' => 'Vĩnh Long',
    'SOCTRANG' => 'Sóc Trăng',
    'BACLIEU' => 'Bạc Liêu',
    'CAMAU' => 'Cà Mau',
    'DIENBIEN' => 'Điện Biên',
    'DAKNONG' => 'Đắk Nông',
    'HAUGIANG' => 'Hậu Giang',
);
*/
$provinces = array('76'=>'An Giang',
    '64'=>'Bà Rịa – Vũng Tàu',
    '240'=>'Bắc Giang',
    '281'=>'Bắc Kạn',
    '781'=>'Bạc Liêu',
    '241'=>'Bắc Ninh',
    '75'=>'Bến Tre',
    '56'=>'Bình Định',
    '065'=>'Bình Dương',
    '651'=>'Bình Phước',
    '62'=>'Bình Thuận',
    '780'=>'Cà Mau',
    '710'=>'Cần Thơ',
    '26'=>'Cao Bằng',
    '511'=>'Đà Nẵng',
    '500'=>'Đắk Lắk',
    '501'=>'Đắk Nông',
    '230'=>'Điện Biên',
    '61'=>'Đồng Nai',
    '67'=>'Đồng Tháp',
    '59'=>'Gia Lai',
    '219'=>'Hà Giang',
    '351'=>'Hà Nam',
    '4'=>'Hà Nội',
    '39'=>'Hà Tĩnh',
    '320'=>'Hải Dương',
    '31'=>'Hải Phòng',
    '711'=>'Hậu Giang',
    '8'=>'Hồ Chí Minh',
    '218'=>'Hòa Bình',
    '321'=>'Hưng Yên',
    '58'=>'Khánh Hòa',
    '77'=>'Kiên Giang',
    '60'=>'Kon Tum',
    '231'=>'Lai Châu',
    '63'=>'Lâm Đồng',
    '25'=>'Lạng Sơn',
    '20'=>'Lào Cai',
    '72'=>'Long An',
    '350'=>'Nam Định',
    '38'=>'Nghệ An',
    '30'=>'Ninh Bình',
    '68'=>'Ninh Thuận',
    '210'=>'Phú Thọ',
    '57'=>'Phú Yên',
    '52'=>'Quảng Bình',
    '510'=>'Quảng Nam',
    '55'=>'Quảng Ngãi',
    '33'=>'Quảng Ninh',
    '53'=>'Quảng Trị',
    '79'=>'Sóc Trăng',
    '22'=>'Sơn La',
    '66'=>'Tây Ninh',
    '36'=>'Thái Bình',
    '280'=>'Thái Nguyên',
    '37'=>'Thanh Hóa',
    '54'=>'Thừa Thiên – Huế',
    '73'=>'Tiền Giang',
    '74'=>'Trà Vinh',
    '27'=>'Tuyên Quang',
    '70'=>'Vĩnh Long',
    '211'=>'Vĩnh Phúc',
    '29'=>'Yên Bái');
    
    
    $districts = array();
    $districts[0]=array("DistrictCode"=>"5101","DistrictName"=>"Thành phố Long Xuyên","ProvinceCode"=>"76","ProvinceName"=>"An Giang","SupportType"=>"3","Type"=>"1");
    
$districts[1]=array("DistrictCode"=>"5111","DistrictName"=>"Huyện Thoại Sơn","ProvinceCode"=>"76","ProvinceName"=>"An Giang","SupportType"=>"3","Type"=>"3");
$districts[2]=array("DistrictCode"=>"5110","DistrictName"=>"Huyện Châu Thành","ProvinceCode"=>"76","ProvinceName"=>"An Giang","SupportType"=>"2","Type"=>"2");
$districts[3]=array("DistrictCode"=>"5107","DistrictName"=>"Huyện Tri Tôn","ProvinceCode"=>"76","ProvinceName"=>"An Giang","SupportType"=>"3","Type"=>"3");
$districts[4]=array("DistrictCode"=>"5106","DistrictName"=>"Huyện Tịnh Biên","ProvinceCode"=>"76","ProvinceName"=>"An Giang","SupportType"=>"3","Type"=>"3");
$districts[5]=array("DistrictCode"=>"5102","DistrictName"=>"Thành phố Châu Đốc","ProvinceCode"=>"76","ProvinceName"=>"An Giang","SupportType"=>"3","Type"=>"3");
$districts[6]=array("DistrictCode"=>"5103","DistrictName"=>"Huyện An Phú","ProvinceCode"=>"76","ProvinceName"=>"An Giang","SupportType"=>"3","Type"=>"3");
$districts[7]=array("DistrictCode"=>"5104","DistrictName"=>"Huyện Tân Châu","ProvinceCode"=>"76","ProvinceName"=>"An Giang","SupportType"=>"3","Type"=>"3");
$districts[8]=array("DistrictCode"=>"5105","DistrictName"=>"Huyện Phú Tân","ProvinceCode"=>"76","ProvinceName"=>"An Giang","SupportType"=>"3","Type"=>"3");
$districts[9]=array("DistrictCode"=>"5109","DistrictName"=>"Huyện Chợ Mới","ProvinceCode"=>"76","ProvinceName"=>"An Giang","SupportType"=>"3","Type"=>"3");
$districts[10]=array("DistrictCode"=>"5108","DistrictName"=>"Huyện Châu Phú","ProvinceCode"=>"76","ProvinceName"=>"An Giang","SupportType"=>"3","Type"=>"3");
$districts[11]=array("DistrictCode"=>"5201","DistrictName"=>"Thành phố Vũng Tàu","ProvinceCode"=>"64","ProvinceName"=>"Bà Rịa – Vũng Tàu","SupportType"=>"3","Type"=>"1");
$districts[12]=array("DistrictCode"=>"5206","DistrictName"=>"Huyện Tân Thành","ProvinceCode"=>"64","ProvinceName"=>"Bà Rịa – Vũng Tàu","SupportType"=>"3","Type"=>"2");
$districts[13]=array("DistrictCode"=>"5207","DistrictName"=>"Huyện Châu Đức","ProvinceCode"=>"64","ProvinceName"=>"Bà Rịa – Vũng Tàu","SupportType"=>"3","Type"=>"2");
$districts[14]=array("DistrictCode"=>"5208","DistrictName"=>"Huyện Đất Đỏ","ProvinceCode"=>"64","ProvinceName"=>"Bà Rịa – Vũng Tàu","SupportType"=>"3","Type"=>"2");
$districts[15]=array("DistrictCode"=>"5202","DistrictName"=>"Thành phố Bà Rịa","ProvinceCode"=>"64","ProvinceName"=>"Bà Rịa – Vũng Tàu","SupportType"=>"3","Type"=>"1");
$districts[16]=array("DistrictCode"=>"5203","DistrictName"=>"Huyện Xuyên Mộc","ProvinceCode"=>"64","ProvinceName"=>"Bà Rịa – Vũng Tàu","SupportType"=>"3","Type"=>"3");
$districts[17]=array("DistrictCode"=>"5204","DistrictName"=>"Huyện Long Điền","ProvinceCode"=>"64","ProvinceName"=>"Bà Rịa – Vũng Tàu","SupportType"=>"3","Type"=>"2");
$districts[18]=array("DistrictCode"=>"1801","DistrictName"=>"Thành phố Bắc Giang","ProvinceCode"=>"240","ProvinceName"=>"Bắc Giang","SupportType"=>"3","Type"=>"1");
$districts[19]=array("DistrictCode"=>"1807","DistrictName"=>"Huyện Hiệp Hòa","ProvinceCode"=>"240","ProvinceName"=>"Bắc Giang","SupportType"=>"3","Type"=>"3");
$districts[20]=array("DistrictCode"=>"1808","DistrictName"=>"Huyện Lạng Giang","ProvinceCode"=>"240","ProvinceName"=>"Bắc Giang","SupportType"=>"3","Type"=>"3");
$districts[21]=array("DistrictCode"=>"1804","DistrictName"=>"Huyện Sơn Động","ProvinceCode"=>"240","ProvinceName"=>"Bắc Giang","SupportType"=>"3","Type"=>"3");
$districts[22]=array("DistrictCode"=>"1806","DistrictName"=>"Huyện Tân Yên","ProvinceCode"=>"240","ProvinceName"=>"Bắc Giang","SupportType"=>"3","Type"=>"3");
$districts[23]=array("DistrictCode"=>"1809","DistrictName"=>"Huyện Việt Yên","ProvinceCode"=>"240","ProvinceName"=>"Bắc Giang","SupportType"=>"3","Type"=>"2");
$districts[24]=array("DistrictCode"=>"1810","DistrictName"=>"Huyện Yên Dũng","ProvinceCode"=>"240","ProvinceName"=>"Bắc Giang","SupportType"=>"3","Type"=>"2");
$districts[25]=array("DistrictCode"=>"1802","DistrictName"=>"Huyện Yên Thế","ProvinceCode"=>"240","ProvinceName"=>"Bắc Giang","SupportType"=>"3","Type"=>"3");
$districts[26]=array("DistrictCode"=>"1805","DistrictName"=>"Huyện Lục Nam","ProvinceCode"=>"240","ProvinceName"=>"Bắc Giang","SupportType"=>"3","Type"=>"2");
$districts[27]=array("DistrictCode"=>"1803","DistrictName"=>"Huyện Lục Ngạn","ProvinceCode"=>"240","ProvinceName"=>"Bắc Giang","SupportType"=>"3","Type"=>"3");
$districts[28]=array("DistrictCode"=>"1101","DistrictName"=>"Thành phố Bắc Kạn","ProvinceCode"=>"281","ProvinceName"=>"Bắc Kạn","SupportType"=>"3","Type"=>"1");
$districts[29]=array("DistrictCode"=>"1106","DistrictName"=>"Huyện Ba Bể","ProvinceCode"=>"281","ProvinceName"=>"Bắc Kạn","SupportType"=>"3","Type"=>"3");
$districts[30]=array("DistrictCode"=>"1103","DistrictName"=>"Huyện Bạch Thông","ProvinceCode"=>"281","ProvinceName"=>"Bắc Kạn","SupportType"=>"3","Type"=>"3");
$districts[31]=array("DistrictCode"=>"1102","DistrictName"=>"Huyện Chợ Đồn","ProvinceCode"=>"281","ProvinceName"=>"Bắc Kạn","SupportType"=>"3","Type"=>"3");
$districts[32]=array("DistrictCode"=>"1107","DistrictName"=>"Huyện Chợ Mới","ProvinceCode"=>"281","ProvinceName"=>"Bắc Kạn","SupportType"=>"3","Type"=>"3");
$districts[33]=array("DistrictCode"=>"6007","DistrictName"=>"Huyện Hòa Bình","ProvinceCode"=>"781","ProvinceName"=>"Bạc Liêu","SupportType"=>"2","Type"=>"2");
$districts[34]=array("DistrictCode"=>"6001","DistrictName"=>"Thành phố Bạc Liêu","ProvinceCode"=>"781","ProvinceName"=>"Bạc Liêu","SupportType"=>"3","Type"=>"1");
$districts[35]=array("DistrictCode"=>"6006","DistrictName"=>"Huyện Đông Hải","ProvinceCode"=>"781","ProvinceName"=>"Bạc Liêu","SupportType"=>"3","Type"=>"3");
$districts[36]=array("DistrictCode"=>"6004","DistrictName"=>"Huyện Giá Rai","ProvinceCode"=>"781","ProvinceName"=>"Bạc Liêu","SupportType"=>"3","Type"=>"3");
$districts[37]=array("DistrictCode"=>"6003","DistrictName"=>"Huyện Hồng Dân","ProvinceCode"=>"781","ProvinceName"=>"Bạc Liêu","SupportType"=>"3","Type"=>"3");
$districts[38]=array("DistrictCode"=>"6005","DistrictName"=>"Huyện Phước Long","ProvinceCode"=>"781","ProvinceName"=>"Bạc Liêu","SupportType"=>"3","Type"=>"3");
$districts[39]=array("DistrictCode"=>"6002","DistrictName"=>"Huyện Vĩnh Lợi","ProvinceCode"=>"781","ProvinceName"=>"Bạc Liêu","SupportType"=>"3","Type"=>"2");
$districts[40]=array("DistrictCode"=>"1901","DistrictName"=>"Thành phố Bắc Ninh","ProvinceCode"=>"241","ProvinceName"=>"Bắc Ninh","SupportType"=>"3","Type"=>"1");
$districts[41]=array("DistrictCode"=>"1903","DistrictName"=>"Huyện Quế Võ","ProvinceCode"=>"241","ProvinceName"=>"Bắc Ninh","SupportType"=>"2","Type"=>"2");
$districts[42]=array("DistrictCode"=>"1904","DistrictName"=>"Huyện Tiên Du","ProvinceCode"=>"241","ProvinceName"=>"Bắc Ninh","SupportType"=>"2","Type"=>"2");
$districts[43]=array("DistrictCode"=>"1905","DistrictName"=>"Thị xã Từ Sơn","ProvinceCode"=>"241","ProvinceName"=>"Bắc Ninh","SupportType"=>"2","Type"=>"2");
$districts[44]=array("DistrictCode"=>"1907","DistrictName"=>"Huyện Gia Bình","ProvinceCode"=>"241","ProvinceName"=>"Bắc Ninh","SupportType"=>"3","Type"=>"3");
$districts[45]=array("DistrictCode"=>"1906","DistrictName"=>"Huyện Thuận Thành","ProvinceCode"=>"241","ProvinceName"=>"Bắc Ninh","SupportType"=>"3","Type"=>"2");
$districts[46]=array("DistrictCode"=>"1902","DistrictName"=>"Huyện Yên Phong","ProvinceCode"=>"241","ProvinceName"=>"Bắc Ninh","SupportType"=>"3","Type"=>"2");
$districts[47]=array("DistrictCode"=>"1908","DistrictName"=>"Huyện Lương Tài","ProvinceCode"=>"241","ProvinceName"=>"Bắc Ninh","SupportType"=>"3","Type"=>"3");
$districts[48]=array("DistrictCode"=>"5601","DistrictName"=>"Thành phố Bến Tre","ProvinceCode"=>"75","ProvinceName"=>"Bến Tre","SupportType"=>"3","Type"=>"1");
$districts[49]=array("DistrictCode"=>"5602","DistrictName"=>"Huyện Châu Thành","ProvinceCode"=>"75","ProvinceName"=>"Bến Tre","SupportType"=>"2","Type"=>"2");
$districts[50]=array("DistrictCode"=>"5607","DistrictName"=>"Huyện Ba Tri","ProvinceCode"=>"75","ProvinceName"=>"Bến Tre","SupportType"=>"3","Type"=>"3");
$districts[51]=array("DistrictCode"=>"5606","DistrictName"=>"Huyện Bình Đại","ProvinceCode"=>"75","ProvinceName"=>"Bến Tre","SupportType"=>"3","Type"=>"3");
$districts[52]=array("DistrictCode"=>"5605","DistrictName"=>"Huyện Giồng Trôm","ProvinceCode"=>"75","ProvinceName"=>"Bến Tre","SupportType"=>"3","Type"=>"2");
$districts[53]=array("DistrictCode"=>"5604","DistrictName"=>"Huyện Mỏ Cày Bắc","ProvinceCode"=>"75","ProvinceName"=>"Bến Tre","SupportType"=>"3","Type"=>"2");
$districts[54]=array("DistrictCode"=>"5609","DistrictName"=>"Huyện Mỏ Cày Nam","ProvinceCode"=>"75","ProvinceName"=>"Bến Tre","SupportType"=>"3","Type"=>"2");
$districts[55]=array("DistrictCode"=>"5608","DistrictName"=>"Huyện Thạnh Phú","ProvinceCode"=>"75","ProvinceName"=>"Bến Tre","SupportType"=>"3","Type"=>"3");
$districts[56]=array("DistrictCode"=>"3702","DistrictName"=>"Huyện An Lão","ProvinceCode"=>"56","ProvinceName"=>"Bình Định","SupportType"=>"3","Type"=>"3");
$districts[57]=array("DistrictCode"=>"3701","DistrictName"=>"Thành phố Quy Nhơn","ProvinceCode"=>"56","ProvinceName"=>"Bình Định","SupportType"=>"3","Type"=>"1");
$districts[58]=array("DistrictCode"=>"3710","DistrictName"=>"Thị xã An Nhơn","ProvinceCode"=>"56","ProvinceName"=>"Bình Định","SupportType"=>"3","Type"=>"3");
$districts[59]=array("DistrictCode"=>"3706","DistrictName"=>"Huyện Phù Cát","ProvinceCode"=>"56","ProvinceName"=>"Bình Định","SupportType"=>"3","Type"=>"3");
$districts[60]=array("DistrictCode"=>"3704","DistrictName"=>"Huyện Hoài Nhơn","ProvinceCode"=>"56","ProvinceName"=>"Bình Định","SupportType"=>"3","Type"=>"3");
$districts[61]=array("DistrictCode"=>"3711","DistrictName"=>"Huyện Tuy Phước","ProvinceCode"=>"56","ProvinceName"=>"Bình Định","SupportType"=>"3","Type"=>"2");
$districts[62]=array("DistrictCode"=>"4401","DistrictName"=>"Thành phố Thủ Dầu Một","ProvinceCode"=>"065","ProvinceName"=>"Bình Dương","SupportType"=>"3","Type"=>"1");
$districts[63]=array("DistrictCode"=>"4405","DistrictName"=>"Thị xã Dĩ An","ProvinceCode"=>"065","ProvinceName"=>"Bình Dương","SupportType"=>"3","Type"=>"1");
$districts[64]=array("DistrictCode"=>"4404","DistrictName"=>"Thị xã Thuận An","ProvinceCode"=>"065","ProvinceName"=>"Bình Dương","SupportType"=>"3","Type"=>"2");
$districts[65]=array("DistrictCode"=>"4403","DistrictName"=>"Thị xã Tân Uyên","ProvinceCode"=>"065","ProvinceName"=>"Bình Dương","SupportType"=>"3","Type"=>"2");
$districts[66]=array("DistrictCode"=>"4407","DistrictName"=>"Huyện Dầu Tiếng","ProvinceCode"=>"065","ProvinceName"=>"Bình Dương","SupportType"=>"2","Type"=>"3");
$districts[67]=array("DistrictCode"=>"4408","DistrictName"=>"Huyện Bàu Bàng","ProvinceCode"=>"065","ProvinceName"=>"Bình Dương","SupportType"=>"3","Type"=>"3");
$districts[68]=array("DistrictCode"=>"4402","DistrictName"=>"Thị xã Bến Cát","ProvinceCode"=>"065","ProvinceName"=>"Bình Dương","SupportType"=>"3","Type"=>"3");
$districts[69]=array("DistrictCode"=>"4406","DistrictName"=>"Huyện Phú Giáo","ProvinceCode"=>"065","ProvinceName"=>"Bình Dương","SupportType"=>"3","Type"=>"3");
$districts[70]=array("DistrictCode"=>"4302","DistrictName"=>"Huyện Đồng Phú","ProvinceCode"=>"651","ProvinceName"=>"Bình Phước","SupportType"=>"2","Type"=>"2");
$districts[71]=array("DistrictCode"=>"4308","DistrictName"=>"Huyện Bù Đăng","ProvinceCode"=>"651","ProvinceName"=>"Bình Phước","SupportType"=>"3","Type"=>"3");
$districts[72]=array("DistrictCode"=>"4301","DistrictName"=>"Thị xã Đồng Xoài","ProvinceCode"=>"651","ProvinceName"=>"Bình Phước","SupportType"=>"3","Type"=>"1");
$districts[73]=array("DistrictCode"=>"4303","DistrictName"=>"Huyện Chơn Thành","ProvinceCode"=>"651","ProvinceName"=>"Bình Phước","SupportType"=>"3","Type"=>"3");
$districts[74]=array("DistrictCode"=>"4309","DistrictName"=>"Huyện Hớn Quản","ProvinceCode"=>"651","ProvinceName"=>"Bình Phước","SupportType"=>"3","Type"=>"3");
$districts[75]=array("DistrictCode"=>"4304","DistrictName"=>"Thị xã Bình Long","ProvinceCode"=>"651","ProvinceName"=>"Bình Phước","SupportType"=>"3","Type"=>"3");
$districts[76]=array("DistrictCode"=>"4307","DistrictName"=>"Thị xã Phước Long","ProvinceCode"=>"651","ProvinceName"=>"Bình Phước","SupportType"=>"3","Type"=>"3");
$districts[77]=array("DistrictCode"=>"4305","DistrictName"=>"Huyện Lộc Ninh","ProvinceCode"=>"651","ProvinceName"=>"Bình Phước","SupportType"=>"3","Type"=>"3");
$districts[78]=array("DistrictCode"=>"4701","DistrictName"=>"Thành phố Phan Thiết","ProvinceCode"=>"62","ProvinceName"=>"Bình Thuận","SupportType"=>"3","Type"=>"1");
$districts[79]=array("DistrictCode"=>"4705","DistrictName"=>"Huyện Hàm Thuận Nam","ProvinceCode"=>"62","ProvinceName"=>"Bình Thuận","SupportType"=>"3","Type"=>"3");
$districts[80]=array("DistrictCode"=>"4704","DistrictName"=>"Huyện Hàm Thuận Bắc","ProvinceCode"=>"62","ProvinceName"=>"Bình Thuận","SupportType"=>"3","Type"=>"2");
$districts[81]=array("DistrictCode"=>"4710","DistrictName"=>"Thị xã La Gi","ProvinceCode"=>"62","ProvinceName"=>"Bình Thuận","SupportType"=>"3","Type"=>"3");
$districts[82]=array("DistrictCode"=>"4707","DistrictName"=>"Huyện Đức Linh","ProvinceCode"=>"62","ProvinceName"=>"Bình Thuận","SupportType"=>"3","Type"=>"3");
$districts[83]=array("DistrictCode"=>"4703","DistrictName"=>"Huyện Bắc Bình","ProvinceCode"=>"62","ProvinceName"=>"Bình Thuận","SupportType"=>"3","Type"=>"3");
$districts[84]=array("DistrictCode"=>"4702","DistrictName"=>"Huyện Tuy Phong","ProvinceCode"=>"62","ProvinceName"=>"Bình Thuận","SupportType"=>"3","Type"=>"3");
$districts[85]=array("DistrictCode"=>"4708","DistrictName"=>"Huyện Tánh Linh","ProvinceCode"=>"62","ProvinceName"=>"Bình Thuận","SupportType"=>"3","Type"=>"3");
$districts[86]=array("DistrictCode"=>"6101","DistrictName"=>"Thành phố Cà Mau","ProvinceCode"=>"780","ProvinceName"=>"Cà Mau","SupportType"=>"3","Type"=>"1");
$districts[87]=array("DistrictCode"=>"6109","DistrictName"=>"Huyện Phú Tân","ProvinceCode"=>"780","ProvinceName"=>"Cà Mau","SupportType"=>"3","Type"=>"3");
$districts[88]=array("DistrictCode"=>"6105","DistrictName"=>"Huyện Cái Nước","ProvinceCode"=>"780","ProvinceName"=>"Cà Mau","SupportType"=>"3","Type"=>"3");
$districts[89]=array("DistrictCode"=>"6102","DistrictName"=>"Huyện Thới Bình","ProvinceCode"=>"780","ProvinceName"=>"Cà Mau","SupportType"=>"3","Type"=>"3");
$districts[90]=array("DistrictCode"=>"6108","DistrictName"=>"Huyện Năm Căn","ProvinceCode"=>"780","ProvinceName"=>"Cà Mau","SupportType"=>"3","Type"=>"3");
$districts[91]=array("DistrictCode"=>"6106","DistrictName"=>"Huyện Đầm Dơi","ProvinceCode"=>"780","ProvinceName"=>"Cà Mau","SupportType"=>"3","Type"=>"3");
$districts[92]=array("DistrictCode"=>"6104","DistrictName"=>"Huyện Trần Văn Thời","ProvinceCode"=>"780","ProvinceName"=>"Cà Mau","SupportType"=>"3","Type"=>"3");
$districts[93]=array("DistrictCode"=>"6103","DistrictName"=>"Huyện U Minh","ProvinceCode"=>"780","ProvinceName"=>"Cà Mau","SupportType"=>"3","Type"=>"3");
$districts[94]=array("DistrictCode"=>"5501","DistrictName"=>"Quận Ninh Kiều","ProvinceCode"=>"710","ProvinceName"=>"Cần Thơ","SupportType"=>"3","Type"=>"1");
$districts[95]=array("DistrictCode"=>"5502","DistrictName"=>"Quận Bình Thủy","ProvinceCode"=>"710","ProvinceName"=>"Cần Thơ","SupportType"=>"3","Type"=>"1");
$districts[96]=array("DistrictCode"=>"5503","DistrictName"=>"Quận Cái Răng","ProvinceCode"=>"710","ProvinceName"=>"Cần Thơ","SupportType"=>"3","Type"=>"1");
$districts[97]=array("DistrictCode"=>"5504","DistrictName"=>"Quận Ô Môn","ProvinceCode"=>"710","ProvinceName"=>"Cần Thơ","SupportType"=>"3","Type"=>"2");
$districts[98]=array("DistrictCode"=>"5508","DistrictName"=>"Quận Thốt Nốt","ProvinceCode"=>"710","ProvinceName"=>"Cần Thơ","SupportType"=>"3","Type"=>"2");
$districts[99]=array("DistrictCode"=>"0601","DistrictName"=>"Thành phố Cao Bằng","ProvinceCode"=>"26","ProvinceName"=>"Cao Bằng","SupportType"=>"3","Type"=>"1");
$districts[100]=array("DistrictCode"=>"0612","DistrictName"=>"Huyện Bảo Lâm","ProvinceCode"=>"26","ProvinceName"=>"Cao Bằng","SupportType"=>"3","Type"=>"3");
$districts[101]=array("DistrictCode"=>"0604","DistrictName"=>"Huyện Hà Quảng","ProvinceCode"=>"26","ProvinceName"=>"Cao Bằng","SupportType"=>"3","Type"=>"3");
$districts[102]=array("DistrictCode"=>"0608","DistrictName"=>"Huyện Hòa An","ProvinceCode"=>"26","ProvinceName"=>"Cao Bằng","SupportType"=>"3","Type"=>"3");
$districts[103]=array("DistrictCode"=>"0613","DistrictName"=>"Huyện Phục Hòa","ProvinceCode"=>"26","ProvinceName"=>"Cao Bằng","SupportType"=>"3","Type"=>"3");
$districts[104]=array("DistrictCode"=>"0606","DistrictName"=>"Huyện Trùng Khánh","ProvinceCode"=>"26","ProvinceName"=>"Cao Bằng","SupportType"=>"3","Type"=>"3");
$districts[105]=array("DistrictCode"=>"0401","DistrictName"=>"Quận Hải Châu","ProvinceCode"=>"511","ProvinceName"=>"Đà Nẵng","SupportType"=>"3","Type"=>"1");
$districts[106]=array("DistrictCode"=>"0402","DistrictName"=>"Quận Thanh Khê","ProvinceCode"=>"511","ProvinceName"=>"Đà Nẵng","SupportType"=>"3","Type"=>"1");
$districts[107]=array("DistrictCode"=>"0403","DistrictName"=>"Quận Sơn Trà","ProvinceCode"=>"511","ProvinceName"=>"Đà Nẵng","SupportType"=>"3","Type"=>"1");
$districts[108]=array("DistrictCode"=>"0404","DistrictName"=>"Quận Ngũ Hành Sơn","ProvinceCode"=>"511","ProvinceName"=>"Đà Nẵng","SupportType"=>"3","Type"=>"1");
$districts[109]=array("DistrictCode"=>"0405","DistrictName"=>"Quận Liên Chiểu","ProvinceCode"=>"511","ProvinceName"=>"Đà Nẵng","SupportType"=>"3","Type"=>"1");
$districts[110]=array("DistrictCode"=>"0407","DistrictName"=>"Quận Cẩm Lệ","ProvinceCode"=>"511","ProvinceName"=>"Đà Nẵng","SupportType"=>"3","Type"=>"1");
$districts[111]=array("DistrictCode"=>"0406","DistrictName"=>"Huyện Hòa Vang","ProvinceCode"=>"511","ProvinceName"=>"Đà Nẵng","SupportType"=>"3","Type"=>"3");
$districts[112]=array("DistrictCode"=>"4001","DistrictName"=>"Thành phố Buôn Ma Thuột","ProvinceCode"=>"500","ProvinceName"=>"Đắk Lắk","SupportType"=>"3","Type"=>"1");
$districts[113]=array("DistrictCode"=>"4010","DistrictName"=>"Huyện Krông Ana","ProvinceCode"=>"500","ProvinceName"=>"Đắk Lắk","SupportType"=>"3","Type"=>"3");
$districts[114]=array("DistrictCode"=>"4009","DistrictName"=>"Huyện M đrắk","ProvinceCode"=>"500","ProvinceName"=>"Đắk Lắk","SupportType"=>"3","Type"=>"3");
$districts[115]=array("DistrictCode"=>"4013","DistrictName"=>"Huyện Buôn Ðôn","ProvinceCode"=>"500","ProvinceName"=>"Đắk Lắk","SupportType"=>"3","Type"=>"3");
$districts[116]=array("DistrictCode"=>"4006","DistrictName"=>"Huy?n Cu M gar","ProvinceCode"=>"500","ProvinceName"=>"Đắk Lắk","SupportType"=>"3","Type"=>"2");
$districts[117]=array("DistrictCode"=>"4002","DistrictName"=>"Huy?n Ea H leo","ProvinceCode"=>"500","ProvinceName"=>"Đắk Lắk","SupportType"=>"3","Type"=>"3");
$districts[118]=array("DistrictCode"=>"4004","DistrictName"=>"Huyện Krông Năng","ProvinceCode"=>"500","ProvinceName"=>"Đắk Lắk","SupportType"=>"3","Type"=>"3");
$districts[119]=array("DistrictCode"=>"4015","DistrictName"=>"Thị xã Buôn Hồ","ProvinceCode"=>"500","ProvinceName"=>"Đắk Lắk","SupportType"=>"3","Type"=>"3");
$districts[120]=array("DistrictCode"=>"4011","DistrictName"=>"Huyện Krông Bông","ProvinceCode"=>"500","ProvinceName"=>"Đắk Lắk","SupportType"=>"3","Type"=>"3");
$districts[121]=array("DistrictCode"=>"4008","DistrictName"=>"Huyện Ea Kar","ProvinceCode"=>"500","ProvinceName"=>"Đắk Lắk","SupportType"=>"3","Type"=>"3");
$districts[122]=array("DistrictCode"=>"4007","DistrictName"=>"Huyện Krông Pắc","ProvinceCode"=>"500","ProvinceName"=>"Đắk Lắk","SupportType"=>"3","Type"=>"3");
$districts[123]=array("DistrictCode"=>"4009","DistrictName"=>"Huy?n M dr?k","ProvinceCode"=>"500","ProvinceName"=>"Đắk Lắk","SupportType"=>"3","Type"=>"3");
$districts[124]=array("DistrictCode"=>"6301","DistrictName"=>"Thị xã Gia Nghĩa","ProvinceCode"=>"501","ProvinceName"=>"Đắk Nông","SupportType"=>"3","Type"=>"1");
$districts[125]=array("DistrictCode"=>"6302","DistrictName"=>"Huy?n Ð?k R l?p","ProvinceCode"=>"501","ProvinceName"=>"Đắk Nông","SupportType"=>"3","Type"=>"3");
$districts[126]=array("DistrictCode"=>"6307","DistrictName"=>"Huyện Đắk Glong","ProvinceCode"=>"501","ProvinceName"=>"Đắk Nông","SupportType"=>"3","Type"=>"3");
$districts[127]=array("DistrictCode"=>"6303","DistrictName"=>"Huyện Đắk Mil","ProvinceCode"=>"501","ProvinceName"=>"Đắk Nông","SupportType"=>"3","Type"=>"3");
$districts[128]=array("DistrictCode"=>"6201","DistrictName"=>"Thành phố Điện Biên Phủ","ProvinceCode"=>"230","ProvinceName"=>"Điện Biên","SupportType"=>"3","Type"=>"1");
$districts[129]=array("DistrictCode"=>"6203","DistrictName"=>"Huyện Điện Biên","ProvinceCode"=>"230","ProvinceName"=>"Điện Biên","SupportType"=>"3","Type"=>"3");
$districts[130]=array("DistrictCode"=>"6205","DistrictName"=>"Huyện Mường Chà","ProvinceCode"=>"230","ProvinceName"=>"Điện Biên","SupportType"=>"3","Type"=>"3");
$districts[131]=array("DistrictCode"=>"6208","DistrictName"=>"Huyện Mường Nhé","ProvinceCode"=>"230","ProvinceName"=>"Điện Biên","SupportType"=>"3","Type"=>"3");
$districts[132]=array("DistrictCode"=>"6206","DistrictName"=>"Huyện Tủa Chùa","ProvinceCode"=>"230","ProvinceName"=>"Điện Biên","SupportType"=>"3","Type"=>"3");
$districts[133]=array("DistrictCode"=>"6204","DistrictName"=>"Huyện Tuần Giáo","ProvinceCode"=>"230","ProvinceName"=>"Điện Biên","SupportType"=>"3","Type"=>"3");
$districts[134]=array("DistrictCode"=>"6202","DistrictName"=>"Thị xã Mường Lay","ProvinceCode"=>"230","ProvinceName"=>"Điện Biên","SupportType"=>"3","Type"=>"3");
$districts[135]=array("DistrictCode"=>"4801","DistrictName"=>"Thành phố Biên Hòa","ProvinceCode"=>"61","ProvinceName"=>"Đồng Nai","SupportType"=>"3","Type"=>"1");
$districts[136]=array("DistrictCode"=>"4810","DistrictName"=>"Huyện Trảng Bom","ProvinceCode"=>"61","ProvinceName"=>"Đồng Nai","SupportType"=>"3","Type"=>"3");
$districts[137]=array("DistrictCode"=>"4803","DistrictName"=>"Huyện Tân Phú","ProvinceCode"=>"61","ProvinceName"=>"Đồng Nai","SupportType"=>"3","Type"=>"3");
$districts[138]=array("DistrictCode"=>"4811","DistrictName"=>"Huyện Cẩm Mỹ","ProvinceCode"=>"61","ProvinceName"=>"Đồng Nai","SupportType"=>"3","Type"=>"3");
$districts[139]=array("DistrictCode"=>"4805","DistrictName"=>"Huyện Thống Nhất","ProvinceCode"=>"61","ProvinceName"=>"Đồng Nai","SupportType"=>"3","Type"=>"3");
$districts[140]=array("DistrictCode"=>"4809","DistrictName"=>"Huyện Nhơn Trạch","ProvinceCode"=>"61","ProvinceName"=>"Đồng Nai","SupportType"=>"3","Type"=>"3");
$districts[141]=array("DistrictCode"=>"4808","DistrictName"=>"Huyện Long Thành","ProvinceCode"=>"61","ProvinceName"=>"Đồng Nai","SupportType"=>"3","Type"=>"3");
$districts[142]=array("DistrictCode"=>"4804","DistrictName"=>"Huyện Định Quán","ProvinceCode"=>"61","ProvinceName"=>"Đồng Nai","SupportType"=>"3","Type"=>"3");
$districts[143]=array("DistrictCode"=>"4802","DistrictName"=>"Huyện Vĩnh Cửu","ProvinceCode"=>"61","ProvinceName"=>"Đồng Nai","SupportType"=>"3","Type"=>"3");
$districts[144]=array("DistrictCode"=>"5001","DistrictName"=>"Thành phố Cao Lãnh","ProvinceCode"=>"67","ProvinceName"=>"Đồng Tháp","SupportType"=>"3","Type"=>"1");
$districts[145]=array("DistrictCode"=>"5007","DistrictName"=>"Huyện Cao Lãnh","ProvinceCode"=>"67","ProvinceName"=>"Đồng Tháp","SupportType"=>"2","Type"=>"2");
$districts[146]=array("DistrictCode"=>"5010","DistrictName"=>"Huyện Lai Vung","ProvinceCode"=>"67","ProvinceName"=>"Đồng Tháp","SupportType"=>"2","Type"=>"2");
$districts[147]=array("DistrictCode"=>"5002","DistrictName"=>"Thành phố Sa Đéc","ProvinceCode"=>"67","ProvinceName"=>"Đồng Tháp","SupportType"=>"3","Type"=>"1");
$districts[148]=array("DistrictCode"=>"5008","DistrictName"=>"Huyện Lấp Vò","ProvinceCode"=>"67","ProvinceName"=>"Đồng Tháp","SupportType"=>"3","Type"=>"3");
$districts[149]=array("DistrictCode"=>"5005","DistrictName"=>"Huyện Tam Nông","ProvinceCode"=>"67","ProvinceName"=>"Đồng Tháp","SupportType"=>"3","Type"=>"3");
$districts[150]=array("DistrictCode"=>"5003","DistrictName"=>"Huyện Tân Hồng","ProvinceCode"=>"67","ProvinceName"=>"Đồng Tháp","SupportType"=>"3","Type"=>"3");
$districts[151]=array("DistrictCode"=>"5006","DistrictName"=>"Huyện Thanh Bình","ProvinceCode"=>"67","ProvinceName"=>"Đồng Tháp","SupportType"=>"3","Type"=>"3");
$districts[152]=array("DistrictCode"=>"5009","DistrictName"=>"Huyện Tháp Mười","ProvinceCode"=>"67","ProvinceName"=>"Đồng Tháp","SupportType"=>"3","Type"=>"3");
$districts[153]=array("DistrictCode"=>"5012","DistrictName"=>"Thị xã Hồng Ngự","ProvinceCode"=>"67","ProvinceName"=>"Đồng Tháp","SupportType"=>"3","Type"=>"3");
$districts[154]=array("DistrictCode"=>"3801","DistrictName"=>"Thành phố Pleiku","ProvinceCode"=>"59","ProvinceName"=>"Gia Lai","SupportType"=>"3","Type"=>"1");
$districts[155]=array("DistrictCode"=>"3812","DistrictName"=>"Huyện Ia Grai","ProvinceCode"=>"59","ProvinceName"=>"Gia Lai","SupportType"=>"3","Type"=>"2");
$districts[156]=array("DistrictCode"=>"3807","DistrictName"=>"Huyện Đức Cơ","ProvinceCode"=>"59","ProvinceName"=>"Gia Lai","SupportType"=>"3","Type"=>"3");
$districts[157]=array("DistrictCode"=>"3808","DistrictName"=>"Huyện Chư Prông","ProvinceCode"=>"59","ProvinceName"=>"Gia Lai","SupportType"=>"3","Type"=>"3");
$districts[158]=array("DistrictCode"=>"3809","DistrictName"=>"Huyện Chư Sê","ProvinceCode"=>"59","ProvinceName"=>"Gia Lai","SupportType"=>"3","Type"=>"3");
$districts[159]=array("DistrictCode"=>"3816","DistrictName"=>"Huyện Phú Thiện","ProvinceCode"=>"59","ProvinceName"=>"Gia Lai","SupportType"=>"3","Type"=>"3");
$districts[160]=array("DistrictCode"=>"3810","DistrictName"=>"Thị xã Ayun Pa","ProvinceCode"=>"59","ProvinceName"=>"Gia Lai","SupportType"=>"3","Type"=>"3");
$districts[161]=array("DistrictCode"=>"3814","DistrictName"=>"Huyện Ia Pa","ProvinceCode"=>"59","ProvinceName"=>"Gia Lai","SupportType"=>"3","Type"=>"3");
$districts[162]=array("DistrictCode"=>"3805","DistrictName"=>"Thị xã An Khê","ProvinceCode"=>"59","ProvinceName"=>"Gia Lai","SupportType"=>"3","Type"=>"3");
$districts[163]=array("DistrictCode"=>"3802","DistrictName"=>"Huyện Chư Păh","ProvinceCode"=>"59","ProvinceName"=>"Gia Lai","SupportType"=>"3","Type"=>"2");
$districts[164]=array("DistrictCode"=>"0501","DistrictName"=>"Thành phố Hà Giang","ProvinceCode"=>"219","ProvinceName"=>"Hà Giang","SupportType"=>"3","Type"=>"1");
$districts[165]=array("DistrictCode"=>"0510","DistrictName"=>"Huyện Bắc Quang","ProvinceCode"=>"219","ProvinceName"=>"Hà Giang","SupportType"=>"3","Type"=>"3");
$districts[166]=array("DistrictCode"=>"0502","DistrictName"=>"Huyện Đồng Văn","ProvinceCode"=>"219","ProvinceName"=>"Hà Giang","SupportType"=>"3","Type"=>"3");
$districts[167]=array("DistrictCode"=>"0508","DistrictName"=>"Huyện Hoàng Su Phì","ProvinceCode"=>"219","ProvinceName"=>"Hà Giang","SupportType"=>"3","Type"=>"3");
$districts[168]=array("DistrictCode"=>"0503","DistrictName"=>"Huyện Mèo Vạc","ProvinceCode"=>"219","ProvinceName"=>"Hà Giang","SupportType"=>"3","Type"=>"3");
$districts[169]=array("DistrictCode"=>"0505","DistrictName"=>"Huyện Quản Bạ","ProvinceCode"=>"219","ProvinceName"=>"Hà Giang","SupportType"=>"3","Type"=>"3");
$districts[170]=array("DistrictCode"=>"0511","DistrictName"=>"Huyện Quang Bình","ProvinceCode"=>"219","ProvinceName"=>"Hà Giang","SupportType"=>"3","Type"=>"3");
$districts[171]=array("DistrictCode"=>"0509","DistrictName"=>"Huyện Xín Mần","ProvinceCode"=>"219","ProvinceName"=>"Hà Giang","SupportType"=>"3","Type"=>"3");
$districts[172]=array("DistrictCode"=>"0504","DistrictName"=>"Huyện Yên Minh","ProvinceCode"=>"219","ProvinceName"=>"Hà Giang","SupportType"=>"3","Type"=>"3");
$districts[173]=array("DistrictCode"=>"2401","DistrictName"=>"Thành phố Phủ Lý","ProvinceCode"=>"351","ProvinceName"=>"Hà Nam","SupportType"=>"3","Type"=>"1");
$districts[174]=array("DistrictCode"=>"2406","DistrictName"=>"Huyện Bình Lục","ProvinceCode"=>"351","ProvinceName"=>"Hà Nam","SupportType"=>"3","Type"=>"2");
$districts[175]=array("DistrictCode"=>"2402","DistrictName"=>"Huyện Duy Tiên","ProvinceCode"=>"351","ProvinceName"=>"Hà Nam","SupportType"=>"3","Type"=>"2");
$districts[176]=array("DistrictCode"=>"2403","DistrictName"=>"Huyện Kim Bảng","ProvinceCode"=>"351","ProvinceName"=>"Hà Nam","SupportType"=>"3","Type"=>"2");
$districts[177]=array("DistrictCode"=>"2404","DistrictName"=>"Huyện Lý Nhân","ProvinceCode"=>"351","ProvinceName"=>"Hà Nam","SupportType"=>"3","Type"=>"2");
$districts[178]=array("DistrictCode"=>"2405","DistrictName"=>"Huyện Thanh Liêm","ProvinceCode"=>"351","ProvinceName"=>"Hà Nam","SupportType"=>"3","Type"=>"2");
$districts[179]=array("DistrictCode"=>"1B15","DistrictName"=>"Quận Hà Đông","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"2");
$districts[180]=array("DistrictCode"=>"1A10","DistrictName"=>"Quận Từ Liêm","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"2");
$districts[181]=array("DistrictCode"=>"1A01","DistrictName"=>"Quận Ba Đình","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"1");
$districts[182]=array("DistrictCode"=>"1A06","DistrictName"=>"Quận Cầu Giấy","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"1");
$districts[183]=array("DistrictCode"=>"1A04","DistrictName"=>"Quận Đống Đa","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"1");
$districts[184]=array("DistrictCode"=>"1A03","DistrictName"=>"Quận Hai Bà Trưng","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"1");
$districts[185]=array("DistrictCode"=>"1A02","DistrictName"=>"Quận Hoàn Kiếm","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"1");
$districts[186]=array("DistrictCode"=>"1A08","DistrictName"=>"Quận Hoàng Mai","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"1");
$districts[187]=array("DistrictCode"=>"1A09","DistrictName"=>"Quận Long Biên","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"2");
$districts[188]=array("DistrictCode"=>"1A05","DistrictName"=>"Quận Tây Hồ","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"1");
$districts[189]=array("DistrictCode"=>"1A07","DistrictName"=>"Quận Thanh Xuân","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"1");
$districts[190]=array("DistrictCode"=>"1B29","DistrictName"=>"Huyện Mê Linh","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"3");
$districts[191]=array("DistrictCode"=>"1A13","DistrictName"=>"Huyện Đông Anh","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"3");
$districts[192]=array("DistrictCode"=>"1A14","DistrictName"=>"Huyện Sóc Sơn","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"3");
$districts[193]=array("DistrictCode"=>"1A12","DistrictName"=>"Huyện Gia Lâm","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"3");
$districts[194]=array("DistrictCode"=>"1A11","DistrictName"=>"Huyện Thanh Trì","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"3");
$districts[195]=array("DistrictCode"=>"1B16","DistrictName"=>"Thị xã Sơn Tây","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"3");
$districts[196]=array("DistrictCode"=>"1B17","DistrictName"=>"Huyện Ba Vì","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"3");
$districts[197]=array("DistrictCode"=>"1B22","DistrictName"=>"Huyện Đan Phượng","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"3");
$districts[198]=array("DistrictCode"=>"1B23","DistrictName"=>"Huyện Hoài Đức","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"3");
$districts[199]=array("DistrictCode"=>"1B25","DistrictName"=>"Huyện Mỹ Đức","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"3");
$districts[200]=array("DistrictCode"=>"1B18","DistrictName"=>"Huyện Phúc Thọ","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"3");
$districts[201]=array("DistrictCode"=>"1B19","DistrictName"=>"Huyện Thạch Thất","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"3");
$districts[202]=array("DistrictCode"=>"1B24","DistrictName"=>"Huyện Thanh Oai","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"3");
$districts[203]=array("DistrictCode"=>"1B26","DistrictName"=>"Huyện Ứng Hòa","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"3");
$districts[204]=array("DistrictCode"=>"1B21","DistrictName"=>"Huyện Chương Mỹ","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"3");
$districts[205]=array("DistrictCode"=>"1B20","DistrictName"=>"Huyện Quốc Oai ","ProvinceCode"=>"4","ProvinceName"=>"Hà Nội","SupportType"=>"3","Type"=>"3");
$districts[206]=array("DistrictCode"=>"3001","DistrictName"=>"Thành phố Hà Tĩnh","ProvinceCode"=>"39","ProvinceName"=>"Hà Tĩnh","SupportType"=>"3","Type"=>"1");
$districts[207]=array("DistrictCode"=>"3010","DistrictName"=>"Huyện Kỳ Anh","ProvinceCode"=>"39","ProvinceName"=>"Hà Tĩnh","SupportType"=>"3","Type"=>"3");
$districts[208]=array("DistrictCode"=>"3007","DistrictName"=>"Huyện Hương Khê","ProvinceCode"=>"39","ProvinceName"=>"Hà Tĩnh","SupportType"=>"3","Type"=>"3");
$districts[209]=array("DistrictCode"=>"3005","DistrictName"=>"Huyện Nghi Xuân","ProvinceCode"=>"39","ProvinceName"=>"Hà Tĩnh","SupportType"=>"3","Type"=>"3");
$districts[210]=array("DistrictCode"=>"3002","DistrictName"=>"Thị xã Hồng Lĩnh","ProvinceCode"=>"39","ProvinceName"=>"Hà Tĩnh","SupportType"=>"3","Type"=>"3");
$districts[211]=array("DistrictCode"=>"3009","DistrictName"=>"Huyện Cẩm Xuyên","ProvinceCode"=>"39","ProvinceName"=>"Hà Tĩnh","SupportType"=>"3","Type"=>"2");
$districts[212]=array("DistrictCode"=>"3008","DistrictName"=>"Huyện Thạch Hà","ProvinceCode"=>"39","ProvinceName"=>"Hà Tĩnh","SupportType"=>"3","Type"=>"2");
$districts[213]=array("DistrictCode"=>"2103","DistrictName"=>"Huyện Nam Sách","ProvinceCode"=>"320","ProvinceName"=>"Hải Dương","SupportType"=>"2","Type"=>"2");
$districts[214]=array("DistrictCode"=>"2101","DistrictName"=>"Thành phố Hải Dương","ProvinceCode"=>"320","ProvinceName"=>"Hải Dương","SupportType"=>"3","Type"=>"1");
$districts[215]=array("DistrictCode"=>"2112","DistrictName"=>"Huyện Bình Giang","ProvinceCode"=>"320","ProvinceName"=>"Hải Dương","SupportType"=>"3","Type"=>"2");
$districts[216]=array("DistrictCode"=>"2109","DistrictName"=>"Huyện Cẩm Giàng","ProvinceCode"=>"320","ProvinceName"=>"Hải Dương","SupportType"=>"3","Type"=>"2");
$districts[217]=array("DistrictCode"=>"2104","DistrictName"=>"Huyện Kinh Môn","ProvinceCode"=>"320","ProvinceName"=>"Hải Dương","SupportType"=>"3","Type"=>"3");
$districts[218]=array("DistrictCode"=>"2105","DistrictName"=>"Huyện Gia Lộc","ProvinceCode"=>"320","ProvinceName"=>"Hải Dương","SupportType"=>"3","Type"=>"2");
$districts[219]=array("DistrictCode"=>"2111","DistrictName"=>"Huyện Kim Thành","ProvinceCode"=>"320","ProvinceName"=>"Hải Dương","SupportType"=>"3","Type"=>"3");
$districts[220]=array("DistrictCode"=>"2102","DistrictName"=>"Thị xã Chí Linh","ProvinceCode"=>"320","ProvinceName"=>"Hải Dương","SupportType"=>"3","Type"=>"3");
$districts[221]=array("DistrictCode"=>"0303","DistrictName"=>"Quận Ngô Quyền","ProvinceCode"=>"31","ProvinceName"=>"Hải Phòng","SupportType"=>"3","Type"=>"1");
$districts[222]=array("DistrictCode"=>"0302","DistrictName"=>"Quận Lê Chân","ProvinceCode"=>"31","ProvinceName"=>"Hải Phòng","SupportType"=>"3","Type"=>"1");
$districts[223]=array("DistrictCode"=>"0304","DistrictName"=>"Quận Kiến An","ProvinceCode"=>"31","ProvinceName"=>"Hải Phòng","SupportType"=>"3","Type"=>"2");
$districts[224]=array("DistrictCode"=>"0305","DistrictName"=>"Quận Hải An","ProvinceCode"=>"31","ProvinceName"=>"Hải Phòng","SupportType"=>"3","Type"=>"1");
$districts[225]=array("DistrictCode"=>"0301","DistrictName"=>"Quận Hồng Bàng","ProvinceCode"=>"31","ProvinceName"=>"Hải Phòng","SupportType"=>"3","Type"=>"1");
$districts[226]=array("DistrictCode"=>"0306","DistrictName"=>"Quận Đồ Sơn","ProvinceCode"=>"31","ProvinceName"=>"Hải Phòng","SupportType"=>"3","Type"=>"3");
$districts[227]=array("DistrictCode"=>"0309","DistrictName"=>"Huyện Thủy Nguyên","ProvinceCode"=>"31","ProvinceName"=>"Hải Phòng","SupportType"=>"2","Type"=>"2");
$districts[228]=array("DistrictCode"=>"0315","DistrictName"=>"Quận Dương Kinh","ProvinceCode"=>"31","ProvinceName"=>"Hải Phòng","SupportType"=>"3","Type"=>"2");
$districts[229]=array("DistrictCode"=>"0310","DistrictName"=>"Huyện An Dương","ProvinceCode"=>"31","ProvinceName"=>"Hải Phòng","SupportType"=>"3","Type"=>"2");
$districts[230]=array("DistrictCode"=>"0307","DistrictName"=>"Huyện An Lão","ProvinceCode"=>"31","ProvinceName"=>"Hải Phòng","SupportType"=>"3","Type"=>"3");
$districts[231]=array("DistrictCode"=>"0311","DistrictName"=>"Huyện Tiên Lãng","ProvinceCode"=>"31","ProvinceName"=>"Hải Phòng","SupportType"=>"3","Type"=>"3");
$districts[232]=array("DistrictCode"=>"0312","DistrictName"=>"Huyện Vĩnh Bảo","ProvinceCode"=>"31","ProvinceName"=>"Hải Phòng","SupportType"=>"3","Type"=>"3");
$districts[233]=array("DistrictCode"=>"6401","DistrictName"=>"Thành phố Vị Thanh","ProvinceCode"=>"711","ProvinceName"=>"Hậu Giang","SupportType"=>"3","Type"=>"1");
$districts[234]=array("DistrictCode"=>"6407","DistrictName"=>"Thị xã Ngã Bảy","ProvinceCode"=>"711","ProvinceName"=>"Hậu Giang","SupportType"=>"3","Type"=>"3");
$districts[235]=array("DistrictCode"=>"6404","DistrictName"=>"Huyện Phụng Hiệp","ProvinceCode"=>"711","ProvinceName"=>"Hậu Giang","SupportType"=>"3","Type"=>"3");
$districts[236]=array("DistrictCode"=>"6406","DistrictName"=>"Huyện Châu Thành A","ProvinceCode"=>"711","ProvinceName"=>"Hậu Giang","SupportType"=>"3","Type"=>"3");
$districts[237]=array("DistrictCode"=>"6402","DistrictName"=>"Huyện Vị Thuỷ","ProvinceCode"=>"711","ProvinceName"=>"Hậu Giang","SupportType"=>"3","Type"=>"2");
$districts[238]=array("DistrictCode"=>"0201","DistrictName"=>"Quận 1","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"1");
$districts[239]=array("DistrictCode"=>"0202","DistrictName"=>"Quận 2","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"1");
$districts[240]=array("DistrictCode"=>"0203","DistrictName"=>"Quận 3","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"1");
$districts[241]=array("DistrictCode"=>"0204","DistrictName"=>"Quận 4","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"1");
$districts[242]=array("DistrictCode"=>"0205","DistrictName"=>"Quận 5","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"1");
$districts[243]=array("DistrictCode"=>"0206","DistrictName"=>"Quận 6","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"1");
$districts[244]=array("DistrictCode"=>"0207","DistrictName"=>"Quận 7","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"1");
$districts[245]=array("DistrictCode"=>"0208","DistrictName"=>"Quận 8","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"1");
$districts[246]=array("DistrictCode"=>"0209","DistrictName"=>"Quận 9","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"2");
$districts[247]=array("DistrictCode"=>"0210","DistrictName"=>"Quận 10","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"1");
$districts[248]=array("DistrictCode"=>"0211","DistrictName"=>"Quận 11","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"1");
$districts[249]=array("DistrictCode"=>"0212","DistrictName"=>"Quận 12","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"2");
$districts[250]=array("DistrictCode"=>"0214","DistrictName"=>"Quận Tân Bình","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"1");
$districts[251]=array("DistrictCode"=>"0215","DistrictName"=>"Quận Tân Phú","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"1");
$districts[252]=array("DistrictCode"=>"0217","DistrictName"=>"Quận Phú Nhuận","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"1");
$districts[253]=array("DistrictCode"=>"0219","DistrictName"=>"Quận Bình Tân","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"2");
$districts[254]=array("DistrictCode"=>"0222","DistrictName"=>"Huyện Hóc Môn","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"3");
$districts[255]=array("DistrictCode"=>"0221","DistrictName"=>"Huyện Củ Chi","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"3");
$districts[256]=array("DistrictCode"=>"0213","DistrictName"=>"Quận Gò Vấp","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"1");
$districts[257]=array("DistrictCode"=>"0216","DistrictName"=>"Quận Bình Thạnh","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"1");
$districts[258]=array("DistrictCode"=>"0218","DistrictName"=>"Quận Thủ Đức","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"2");
$districts[259]=array("DistrictCode"=>"0220","DistrictName"=>"Huyện Bình Chánh - Bình Chánh","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"3");
$districts[260]=array("DistrictCode"=>"0223","DistrictName"=>"Huyện Nhà Bè","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"3");
$districts[261]=array("DistrictCode"=>"02202","DistrictName"=>"Huyện Bình Chánh 2","ProvinceCode"=>"8","ProvinceName"=>"Hồ Chí Minh","SupportType"=>"3","Type"=>"3");
$districts[262]=array("DistrictCode"=>"2301","DistrictName"=>"Thành phố Hòa Bình","ProvinceCode"=>"218","ProvinceName"=>"Hòa Bình","SupportType"=>"3","Type"=>"1");
$districts[263]=array("DistrictCode"=>"2302","DistrictName"=>"Huyện Đà Bắc","ProvinceCode"=>"218","ProvinceName"=>"Hòa Bình","SupportType"=>"3","Type"=>"2");
$districts[264]=array("DistrictCode"=>"2306","DistrictName"=>"Huyện Kỳ Sơn","ProvinceCode"=>"218","ProvinceName"=>"Hòa Bình","SupportType"=>"3","Type"=>"2");
$districts[265]=array("DistrictCode"=>"2307","DistrictName"=>"Huyện Lương Sơn","ProvinceCode"=>"218","ProvinceName"=>"Hòa Bình","SupportType"=>"3","Type"=>"3");
$districts[266]=array("DistrictCode"=>"2304","DistrictName"=>"Huyện Tân Lạc","ProvinceCode"=>"218","ProvinceName"=>"Hòa Bình","SupportType"=>"3","Type"=>"3");
$districts[267]=array("DistrictCode"=>"2201","DistrictName"=>"Thành phố Hưng Yên","ProvinceCode"=>"321","ProvinceName"=>"Hưng Yên","SupportType"=>"3","Type"=>"1");
$districts[268]=array("DistrictCode"=>"2202","DistrictName"=>"Huyện Kim Động","ProvinceCode"=>"321","ProvinceName"=>"Hưng Yên","SupportType"=>"2","Type"=>"3");
$districts[269]=array("DistrictCode"=>"2203","DistrictName"=>"Huyện Ân Thi","ProvinceCode"=>"321","ProvinceName"=>"Hưng Yên","SupportType"=>"3","Type"=>"3");
$districts[270]=array("DistrictCode"=>"2204","DistrictName"=>"Huyện Khoái Châu","ProvinceCode"=>"321","ProvinceName"=>"Hưng Yên","SupportType"=>"3","Type"=>"3");
$districts[271]=array("DistrictCode"=>"2208","DistrictName"=>"Huyện Mỹ Hào","ProvinceCode"=>"321","ProvinceName"=>"Hưng Yên","SupportType"=>"3","Type"=>"3");
$districts[272]=array("DistrictCode"=>"2205","DistrictName"=>"Huyện Yên Mỹ","ProvinceCode"=>"321","ProvinceName"=>"Hưng Yên","SupportType"=>"3","Type"=>"3");
$districts[273]=array("DistrictCode"=>"2206","DistrictName"=>"Huyện Tiên Lữ","ProvinceCode"=>"321","ProvinceName"=>"Hưng Yên","SupportType"=>"3","Type"=>"2");
$districts[274]=array("DistrictCode"=>"2210","DistrictName"=>"Huyện Văn Giang","ProvinceCode"=>"321","ProvinceName"=>"Hưng Yên","SupportType"=>"3","Type"=>"3");
$districts[275]=array("DistrictCode"=>"2209","DistrictName"=>"Huyện Văn Lâm","ProvinceCode"=>"321","ProvinceName"=>"Hưng Yên","SupportType"=>"3","Type"=>"3");
$districts[276]=array("DistrictCode"=>"4101","DistrictName"=>"Thành phố Nha Trang","ProvinceCode"=>"58","ProvinceName"=>"Khánh Hòa","SupportType"=>"3","Type"=>"1");
$districts[277]=array("DistrictCode"=>"4106","DistrictName"=>"Thành phố Cam Ranh","ProvinceCode"=>"58","ProvinceName"=>"Khánh Hòa","SupportType"=>"3","Type"=>"1");
$districts[278]=array("DistrictCode"=>"4104","DistrictName"=>"Huyện Diên Khánh","ProvinceCode"=>"58","ProvinceName"=>"Khánh Hòa","SupportType"=>"2","Type"=>"2");
$districts[279]=array("DistrictCode"=>"4109","DistrictName"=>"Huyện Cam Lâm","ProvinceCode"=>"58","ProvinceName"=>"Khánh Hòa","SupportType"=>"3","Type"=>"3");
$districts[280]=array("DistrictCode"=>"4102","DistrictName"=>"Huyện Vạn Ninh","ProvinceCode"=>"58","ProvinceName"=>"Khánh Hòa","SupportType"=>"3","Type"=>"3");
$districts[281]=array("DistrictCode"=>"4103","DistrictName"=>"Thị xã Ninh Hòa","ProvinceCode"=>"58","ProvinceName"=>"Khánh Hòa","SupportType"=>"3","Type"=>"3");
$districts[282]=array("DistrictCode"=>"5401","DistrictName"=>"Thành phố Rạch Giá","ProvinceCode"=>"77","ProvinceName"=>"Kiên Giang","SupportType"=>"3","Type"=>"1");
$districts[283]=array("DistrictCode"=>"5406","DistrictName"=>"Huyện Châu Thành","ProvinceCode"=>"77","ProvinceName"=>"Kiên Giang","SupportType"=>"2","Type"=>"2");
$districts[284]=array("DistrictCode"=>"5405","DistrictName"=>"Huyện Tân Hiệp","ProvinceCode"=>"77","ProvinceName"=>"Kiên Giang","SupportType"=>"3","Type"=>"3");
$districts[285]=array("DistrictCode"=>"5407","DistrictName"=>"Huyện Giồng Riềng","ProvinceCode"=>"77","ProvinceName"=>"Kiên Giang","SupportType"=>"3","Type"=>"3");
$districts[286]=array("DistrictCode"=>"5409","DistrictName"=>"Huyện An Biên","ProvinceCode"=>"77","ProvinceName"=>"Kiên Giang","SupportType"=>"3","Type"=>"3");
$districts[287]=array("DistrictCode"=>"5404","DistrictName"=>"Huyện Hòn Đất","ProvinceCode"=>"77","ProvinceName"=>"Kiên Giang","SupportType"=>"3","Type"=>"3");
$districts[288]=array("DistrictCode"=>"5403","DistrictName"=>"Huyện Kiên Lương","ProvinceCode"=>"77","ProvinceName"=>"Kiên Giang","SupportType"=>"3","Type"=>"3");
$districts[289]=array("DistrictCode"=>"5402","DistrictName"=>"Thị xã Hà Tiên","ProvinceCode"=>"77","ProvinceName"=>"Kiên Giang","SupportType"=>"3","Type"=>"3");
$districts[290]=array("DistrictCode"=>"3606","DistrictName"=>"Huyện Kon Plông","ProvinceCode"=>"60","ProvinceName"=>"Kon Tum","SupportType"=>"3","Type"=>"3");
$districts[291]=array("DistrictCode"=>"3607","DistrictName"=>"Huyện Đắk Hà","ProvinceCode"=>"60","ProvinceName"=>"Kon Tum","SupportType"=>"3","Type"=>"3");
$districts[292]=array("DistrictCode"=>"3601","DistrictName"=>"Thành phố Kon Tum","ProvinceCode"=>"60","ProvinceName"=>"Kon Tum","SupportType"=>"3","Type"=>"1");
$districts[293]=array("DistrictCode"=>"3602","DistrictName"=>"Huyện Đắk Glei","ProvinceCode"=>"60","ProvinceName"=>"Kon Tum","SupportType"=>"3","Type"=>"3");
$districts[294]=array("DistrictCode"=>"0701","DistrictName"=>"Thành phố Lai Châu","ProvinceCode"=>"231","ProvinceName"=>"Lai Châu","SupportType"=>"3","Type"=>"1");
$districts[295]=array("DistrictCode"=>"0705","DistrictName"=>"Huyện Mường Tè","ProvinceCode"=>"231","ProvinceName"=>"Lai Châu","SupportType"=>"3","Type"=>"3");
$districts[296]=array("DistrictCode"=>"0708","DistrictName"=>"Huyện Nậm Nhùm","ProvinceCode"=>"231","ProvinceName"=>"Lai Châu","SupportType"=>"3","Type"=>"3");
$districts[297]=array("DistrictCode"=>"0703","DistrictName"=>"Huyện Phong Thổ","ProvinceCode"=>"231","ProvinceName"=>"Lai Châu","SupportType"=>"3","Type"=>"3");
$districts[298]=array("DistrictCode"=>"0704","DistrictName"=>"Huyện Sìn Hồ","ProvinceCode"=>"231","ProvinceName"=>"Lai Châu","SupportType"=>"3","Type"=>"3");
$districts[299]=array("DistrictCode"=>"0702","DistrictName"=>"Huyện Tam Đường","ProvinceCode"=>"231","ProvinceName"=>"Lai Châu","SupportType"=>"3","Type"=>"3");
$districts[300]=array("DistrictCode"=>"0707","DistrictName"=>"Huyện Tân Uyên","ProvinceCode"=>"231","ProvinceName"=>"Lai Châu","SupportType"=>"3","Type"=>"3");
$districts[301]=array("DistrictCode"=>"0706","DistrictName"=>"Huyện Than Uyên","ProvinceCode"=>"231","ProvinceName"=>"Lai Châu","SupportType"=>"3","Type"=>"3");
$districts[302]=array("DistrictCode"=>"4201","DistrictName"=>"Thành phố Đà Lạt","ProvinceCode"=>"63","ProvinceName"=>"Lâm Đồng","SupportType"=>"3","Type"=>"1");
$districts[303]=array("DistrictCode"=>"4205","DistrictName"=>"Huyện Đơn Dương","ProvinceCode"=>"63","ProvinceName"=>"Lâm Đồng","SupportType"=>"3","Type"=>"3");
$districts[304]=array("DistrictCode"=>"4203","DistrictName"=>"Huyện Đức Trọng","ProvinceCode"=>"63","ProvinceName"=>"Lâm Đồng","SupportType"=>"3","Type"=>"3");
$districts[305]=array("DistrictCode"=>"4202","DistrictName"=>"Thành phố Bảo Lộc","ProvinceCode"=>"63","ProvinceName"=>"Lâm Đồng","SupportType"=>"3","Type"=>"3");
$districts[306]=array("DistrictCode"=>"4211","DistrictName"=>"Huyện Bảo Lâm","ProvinceCode"=>"63","ProvinceName"=>"Lâm Đồng","SupportType"=>"3","Type"=>"3");
$districts[307]=array("DistrictCode"=>"4212","DistrictName"=>"Huyện Đam Rông","ProvinceCode"=>"63","ProvinceName"=>"Lâm Đồng","SupportType"=>"3","Type"=>"3");
$districts[308]=array("DistrictCode"=>"4206","DistrictName"=>"Huyện Lạc Dương","ProvinceCode"=>"63","ProvinceName"=>"Lâm Đồng","SupportType"=>"3","Type"=>"2");
$districts[309]=array("DistrictCode"=>"4210","DistrictName"=>"Huyện Lâm Hà","ProvinceCode"=>"63","ProvinceName"=>"Lâm Đồng","SupportType"=>"3","Type"=>"3");
$districts[310]=array("DistrictCode"=>"1001","DistrictName"=>"Thành phố Lạng Sơn","ProvinceCode"=>"25","ProvinceName"=>"Lạng Sơn","SupportType"=>"3","Type"=>"1");
$districts[311]=array("DistrictCode"=>"1007","DistrictName"=>"Huyện Cao Lộc","ProvinceCode"=>"25","ProvinceName"=>"Lạng Sơn","SupportType"=>"3","Type"=>"2");
$districts[312]=array("DistrictCode"=>"1011","DistrictName"=>"Huyện Hữu Lũng","ProvinceCode"=>"25","ProvinceName"=>"Lạng Sơn","SupportType"=>"3","Type"=>"3");
$districts[313]=array("DistrictCode"=>"1008","DistrictName"=>"Huyện Lộc Bình","ProvinceCode"=>"25","ProvinceName"=>"Lạng Sơn","SupportType"=>"3","Type"=>"2");
$districts[314]=array("DistrictCode"=>"1002","DistrictName"=>"Huyện Tràng Định","ProvinceCode"=>"25","ProvinceName"=>"Lạng Sơn","SupportType"=>"3","Type"=>"3");
$districts[315]=array("DistrictCode"=>"0803","DistrictName"=>"Huyện Bát Xát","ProvinceCode"=>"20","ProvinceName"=>"Lào Cai","SupportType"=>"2","Type"=>"2");
$districts[316]=array("DistrictCode"=>"0807","DistrictName"=>"Huyện Bảo Yên","ProvinceCode"=>"20","ProvinceName"=>"Lào Cai","SupportType"=>"3","Type"=>"3");
$districts[317]=array("DistrictCode"=>"0808","DistrictName"=>"Huyện Bắc Hà","ProvinceCode"=>"20","ProvinceName"=>"Lào Cai","SupportType"=>"3","Type"=>"3");
$districts[318]=array("DistrictCode"=>"0801","DistrictName"=>"Thành phố Lào Cai","ProvinceCode"=>"20","ProvinceName"=>"Lào Cai","SupportType"=>"3","Type"=>"1");
$districts[319]=array("DistrictCode"=>"0805","DistrictName"=>"Huyện Sa Pa","ProvinceCode"=>"20","ProvinceName"=>"Lào Cai","SupportType"=>"3","Type"=>"3");
$districts[320]=array("DistrictCode"=>"0806","DistrictName"=>"Huyện Văn Bàn","ProvinceCode"=>"20","ProvinceName"=>"Lào Cai","SupportType"=>"3","Type"=>"3");
$districts[321]=array("DistrictCode"=>"4901","DistrictName"=>"Thành phố Tân An","ProvinceCode"=>"72","ProvinceName"=>"Long An","SupportType"=>"3","Type"=>"1");
$districts[322]=array("DistrictCode"=>"4908","DistrictName"=>"Huyện Bến Lức","ProvinceCode"=>"72","ProvinceName"=>"Long An","SupportType"=>"3","Type"=>"2");
$districts[323]=array("DistrictCode"=>"4912","DistrictName"=>"Huyện Cần Đước","ProvinceCode"=>"72","ProvinceName"=>"Long An","SupportType"=>"3","Type"=>"3");
$districts[324]=array("DistrictCode"=>"4913","DistrictName"=>"Huyện Cần Giuộc","ProvinceCode"=>"72","ProvinceName"=>"Long An","SupportType"=>"3","Type"=>"3");
$districts[325]=array("DistrictCode"=>"4910","DistrictName"=>"Huyện Châu Thành","ProvinceCode"=>"72","ProvinceName"=>"Long An","SupportType"=>"3","Type"=>"2");
$districts[326]=array("DistrictCode"=>"4907","DistrictName"=>"Huyện Đức Hòa","ProvinceCode"=>"72","ProvinceName"=>"Long An","SupportType"=>"3","Type"=>"3");
$districts[327]=array("DistrictCode"=>"4911","DistrictName"=>"Huyện Tân Trụ","ProvinceCode"=>"72","ProvinceName"=>"Long An","SupportType"=>"3","Type"=>"2");
$districts[328]=array("DistrictCode"=>"4909","DistrictName"=>"Huyện Thủ Thừa","ProvinceCode"=>"72","ProvinceName"=>"Long An","SupportType"=>"3","Type"=>"2");
$districts[329]=array("DistrictCode"=>"2501","DistrictName"=>"Thành phố Nam Định","ProvinceCode"=>"350","ProvinceName"=>"Nam Định","SupportType"=>"3","Type"=>"1");
$districts[330]=array("DistrictCode"=>"2510","DistrictName"=>"Huyện Hải Hậu","ProvinceCode"=>"350","ProvinceName"=>"Nam Định","SupportType"=>"3","Type"=>"3");
$districts[331]=array("DistrictCode"=>"2505","DistrictName"=>"Huyện Ý Yên","ProvinceCode"=>"350","ProvinceName"=>"Nam Định","SupportType"=>"3","Type"=>"3");
$districts[332]=array("DistrictCode"=>"2502","DistrictName"=>"Huyện Mỹ Lộc","ProvinceCode"=>"350","ProvinceName"=>"Nam Định","SupportType"=>"3","Type"=>"2");
$districts[333]=array("DistrictCode"=>"2507","DistrictName"=>"Huyện Nam Trực","ProvinceCode"=>"350","ProvinceName"=>"Nam Định","SupportType"=>"3","Type"=>"2");
$districts[334]=array("DistrictCode"=>"2901","DistrictName"=>"Thành phố Vinh","ProvinceCode"=>"38","ProvinceName"=>"Nghệ An","SupportType"=>"3","Type"=>"1");
$districts[335]=array("DistrictCode"=>"2902","DistrictName"=>"Thị xã Cửa Lò","ProvinceCode"=>"38","ProvinceName"=>"Nghệ An","SupportType"=>"3","Type"=>"2");
$districts[336]=array("DistrictCode"=>"2914","DistrictName"=>"Huyện Đô Lương","ProvinceCode"=>"38","ProvinceName"=>"Nghệ An","SupportType"=>"3","Type"=>"3");
$districts[337]=array("DistrictCode"=>"2913","DistrictName"=>"Huyện Anh Sơn","ProvinceCode"=>"38","ProvinceName"=>"Nghệ An","SupportType"=>"3","Type"=>"3");
$districts[338]=array("DistrictCode"=>"2910","DistrictName"=>"Huyện Tân Kỳ","ProvinceCode"=>"38","ProvinceName"=>"Nghệ An","SupportType"=>"3","Type"=>"3");
$districts[339]=array("DistrictCode"=>"2911","DistrictName"=>"Huyện Yên Thành","ProvinceCode"=>"38","ProvinceName"=>"Nghệ An","SupportType"=>"3","Type"=>"3");
$districts[340]=array("DistrictCode"=>"2912","DistrictName"=>"Huyện Diễn Châu","ProvinceCode"=>"38","ProvinceName"=>"Nghệ An","SupportType"=>"3","Type"=>"3");
$districts[341]=array("DistrictCode"=>"2906","DistrictName"=>"Huyện Quỳnh Lưu","ProvinceCode"=>"38","ProvinceName"=>"Nghệ An","SupportType"=>"3","Type"=>"3");
$districts[342]=array("DistrictCode"=>"2921","DistrictName"=>"Thị xã Hoàng Mai","ProvinceCode"=>"38","ProvinceName"=>"Nghệ An","SupportType"=>"3","Type"=>"3");
$districts[343]=array("DistrictCode"=>"2920","DistrictName"=>"Thị xã Thái Hòa","ProvinceCode"=>"38","ProvinceName"=>"Nghệ An","SupportType"=>"3","Type"=>"3");
$districts[344]=array("DistrictCode"=>"2905","DistrictName"=>"Huyện Nghĩa Đàn","ProvinceCode"=>"38","ProvinceName"=>"Nghệ An","SupportType"=>"3","Type"=>"3");
$districts[345]=array("DistrictCode"=>"2904","DistrictName"=>"Huyện Quỳ Hợp","ProvinceCode"=>"38","ProvinceName"=>"Nghệ An","SupportType"=>"3","Type"=>"3");
$districts[346]=array("DistrictCode"=>"2909","DistrictName"=>"Huyện Con Cuông","ProvinceCode"=>"38","ProvinceName"=>"Nghệ An","SupportType"=>"3","Type"=>"3");
$districts[347]=array("DistrictCode"=>"2916","DistrictName"=>"Huyện Nghi Lộc","ProvinceCode"=>"38","ProvinceName"=>"Nghệ An","SupportType"=>"3","Type"=>"2");
$districts[348]=array("DistrictCode"=>"2918","DistrictName"=>"Huyện Hưng Nguyên","ProvinceCode"=>"38","ProvinceName"=>"Nghệ An","SupportType"=>"3","Type"=>"2");
$districts[349]=array("DistrictCode"=>"2702","DistrictName"=>"Thị xã Tam Điệp","ProvinceCode"=>"30","ProvinceName"=>"Ninh Bình","SupportType"=>"2","Type"=>"2");
$districts[350]=array("DistrictCode"=>"2708","DistrictName"=>"Huyện Yên Khánh","ProvinceCode"=>"30","ProvinceName"=>"Ninh Bình","SupportType"=>"2","Type"=>"3");
$districts[351]=array("DistrictCode"=>"2701","DistrictName"=>"Thành phố Ninh Bình","ProvinceCode"=>"30","ProvinceName"=>"Ninh Bình","SupportType"=>"3","Type"=>"1");
$districts[352]=array("DistrictCode"=>"2705","DistrictName"=>"Huyện Hoa Lư","ProvinceCode"=>"30","ProvinceName"=>"Ninh Bình","SupportType"=>"3","Type"=>"2");
$districts[353]=array("DistrictCode"=>"4502","DistrictName"=>"Huyện Ninh Sơn","ProvinceCode"=>"68","ProvinceName"=>"Ninh Thuận","SupportType"=>"3","Type"=>"3");
$districts[354]=array("DistrictCode"=>"4501","DistrictName"=>"Thành phố Phan Rang – Tháp Chàm","ProvinceCode"=>"68","ProvinceName"=>"Ninh Thuận","SupportType"=>"3","Type"=>"1");
$districts[355]=array("DistrictCode"=>"4503","DistrictName"=>"Huyện Ninh Hải","ProvinceCode"=>"68","ProvinceName"=>"Ninh Thuận","SupportType"=>"3","Type"=>"2");
$districts[356]=array("DistrictCode"=>"4504","DistrictName"=>"Huyện Ninh Phước","ProvinceCode"=>"68","ProvinceName"=>"Ninh Thuận","SupportType"=>"3","Type"=>"2");
$districts[357]=array("DistrictCode"=>"1501","DistrictName"=>"Thành phố Việt Trì","ProvinceCode"=>"210","ProvinceName"=>"Phú Thọ","SupportType"=>"3","Type"=>"1");
$districts[358]=array("DistrictCode"=>"1506","DistrictName"=>"Huyện Cẩm Khê","ProvinceCode"=>"210","ProvinceName"=>"Phú Thọ","SupportType"=>"3","Type"=>"3");
$districts[359]=array("DistrictCode"=>"1503","DistrictName"=>"Huyện Đoan Hùng","ProvinceCode"=>"210","ProvinceName"=>"Phú Thọ","SupportType"=>"3","Type"=>"3");
$districts[360]=array("DistrictCode"=>"1505","DistrictName"=>"Huyện Hạ Hòa","ProvinceCode"=>"210","ProvinceName"=>"Phú Thọ","SupportType"=>"3","Type"=>"3");
$districts[361]=array("DistrictCode"=>"1510","DistrictName"=>"Huyện Lâm Thao","ProvinceCode"=>"210","ProvinceName"=>"Phú Thọ","SupportType"=>"3","Type"=>"2");
$districts[362]=array("DistrictCode"=>"1509","DistrictName"=>"Huyện Phù Ninh","ProvinceCode"=>"210","ProvinceName"=>"Phú Thọ","SupportType"=>"3","Type"=>"3");
$districts[363]=array("DistrictCode"=>"1513","DistrictName"=>"Huyện Tân Sơn","ProvinceCode"=>"210","ProvinceName"=>"Phú Thọ","SupportType"=>"3","Type"=>"3");
$districts[364]=array("DistrictCode"=>"1508","DistrictName"=>"Huyện Thanh Sơn","ProvinceCode"=>"210","ProvinceName"=>"Phú Thọ","SupportType"=>"3","Type"=>"3");
$districts[365]=array("DistrictCode"=>"1502","DistrictName"=>"Thị xã Phú Thọ","ProvinceCode"=>"210","ProvinceName"=>"Phú Thọ","SupportType"=>"3","Type"=>"3");
$districts[366]=array("DistrictCode"=>"3903","DistrictName"=>"Thị Xã Sông Cầu","ProvinceCode"=>"57","ProvinceName"=>"Phú Yên","SupportType"=>"3","Type"=>"3");
$districts[367]=array("DistrictCode"=>"3901","DistrictName"=>"Thành phố Tuy Hòa","ProvinceCode"=>"57","ProvinceName"=>"Phú Yên","SupportType"=>"3","Type"=>"1");
$districts[368]=array("DistrictCode"=>"3908","DistrictName"=>"Huyện Phú Hòa","ProvinceCode"=>"57","ProvinceName"=>"Phú Yên","SupportType"=>"3","Type"=>"2");
$districts[369]=array("DistrictCode"=>"3101","DistrictName"=>"Thành phố Đồng Hới","ProvinceCode"=>"52","ProvinceName"=>"Quảng Bình","SupportType"=>"3","Type"=>"1");
$districts[370]=array("DistrictCode"=>"3107","DistrictName"=>"Huyện Lệ Thủy","ProvinceCode"=>"52","ProvinceName"=>"Quảng Bình","SupportType"=>"3","Type"=>"3");
$districts[371]=array("DistrictCode"=>"3105","DistrictName"=>"Huyện Bố Trạch","ProvinceCode"=>"52","ProvinceName"=>"Quảng Bình","SupportType"=>"3","Type"=>"2");
$districts[372]=array("DistrictCode"=>"3108","DistrictName"=>"Thị xã Ba Đồn","ProvinceCode"=>"52","ProvinceName"=>"Quảng Bình","SupportType"=>"3","Type"=>"3");
$districts[373]=array("DistrictCode"=>"3106","DistrictName"=>"Huyện Quảng Ninh","ProvinceCode"=>"52","ProvinceName"=>"Quảng Bình","SupportType"=>"3","Type"=>"2");
$districts[374]=array("DistrictCode"=>"3401","DistrictName"=>"Thành phố Tam Kỳ","ProvinceCode"=>"510","ProvinceName"=>"Quảng Nam","SupportType"=>"3","Type"=>"1");
$districts[375]=array("DistrictCode"=>"3402","DistrictName"=>"Thành phố Hội An","ProvinceCode"=>"510","ProvinceName"=>"Quảng Nam","SupportType"=>"3","Type"=>"1");
$districts[376]=array("DistrictCode"=>"3403","DistrictName"=>"Huyện Duy Xuyên","ProvinceCode"=>"510","ProvinceName"=>"Quảng Nam","SupportType"=>"2","Type"=>"3");
$districts[377]=array("DistrictCode"=>"3404","DistrictName"=>"Huyện Điện Bàn","ProvinceCode"=>"510","ProvinceName"=>"Quảng Nam","SupportType"=>"2","Type"=>"2");
$districts[378]=array("DistrictCode"=>"3405","DistrictName"=>"Huyện Đại Lộc","ProvinceCode"=>"510","ProvinceName"=>"Quảng Nam","SupportType"=>"3","Type"=>"3");
$districts[379]=array("DistrictCode"=>"3409","DistrictName"=>"Huyện Núi Thành","ProvinceCode"=>"510","ProvinceName"=>"Quảng Nam","SupportType"=>"3","Type"=>"3");
$districts[380]=array("DistrictCode"=>"3417","DistrictName"=>"Huyện Phú Ninh","ProvinceCode"=>"510","ProvinceName"=>"Quảng Nam","SupportType"=>"3","Type"=>"2");
$districts[381]=array("DistrictCode"=>"3406","DistrictName"=>"Huyện Quế Sơn","ProvinceCode"=>"510","ProvinceName"=>"Quảng Nam","SupportType"=>"3","Type"=>"3");
$districts[382]=array("DistrictCode"=>"3501","DistrictName"=>"Thành phố Quảng Ngãi","ProvinceCode"=>"55","ProvinceName"=>"Quảng Ngãi","SupportType"=>"3","Type"=>"1");
$districts[383]=array("DistrictCode"=>"3505","DistrictName"=>"Huyện Sơn Tịnh","ProvinceCode"=>"55","ProvinceName"=>"Quảng Ngãi","SupportType"=>"2","Type"=>"2");
$districts[384]=array("DistrictCode"=>"3507","DistrictName"=>"Huyện Tư Nghĩa","ProvinceCode"=>"55","ProvinceName"=>"Quảng Ngãi","SupportType"=>"2","Type"=>"2");
$districts[385]=array("DistrictCode"=>"3503","DistrictName"=>"Huyện Bình Sơn","ProvinceCode"=>"55","ProvinceName"=>"Quảng Ngãi","SupportType"=>"3","Type"=>"3");
$districts[386]=array("DistrictCode"=>"3511","DistrictName"=>"Huyện Đức Phổ","ProvinceCode"=>"55","ProvinceName"=>"Quảng Ngãi","SupportType"=>"3","Type"=>"3");
$districts[387]=array("DistrictCode"=>"3508","DistrictName"=>"Huyện Nghĩa Hành","ProvinceCode"=>"55","ProvinceName"=>"Quảng Ngãi","SupportType"=>"3","Type"=>"2");
$districts[388]=array("DistrictCode"=>"1702","DistrictName"=>"Thành phố Cẩm Phả","ProvinceCode"=>"33","ProvinceName"=>"Quảng Ninh","SupportType"=>"3","Type"=>"1");
$districts[389]=array("DistrictCode"=>"1703","DistrictName"=>"Thành phố Uông Bí","ProvinceCode"=>"33","ProvinceName"=>"Quảng Ninh","SupportType"=>"3","Type"=>"3");
$districts[390]=array("DistrictCode"=>"1704","DistrictName"=>"Thành phố Móng Cái","ProvinceCode"=>"33","ProvinceName"=>"Quảng Ninh","SupportType"=>"3","Type"=>"3");
$districts[391]=array("DistrictCode"=>"1701","DistrictName"=>"Thành phố Hạ Long","ProvinceCode"=>"33","ProvinceName"=>"Quảng Ninh","SupportType"=>"3","Type"=>"1");
$districts[392]=array("DistrictCode"=>"1705","DistrictName"=>"Huyện Bình Liêu","ProvinceCode"=>"33","ProvinceName"=>"Quảng Ninh","SupportType"=>"3","Type"=>"3");
$districts[393]=array("DistrictCode"=>"1713","DistrictName"=>"Huyện đảo Vân Đồn","ProvinceCode"=>"33","ProvinceName"=>"Quảng Ninh","SupportType"=>"3","Type"=>"3");
$districts[394]=array("DistrictCode"=>"1707","DistrictName"=>"Huyện Hải Hà","ProvinceCode"=>"33","ProvinceName"=>"Quảng Ninh","SupportType"=>"3","Type"=>"3");
$districts[395]=array("DistrictCode"=>"1708","DistrictName"=>"Huyện Tiên Yên","ProvinceCode"=>"33","ProvinceName"=>"Quảng Ninh","SupportType"=>"3","Type"=>"3");
$districts[396]=array("DistrictCode"=>"1711","DistrictName"=>"Thị xã Quảng Yên","ProvinceCode"=>"33","ProvinceName"=>"Quảng Ninh","SupportType"=>"3","Type"=>"3");
$districts[397]=array("DistrictCode"=>"3201","DistrictName"=>"Thành phố Đông Hà","ProvinceCode"=>"53","ProvinceName"=>"Quảng Trị","SupportType"=>"3","Type"=>"1");
$districts[398]=array("DistrictCode"=>"3202","DistrictName"=>"Thị xã Quảng Trị","ProvinceCode"=>"53","ProvinceName"=>"Quảng Trị","SupportType"=>"3","Type"=>"3");
$districts[399]=array("DistrictCode"=>"3208","DistrictName"=>"Huyện Hướng Hóa","ProvinceCode"=>"53","ProvinceName"=>"Quảng Trị","SupportType"=>"3","Type"=>"3");
$districts[400]=array("DistrictCode"=>"3203","DistrictName"=>"Huyện Vĩnh Linh","ProvinceCode"=>"53","ProvinceName"=>"Quảng Trị","SupportType"=>"3","Type"=>"3");
$districts[401]=array("DistrictCode"=>"3205","DistrictName"=>"Huyện Cam Lộ","ProvinceCode"=>"53","ProvinceName"=>"Quảng Trị","SupportType"=>"3","Type"=>"2");
$districts[402]=array("DistrictCode"=>"3204","DistrictName"=>"Huyện Gio Linh","ProvinceCode"=>"53","ProvinceName"=>"Quảng Trị","SupportType"=>"3","Type"=>"2");
$districts[403]=array("DistrictCode"=>"3206","DistrictName"=>"Huyện Triệu Phong","ProvinceCode"=>"53","ProvinceName"=>"Quảng Trị","SupportType"=>"3","Type"=>"2");
$districts[404]=array("DistrictCode"=>"5901","DistrictName"=>"Thành phố Sóc Trăng","ProvinceCode"=>"79","ProvinceName"=>"Sóc Trăng","SupportType"=>"3","Type"=>"1");
$districts[405]=array("DistrictCode"=>"5904","DistrictName"=>"Huyện Mỹ Xuyên","ProvinceCode"=>"79","ProvinceName"=>"Sóc Trăng","SupportType"=>"2","Type"=>"2");
$districts[406]=array("DistrictCode"=>"5910","DistrictName"=>"Huyện Châu Thành","ProvinceCode"=>"79","ProvinceName"=>"Sóc Trăng","SupportType"=>"3","Type"=>"2");
$districts[407]=array("DistrictCode"=>"5902","DistrictName"=>"Huyện Kế Sách","ProvinceCode"=>"79","ProvinceName"=>"Sóc Trăng","SupportType"=>"3","Type"=>"3");
$districts[408]=array("DistrictCode"=>"5911","DistrictName"=>"Huyện Trần Đề","ProvinceCode"=>"79","ProvinceName"=>"Sóc Trăng","SupportType"=>"3","Type"=>"2");
$districts[409]=array("DistrictCode"=>"5909","DistrictName"=>"Thị xã Ngã Năm","ProvinceCode"=>"79","ProvinceName"=>"Sóc Trăng","SupportType"=>"3","Type"=>"3");
$districts[410]=array("DistrictCode"=>"1401","DistrictName"=>"Thành phố Sơn La","ProvinceCode"=>"22","ProvinceName"=>"Sơn La","SupportType"=>"3","Type"=>"1");
$districts[411]=array("DistrictCode"=>"1407","DistrictName"=>"Huyện Mai Sơn","ProvinceCode"=>"22","ProvinceName"=>"Sơn La","SupportType"=>"3","Type"=>"3");
$districts[412]=array("DistrictCode"=>"1410","DistrictName"=>"Huyện Mộc Châu","ProvinceCode"=>"22","ProvinceName"=>"Sơn La","SupportType"=>"3","Type"=>"3");
$districts[413]=array("DistrictCode"=>"1406","DistrictName"=>"Huyện Phù Yên","ProvinceCode"=>"22","ProvinceName"=>"Sơn La","SupportType"=>"3","Type"=>"3");
$districts[414]=array("DistrictCode"=>"1409","DistrictName"=>"Huyện Sông Mã","ProvinceCode"=>"22","ProvinceName"=>"Sơn La","SupportType"=>"3","Type"=>"3");
$districts[415]=array("DistrictCode"=>"1404","DistrictName"=>"Huyện Thuận Châu","ProvinceCode"=>"22","ProvinceName"=>"Sơn La","SupportType"=>"3","Type"=>"3");
$districts[416]=array("DistrictCode"=>"4605","DistrictName"=>"Huyện Châu Thành","ProvinceCode"=>"66","ProvinceName"=>"Tây Ninh","SupportType"=>"2","Type"=>"2");
$districts[417]=array("DistrictCode"=>"4606","DistrictName"=>"Huyện Hòa Thành","ProvinceCode"=>"66","ProvinceName"=>"Tây Ninh","SupportType"=>"2","Type"=>"2");
$districts[418]=array("DistrictCode"=>"4602","DistrictName"=>"Huyện Tân Biên","ProvinceCode"=>"66","ProvinceName"=>"Tây Ninh","SupportType"=>"3","Type"=>"3");
$districts[419]=array("DistrictCode"=>"4603","DistrictName"=>"Huyện Tân Châu","ProvinceCode"=>"66","ProvinceName"=>"Tây Ninh","SupportType"=>"3","Type"=>"3");
$districts[420]=array("DistrictCode"=>"4604","DistrictName"=>"Huyện Dương Minh Châu","ProvinceCode"=>"66","ProvinceName"=>"Tây Ninh","SupportType"=>"3","Type"=>"2");
$districts[421]=array("DistrictCode"=>"4607","DistrictName"=>"Huyện Bến Cầu","ProvinceCode"=>"66","ProvinceName"=>"Tây Ninh","SupportType"=>"3","Type"=>"3");
$districts[422]=array("DistrictCode"=>"4608","DistrictName"=>"Huyện Gò Dầu","ProvinceCode"=>"66","ProvinceName"=>"Tây Ninh","SupportType"=>"3","Type"=>"3");
$districts[423]=array("DistrictCode"=>"4601","DistrictName"=>"Thành phố Tây Ninh","ProvinceCode"=>"66","ProvinceName"=>"Tây Ninh","SupportType"=>"3","Type"=>"1");
$districts[424]=array("DistrictCode"=>"4609","DistrictName"=>"Huyện Trảng Bàng","ProvinceCode"=>"66","ProvinceName"=>"Tây Ninh","SupportType"=>"3","Type"=>"3");
$districts[425]=array("DistrictCode"=>"2604","DistrictName"=>"Huyện Đông Hưng","ProvinceCode"=>"36","ProvinceName"=>"Thái Bình","SupportType"=>"2","Type"=>"2");
$districts[426]=array("DistrictCode"=>"2605","DistrictName"=>"Huyện Vũ Thư","ProvinceCode"=>"36","ProvinceName"=>"Thái Bình","SupportType"=>"2","Type"=>"2");
$districts[427]=array("DistrictCode"=>"2601","DistrictName"=>"Thành phố Thái Bình","ProvinceCode"=>"36","ProvinceName"=>"Thái Bình","SupportType"=>"3","Type"=>"1");
$districts[428]=array("DistrictCode"=>"2603","DistrictName"=>"Huyện Hưng Hà","ProvinceCode"=>"36","ProvinceName"=>"Thái Bình","SupportType"=>"3","Type"=>"2");
$districts[429]=array("DistrictCode"=>"2602","DistrictName"=>"Huyện Quỳnh Phụ","ProvinceCode"=>"36","ProvinceName"=>"Thái Bình","SupportType"=>"3","Type"=>"2");
$districts[430]=array("DistrictCode"=>"2608","DistrictName"=>"Huyện Thái Thụy","ProvinceCode"=>"36","ProvinceName"=>"Thái Bình","SupportType"=>"3","Type"=>"2");
$districts[431]=array("DistrictCode"=>"2606","DistrictName"=>"Huyện Kiến Xương","ProvinceCode"=>"36","ProvinceName"=>"Thái Bình","SupportType"=>"3","Type"=>"2");
$districts[432]=array("DistrictCode"=>"1207","DistrictName"=>"Huyện Đồng Hỷ","ProvinceCode"=>"280","ProvinceName"=>"Thái Nguyên","SupportType"=>"2","Type"=>"2");
$districts[433]=array("DistrictCode"=>"1201","DistrictName"=>"Thành phố Thái Nguyên","ProvinceCode"=>"280","ProvinceName"=>"Thái Nguyên","SupportType"=>"3","Type"=>"1");
$districts[434]=array("DistrictCode"=>"1202","DistrictName"=>"Thị xã Sông Công","ProvinceCode"=>"280","ProvinceName"=>"Thái Nguyên","SupportType"=>"3","Type"=>"2");
$districts[435]=array("DistrictCode"=>"1206","DistrictName"=>"Huyện Đại Từ","ProvinceCode"=>"280","ProvinceName"=>"Thái Nguyên","SupportType"=>"3","Type"=>"3");
$districts[436]=array("DistrictCode"=>"1203","DistrictName"=>"Huyện Định Hóa","ProvinceCode"=>"280","ProvinceName"=>"Thái Nguyên","SupportType"=>"3","Type"=>"3");
$districts[437]=array("DistrictCode"=>"1209","DistrictName"=>"Huyện Phổ Yên","ProvinceCode"=>"280","ProvinceName"=>"Thái Nguyên","SupportType"=>"3","Type"=>"3");
$districts[438]=array("DistrictCode"=>"1208","DistrictName"=>"Huyện Phú Bình","ProvinceCode"=>"280","ProvinceName"=>"Thái Nguyên","SupportType"=>"3","Type"=>"3");
$districts[439]=array("DistrictCode"=>"1205","DistrictName"=>"Huyện Võ Nhai","ProvinceCode"=>"280","ProvinceName"=>"Thái Nguyên","SupportType"=>"3","Type"=>"3");
$districts[440]=array("DistrictCode"=>"2801","DistrictName"=>"Thành phố Thanh Hóa","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"1");
$districts[441]=array("DistrictCode"=>"2803","DistrictName"=>"Thị xã Sầm Sơn","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"2","Type"=>"2");
$districts[442]=array("DistrictCode"=>"2826","DistrictName"=>"Huyện Tĩnh Gia","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"3");
$districts[443]=array("DistrictCode"=>"2809","DistrictName"=>"Huyện Như Xuân","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"3");
$districts[444]=array("DistrictCode"=>"2808","DistrictName"=>"Huyện Thường Xuân","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"3");
$districts[445]=array("DistrictCode"=>"2815","DistrictName"=>"Huyện Thọ Xuân","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"3");
$districts[446]=array("DistrictCode"=>"2812","DistrictName"=>"Huyện Ngọc Lặc","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"3");
$districts[447]=array("DistrictCode"=>"2827","DistrictName"=>"Huyện Yên Định","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"3");
$districts[448]=array("DistrictCode"=>"2802","DistrictName"=>"Thị xã Bỉm Sơn","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"3");
$districts[449]=array("DistrictCode"=>"2821","DistrictName"=>"Huyện Hà Trung","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"2");
$districts[450]=array("DistrictCode"=>"2806","DistrictName"=>"Huyện Mường Lát","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"3");
$districts[451]=array("DistrictCode"=>"2804","DistrictName"=>"Huyện Quan Hóa","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"3");
$districts[452]=array("DistrictCode"=>"2813","DistrictName"=>"Huyện Thạch Thành","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"3");
$districts[453]=array("DistrictCode"=>"2816","DistrictName"=>"Huyện Vĩnh Lộc","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"3");
$districts[454]=array("DistrictCode"=>"2825","DistrictName"=>"Huyện Quảng Xương","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"2");
$districts[455]=array("DistrictCode"=>"2822","DistrictName"=>"Huyện Hoằng Hóa","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"2");
$districts[456]=array("DistrictCode"=>"2820","DistrictName"=>"Huyện Đông Sơn","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"2");
$districts[457]=array("DistrictCode"=>"2824","DistrictName"=>"Huyện Hậu Lộc","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"3");
$districts[458]=array("DistrictCode"=>"2805","DistrictName"=>"Huyện Quan Sơn","ProvinceCode"=>"37","ProvinceName"=>"Thanh Hóa","SupportType"=>"3","Type"=>"3");
$districts[459]=array("DistrictCode"=>"3301","DistrictName"=>"Thành phố Huế","ProvinceCode"=>"54","ProvinceName"=>"Thừa Thiên – Huế","SupportType"=>"3","Type"=>"1");
$districts[460]=array("DistrictCode"=>"3305","DistrictName"=>"Huyện Phú Vang","ProvinceCode"=>"54","ProvinceName"=>"Thừa Thiên – Huế","SupportType"=>"3","Type"=>"3");
$districts[461]=array("DistrictCode"=>"3307","DistrictName"=>"Huyện Phú Lộc","ProvinceCode"=>"54","ProvinceName"=>"Thừa Thiên – Huế","SupportType"=>"3","Type"=>"3");
$districts[462]=array("DistrictCode"=>"3309","DistrictName"=>"Huyện A Lưới","ProvinceCode"=>"54","ProvinceName"=>"Thừa Thiên – Huế","SupportType"=>"3","Type"=>"3");
$districts[463]=array("DistrictCode"=>"3304","DistrictName"=>"Thị xã Hương Trà","ProvinceCode"=>"54","ProvinceName"=>"Thừa Thiên – Huế","SupportType"=>"3","Type"=>"2");
$districts[464]=array("DistrictCode"=>"3306","DistrictName"=>"Thị xã Hương Thủy","ProvinceCode"=>"54","ProvinceName"=>"Thừa Thiên – Huế","SupportType"=>"3","Type"=>"2");
$districts[465]=array("DistrictCode"=>"5301","DistrictName"=>"Thành phố Mỹ Tho","ProvinceCode"=>"73","ProvinceName"=>"Tiền Giang","SupportType"=>"3","Type"=>"1");
$districts[466]=array("DistrictCode"=>"5305","DistrictName"=>"Huyện Châu Thành","ProvinceCode"=>"73","ProvinceName"=>"Tiền Giang","SupportType"=>"2","Type"=>"2");
$districts[467]=array("DistrictCode"=>"5306","DistrictName"=>"Huyện Chợ Gạo","ProvinceCode"=>"73","ProvinceName"=>"Tiền Giang","SupportType"=>"2","Type"=>"2");
$districts[468]=array("DistrictCode"=>"5303","DistrictName"=>"Huyện Cái Bè","ProvinceCode"=>"73","ProvinceName"=>"Tiền Giang","SupportType"=>"3","Type"=>"3");
$districts[469]=array("DistrictCode"=>"5308","DistrictName"=>"Huyện Gò Công Đông","ProvinceCode"=>"73","ProvinceName"=>"Tiền Giang","SupportType"=>"3","Type"=>"3");
$districts[470]=array("DistrictCode"=>"5307","DistrictName"=>"Huyện Gò Công Tây","ProvinceCode"=>"73","ProvinceName"=>"Tiền Giang","SupportType"=>"3","Type"=>"2");
$districts[471]=array("DistrictCode"=>"5311","DistrictName"=>"Thị xã Cai Lậy","ProvinceCode"=>"73","ProvinceName"=>"Tiền Giang","SupportType"=>"3","Type"=>"3");
$districts[472]=array("DistrictCode"=>"5302","DistrictName"=>"Thị xã Gò Công","ProvinceCode"=>"73","ProvinceName"=>"Tiền Giang","SupportType"=>"3","Type"=>"3");
$districts[473]=array("DistrictCode"=>"5801","DistrictName"=>"Thành phố Trà Vinh","ProvinceCode"=>"74","ProvinceName"=>"Trà Vinh","SupportType"=>"3","Type"=>"1");
$districts[474]=array("DistrictCode"=>"5807","DistrictName"=>"Huyện Cầu Ngang","ProvinceCode"=>"74","ProvinceName"=>"Trà Vinh","SupportType"=>"3","Type"=>"3");
$districts[475]=array("DistrictCode"=>"5805","DistrictName"=>"Huyện Châu Thành","ProvinceCode"=>"74","ProvinceName"=>"Trà Vinh","SupportType"=>"3","Type"=>"2");
$districts[476]=array("DistrictCode"=>"5804","DistrictName"=>"Huyện Tiểu Cần","ProvinceCode"=>"74","ProvinceName"=>"Trà Vinh","SupportType"=>"3","Type"=>"3");
$districts[477]=array("DistrictCode"=>"5806","DistrictName"=>"Huyện Trà Cú","ProvinceCode"=>"74","ProvinceName"=>"Trà Vinh","SupportType"=>"3","Type"=>"3");
$districts[478]=array("DistrictCode"=>"0906","DistrictName"=>"Huyện Yên Sơn","ProvinceCode"=>"27","ProvinceName"=>"Tuyên Quang","SupportType"=>"2","Type"=>"2");
$districts[479]=array("DistrictCode"=>"0901","DistrictName"=>"Thành phố Tuyên Quang","ProvinceCode"=>"27","ProvinceName"=>"Tuyên Quang","SupportType"=>"3","Type"=>"1");
$districts[480]=array("DistrictCode"=>"0905","DistrictName"=>"Huyện Hàm Yên","ProvinceCode"=>"27","ProvinceName"=>"Tuyên Quang","SupportType"=>"3","Type"=>"3");
$districts[481]=array("DistrictCode"=>"0902","DistrictName"=>"Huyện Lâm Bình","ProvinceCode"=>"27","ProvinceName"=>"Tuyên Quang","SupportType"=>"3","Type"=>"3");
$districts[482]=array("DistrictCode"=>"0903","DistrictName"=>"Huyện Na Hang","ProvinceCode"=>"27","ProvinceName"=>"Tuyên Quang","SupportType"=>"3","Type"=>"3");
$districts[483]=array("DistrictCode"=>"5701","DistrictName"=>"Thành phố Vĩnh Long","ProvinceCode"=>"70","ProvinceName"=>"Vĩnh Long","SupportType"=>"3","Type"=>"1");
$districts[484]=array("DistrictCode"=>"5702","DistrictName"=>"Huyện Long Hồ","ProvinceCode"=>"70","ProvinceName"=>"Vĩnh Long","SupportType"=>"3","Type"=>"2");
$districts[485]=array("DistrictCode"=>"5705","DistrictName"=>"Huyện Tam Bình","ProvinceCode"=>"70","ProvinceName"=>"Vĩnh Long","SupportType"=>"3","Type"=>"3");
$districts[486]=array("DistrictCode"=>"5706","DistrictName"=>"Huyện Trà Ôn","ProvinceCode"=>"70","ProvinceName"=>"Vĩnh Long","SupportType"=>"3","Type"=>"3");
$districts[487]=array("DistrictCode"=>"5704","DistrictName"=>"Thị xã Bình Minh","ProvinceCode"=>"70","ProvinceName"=>"Vĩnh Long","SupportType"=>"3","Type"=>"3");
$districts[488]=array("DistrictCode"=>"1601","DistrictName"=>"Thành phố Vĩnh Yên","ProvinceCode"=>"211","ProvinceName"=>"Vĩnh Phúc","SupportType"=>"3","Type"=>"1");
$districts[489]=array("DistrictCode"=>"1606","DistrictName"=>"Huyện Bình Xuyên","ProvinceCode"=>"211","ProvinceName"=>"Vĩnh Phúc","SupportType"=>"2","Type"=>"2");
$districts[490]=array("DistrictCode"=>"1604","DistrictName"=>"Huyện Vĩnh Tường","ProvinceCode"=>"211","ProvinceName"=>"Vĩnh Phúc","SupportType"=>"2","Type"=>"2");
$districts[491]=array("DistrictCode"=>"1605","DistrictName"=>"Huyện Yên Lạc","ProvinceCode"=>"211","ProvinceName"=>"Vĩnh Phúc","SupportType"=>"2","Type"=>"2");
$districts[492]=array("DistrictCode"=>"1603","DistrictName"=>"Huyện Lập Thạch","ProvinceCode"=>"211","ProvinceName"=>"Vĩnh Phúc","SupportType"=>"3","Type"=>"3");
$districts[493]=array("DistrictCode"=>"1602","DistrictName"=>"Huyện Tam Dương","ProvinceCode"=>"211","ProvinceName"=>"Vĩnh Phúc","SupportType"=>"3","Type"=>"2");
$districts[494]=array("DistrictCode"=>"1608","DistrictName"=>"Thị xã Phúc Yên","ProvinceCode"=>"211","ProvinceName"=>"Vĩnh Phúc","SupportType"=>"3","Type"=>"2");
$districts[495]=array("DistrictCode"=>"1301","DistrictName"=>"Thành phố Yên Bái","ProvinceCode"=>"29","ProvinceName"=>"Yên Bái","SupportType"=>"2","Type"=>"1");
$districts[496]=array("DistrictCode"=>"1309","DistrictName"=>"Huyện Lục Yên","ProvinceCode"=>"29","ProvinceName"=>"Yên Bái","SupportType"=>"3","Type"=>"3");
$districts[497]=array("DistrictCode"=>"1305","DistrictName"=>"Huyện Mù Cang Chải","ProvinceCode"=>"29","ProvinceName"=>"Yên Bái","SupportType"=>"3","Type"=>"3");
$districts[498]=array("DistrictCode"=>"1307","DistrictName"=>"Huyện Trấn Yên","ProvinceCode"=>"29","ProvinceName"=>"Yên Bái","SupportType"=>"3","Type"=>"2");
$districts[499]=array("DistrictCode"=>"1306","DistrictName"=>"Huyện Văn Chấn","ProvinceCode"=>"29","ProvinceName"=>"Yên Bái","SupportType"=>"3","Type"=>"3");
$districts[500]=array("DistrictCode"=>"1303","DistrictName"=>"Huyện Văn Yên","ProvinceCode"=>"29","ProvinceName"=>"Yên Bái","SupportType"=>"3","Type"=>"3");
$districts[501]=array("DistrictCode"=>"1302","DistrictName"=>"Thị xã Nghĩa Lộ","ProvinceCode"=>"29","ProvinceName"=>"Yên Bái","SupportType"=>"3","Type"=>"3");


function getDistrictByCode($districts,$code){
        $districtName = "";
        foreach($districts as $item){
            if(strcasecmp($item["DistrictCode"],$code)==0){
                $districtName = $item["DistrictName"];
                break;
            }
        }
        return $districtName;
    } 
    
    function getProvinceByCode($provinces,$code){
        $provinceName = "";
        foreach($provinces as $key => $value){
            if(strcasecmp($key,$code)==0){
                $provinceName = $value;
                break;
            }
        }
        return $provinceName;
    } 