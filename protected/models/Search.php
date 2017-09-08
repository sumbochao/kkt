<?php
class Search extends CActiveRecord
{
	public function getSearch($keyword,$page,$num_per_page)
	{
		$cacheService = new CacheService("Search","getSearch",$keyword.$page.$num_per_page);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			//Ket qua search		
			$output=array();
			$total=0;			
			try
			{				
				require_once("http://210.245.90.243:8080/JavaBridge/java/Java.inc");
				$searcher = new java("com.az24.search.taoviec.TaoViecSearch","/data/search/index/kkt");
                
				$topDocs = $searcher->query($keyword,0,0,$page,$num_per_page);
				$docs = java_values($topDocs); 
                
				if(!empty($docs))
				{          
					$num_row=count($docs);   
					for($i=0;$i<$num_row;$i++)
					{
						$doc = $docs[$i];
						$id=java_values($doc->id);
						$title=java_values($doc->title);
						$alias=java_values($doc->alias);
						$cat_id=java_values($doc->categoryId);
						$create_date=java_values($doc->create_date);
						$picture=java_values($doc->picture);
						$type=java_values($doc->type);
						$introtext=java_values($doc->introtext);
						$hit=java_values($doc->hit);
						$download=java_values($doc->download);
						$isOnline=java_values($doc->isOnline);
						
						$output[]=array('id' => $id,'title'=>$title,'alias'=>$alias,'cat_id'=>$cat_id,'picture'=>$picture,'create_date'=>$create_date,'type'=>$type,'introtext'=>$introtext,'hit'=>$hit,'download'=>$download,'isOnline'=>$isOnline);
					}
                    
				}
                
				$total=intval(trim($searcher->getTotalHit()));//Tong so ban ghi
				$num_page=ceil($total/$num_per_page);
				$iSEGSIZE = 9;
				$url_rewrite = Url::createUrl('kktSearch/index',array('keyword'=>str_replace(' ','+',$keyword)));
				$url_rewrite1=$url_rewrite;
				$url_rewrite=str_replace('.html','',$url_rewrite).'/';
				$paging=Paging::show_paging_wap($num_page,$page,$url_rewrite,$url_rewrite1);
				$searcher->close();
                
			}
			catch (Exception $e) 
			{
				$output=array();
				$paging='';
			}
			$a=array($output,$paging,$total);
			Yii::app()->cache->set($key, $a, ConstantsUtil::TIME_CACHE_86400);
		}
		else
		{
			$a=$cache;
		}
		return $a;
	}
}
?>