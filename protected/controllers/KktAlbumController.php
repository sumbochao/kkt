<?php
class KktAlbumController extends Controller
{
	public $layout='main_member';
	public $cats;
	public $domain;
	public function init()
	{
		$this->cats=Category::getCatByType(3);//Danh sach danh muc cua album
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
        $data_seo = ShopSeo::getDataByUsernameAndType($username,3);
        if($data_seo){
            $this->metaTitle = $data_seo["metaTitle"];
            $this->metaDescription = $data_seo["metaDescription"];
            $this->metaKeywords = $data_seo["metaKeyword"];
        }
		$page = isset($_GET['page']) ? intval($_GET['page']):1;
		$num_per_page=10;
		list($album,$paging)=Album::getLatestAlbum($page,$num_per_page);
        $this->metaTitle = "Anh nong ";
        foreach( $album as $key=>$value){
             $this->metaTitle .= '' . $value["title"] . ', ';
         }
		$this->render('index',
				array('album'=>$album,'paging'=>$paging,'cats'=>$this->cats
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
			list($album,$paging)=Album::getAlbumByCat($cat_id,$info['alias'],$page,$num_per_page);	
		}
		else
		{
			$link_error=Url::createUrl('kktMember/error');
			header('Location:'.$link_error);
			exit();
		}
		$hot_album=Album::getHotAlbumByCat($cat_id,0,2);
        $this->render("cat",
				array("album"=>$album,'paging'=>$paging,
					  "info"=>$info,'hot_album'=>$hot_album,
					  "cats"=>$this->cats
		));
    }
	public function actionDetail()
    {
		$page = isset($_GET['page']) ? intval($_GET['page']):1;
		$num_per_page=3;
		$album_id = isset($_GET['album_id']) ? intval($_GET['album_id']):0;
		$detail=Album::getAlbumById($album_id);
        $this->metaTitle = '[Anh nong] '.$detail["title"];
		$cat_id=isset($detail['categoryId']) ? intval($detail['categoryId']):0;
		$info=Category::getCatInfo($cat_id);
		$cat_alias=isset($info) ? $info['alias']:'';
		if(!$detail)
		{
			$link_error=Url::createUrl('kktMember/error');
			header('Location:'.$link_error);
			exit();
		}
		Album::updateHitDownload($album_id);
		$images=Album::getImgByAlbum($album_id);
		list($hot_video,$paging)=Video::getHotVideo($page,$num_per_page);
		list($news,$paging)=News::getNewsByCat($cat_id,$cat_alias,$page,$num_per_page);
		$this->render("detail",array('detail'=>$detail,'images'=>$images,'hot_video'=>$hot_video,'news'=>$news,'cats'=>$this->cats,'info'=>$info));
    }
	public function actionVi()
    {
		$page = isset($_GET['page']) ? intval($_GET['page']):1;
		$num_per_page=3;
		$album_id = isset($_GET['album_id']) ? intval($_GET['album_id']):0;
		$detail=Album::getAlbumById($album_id);
		$cat_id=isset($detail['categoryId']) ? intval($detail['categoryId']):0;
		$info=Category::getCatInfo($cat_id);
		$cat_alias=isset($info) ? $info['alias']:'';
		if(!$detail)
		{
			$link_error=Url::createUrl('kktMember/error');
			header('Location:'.$link_error);
			exit();
		}
		Album::updateHitDownload($album_id);
		$images=Album::getImgByAlbum($album_id);
		list($hot_video,$paging)=Video::getHotVideo($page,$num_per_page);
		list($news,$paging)=News::getNewsByCat($cat_id,$cat_alias,$page,$num_per_page);
		$this->render("vi",array('detail'=>$detail,'images'=>$images,'hot_video'=>$hot_video,'news'=>$news,'cats'=>$this->cats,'info'=>$info));
    }
	public function actionDownload()
	{
		$album_id = isset($_GET['album_id']) ? intval($_GET['album_id']):0;
        $detail=Album::getAlbumById($album_id);
        $file_name=Common::genFilenameApp(3);
        $extension=Common::detectFileExtension();
        $orginal_filename=$file_name.'.'.$extension;
        Home::updateTimeDownload($album_id,3);
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
			header("Pragma: public");
			header("Content-disposition: attachment; filename=".$detail['alias'].".jad");			
			header("Content-type:".mime_content_type($upload_dir));
			//header('Content-Transfer-Encoding: binary');
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