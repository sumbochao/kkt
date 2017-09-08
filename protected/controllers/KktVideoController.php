<?php
class KktVideoController extends Controller
{
	public $layout='main_member';
	public $cats;
	public $domain;
	public function init()
	{
		$this->cats=Category::getCatByType(2);//Danh sach danh muc cua game
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
              }
        }    
        
		$this->domain=$domain;
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
        $this->metaTitle = 'Mobile video anh nong, quay len, lo hang | mobile clip, mobile 3gp';
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
        $data_seo = ShopSeo::getDataByUsernameAndType($username,2);
        if($data_seo){
            $this->metaTitle = $data_seo["metaTitle"];
            $this->metaDescription = $data_seo["metaDescription"];
            $this->metaKeywords = $data_seo["metaKeyword"];
        }
		$page = isset($_GET['page']) ? intval($_GET['page']):1;
		$num_per_page=5;
		list($hot_video,$paging)=Video::getHotVideo($page,$num_per_page);
		list($latest_video,$paging)=Video::getLatestVideo($page,$num_per_page);
		$this->render('index',
				array('hot_video'=>$hot_video,'latest_video'=>$latest_video,'cats'=>$this->cats
		));
	}
	public function actionHot()
    {
        $this->metaTitle = '[Video] hot nhat ';
		$page = isset($_GET['page']) ? intval($_GET['page']):1;
		$num_per_page=5;
		list($hot_video,$paging)=Video::getHotVideo($page,$num_per_page);
        foreach( $hot_video as $key=>$value){
             $this->metaTitle .= '' . $value["title"] . ', ';
        }
        $this->render("hot",
				array("hot_video"=>$hot_video,'paging'=>$paging,
					  "cats"=>$this->cats
		));
    }
	public function actionLatest()
    {
        $this->metaTitle = '[Video] moi nhat';
		$page = isset($_GET['page']) ? intval($_GET['page']):1;
		$num_per_page=5;
		list($latest_video,$paging)=Video::getLatestVideo($page,$num_per_page);
        foreach( $latest_video as $key=>$value){
             $this->metaTitle .= '' . $value["title"] . ', ';
        }
        $this->render("latest",
				array("latest_video"=>$latest_video,'paging'=>$paging,
					  "cats"=>$this->cats
		));
    }
	public function actionCat()
    {
		$page = isset($_GET['page']) ? intval($_GET['page']):1;
		$num_per_page=5;
		$cat_id = isset($_GET['cat_id']) ? intval($_GET['cat_id']):0;
		$info=Category::getCatInfo($cat_id);
		if($info)
		{
			list($video,$paging)=Video::getVideoByCat($cat_id,$info['alias'],$page,$num_per_page);	
		}
		else
		{
			$link_error=Url::createUrl('kktMember/error');
			header('Location:'.$link_error);
			exit();
		}
		$hot_video=Video::getHotVideoByCat($cat_id,0,2);
        $this->render("cat",
				array("video"=>$video,'paging'=>$paging,
					  "info"=>$info,'hot_video'=>$hot_video,
					  "cats"=>$this->cats
		));
    }
	public function actionDetail()
    {
		$page = isset($_GET['page']) ? intval($_GET['page']):1;
		$num_per_page=3;
		$video_id = isset($_GET['video_id']) ? intval($_GET['video_id']):0;
		$detail=Video::getVideoById($video_id);
        $this->metaTitle = '[Video] '.$detail["title"];
		$cat_id=isset($detail['categoryId']) ? intval($detail['categoryId']):0;
		$info=Category::getCatInfo($cat_id);
		$cat_alias=isset($info) ? $info['alias']:'';
		if(!$detail)
		{
			$link_error=Url::createUrl('kktMember/error');
			header('Location:'.$link_error);
			exit();
		}
		Video::updateHitDownload($video_id);//Update luot view, download
		list($video_cat,$paging)=Video::getVideoByCat($cat_id,$cat_alias,$page,$num_per_page);//Video cung the loai
		$video_hot=Video::getHotVideoByCat($cat_id,$video_id,2);
		$this->render("detail",array('detail'=>$detail,'video_cat'=>$video_cat,'info'=>$info,"cats"=>$this->cats,'video_hot'=>$video_hot));
    }
	public function actionVi()
    {
		$page = isset($_GET['page']) ? intval($_GET['page']):1;
		$num_per_page=3;
		$video_id = isset($_GET['video_id']) ? intval($_GET['video_id']):0;
		$detail=Video::getVideoById($video_id);
		$cat_id=isset($detail['categoryId']) ? intval($detail['categoryId']):0;
		$info=Category::getCatInfo($cat_id);
		$cat_alias=isset($info) ? $info['alias']:'';
		if(!$detail)
		{
			$link_error=Url::createUrl('kktMember/error');
			header('Location:'.$link_error);
			exit();
		}
		Video::updateHitDownload($video_id);//Update luot view, download
		list($video_cat,$paging)=Video::getVideoByCat($cat_id,$cat_alias,$page,$num_per_page);//Video cung the loai
		$video_hot=Video::getHotVideoByCat($cat_id,$video_id,2);
		$this->render("vi",array('detail'=>$detail,'video_cat'=>$video_cat,'info'=>$info,"cats"=>$this->cats,'video_hot'=>$video_hot));
    }
	public function actionDownload()
	{
		$video_id = isset($_GET['video_id']) ? intval($_GET['video_id']):0;
        $detail=Video::getVideoById($video_id);
        /*Lay duong danh file app*/
        $file_name=Common::genFilenameApp(2);
        $extension=Common::detectFileExtension();
        $orginal_filename=$file_name.'.'.$extension;
        Home::updateTimeDownload($video_id,2);
        if("ipa"!=$extension)
        {
        	$url_download=Common::getApp($this->domain,$orginal_filename);
        }else
        {
        	$url_download="itms-services://?action=download-manifest&url=".Common::getApp($this->domain,$file_name.".plist");
        }
        
        header('Location:'.$url_download);
        
        exit();
		/*
		if($detail)
		{
			header('Content-Description: File Transfer');
			header("Content-disposition: attachment; filename=".$detail['alias'].".jad");
			//header('Content-type: application/octet-stream');
			header('Content-Type: application/force-download');
			header('Content-Transfer-Encoding: binary');
			ob_clean();
			flush();
			readfile($url_download);
		}
		else
		{
			header('Location:'.$url_download);
		}		
		exit();
		*/
	}
}
?>
