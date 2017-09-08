<?php
class PermitConfig{  
    public static $permission = array(
        "can_view"=>1,
        "can_create"=>2,
        "can_edit"=>4,
        "can_del"=>8,
    );
    public static $permission_module = array(
        1=>array("label"=>"QL Danh mục","value"=>"category"),
        2=>array("label"=>"QL Game","value"=>"game"),
        3=>array("label"=>"QL Album ảnh","value"=>"album"),
        4=>array("label"=>"QL Video","value"=>"video"),
        5=>array("label"=>"QL Tin tức","value"=>"news"),
        6=>array("label"=>"QL Khách hàng","value"=>"member"),
        7=>array("label"=>"QL Box chat","value"=>"chat"),
        8=>array("label"=>"Thống kê doanh số","value"=>"report"),
        9=>array("label"=>"QL Tips","value"=>"tips"),       
        10=>array("label"=>"Ql Admin và phân quyền","value"=>"admin"),
        11=>array("label"=>"QL Version","value"=>"version"),
        12=>array("label"=>"QL Box Share","value"=>"share"),
        13=>array("label"=>"QL Banner","value"=>"advertise"),
        14=>array("label"=>"QL Box Quảng Cáo","value"=>"boxAdv"),
        15=>array("label"=>"QL tỷ lệ","value"=>"rate"),
        16=>array("label"=>"QL Blacklist","value"=>"blacklist"),
        17=>array("label"=>"QL SEO","value"=>"seo"),
        18=>array("label"=>"QL Partner","value"=>"partner"),
        19=>array("label"=>"QL Audio","value"=>"audio"),
        20=>array("label"=>"QL App","value"=>"app"),
        21=>array("label"=>"Wap Game","value"=>"wapgame"),
        22=>array("label"=>"QL Facebook Account","value"=>"fbaccount"),
        23=>array("label"=>"QL Facebook Friends","value"=>"fbfriend"),
        24=>array("label"=>"QL Facebook Campaign","value"=>"fbcampaign"),
    	25=>array("label"=>"Thành viên FB","value"=>"fbmember"),
        26=>array("label"=>"Import Tài Khoản","value"=>"fbimport"),
        
    );
    public static $category = array(
        "can_view"=>array("index"),
        "can_create"=>array("create","ajaxSaveCategory"),
        "can_edit"=>array("ajaxQuickUpdate","edit","ajaxUpdate"),
        "can_del"=>array("ajaxDelete"),
    );
     public static $game = array(
        "can_view"=>array("index"),
        "can_create"=>array("create","ajaxSaveGame"),
        "can_edit"=>array("ajaxQuickUpdate","edit","ajaxUpdateGame"),
        "can_del"=>array("ajaxDelete","ajaxDeleteFile"),
    );
    public static $album = array(
        "can_view"=>array("index","image"),
        "can_create"=>array("create","ajaxSaveAlbum"),
        "can_edit"=>array("ajaxQuickUpdate","edit","ajaxUpdateAlbum"),
        "can_del"=>array("ajaxDelete","ajaxDeleteImage"),
    );
    public static $video = array(
        "can_view"=>array("index","show"),
        "can_create"=>array("create","ajaxSaveVideo"),
        "can_edit"=>array("ajaxQuickUpdate","edit","ajaxUpdateVideo"),
        "can_del"=>array("ajaxDelete"),
    );
    public static $news = array(
        "can_view"=>array("index"),
        "can_create"=>array("create","ajaxSaveNews"),
        "can_edit"=>array("ajaxQuickUpdate","edit","ajaxUpdateNews"),
        "can_del"=>array("ajaxDelete"),
    );
    public static $member = array(
        "can_view"=>array("index"),
        "can_create"=>array(),
        "can_edit"=>array("ajaxQuickUpdate"),
        "can_del"=>array("ajaxDelete"),
    );
    public static $chat = array(
        "can_view"=>array("index"),
        "can_create"=>array(),
        "can_edit"=>array(),
        "can_del"=>array("ajaxDelete"),
    );
    public static $report = array(
        "can_view"=>array("userSms", "userSmsDetail", "userCard", "userCardDetail", "download", "exportSms", "exportCard", "export"),
        "can_create"=>array(),
        "can_edit"=>array(),
        "can_del"=>array(),
    );
    public static $tips = array(
        "can_view"=>array("index"),
        "can_create"=>array("create","ajaxSaveTips"),
        "can_edit"=>array("edit","ajaxUpdateTips","ajaxQuickUpdate"),
        "can_del"=>array("ajaxDelete"),
    );
    public static $version = array(
        "can_view"=>array("index"),
        "can_create"=>array("create","ajaxSaveVersion"),
        "can_edit"=>array(),
        "can_del"=>array("ajaxDelete"),
    );
    public static $admin = array(
        "can_view"=>array("index","permit"),
        "can_create"=>array("ajaxSaveAdmin","ajaxSavePermit"),
        "can_edit"=>array("edit","ajaxResetPass","ajaxSavePermit","ajaxQuickUpdate","ajaxChangePass"),
        "can_del"=>array("ajaxDelete","ajaxSavePermit","ajaxDeletePermit"),
    );
    public static $share = array(
        "can_view"=>array("index"),
        "can_create"=>array(),
        "can_edit"=>array(),
        "can_del"=>array("ajaxDelete"),
    );
    public static $advertise = array(
        "can_view"=>array("index"),
        "can_create"=>array("create","ajaxSaveBanner"),
        "can_edit"=>array("ajaxQuickUpdate","edit","ajaxUpdateBanner"),
        "can_del"=>array("ajaxDelete"),
    );
    public static $boxAdv = array(
        "can_view"=>array("index"),
        "can_create"=>array("create","ajaxSaveBanner"),
        "can_edit"=>array("ajaxQuickUpdate","edit","ajaxUpdateBanner"),
        "can_del"=>array("ajaxDelete"),
    );
    public static $rate = array(
        "can_view"=>array("index", "sms", "card", "service"),
        "can_create"=>array("",""),
        "can_edit"=>array("","",""),
        "can_del"=>array(""),
    );
    public static $blacklist = array(
        "can_view"=>array("index"),
        "can_create"=>array("create","ajaxSaveBlacklist"),
        "can_edit"=>array(),
        "can_del"=>array("ajaxDelete"),
    );
    public static $seo = array(
        "can_view"=>array("category","detail"),
        "can_create"=>array(),
        "can_edit"=>array("ajaxSaveSeoCategory","ajaxSaveSeoDetail"),
        "can_del"=>array(),
    );
    public static $partner = array(
        "can_view"=>array("index"),
        "can_create"=>array("ajaxSavePartner"),
        "can_edit"=>array("ajaxQuickUpdate"),
        "can_del"=>array("ajaxDelete"),
    );
    public static $audio = array(
        "can_view"=>array("index","show"),
        "can_create"=>array("ajaxSaveAudio","create","ajaxSaveAudioDetail"),
        "can_edit"=>array("ajaxQuickUpdate","edit","ajaxUpdateAudio","ajaxUpdateAudioDetail","ajaxGetEditAudioDetail"),
        "can_del"=>array("ajaxDelete","ajaxDeleteAudioDetail"),
    );
   public static $app = array(
        "can_view"=>array("index"),
        "can_create"=>array("ajaxSaveApp","create"),
        "can_edit"=>array("edit","ajaxUpdateApp"),
        "can_del"=>array("ajaxDelete"),
    );
    public static $wapgame = array(
        "can_view"=>array("index"),
        "can_create"=>array("ajaxSaveGame","create"),
        "can_edit"=>array("edit","ajaxUpdateGame","ajaxQuickUpdate"),
        "can_del"=>array("ajaxDelete","ajaxDeleteFile"),
    );
    public static $fbaccount = array(
        "can_view"=>array("index","login","logout","destroy"),
        "can_create"=>array("create","ajaxSaveFriend","ajaxSaveAccount"),
        "can_edit"=>array("edit","ajaxUpdateAccount"),
        "can_del"=>array("ajaxDeleteFriend","ajaxDeleteAccount"),
    );
    public static $fbfriend = array(
        "can_view"=>array("index","add"),
        "can_create"=>array("ajaxExcelFriend","ajaxRequestFriend"),
        "can_edit"=>array(),
        "can_del"=>array("ajaxDeleteFriend","ajaxDeleteAll"),
    );
    public static $fbcampaign = array(
        "can_view"=>array("index","log"),
        "can_create"=>array(),
        "can_edit"=>array(),
        "can_del"=>array("ajaxDeleteLog"),
    );
    public static $fbmember = array(
    	"can_view"=>array("index","safe","logout","destroy"),
    	"can_create"=>array(),
    	"can_edit"=>array(),
    	"can_del"=>array(),
    );
    public static $fbimport = array(
        "can_view"=>array("index","ajaxImport"),
        "can_create"=>array(),
        "can_edit"=>array(),
        "can_del"=>array(),
    ); 
}
    
