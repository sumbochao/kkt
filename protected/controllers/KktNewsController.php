<?php
class KktNewsController extends Controller
{
	public $layout='main_member';
	public $cats;
	public function init()
	{
		$this->cats=Category::getCatByType(4);//Danh sach danh muc cua tin tuc
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
        $data_seo = ShopSeo::getDataByUsernameAndType($username,4);
        if($data_seo){
            $this->metaTitle = $data_seo["metaTitle"];
            $this->metaDescription = $data_seo["metaDescription"];
            $this->metaKeywords = $data_seo["metaKeyword"];
        }
		$page = isset($_GET['page']) ? intval($_GET['page']):1;
		$num_per_page=10;
		list($news,$paging)=News::getLatestNews($page,$num_per_page);
        $this->metaTitle = "Tin nong bong tai ";
        foreach( $news as $key=>$value){
             $this->metaTitle .= '' . $value["title"] . ', ';
         }
		$this->render('index',
				array('news'=>$news,'paging'=>$paging,'cats'=>$this->cats
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
			list($news,$paging)=News::getNewsByCat($cat_id,$info['alias'],$page,$num_per_page);	
		}
		else
		{
			$link_error=Url::createUrl('kktMember/error');
			header('Location:'.$link_error);
			exit();
		}
		$hot_news=News::getHotNewsByCat($cat_id,0,2);//Tin hot theo danh muc
        $this->render("cat",
				array("news"=>$news,'paging'=>$paging,
					  "info"=>$info,'hot_news'=>$hot_news,
					  "cats"=>$this->cats
		));
    }
	public function actionDetail()
    {
		$page = isset($_GET['page']) ? intval($_GET['page']):1;
		$num_per_page=3;
		$new_id = isset($_GET['new_id']) ? intval($_GET['new_id']):0;
		$detail=News::getNewsById($new_id);
        $this->metaTitle = '[Tin nong] '.$detail["title"];
		$cat_id=isset($detail['categoryId']) ? intval($detail['categoryId']):0;
		$info=Category::getCatInfo($cat_id);
		$cat_alias=isset($info) ? $info['alias']:'';
		if(!$detail)
		{
			$link_error=Url::createUrl('kktMember/error');
			header('Location:'.$link_error);
			exit();
		}
		News::updateHit($new_id);
		list($hot_video,$paging)=Video::getHotVideo($page,$num_per_page);
		list($news,$paging)=News::getNewsByCat($cat_id,$cat_alias,$page,$num_per_page);
		$this->render("detail",
				array('detail'=>$detail,'hot_video'=>$hot_video,'news'=>$news,
					  'cats'=>$this->cats,'info'=>$info));
    }
	public function actionVi()
    {
		$page = isset($_GET['page']) ? intval($_GET['page']):1;
		$num_per_page=3;
		$new_id = isset($_GET['new_id']) ? intval($_GET['new_id']):0;
		$detail=News::getNewsById($new_id);
		$cat_id=isset($detail['categoryId']) ? intval($detail['categoryId']):0;
		$info=Category::getCatInfo($cat_id);
		$cat_alias=isset($info) ? $info['alias']:'';
		if(!$detail)
		{
			$link_error=Url::createUrl('kktMember/error');
			header('Location:'.$link_error);
			exit();
		}
		News::updateHit($new_id);
		list($hot_video,$paging)=Video::getHotVideo($page,$num_per_page);
		list($news,$paging)=News::getNewsByCat($cat_id,$cat_alias,$page,$num_per_page);
		$this->render("detail",array('detail'=>$detail,'hot_video'=>$hot_video,'news'=>$news,'cats'=>$this->cats,'info'=>$info));
    }
}
?>