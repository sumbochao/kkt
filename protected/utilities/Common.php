<?php
    class Common{
        // hàm lấy ảnh
        static function getImage($nameImage, $folder, $date='', $type='')
        {  
            if($type!='')
                $nameImage=$type.'_'.$nameImage;
            if($date!='')
                return Yii::app()->params['urlImages'].$folder.'/'.date('Y', $date).'/'.date('md', $date).'/'.$nameImage;
            else
                return Yii::app()->params['urlImages'].$folder.'/'.$nameImage;
        }

        static function getRealIpAddr()
        {
            if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
            {
                $ip=$_SERVER['HTTP_CLIENT_IP'];
            }
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
            {
                $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else
            {
                $ip=$_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }

        /**
        * put your comment there...
        *  
        * @param mixed $email
        */
        static function validateEmailSyntax($email) {
            $atom = '[-a-z0-9!#$%&\'*+/=?^_`{|}~]'; // allowed characters for part before "at" character
            $domain = '([-a-z0-9]*[a-z0-9]+)'; // allowed characters for part after "at" character
            $regex = '^'.$atom.'+'. // One or more atom characters.
            '(\.'.$atom.'+)*'. // Followed by zero or more dot separated sets of one or more atom characters.
            '@'. // Followed by an "at" character.
            '('.$domain.'{1,63}\.)+'. // Followed by one or max 63 domain characters (dot separated).
            $domain.'{2,63}'. // Must be followed by one set consisting a period of two
            '$'; // or max 63 domain characters.
            if(eregi($regex,$email)) return true;
            else  return false;
        } //validate_email_syntax

        /* Hàm lấy introtext trong nội dung */
        static function getIntroText($str,$len,$more){
            if ($str=="" || $str==NULL) 
                return $str;
            if (is_array($str)) 
                return $str;
            $str = trim($str);
            if (strlen($str) <= $len) 
                return $str;
            $str = substr($str,0,$len);
            if ($str != "") 
            {
                if (!substr_count($str," ")) 
                {
                    if ($more) 
                        $str .= " ...";
                    return $str;
                }
                while(strlen($str) && ($str[strlen($str)-1] != " ")) 
                {
                    $str = substr($str,0,-1);
                }
                $str = substr($str,0,-1);
                if ($more) 
                    $str .= " ...";
            }
            return $str;
        }

        function generate_slug($string) {
            $string = Common::change($string);
            $string = preg_replace("/(^|&\S+;)|(<[^>]*>)/U", "", $string);
            $string = strtolower(preg_replace('/[\s\-]+/', '-', trim(preg_replace('/[^\w\s\-]/', '', $string))));
            $slug = preg_replace("/[^A-Za-z0-9\-]/", "", $string);
            return $slug;
        }

        function change($text) {
            $chars = array("a", "A", "e", "E", "o", "O", "u", "U", "i", "I", "d", "D", "y", "Y");
            $uni[0] = array("á", "à", "ạ", "ả", "ã", "â", "ấ", "ầ", "ậ", "ẩ", "ẫ", "ă", "ắ", "ằ", "ặ", "ẵ", "ẳ", "� �");
            $uni[1] = array("Á", "À", "Ạ", "Ả", "Ã", "Â", "Ấ", "Ầ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ắ", "Ằ", "Ặ", "Ẵ", "Ẳ", "� �");
            $uni[2] = array("é", "è", "ẹ", "ẻ", "ẽ", "ê", "ế", "ề", "ệ", "ể", "ễ");
            $uni[3] = array("É", "È", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ế", "Ề", "Ệ", "Ể", "Ễ");
            $uni[4] = array("ó", "ò", "ọ", "ỏ", "õ", "ô", "ố", "ồ", "ộ", "ổ", "ỗ", "ơ", "ớ", "ờ", "ợ", "ỡ", "ở", "� �");
            $uni[5] = array("Ó", "Ò", "Ọ", "Ỏ", "Õ", "Ô", "Ố", "Ồ", "Ộ", "Ổ", "Ỗ", "Ơ", "Ớ", "Ờ", "Ợ", "Ỡ", "Ở", "� �");
            $uni[6] = array("ú", "ù", "ụ", "ủ", "ũ", "ư", "ứ", "ừ", "ự", "ử", "ữ");
            $uni[7] = array("Ú", "Ù", "Ụ", "Ủ", "Ũ", "Ư", "Ứ", "Ừ", "Ự", "Ử", "Ữ");
            $uni[8] = array("í", "ì", "ị", "ỉ", "ĩ");
            $uni[9] = array("Í", "Ì", "Ị", "Ỉ", "Ĩ");
            $uni[10] = array("đ");
            $uni[11] = array("Đ");
            $uni[12] = array("ý", "ỳ", "ỵ", "ỷ", "ỹ");
            $uni[13] = array("Ý", "Ỳ", "Ỵ", "Ỷ", "Ỹ");

            for ($i = 0; $i <= 13; $i++) {
                $text = str_replace($uni[$i], $chars[$i], $text);
            }
            return $text;
        }   

        function file_extension($filename)
        {
            return end(explode(".", $filename));
        }

        public function remove_duplicate($list_id)
        {
            $list_id = explode(",", $list_id);
            $new_id = array();
            foreach($list_id as $value){
                if(!in_array($value, $new_id)){
                    $new_id[] = $value;
                }
            }            
            $list_new_id = "";
            foreach($new_id as $value){
                $list_new_id .= $value.",";   
            }
            $list_new_id = rtrim($list_new_id, ",");
            return $list_new_id;
        }        

        public function removeSign($str) {
            $coDau = array ("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ", "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ", "ê", "ù", "à" );

            $khongDau = array ("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "y", "y", "y", "y", "y", "d", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "Y", "Y", "Y", "Y", "Y", "D", "e", "u", "a" );
            return str_replace ( $coDau, $khongDau, $str );
        }                


        public function genDate($time)
        {        
            $curTime = time();
            $sub = $curTime - $time;
            if($sub < 60)
            {
                $date = $sub . " seconds ago";
            } 
            else if($sub >= 60 && $sub < 3600)
                {
                    $minutes = floor($sub / 60);
                    $date = $minutes . " minutes ago";
                } 
                else if($sub >= 3600 && $sub < 24 * 3600)
                    {
                        $hours = floor($sub / 3600);
                        $minutes = floor(($sub - ($hours * 3600)) / 60);  
                        $date = $hours . " hour " . $minutes . " minutes ago";
                    } 
                    else if($sub >= 24 * 3600 && $sub < 7 * 24 * 3600)
                        {        
                            $date = date("l", $time) . " at " . date("H:i", $time);
                        } 
                        else if($sub >= 7 * 24 * 3600 && $sub < 30 * 24 * 3600)
                            {        
                                $date = date("l", $time) . ", " . date("F", $time) . " " . date("d", $time) . " at " . date("H:i", $time);
                            } 
                            else 
                            {
                                $date = "At " . date("d-m-Y H:i:s");
            }        

            return $date;
        }

        static function CheckPassword($pwd)
        {        
            $error = "";
            if(strlen($pwd) < 6 ) {
                $error .= "<p>- Mật khẩu phải có ít nhất 6 ký tự</p>";            
            }

            if(strlen($pwd) > 15 ) {
                $error .= "<p>- Mật khẩu có nhiều nhất 15 ký tự</p>";            
            }        

            if(!preg_match("#[0-9]+#", $pwd) ) {
                $error .= "<p>- Mật khẩu phải có ít nhất 1 chữ số</p>";            
            }

            if(!preg_match("#[a-zA-Z]+#", $pwd) ) {
                $error .= "<p>- Mật khẩu phải có ít nhất 1 chữ viết</p>";            
            }

            if( !preg_match("#[A-Z]+#", $pwd) ) {
                //            $error .= "<p>- Mật khẩu phải có ít nhất 1 chữ viết hoa</p>";
            }

            if( !preg_match("#\W+#", $pwd) ) {
                //            $error .= "<p>- Mật khẩu phải có ít nhất 1 ký tự đặc biệt</p>";            
            }

            return $error;          
        }

        static function cleanQuery($string)
        {        
            if(empty($string)) return $string;
            $string = mysql_escape_string(trim($string));

            $badWords = array(
            "/Select(.*)From/i"
            , "/Union(.*)Select/i"
            , "/Update(.*)Set/i"
            , "/Delete(.*)From/i"
            , "/Drop(.*)Table/i"
            , "/Insert(.*)Into/i"                
            //, "/http/i"
            //, "/--/i"
            );

            $string = preg_replace($badWords, "", $string);

            return $string;
        }        

        function detectMobile()
        {
            preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sonyericsson|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/si',$_SERVER['HTTP_USER_AGENT'],$match);
            $device=isset($match[1]) ? $match[1]:'';
            /*
            if(preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']))
            return true;
            else
            return false;
            */
            return $device;
        }

        public function serviceCode()
        {
            return array(
            "6022"=>"500"
            , "6122"=>"1000"
            , "6222"=>"2000"
            , "6322"=>"3000"
            , "6422"=>"4000"
            , "6522"=>"5000"
            , "6622"=>"10000"
            , "6722"=>"15000"
            );            
        }

        public function getSubDomain()
        {
            $path = $_SERVER['HTTP_HOST'];
            if (strpos($path,'.')!=FALSE)
            {
                $path = explode('.',$path);
                $path = $path[0];
            }
            else $path='';
            return $path;
        }
        public function getUserDomain()
        {
            $path = $_SERVER['HTTP_HOST'];
            $domain = explode(".",$path);
            return $domain;
        }

        static function getApp($user,$app_name)
        {
            return Yii::app()->params['urlImages'].'user/'.$user.'/'.$app_name;
        }

        /*************************************************************************************
        * Lãnh thổ của datnd
        */
        /* định dạng giá tiền ngược */
        public function price_format($price){
            $price = str_replace(".", "", $price);    
            $price = str_replace(",", "", $price);    
            $price = str_replace(" ", "", $price);            
            return $price;
        }

        function detectFileExtension()
        {              
            /*if (preg_match('/midp|Mobile|IEMobile|Fennec|Opera Mini|Opera Mobi|Safari|android|Android|iPhone/si', $_SERVER['HTTP_USER_AGENT'])) {
            if (preg_match('/midp/si', $_SERVER['HTTP_USER_AGENT'])) {
            $ext = "jar";
            } else if(preg_match('/android/si', $_SERVER['HTTP_USER_AGENT']) || preg_match('/Android/si', $_SERVER['HTTP_USER_AGENT'])){
            $ext = "apk";   
            } else if(preg_match('/ios/si', $_SERVER['HTTP_USER_AGENT'])||preg_match('/iPhone/si', $_SERVER['HTTP_USER_AGENT'])){
            $ext = "ipa";    
            } else {
            $ext = "jar";
            }

            } else {
            $ext = "jar";   
            }*/
            $ext = "jar";
            require("Mobile_Detect.php");   
            $detect = new Mobile_Detect();
            if($detect->isiOS()){
                $ext = "ipa";
            }elseif($detect->isAndroidOS()){
                $ext = "apk";    
            }elseif($detect->isMobile()){
                $ext = "jar";
            }else{
                $ext = "jar";
            }
            return $ext;
        }

        function priceServiceCode($serviceCode)
        {
            $pattern_0 = "/^(\d)0(\d)(\d)$/si";
            $pattern_1 = "/^(\d)1(\d)(\d)$/si";
            $pattern_2 = "/^(\d)2(\d)(\d)$/si";
            $pattern_3 = "/^(\d)3(\d)(\d)$/si";
            $pattern_4 = "/^(\d)4(\d)(\d)$/si";
            $pattern_5 = "/^(\d)5(\d)(\d)$/si";
            $pattern_6 = "/^(\d)6(\d)(\d)$/si";        
            $pattern_7 = "/^(\d)7(\d)(\d)$/si";        

            $price = 0;
            if(preg_match($pattern_0, $serviceCode)){
                $price = 500;    
            } else if(preg_match($pattern_1, $serviceCode)){
                    $price = 1000;    
                } else if(preg_match($pattern_2, $serviceCode)){
                        $price = 2000;    
                    } else if(preg_match($pattern_3, $serviceCode)){
                            $price = 3000;    
                        } else if(preg_match($pattern_4, $serviceCode)){
                                $price = 4000;    
                            } else if(preg_match($pattern_5, $serviceCode)){
                                    $price = 5000;    
                                } else if(preg_match($pattern_6, $serviceCode)){
                                        $price = 10000;    
                                    } else if(preg_match($pattern_7, $serviceCode)){
                                            $price = 15000;    
                                        } 
                                        return $price;
        }

        public function checkTelco($mobile)
        {        
            $first = substr($mobile, 0, 1);
            if($first=="0"){
                $mobile = substr($mobile, 1, strlen($mobile) - 1);
            } else if($first="8"){
                    $mobile = substr($mobile, 2, strlen($mobile) - 2);
                }

                $mobile = "84" . $mobile;

            $patternViettel = "/^84(9[678]|16[2-9])[\d]{7}/";
            $patternMobi = "/^84(9[03]|12[01268])[\d]{7}/";
            $patternVina = "/^84(9[14]|12[34579])[\d]{7}/";
            $patternVnmobile = "/^84(9[2]|18[86])[\d]{7}/";
            $patternBeeline = "/^84(9[9]|19[9])[\d]{7}/";

            if(preg_match($patternViettel, $mobile)){
                $telco = "1";    
            } else if(preg_match($patternMobi, $mobile)){
                    $telco = "2";
                } else if(preg_match($patternVina, $mobile)){
                        $telco = "3";
                    } else if(preg_match($patternVnmobile, $mobile)){
                            $telco = "4";
                        } else if(preg_match($patternBeeline, $mobile)){
                                $telco = "5";
                            } else {
                                $telco = "0";
            }

            return $telco;    
        }

        /* định dạng số */
        public function format_price($price){
            $number = number_format($price,1,",","."); //Vietnamese format with decimals by a coma
            if(strrchr($number,",")==",0") return str_replace(",0","",$number);
            else return $number;
        }

        public function genPass($password)
        {
            return md5(md5($password) . "kkt_wap_content2012#$%^");
        }

        public function cleanFileName($string) {        
            $string = Common::change($string);        
            $string = preg_replace("/(^|&\S+;)|(<[^>]*>)/U", "", $string);
            $string = trim(preg_replace('/[^\w\s\(.)\-]/', '', $string));        
            $string = strtolower(preg_replace('/[\s\-]+/', '_', $string));    
            $string = preg_replace("/[^A-Za-z0-9\(.)\_]/", "", $string);     
            $string = str_replace("small","s_mall",$string);
            $string = str_replace("medium","m_deium",$string);   
            return $string;
        }

        public function genRefCode($id){
            return md5(md5($id) . "CunKIEmTieN$#$@$%");
        }

        public function genFilenameApp($type)
        {
            $file = array();
            if($type==1){
                $filename = "GameHot";
            } else if($type==2){
                    $filename = "ClipSexy";
                } else if($type==3){
                        $filename = "GirlXinh";
                    } else {
                        $filename = "";
            }

            return $filename;
        }

        public function encodeHex($id)
        {
            $id = intval($id);    
            $str = dechex($id + 27111986);        
            $subStr = substr(dechex($id + 26101984), -5); //last three characters        
            $str = $str . $subStr;

            return $str;
        }

        public function decodeHex($code)
        {
            $str = substr($code, 0, strlen($code) - 5);            
            $id = hexdec($str) - 27111986;        
            return intval($id);
        }

        public function buildRateServiceCode($rate, $total_money)
        {
            $total_money = intval($total_money);

            $rate_return = 0;
            if(isset($rate[$total_money])){
                $rate_return = $rate[$total_money];
            } else {
                $rate[$total_money] = 0;            
                ksort($rate);            
                $keys = array_keys($rate);            
                $current_key_index = array_search($total_money, $keys);            
                if(isset($keys[$current_key_index - 1])) {
                    $key = $keys[$current_key_index - 1];
                    $rate_return = $rate[$key];
                }            
            }        
            return $rate_return;            
        }

        public function buildRateCard($rate, $total_money)
        {
            $total_money = intval($total_money);

            $rate_return = 0;
            if(isset($rate[$total_money])){
                $rate_return = $rate[$total_money];
            } else {
                $rate[$total_money] = 0;
                ksort($rate);
                $keys = array_keys($rate);
                $current_key_index = array_search($total_money, $keys);
                if(isset($keys[$current_key_index - 1])) {
                    $key = $keys[$current_key_index - 1];
                    $rate_return = $rate[$key];
                }            
            }        
            return $rate_return;            
        }

        public function buildRateUser($rows, $total_money)
        {        
            $rate = array();        
            $rate["issue_rate_of_user"] = 0;
            $rate["issue_rate_of_hdc"] = 0;
            $rate["issue_rate_of_producer"] = 0;
            $rate["rate_of_user"] = 0;
            $rate["rate_of_hdc"] = 0;
            $rate["rate_of_producer"] = 0;
            if(!empty($rows)){            
                if($total_money < $rows["issue_price"]){                
                    $rate["issue_rate_of_user"] = $rows["issue_rate_of_user_min"];
                    $rate["issue_rate_of_hdc"] = $rows["issue_rate_of_hdc_min"];
                    $rate["issue_rate_of_producer"] = $rows["issue_rate_of_producer_min"];    
                } else {
                    $rate["issue_rate_of_user"] = $rows["issue_rate_of_user_max"];
                    $rate["issue_rate_of_hdc"] = $rows["issue_rate_of_hdc_max"];
                    $rate["issue_rate_of_producer"] = $rows["issue_rate_of_producer_max"];
                }

                if($total_money < $rows["price"]){
                    $rate["rate_of_user"] = $rows["rate_of_user_min"];
                    $rate["rate_of_hdc"] = $rows["rate_of_hdc_min"];
                    $rate["rate_of_producer"] = 0;
                } else {
                    $rate["rate_of_user"] = $rows["rate_of_user_max"];
                    $rate["rate_of_hdc"] = $rows["rate_of_hdc_max"];
                    $rate["rate_of_producer"] = 0;
                }
            }
            return $rate;
        }

        public function parseBBCode($str)
        {
            $pattern[0] = "/\[color=(.*?)\]/si";
            $replace[0] = "<span style='color:$1'>";
            $pattern[1] = "/\[\/color\]/si";
            $replace[1] = " </span>";

            $pattern[2] = "/\[background=(.*?)\]/si";
            $replace[2] = "<span style='background-color:$1'>";
            $pattern[3] = "/\[\/background\]/si";
            $replace[3] = " </span>";

            $pattern[4] = "/\[b\]/si";
            $replace[4] = "<strong>";
            $pattern[5] = "/\[\/b\]/si";
            $replace[5] = " </strong>";

            $pattern[6] = "/\[u\]/si";
            $replace[6] = "<u>";
            $pattern[7] = "/\[\/u\]/si";
            $replace[7] = " </u>";

            $pattern[8] = "/\[i\]/si";
            $replace[8] = " <i>";
            $pattern[9] = "/\[\/i\]/si";
            $replace[9] = " </i>";

            $pattern[10] = "/((http|https|ftp):\/\/(\S*?\.\S*?))(\s|\;|\)|\]|\[|\{|\}|,|\"|'|:|\<|$|\.\s)/si";
            $replace[10] = '<a href="$1" target="_blank">$2://$3</a>';
            $str = preg_replace($pattern, $replace, $str);

            $symbol = array(
            0=>':(('
            , 1=>':('     
            , 2=>':))'     
            , 3=>'/:)'     
            , 4=>':)]'     
            , 5=>'&lt;):)'     
            , 6=>'&gt;:)'     
            , 7=>':)'
            , 8=>'&gt;:D&lt;'
            , 9=>':D'
            , 10=>';;)'
            , 11=>';)'
            , 12=>'#:-S'
            , 13=>':-S'
            , 14=>'&gt;:P'
            , 15=>':P'
            , 16=>':-/'
            , 17=>':x'
            , 18=>':"&gt;'
            , 19=>'=(('
            , 20=>':-SS'
            , 21=>'&lt;:-P'
            , 22=>':-bd'
            , 23=>'^#(^'
            , 24=>':-*'
            , 25=>':-O'
            , 26=>'B-)'
            , 27=>':&gt;'
            , 28=>'~X('
            , 29=>'X('
            , 30=>':|'
            , 31=>'=))'
            , 32=>'O:-)'
            , 33=>':-B'
            , 34=>'=;'
            , 35=>':-c'
            , 36=>':-h'
            , 37=>':-t'
            , 38=>'8-&gt;'
            , 39=>'I-)'
            , 40=>'8-|'
            , 41=>'L-)'
            , 42=>':-&'
            , 43=>':-$'
            , 44=>'[-('
            , 45=>':O)'
            , 46=>'8-}'
            , 47=>'(:|'
            , 48=>'=P~'
            , 49=>':-?'
            , 50=>'#-o'
            , 51=>'=D&gt;'
            , 52=>'@-)'
            , 53=>':^o'
            , 54=>':-w'
            , 55=>':-&lt;'
            , 56=>'X_X'
            , 57=>':!!'
            , 58=>'\m/'
            , 59=>':-q'
            , 60=>':ar!'
            );    

            $icon = array(
            0=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/20.gif">'
            , 1=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/2.gif">'                 
            , 2=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/21.gif">'                 
            , 3=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/23.gif">'                 
            , 4=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/100.gif">'                 
            , 5=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/48.gif">'                 
            , 6=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/19.gif">'                 
            , 7=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/1.gif">'                 
            , 8=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/6.gif">'                 
            , 9=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/4.gif">'                 
            , 10=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/5.gif">'                 
            , 11=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/3.gif">'                 
            , 12=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/18.gif">'                 
            , 13=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/17.gif">'                 
            , 14=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/47.gif">'                 
            , 15=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/10.gif">'                 
            , 16=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/7.gif">'                 
            , 17=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/8.gif">'                 
            , 18=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/9.gif">'                 
            , 19=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/12.gif">'                 
            , 20=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/42.gif">'                 
            , 21=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/36.gif">'                 
            , 22=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/113.gif">'                 
            , 23=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/114.gif">'
            , 24=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/11.gif">'                 
            , 25=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/13.gif">'                 
            , 26=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/16.gif">'                 
            , 27=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/15.gif">'                 
            , 28=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/102.gif">'
            , 29=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/14.gif">'                 
            , 30=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/22.gif">'                 
            , 31=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/24.gif">'                 
            , 32=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/25.gif">'                 
            , 33=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/26.gif">'                 
            , 34=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/27.gif">'                 
            , 35=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/101.gif">'                 
            , 36=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/103.gif">'                 
            , 37=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/104.gif">'                 
            , 38=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/105.gif">'                 
            , 39=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/28.gif">'                 
            , 40=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/29.gif">'                 
            , 41=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/30.gif">'                 
            , 42=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/31.gif">'                 
            , 43=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/32.gif">'                 
            , 44=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/33.gif">'                 
            , 45=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/34.gif">'                 
            , 46=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/35.gif">'                 
            , 47=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/37.gif">'                 
            , 48=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/38.gif">'                 
            , 49=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/39.gif">'                 
            , 50=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/40.gif">'                 
            , 51=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/41.gif">'                 
            , 52=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/43.gif">'                 
            , 53=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/44.gif">'                 
            , 54=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/45.gif">'                 
            , 55=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/46.gif">'                 
            , 56=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/109.gif">'                 
            , 57=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/110.gif">'                 
            , 58=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/111.gif">'                 
            , 59=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/112.gif">'                 
            , 60=>'<img border="0" src="' . Yii::app()->params["static_url"] . 'images/emotions/pirate_2.gif">'                                                  
            );
            $str = str_replace($symbol, $icon, $str);
            return $str;
        }

        public function online($location)
        {
            $rip = Common::getRealIpAddr();
            $sd = time();
            $count = 1;
            $maxu = 1;

            $file1 = $location . "online.log";
            $lines = file($file1);
            $line2 = "";

            foreach ($lines as $line_num => $line)
            {
                if($line_num == 0){
                    $maxu = $line;
                } else {
                    $fp = strpos($line,'****');
                    $nam = substr($line,0,$fp);
                    $sp = strpos($line,'++++');
                    $val = substr($line,$fp+4,$sp-($fp+4));
                    $diff = $sd-$val;

                    if($diff < 300 && $nam != $rip)
                    {
                        $count = $count+1;
                        $line2 = $line2.$line;
                    }
                }
            }

            $my = $rip . "****" . $sd . "++++\n";
            if($count > $maxu)
                $maxu = $count;

            $open1 = fopen($file1, "w");
            fwrite($open1, "$maxu\n");
            fwrite($open1, "$line2");
            fwrite($open1, "$my");
            fclose($open1);
            $count = $count;
            $maxu = $maxu + 200;

            return $count;
        }

        public function today($location)
        {
            $file_count = fopen($location . "count.txt", "rb");
            $data = '';
            while (!feof($file_count)) $data .= fread($file_count, 4096);
            fclose($file_count);
            @list($today, $yesterday, $total, $date, $days) = split("%", $data);
            return $today;
        }

        public function yesterday($location)
        {
            $file_count = fopen($location . "count.txt", "rb");
            $data = '';
            while (!feof($file_count)) $data .= fread($file_count, 4096);
            fclose($file_count);
            @list($today, $yesterday, $total, $date, $days) = split("%", $data);
            return $yesterday;
        }

        public function total($location)
        {
            $file_count = fopen($location . "count.txt", "rb");
            $data = "";
            while(!feof($file_count)) $data .= fread($file_count, 4096);
            fclose($file_count);
            @list($today, $yesterday, $total, $date, $days) = split("%", $data);
            return $total;
        }

        public function avg($location)
        {
            $file_count = fopen($location . "count.txt", "rb");
            $data = '';
            while (!feof($file_count)) $data .= fread($file_count, 4096);
            fclose($file_count);
            list($today, $yesterday, $total, $date, $days) = split("%", $data);
            return ceil($total/$days);
        }

        /*
        * Lãnh thổ của datnd đến đây là hết đất
        *************************************************************************************/




        /*************************************************************************************
        * Lãnh thổ của minhnt
        */
        function generate_slug_register($string) {        
            $string = Common::change($string);
            $string = preg_replace("/(^|&\S+;)|(<[^>]*>)/U","",$string);
            $string = strtolower(preg_replace('/[\s\-]+/','',trim(preg_replace('/[^\w\s\-]/','',$string))));
            $slug = preg_replace("/[^A-Za-z0-9\-]/","",$string);
            return $slug;
        }
        public function getCurrentUrl(){
            $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
            if ($_SERVER["SERVER_PORT"] != "80")
            {
                $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
            } 
            else 
            {
                $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
            }
            return $pageURL;
        }

        public function callUrlAction($url='',$params=array()){
            //create cURL connection
            $curl_connection = curl_init($url);
            //set options
            curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($curl_connection, CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
            curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);
            //set data to be posted
            curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $params);
            //perform our request
            //var_dump($params,$url);die;
            $result = curl_exec($curl_connection);      
            curl_close($curl_connection);  
            echo $result;die;
            return $result;      
        }

        function delete_directory($dirname) {
            if (is_dir($dirname))
                $dir_handle = opendir($dirname);
            if (!$dir_handle)
                return false;
            while($file = readdir($dir_handle)) {
                if ($file != "." && $file != "..") {
                    if (!is_dir($dirname. DIRECTORY_SEPARATOR .$file))                        
                        unlink($dirname. DIRECTORY_SEPARATOR . $file);
                    else
                        Common::delete_directory($dirname . DIRECTORY_SEPARATOR . $file);    
                }
            }
            closedir($dir_handle);
            rmdir($dirname);
            return true;
        }  

        /*
        * Lãnh thổ của minhnt đến đây là hết đất
        ************************************************************************************/




        /*************************************************************************************
        * Lãnh thổ của thanglq
        */
        static function getFilenameGame($user,$filename)//Game online
        {
            return Yii::app()->params['urlImages'].'user/'.$user.'/game/'.$filename;
        }

        /*
        * Lãnh thổ của thanglq đến đây là hết đất
        *************************************************************************************/  
    }
?>
