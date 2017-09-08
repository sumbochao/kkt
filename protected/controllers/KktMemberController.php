<?php
class KktMemberController extends Controller
{
	public $layout='main_member';
	public $device='';
	public $domain='';
        
	public function init()
	{
		//echo Common::genRefCode(1);
		$domain = $GLOBALS["domain"];
        $is_taoviec = $GLOBALS["is_taoviec"];
		if(!$is_taoviec){
			  // echo 	$domain;die;
			  if(strpos($domain,Yii::app()->params["domain_member"])>1)
			  {
			  	$domain = Common::getSubDomain();
			  }else{
                $sub_domain = ShopDomain::getOneDomain($domain);
                $domain = isset($sub_domain['user_name'])? $sub_domain['user_name']:''; 
                $session=new CHttpSession;
  				$session->open();
  				$session['domain']=$sub_domain["domain"];  
  				$session->close();			
              }
        }    
		$this->domain=$domain;
		$this->device=Common::detectMobile();
		$array_input=array('username'=>$domain,'active'=>1,'isBan'=>0);
		$check=Member::getMember($array_input);
		if(!$check)
		{
			header("Location:".Yii::app()->params['base_url']);
			exit();
		}
	}
	
    public function actionIndex()
    {
        $this->metaTitle = "Kho noi dung di dong mien phi | Tai game dien thoai | tai game di dong mien phi | tai video di dong | anh nong | quay len | lo hang";
		$domains = Common::getUserDomain();
        if(count($domains)==3){
            $username = $domains[0];
        }elseif($_SERVER["HTTP_HOST"] !="kenhkiemtien.com"){
            $data_user_domain = ShopDomain::getOneDomain($_SERVER["HTTP_HOST"]);
            if($data_user_domain){
                 $username = $data_user_domain["user_name"];
            }
            
        }else{
            $username = "dola";
        }
        $data_seo = ShopSeo::getDataByUsernameAndType($username,0);
        if($data_seo){
            $this->metaTitle = $data_seo["metaTitle"];
            $this->metaDescription = $data_seo["metaDescription"];
            $this->metaKeywords = $data_seo["metaKeyword"];
        }
        list($games,$games_file)=Game::getGameOnlineHome(0);
		Member::genHtmlBoxKenh18();
		Member::genHtmlBoxNews();
		Member::genHtmlBoxAlbum();
		
		$device=$this->device;
		$game_online=Member::getHtmlModule('mod_home_game_online');
		$kenh18=Member::getHtmlModule('mod_home_kenh18');
		$hot_news=Member::getHtmlModule('mod_home_news');
		$view=Member::getHtmlModule('mod_home_album');
        $this->render("index",
				array("games"=>$games,"games_file"=>$games_file,
					  "kenh18"=>$kenh18,
					  "hot_news"=>$hot_news,
					  "view"=>$view,
					  "device"=>$device,
					  "user"=>$this->domain
		));
    }
	public function actionKenh18()
	{
		Member::genHtmlKenh18();
		$video=Member::getHtmlModule('mod_kenh18_video');
		$news=Member::getHtmlModule('mod_kenh18_news');
		$album=Member::getHtmlModule('mod_kenh18_album');
		$this->render("kenh18",array('video'=>$video,'news'=>$news,'album'=>$album));
	}
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			$this->renderPartial('error',array("error"=>$error));
		}
        else
		{
            throw new CHttpException(404, 'Trang không tồn tại.');
		}
	}
}
?>
