<?php
class KktSearchController extends Controller
{
    public $layout='main_member';
    public function actionIndex()
    {
		$keyword = isset ( $_GET ['keyword'] ) && ($_GET ['keyword']!='Nhập tìm kiếm') ?  Common::cleanQuery($_GET ['keyword']) : '';
		$keyword=str_replace('+',' ',$keyword);
		$page=isset($_GET['page']) ? intval($_GET['page']):1;
		$num_per_page=5;
		list($search,$paging,$total)=Search::getSearch($keyword,$page,$num_per_page);
		//SEO
		if($page!=1)
		{
			$tag_page=" - Trang ".$page;
		}
		else
		{
			$tag_page="";
		}
		/*$this->metaTitle=$keyword.$tag_page;
		$this->metaDescription=$keyword.$tag_page;
		$this->metaKeywords=$keyword;*/
		
     	$this->render('index',array('search'=>$search,'paging'=>$paging,'total'=>$total,'keyword'=>$keyword));
    }
}
?>