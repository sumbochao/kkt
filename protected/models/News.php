<?php
class News extends CActiveRecord
{
	public function getNewsByCat($cat_id,$cat_alias,$page,$num_per_page)
	{
		$cacheService = new CacheService("News","getNewsByCat",$cat_id,$page.$num_per_page);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sub_sql='status=1';
			$sql='SELECT count(id) as total FROM c_news WHERE '.$sub_sql.'';
			$command=$connect->createCommand($sql);
			$row = $command->queryRow();
			$total=$row['total'];
			$begin = ($page - 1) * $num_per_page;
			$sql="SELECT id,title,alias,introtext,picture,hit,create_date,isHot FROM c_news WHERE ".$sub_sql." ORDER BY create_date DESC LIMIT ".$begin.",".$num_per_page."";
			$command=$connect->createCommand($sql);
			$rows = $command->queryAll();
			/*Paging*/
			$num_page=ceil($total/$num_per_page);
			$url=Url::createUrl('kktNews/cat',array('cat_id'=>$cat_id,'alias'=>$cat_alias));
			$url1=$url;
			$url.='/';
			$paging=Paging::show_paging_wap($num_page,$page,$url,$url1);
			$a=array($rows,$paging);
			Yii::app()->cache->set($key, $a, ConstantsUtil::TIME_CACHE_900);
		}
		else
		{
			$a=$cache;
		}
		return $a;
	}
	public function getLatestNews($page,$num_per_page)
	{
		$cacheService = new CacheService("News","getLatestNews",$page,$num_per_page);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sub_sql='status=1';
			$sql='SELECT count(id) as total FROM c_news WHERE '.$sub_sql.'';
			$command=$connect->createCommand($sql);
			$row = $command->queryRow();
			$total=$row['total'];
			$begin = ($page - 1) * $num_per_page;
			$sql="SELECT id,title,alias,introtext,picture,hit,create_date,isHot FROM c_news WHERE ".$sub_sql." ORDER BY create_date DESC LIMIT ".$begin.",".$num_per_page."";
			$command=$connect->createCommand($sql);
			$rows = $command->queryAll();
			/*Paging*/
			$num_page=ceil($total/$num_per_page);
			$url=Url::createUrl('kktNews/index');
			$url1=$url;
			$url.='/';
			$paging=Paging::show_paging_wap($num_page,$page,$url,$url1);
			$a=array($rows,$paging);
			Yii::app()->cache->set($key, $a, ConstantsUtil::TIME_CACHE_900);
		}
		else
		{
			$a=$cache;
		}
		return $a;
	}
	public function getNewsById($new_id)
	{
		$cacheService = new CacheService("News","getNewsById",$new_id);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sql="SELECT * FROM c_news WHERE id=".$new_id." AND status=1";
			$command=$connect->createCommand($sql);
			$row = $command->queryRow();
			Yii::app()->cache->set($key, $row, ConstantsUtil::TIME_CACHE_86400);
		}
		else
		{
			$row=$cache;
		}
		return $row;
	}
	public function updateHit($new_id)
	{
		$connect =Yii::app()->db;
		$sql="UPDATE c_news SET hit=hit+1 WHERE id=".$new_id;
		$command=$connect->createCommand($sql);
		$result = $command->execute();
		$sql="UPDATE c_data SET hit=hit+1 WHERE dataId=".$new_id." AND type=4";
		$command=$connect->createCommand($sql);
		$result = $command->execute();
		return $result;
	}
	public function genHtmlNews($news)
	{
		$html='';
		if($news)
		foreach($news as $row)
		{
			$link_detail=Url::createUrl('kktNews/detail',array('alias'=>$row['alias'],'new_id'=>$row['id']));
			$link_download='';
			$link_img=Common::getImage($row['picture'],'news',$row['create_date'],'m');
			$img_error=Yii::app()->params['static_url'].'/images/farmvui52.png';
			if($row['isHot']==1)
			{
				$icon_hot='<img alt="'.$row['title'].'" class="ic_hot" src="'.Yii::app()->params['static_url'].'/images/icon_hot.gif">';
			}
			else
			{
				$icon_hot='<img alt="'.$row['title'].'" class="ic_new2" src="'.Yii::app()->params['static_url'].'/images/icon_new2.png">';
			}
			$html.='<tr>
						<td width="52">
							<a href="'.$link_detail.'" title="'.$row['title'].'">
								<img src="'.$link_img.'" alt="'.$row['title'].'" class="img52" onerror="this.src=\''.$img_error.'\'">
							</a>
						</td>
						<td valign="top" class="item_data">
							<a class="ic_news" href="'.$link_detail.'"><strong>'.$row['title'].'</strong></a>'.$icon_hot.'
							<br>
							<span class="cl666">'.$row['introtext'].'</span>
							<br />
							<span class="cl999">'.$row['hit'].' Lượt xem</span>
						</td>
					</tr>';
		}
		return $html;
	}
	public function getHotNews($limit)
	{
		$cacheService = new CacheService("News","getHotNews",$limit);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sub_sql='status=1 AND isHot=1';
			$sql="SELECT id,title,alias,introtext,picture,hit,create_date,isHot FROM c_news WHERE ".$sub_sql." ORDER BY date_of_hot DESC LIMIT ".$limit."";
			$command=$connect->createCommand($sql);
			$rows = $command->queryAll();
			Yii::app()->cache->set($key, $rows, ConstantsUtil::TIME_CACHE_900);
		}
		else
		{
			$rows=$cache;
		}
		return $rows;
	}
	public function getHotNewsByCat($cat_id,$new_id,$limit)
	{
		$cacheService = new CacheService("News","getHotNewsByCat",$cat_id.$new_id.$limit);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sub_sql='status=1 AND isHot=1 AND id!='.$new_id.' AND categoryId='.$cat_id;
			$sql="SELECT id,title,alias,introtext,picture,hit,create_date,isHot FROM c_news WHERE ".$sub_sql." ORDER BY date_of_hot DESC LIMIT ".$limit."";
			$command=$connect->createCommand($sql);
			$rows = $command->queryAll();
			Yii::app()->cache->set($key, $rows, ConstantsUtil::TIME_CACHE_900);
		}
		else
		{
			$rows=$cache;
		}
		return $rows;
	}
}
?>