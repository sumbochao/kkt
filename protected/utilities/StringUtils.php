<?php
/**
-------------------------
GNU GPL COPYRIGHT NOTICES
-------------------------
**
* $Id$
*
* @author thangtt <thangtt@az24.com>
* @link http://www.az24.vn/
* @copyright Copyright &copy; 2009-2010 HDC.
*
*/
class StringUtils {
    /*
    * kiem tra tinh hop le cua cookie
    * create by duongpq
    * 03/03/2011
    */
    public static function isValidCookie($str_cookie)
    {
        $error = 0;
        $array_str = str_split($str_cookie);
        for ($i = 0; $i < count($array_str); $i++) {
            $int = ord($array_str[$i]);
            if ($int < 32 || $int >= 127) {
                if ($int != 9) {
                    $error++;
                }
            }
        }
        // echo $error;die;
        if($error == 0){
            return true;
        }else{
            return false;
        }
    }
    /*
    * remove backlink
    * create by duongpq
    * 27/1/2011
    */
    public static function filterHref ($str) {
        $str = stripslashes($str);
        $preg = "/<[\s]*a[\s]*href=[\s]*[\"\']?([\w.-]*)[\"\']?[^>]*>(.*?)<\/a>/i";
        preg_match_all($preg, $str, $match);
        $i = 0;
        foreach ($match[1] as $key=>$val) {
            $pattern[] = '/'.preg_quote($match[0][$key],'/').'/';
            $replace[] = "<a href='$val' rel='nofollow'>{$match[2][$key]}</a>";
            $i++;
        }
        if( $i> 0)
        {
            return preg_replace($pattern, $replace, $str);
        }
        else
        {
            return $str;
        }
    }
    /*
    * edit jsscript
    * create by quyduong
    * 27/1/2011
    */
    public static function filterJS($str){
        $pattern = array('#<script([^>]*)>#i','#</script([^>]*)>#i');
        $replacement = array('<pre>&lt;script\\1&gt;','&lt;/script\\1&gt;</pre>');
        $subject = $str;
        return preg_replace($pattern,$replacement,$subject);
    }
    public static function getTeaser($html) {
        $html = $this->removeHTML ( $html );
        $html = $this->cut_string ( $html, 300 );
        return $html;
    }

    public static function isValidEmail($email) {
        return eregi ( "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email );
    }
    public static function msgbox($title) {
        echo '<script>alert("' . $title . '")</script>';
    }

    public static function removeQuote($string) {
        $sting = trim ( $string );
        $sting = str_replace ( "\'", "'", $sting );
        $sting = str_replace ( "'", "''", $sting );
        return $string;
    }
    public static function getValueArray($value, $array, $default = '') {
        if (isset ( $array [$value] ))
            return $array [$value];
        return $default;
    }
    public static function mailcontact($arrayValue, $content) {
        foreach ( $arrayValue as $key => $value ) {
            $content = str_replace ( "{#" . $key . "#}", $value, $content );
        }
        return $content;
    }

    public static function randomkey($str, $keyword = 0) {
        $return = '';
        $strreturn = explode ( " ", trim ( $str ) );
        $i = 0;
        $listid = '';
        while ( $i < count ( $strreturn ) ) {
            $id = rand ( 0, count ( $strreturn ) );
            if (strpos ( $listid, '[' . $id . ']' ) === false) {
                if (isset ( $strreturn [$id] )) {
                    $return .= $strreturn [$id] . ' ';
                    $i ++;
                    if ($keyword == 1 && ($i % 2) == 0 && $i < count ( $strreturn ))
                        $return .= ',';
                    $listid .= '[' . $id . ']';
                }
            }
        }
        return $return;
    }
    public static function array_language() {
        return array (1 => "vn", 2 => "en" );
    }
    public static function formatNumber($value, $type = "vnd") {
        global $con_currency;
        $str = number_format ( $value, 0, "", "." );
        return $str;
    }
    public static function random() {
        $rand_value = "";
        $rand_value .= rand ( 1000, 9999 );
        $rand_value .= chr ( rand ( 65, 90 ) );
        $rand_value .= rand ( 1000, 9999 );
        $rand_value .= chr ( rand ( 97, 122 ) );
        $rand_value .= rand ( 1000, 9999 );
        $rand_value .= chr ( rand ( 97, 122 ) );
        $rand_value .= rand ( 1000, 9999 );
        return $rand_value;
    }
    public static function str_encode($encodeStr = "") {
        $returnStr = "";
        if ($encodeStr == '')
            return $encodeStr;
        if (! empty ( $encodeStr )) {
            $enc = base64_encode ( $encodeStr );
            $enc = str_replace ( '=', '', $enc );
            $enc = str_rot13 ( $enc );
            $returnStr = $enc;
        }
        return $returnStr;
    }

    public static function str_decode($encodedStr = "", $type = 0) {
        $returnStr = "";
        $encodedStr = str_replace ( " ", "+", $encodedStr );
        if (! empty ( $encodedStr )) {
            $dec = str_rot13 ( $encodedStr );
            $dec = base64_decode ( $dec );
            $returnStr = $dec;
        }
        return $returnStr;
    }

    public static function getURLR($mod_rewrite = 1, $serverName = 0, $scriptName = 0, $fileName = 1, $queryString = 1, $varDenied = '') {
        if ($mod_rewrite == 1) {
            return $_SERVER ['REQUEST_URI'];
        } else {
            return $this->getURL ( $serverName, $scriptName, $fileName, $queryString, $varDenied );
        }
    }
    //hàm get URL
    public static function getURL($serverName = 0, $scriptName = 0, $fileName = 1, $queryString = 1, $varDenied = '') {
        $url = '';
        $slash = '/';
        if ($scriptName != 0)
            $slash = "";
        if ($serverName != 0) {
            if (isset ( $_SERVER ['SERVER_NAME'] )) {
                $url .= 'http://' . $_SERVER ['SERVER_NAME'];
                if (isset ( $_SERVER ['SERVER_PORT'] ))
                    $url .= ":" . $_SERVER ['SERVER_PORT'];
                $url .= $slash;
            }
        }
        if ($scriptName != 0) {
            if (isset ( $_SERVER ['SCRIPT_NAME'] ))
                $url .= substr ( $_SERVER ['SCRIPT_NAME'], 0, strrpos ( $_SERVER ['SCRIPT_NAME'], '/' ) + 1 );
        }
        if ($fileName != 0) {
            if (isset ( $_SERVER ['SCRIPT_NAME'] ))
                $url .= substr ( $_SERVER ['SCRIPT_NAME'], strrpos ( $_SERVER ['SCRIPT_NAME'], '/' ) + 1 );
        }
        if ($queryString != 0) {
            $dau = 0;
            $url .= '?';
            reset ( $_GET );
            if ($varDenied != '') {
                $arrVarDenied = explode ( '|', $varDenied );
                while ( list ( $k, $v ) = each ( $_GET ) ) {
                    if (array_search ( $k, $arrVarDenied ) === false) {
                        $url .= (($dau == 0) ? '' : '&') . $k . '=' . urlencode ( $v );
                        $dau = 1;
                    }
                }
            } else {
                while ( list ( $k, $v ) = each ( $_GET ) )
                    $url .= '&' . $k . '=' . urlencode ( $v );
            }
        }
        $url = str_replace ( '"', '&quot;', strval ( $url ) );
        return $url;
    }
    //hàm tạo link khi cần thiết chuyển sang mod rewrite


    //loại bỏ hoạt động của các thẻ html, vô hiệu hóa
    public static function htmlspecialbo($str) {
        $arrDenied = array ('<', '>', '"' );
        $arrReplace = array ('&lt;', '&gt;', '&quot;' );
        $str = str_replace ( $arrDenied, $arrReplace, $str );
        return $str;
    }

    // loại bỏ các thẻ html, javascript
    public static function removeHTML($string) {
        $string = mb_convert_encoding ( $string, "UTF-8", "UTF-8" );
        $string = preg_replace ( '/<script.*?\>.*?<\/script>/si', ' ', $string );
        $string = preg_replace ( '/<style.*?\>.*?<\/style>/si', ' ', $string );
        $string = preg_replace ( '/<.*?\>/si', ' ', $string );
        $string = str_replace ( '&nbsp;', ' ', $string );
        //$string = html_entity_decode ($string);
        return $string;
    }

    // hàm redirect : 1 url
    public static function redirect($url, $http = 0) {
        $url = str_replace ( "'", "\'", $url );
        echo '<script type="text/javascript">';
        echo 'window.location.href="' . $url . '";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
        echo '</noscript>';
        exit ();
        exit ();
    }

    //hàm cắt chuổi
    public static function cut_string($str, $length) {
        if (mb_strlen ( $str, "UTF-8" ) > $length)
            return mb_substr ( $str, 0, $length, "UTF-8" ) . '...';
        else
            return $str;
    }
    public static function cutstring($str, $len, $more) {
        if ($str == "" || $str == NULL)
            return $str;
        if (strlen ( $str ) <= $len)
            return $str;
        $str = strip_tags ( $str );
        $str = trim ( $str );
        $str = substr ( $str, 0, $len );
        if ($str != "") {
            if (! substr_count ( $str, " " )) {
                if ($more)
                    $str .= " ...";
                return $str;
            }
            while ( strlen ( $str ) && ($str [strlen ( $str ) - 1] != " ") ) {
                $str = substr ( $str, 0, - 1 );
            }
            $str = substr ( $str, 0, - 1 );
            if ($more)
                $str .= " ...";
        }
        return $str;
    }
    public static function length($str) {
        return mb_strlen ( $str, "UTF-8" );
    }
    //
    public static function replaceMQ($text) {
        $text = str_replace ( "\'", "'", $text );
        $text = str_replace ( "'", "''", $text );
        return $text;
    }
    public static function RemoveSign($str) {
        $coDau = array ("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ", "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ", "ê", "ù", "à" );

        $khongDau = array ("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "y", "y", "y", "y", "y", "d", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "Y", "Y", "Y", "Y", "Y", "D", "e", "u", "a" );
        return str_replace ( $coDau, $khongDau, $str );
    }
    public static function removeKey($string) {
        $string = trim ( preg_replace ( "/[^A-Za-z0-9àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸ]/i", " ", $string ) );
        $string = str_replace ( " ", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = mb_convert_encoding ( $string, "UTF-8", "UTF-8" );
        return $string;
    }

    public static function removeTitle($string, $keyReplace='-') {
        $string = StringUtils::RemoveSign ( $string );
        //neu muon de co dau
        $string = trim ( preg_replace ( "/[^A-Za-z0-9]/i", " ", $string ) ); // khong dau
        $string = str_replace ( " ", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = str_replace ( $keyReplace, "-", $string );
        return $string;
    }

    public static function getKeyRef($query, $keyname = "q") {
        $strreturn = '';
        preg_match ( "#" . $keyname . "=(.*)#si", $query, $match );
        if (isset ( $match [1] ))
            $strreturn = preg_replace ( '#\&(.*)#si', "", $match [1] );
        return urldecode ( $strreturn );
    }
    //ham ma hoa
    public static function fSencode($encodeStr = "") {
        $returnStr = "";
        if (! empty ( $encodeStr )) {
            $enc = base64_encode ( $encodeStr );
            $enc = str_replace ( '=', '', $enc );
            $enc = str_rot13 ( $enc );
            $returnStr = $enc;
        }

        return $returnStr;
    }

    //ham giai mai
    public static function fSdecode($encodedStr = "", $type = 0) {
        $returnStr = "";
        $encodedStr = str_replace ( " ", "+", $encodedStr );
        if (! empty ( $encodedStr )) {
            $dec = str_rot13 ( $encodedStr );
            $dec = base64_decode ( $dec );
            $returnStr = $dec;
        }
        switch ($type) {
            case 0 :
                $returnStr = str_replace ( "\'", "'", $returnStr );
                $returnStr = str_replace ( "'", "''", $returnStr );
                return $returnStr;
                break;
            case 1 :
                return intval ( $returnStr );
                break;
            case 3 :
                return doubleval ( $returnStr );
                break;
        }
    }

    public static function int_to_words($x) {
        $nwords = array ("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín", "mười", "mười một", "mười hai", "mười ba", "mười bốn", "mười lăm", "mười sáu", "mười bảy", "mười tám", "mười chín", "hai mươi", 30 => "ba mươi", 40 => "bốn mươi", 50 => "năm mươi", 60 => "sáu mươi", 70 => "bảy mươi", 80 => "tám mươi", 90 => "chín mươi" );
        if (! is_numeric ( $x )) {
            $w = '#';
        } else if (fmod ( $x, 1 ) != 0) {
                $w = '#';
            } else {
                if ($x < 0) {
                    $w = 'minus ';
                    $x = - $x;
                } else {
                    $w = '';
                }
                if ($x < 21) {
                    $w .= $nwords [$x];
                } else if ($x < 100) {
                        $w .= $nwords [10 * floor ( $x / 10 )];
                        $r = fmod ( $x, 10 );
                        if ($r > 0) {
                            $w .= ' ' . $nwords [$r];
                        }
                } else if ($x < 1000) {
                        $w .= $nwords [floor ( $x / 100 )] . ' trăm';
                        $r = fmod ( $x, 100 );
                        if ($r > 0) {
                            $w .= '  ' . $this->int_to_words ( $r );
                        }
                } else if ($x < 1000000) {
                        $w .= $this->int_to_words ( floor ( $x / 1000 ) ) . ' ngàn';
                        $r = fmod ( $x, 1000 );
                        if ($r > 0) {
                            $w .= ' ';
                            if ($r < 100) {
                                $w .= ' ';
                            }
                            $w .= $this->int_to_words ( $r );
                    }
                } else {
                    $w .= $this->int_to_words ( floor ( $x / 1000000 ) ) . ' triệu';
                    $r = fmod ( $x, 1000000 );
                    if ($r > 0) {
                        $w .= ' ';
                        if ($r < 100) {
                            $word .= ' ';
                        }
                        $w .= $this->int_to_words ( $r );
                    }
            }
        }
        return $w . '';
    }
    
    public static function word_limiter($text, $limit = 30, $chars = '') {
        if (strlen ( $text ) > $limit) {
            $text = mb_substr($text,0,$limit,'utf8');
            $text = $text.'&hellip;';
            /*$words = str_word_count ( $text, 2, $chars );
            echo $words[1];die;
            $words = array_reverse ( $words, TRUE );
            foreach ( $words as $length => $word ) {
            if ($length + strlen ( $word ) >= $limit) {
            array_shift ( $words );
            } else {
            break;
            }
            }
            $words = array_reverse ( $words );
            $text = implode ( " ", $words ) . '&hellip;';*/
        }
        return $text;
    }
    
    /*
    * create by duongpq 
    * 21/1/2011
    */
    public static function getExtension($filename){
        $sExtension = substr( $filename, ( strrpos($filename, '.') + 1 ) ) ;
        $sExtension = strtolower($sExtension);
        return $sExtension;
    }
    
    public static function is_valid_email($email)
    {
        return (preg_match("/[a-zA-Z0-9-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/", $email) > 0);
    }
    
    // tao cay menu tu menu nho nhat
    public static function getMenuList($list_all_cate,$cid){
        $list = array();
        $i = 0;
        while ($list_all_cate[$cid]['parent_id'] != 0){
            $list[$i++] = $list_all_cate[$cid]['parent_id'];			
            $cid = $list_all_cate[$cid]['parent_id'];
        }
        return $list;
    }
    
    function cutWordString($str, $length, $minword = 3) {
        $sub = '';
        $len = 0;
        foreach (explode(' ', $str) as $word) {
            $part = (($sub != '') ? ' ' : '') . $word;
            $sub .= $part;
            $len += strlen($part);
            if (strlen($word) > $minword && strlen($sub) >= $length) {
                break;
            }
        }
        return $sub . (($len < strlen($str)) ? '...' : '');
    } 
    
    function checkKeyword($str){
        $str = StringUtils::RemoveSign($str);
        $str = strtolower($str);
        $arr_keyword = ConstantsUtil::$arr_keyword;
        foreach($arr_keyword as $key=>$value){
            $vitri = strpos($str,$value);
            if($vitri===0 || $vitri>0){
                return 1;
            }
        }
        return 0;
    }
    
    function  checkVersionFile($new_version,$older_version){
        echo 1;die;
        $new_version = explode(".",$new_version);
        $older_version = explode(".",$older_version);
        
        $i = 0;$kq = 1;
        $size = count($new_version)<count($older_version)?count($older_version):count($new_version);
        while($i<$size){
            $ver0 = empty($older_version[$i]) ?0:$older_version[$i];
            $ver1 = empty($new_version[$i]) ?0:$new_version[$i];
            
            if($ver1>$ver0){
                $kq = 1;
                break;
            }
            
            if($ver1<$ver0){
                $kq = 0;
                break;
            }
            
            $i++;
        }
        
        return $kq;
    }
}
