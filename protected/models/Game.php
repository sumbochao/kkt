<?php
class Game extends CActiveRecord
{
	public function getHotGameOnline($page,$num_per_page)
	{
		$cacheService = new CacheService("Game","getHotGameOnline",$page,$num_per_page);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sub_sql='status=1 AND isHot=1 AND isOnline=1';
			$sql='SELECT count(id) as total FROM c_game WHERE '.$sub_sql.'';
			$command=$connect->createCommand($sql);
			$row = $command->queryRow();
			$total=$row['total'];
			$begin = ($page - 1) * $num_per_page;
			$sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_game WHERE ".$sub_sql." ORDER BY date_of_hot DESC LIMIT ".$begin.",".$num_per_page."";
			$command=$connect->createCommand($sql);
			$rows = $command->queryAll();
			$list_game_id=array();
			$game_file=array();
			if($rows)
			{
				foreach($rows as $row)
				{
					$list_game_id[]=$row['id'];
				}
				$list_game_id=implode(',',$list_game_id);
				if($list_game_id!='')
				{
					$game_file=Game::getGameFileByListID($list_game_id);// Danh sach app cua game
				}
			}
			/*Paging*/
			$num_page=ceil($total/$num_per_page);
			$url=Url::createUrl('kktGame/hotGameOnline');
			$url1=$url;
			$url.='/';
			$paging=Paging::show_paging_wap($num_page,$page,$url,$url1);
			$a=array($rows,$game_file,$paging);
			Yii::app()->cache->set($key, $a, ConstantsUtil::TIME_CACHE_900);
		}
		else
		{
			$a=$cache;
		}
		return $a;
	}
	public function getHotGameKD($page,$num_per_page)//Game kinh dien
	{
		$cacheService = new CacheService("Game","getHotGameKD",$page,$num_per_page);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sub_sql='status=1 AND isHot=1 AND isOnline=0';
			$sql="SELECT count(id) as total FROM c_game WHERE ".$sub_sql."";
			$command=$connect->createCommand($sql);
			$row = $command->queryRow();
			$total=$row['total'];
			$begin = ($page - 1) * $num_per_page;
			$sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_game WHERE ".$sub_sql." ORDER BY date_of_hot DESC LIMIT ".$begin.",".$num_per_page."";
			$command=$connect->createCommand($sql);
			$rows = $command->queryAll();			
			/*Lay url tai game*/
			/*
			$list_game_id=array();
			$game_file=array();
			if($rows)
			{
				foreach($rows as $row)
				{
					$list_game_id[]=$row['id'];
				}
				$list_game_id=implode(',',$list_game_id);
				if($list_game_id!='')
				{
					$game_file=Game::getGameFileByListID($list_game_id);// Danh sach app cua game
				}
			}
			*/
			/*Paging*/
			$num_page=ceil($total/$num_per_page);
			$url=Url::createUrl('kktGame/hotGameKD');
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
	public function getLatestGameOnline($page,$num_per_page)
	{
		$cacheService = new CacheService("Game","getLatestGameOnline",$page,$num_per_page);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sub_sql='status=1 AND isOnline=1';
			$sql='SELECT count(id) as total FROM c_game WHERE '.$sub_sql.'';
			$command=$connect->createCommand($sql);
			$row = $command->queryRow();
			$total=$row['total'];
			$begin = ($page - 1) * $num_per_page;
			$sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_game WHERE ".$sub_sql." ORDER BY create_date DESC LIMIT ".$begin.",".$num_per_page."";
			$command=$connect->createCommand($sql);
			$rows = $command->queryAll();
			$list_game_id=array();
			$game_file=array();
			if($rows)
			{
				foreach($rows as $row)
				{
					$list_game_id[]=$row['id'];
				}
				$list_game_id=implode(',',$list_game_id);
				if($list_game_id!='')
				{
					$game_file=Game::getGameFileByListID($list_game_id);// Danh sach app cua game
				}
			}
			$num_page=ceil($total/$num_per_page);
			$url=Url::createUrl('kktGame/latestGameOnline');
			$url1=$url;
			$url.='/';
			$paging=Paging::show_paging_wap($num_page,$page,$url,$url1);
			$a=array($rows,$game_file,$paging);
			Yii::app()->cache->set($key, $a, ConstantsUtil::TIME_CACHE_900);
		}
		else
		{
			$a=$cache;
		}
		return $a;
	}
	public function getLatestGameKD($page,$num_per_page)//Game kinh dien
	{
		$cacheService = new CacheService("Game","getLatestGameKD",$page,$num_per_page);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sub_sql='status=1 AND isOnline=0';
			$sql="SELECT count(id) as total FROM c_game WHERE ".$sub_sql."";
			$command=$connect->createCommand($sql);
			$row = $command->queryRow();
			$total=$row['total'];
			$begin = ($page - 1) * $num_per_page;
			$sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_game WHERE ".$sub_sql." ORDER BY create_date DESC LIMIT ".$begin.",".$num_per_page."";
			$command=$connect->createCommand($sql);
			$rows = $command->queryAll();
			$num_page=ceil($total/$num_per_page);
			$url=Url::createUrl('kktGame/latestGameKD');
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
	public function getGameFileByID($game_id)
	{
		$cacheService = new CacheService("Game","getGameFileByID",$game_id);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sql="SELECT * FROM c_game_file WHERE gameId=".$game_id;
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
	public function getGameFileByListID($list_game_id)
	{
		$cacheService = new CacheService("Game","getGameFileByListID",$list_game_id);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sql="SELECT * FROM c_game_file WHERE gameId IN (".$list_game_id.")";
			$command=$connect->createCommand($sql);
			$rows = $command->queryAll();//Danh sach game file
			$list_game_file_id=array();
			$game_file=array();
			$handset=array();
			$output=array();
			if($rows)
			{
				foreach($rows as $row)
				{
					//$list_game_file_id[]=$row['id'];
					$game_file[$row['gameId']][]=$row;
				}
			}
			$output=$game_file;
			/*
			$list_game_file_id=implode(',',$list_game_file_id);
			if($list_game_file_id!='')
			{
				$sql="SELECT t1.id,t1.manufacturer,t1.handset,t2.gameFileId FROM c_mobile_handset t1, c_game_file_mobile_handset t2 WHERE t1.id=t2.mobileHandsetId AND t2.gameFileId IN (".$list_game_file_id.")";
				$command=$connect->createCommand($sql);
				$rows_handset = $command->queryAll();//Danh sach handset cua danh sach game file
				foreach($rows_handset as $row)
				{
					$handset[$row['gameFileId']]=$row;
				}
			}
			if(!empty($game_file))
			foreach($game_file as $key=>$row)
			{
				$handset_file=isset($handset[$row['id']]) ? $handset[$row['id']]:array('manufacturer'=>'','handset'=>'');
				$row['manufacturer']=isset($handset_file['manufacturer']) ? $handset_file['manufacturer']:'';
				$row['handset']=isset($handset_file['handset']) ? $handset_file['handset']:'';
				$output[$key][]=$row;//Danh sach game file + handset cua tung game file
			}
			*/
			Yii::app()->cache->set($key, $output, ConstantsUtil::TIME_CACHE_3600);
		}
		else
		{
			$output=$cache;
		}
		return $output;
	}
	public function genHtmlGameOnline($games,$game_file,$device,$user)
	{
		$html='';
		if($games)
		foreach($games as $row)
		{
			$file_apps=isset($game_file[$row['id']]) ? $game_file[$row['id']]:array();
			$link_file_app='';
			$filename='';
			$html_file_app='';
			if(!empty($file_apps) && sizeof($file_apps)<=2)
			{
				foreach($file_apps as $row2)
				{
					$filename=$row2['filename'];
					$link_file_app=Common::getFilenameGame($user,$filename);
					$html_file_app.='<a class="download clorage" href="'.$link_file_app.'">Tải miễn phí</a>('.$row2['extension'].')|';
					/*
					if(strtolower($row2['manufacturer'])==strtolower($device) && $row2['extension']=='jar')
					{
						$filename=$row2['filename'];
						$create_date=$row2['create_date'];
						break;
					}
					*/
				}
				$html_file_app=rtrim($html_file_app,'|');
			}
			else
			{
				$link_file_app=Url::createUrl('kktGame/gameOnlineDetail',array('game_id'=>$row['id'],'alias'=>$row['alias']));
				$html_file_app.='<a class="download clorage" href="'.$link_file_app.'">Tải miễn phí</a>';
			}
			
			$link_img=Common::getImage($row['picture'],'game',$row['create_date'],'');
			$img_error=Yii::app()->params['static_url'].'/images/farmvui52.png';
			if($row['isHot']==1)
			{
				$icon_hot='<img alt="icon hot" class="ic_hot" src="'.Yii::app()->params['static_url'].'/images/icon_hot.gif">';
			}
			else
			{
				$icon_hot='<img alt="icon hot" class="ic_new2" src="'.Yii::app()->params['static_url'].'/images/icon_new2.png">';
			}
			$html.='<tr>
						<td width="52">
							<a href="'.$link_file_app.'" title="'.$row['title'].'">
								<img src="'.$link_img.'" alt="'.$row['title'].'" class="img52" onerror="this.src=\''.$img_error.'\'">
							</a>
						</td>
						<td valign="top" class="item_data">
							<a href="'.$link_file_app.'"><strong>'.$row['title'].'</strong></a>'.$icon_hot.'
							<br />
							<span class="cl666">'.$row['introtext'].'</span>
							<br>
							<span class="cl999">'.$row['hit'].' Lượt xem &nbsp;|&nbsp;</span>'.$html_file_app.'
						</td>
					</tr>';
		}
		return $html;
	}
	public function genHtmlGameKD($games)
	{
		$html='';
		if($games)
		foreach($games as $row)
		{
			$link_file_app=Url::createUrl('kktGame/download',array('alias'=>$row['alias'],'game_id'=>$row['id']));
			$link_detail=Url::createUrl('kktGame/gameKDDetail',array('game_id'=>$row['id'],'alias'=>$row['alias']));
			$link_img=Common::getImage($row['picture'],'game',$row['create_date'],'m');
			$img_error=Yii::app()->params['static_url'].'/images/farmvui52.png';
			if($row['isHot']==1)
			{
				$icon_hot='<img alt="icon hot" class="ic_hot" src="'.Yii::app()->params['static_url'].'/images/icon_hot.gif">';
			}
			else
			{
				$icon_hot='<img alt="icon hot" class="ic_new2" src="'.Yii::app()->params['static_url'].'/images/icon_new2.png">';
			}
			$html.='<tr>
						<td width="52">
							<a href="'.$link_detail.'" title="'.$row['title'].'">
								<img src="'.$link_img.'" alt="'.$row['title'].'" class="img52" onerror="this.src=\''.$img_error.'\'">
							</a>
						</td>
						<td valign="top" class="item_data">
							<a href="'.$link_detail.'"><strong>'.$row['title'].'</strong></a>'.$icon_hot.'<br>
							<span class="cl666">'.$row['introtext'].'</span>
							<br>
							<span class="cl999">'.$row['hit'].' Lượt xem &nbsp;|&nbsp;</span><a class="download clorage" href="'.$link_file_app.'">Tải miễn phí</a>
						</td>
					</tr>';
		}
		return $html;
	}
	public function getGameById($game_id)
	{
		$cacheService = new CacheService("Game","getGameById",$game_id);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sql="SELECT * FROM c_game WHERE id=".$game_id." AND status=1";
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
	public function getGameOnlineByCat($cat_id,$cat_alias,$page,$num_per_page)
	{
		$cacheService = new CacheService("Game","getGameOnlineByCat",$cat_id,$page.$num_per_page);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sub_sql='status=1 AND isOnline=1 AND categoryId='.$cat_id;
			$sql='SELECT count(id) as total FROM c_game WHERE '.$sub_sql.'';
			$command=$connect->createCommand($sql);
			$row = $command->queryRow();
			$total=$row['total'];
			$begin = ($page - 1) * $num_per_page;
			$sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_game WHERE ".$sub_sql." ORDER BY date_of_online DESC LIMIT ".$begin.",".$num_per_page."";
			$command=$connect->createCommand($sql);
			$rows = $command->queryAll();
			$list_game_id=array();
			$game_file=array();
			if($rows)
			{
				foreach($rows as $row)
				{
					$list_game_id[]=$row['id'];
				}
				$list_game_id=implode(',',$list_game_id);
				if($list_game_id!='')
				{
					$game_file=Game::getGameFileByListID($list_game_id);// Danh sach app cua game
				}
			}
			/*Paging*/
			$num_page=ceil($total/$num_per_page);
			$url=Url::createUrl('kktGame/catGameOnline',array('alias'=>$cat_alias,'cat_id'=>$cat_id));
			$url1=$url;
			$url.='/';
			$paging=Paging::show_paging_wap($num_page,$page,$url,$url1);
			$a=array($rows,$game_file,$paging);
			Yii::app()->cache->set($key, $a, ConstantsUtil::TIME_CACHE_900);
		}
		else
		{
			$a=$cache;
		}
		return $a;
	}
	public function getGameKDByCat($cat_id,$cat_alias,$page,$num_per_page)
	{
		$cacheService = new CacheService("Game","getGameKDByCat",$cat_id,$page.$num_per_page);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sub_sql='status=1 AND isOnline=0 AND categoryId='.$cat_id;
			$sql='SELECT count(id) as total FROM c_game WHERE '.$sub_sql.'';
			$command=$connect->createCommand($sql);
			$row = $command->queryRow();
			$total=$row['total'];
			$begin = ($page - 1) * $num_per_page;
			$sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_game WHERE ".$sub_sql." ORDER BY create_date DESC LIMIT ".$begin.",".$num_per_page."";
			$command=$connect->createCommand($sql);
			$rows = $command->queryAll();
			/*Paging*/
			$num_page=ceil($total/$num_per_page);
			$url=Url::createUrl('kktGame/catGameKD',array('alias'=>$cat_alias,'cat_id'=>$cat_id));
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
	
	public function updateHitDownload($game_id)
	{
		$connect =Yii::app()->db;
		$sql="UPDATE c_game SET hit=hit+1 WHERE id=".$game_id;
		$command=$connect->createCommand($sql);
		$result = $command->execute();
		$sql="UPDATE c_data SET hit=hit+1 WHERE dataId=".$game_id." AND type=1";
		$command=$connect->createCommand($sql);
		$result = $command->execute();
		return $result;
	}
	public function getGameOnlineHome($isOnline=1)
	{
		$cacheService = new CacheService("Game","getGameOnlineHome");
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
            if($isOnline <2){
                $sub_sql='status=1 AND isHome=1 AND isOnline='.intval($isOnline);
            }else{
                $sub_sql='status=1 AND isHome=1';
            }
			
			$sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_game WHERE ".$sub_sql." ORDER BY date_of_home DESC";
            $command=$connect->createCommand($sql);
			$rows = $command->queryAll();
			$list_game_id=array();
			$game_file=array();
			if($rows)
			{
				foreach($rows as $row)
				{
					$list_game_id[]=$row['id'];
				}
				$list_game_id=implode(',',$list_game_id);
				if($list_game_id!='')
				{
					$game_file=Game::getGameFileByListID($list_game_id);// Danh sach app cua game
				}
			}			
			$a=array($rows,$game_file);
			Yii::app()->cache->set($key, $a, ConstantsUtil::TIME_CACHE_900);
		}
		else
		{
			$a=$cache;
		}
		return $a;
	}
	public function getHotGameByCat($game_id,$cat_id,$limit,$type)
	{
		$cacheService = new CacheService("Game","getHotGameByCat",$limit);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			if($type==1)//Game online
				$sub_sql='status=1 AND isHot=1 AND isOnline=1 AND id!='.$game_id.' AND categoryId='.$cat_id;
			else
				$sub_sql='status=1 AND isHot=1 AND isOnline=0 AND id!='.$game_id.' AND categoryId='.$cat_id;
			$sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot,isOnline FROM c_game WHERE ".$sub_sql." ORDER BY date_of_hot DESC LIMIT ".$limit."";
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
	public function getHotGame($limit,$type)
	{
		$cacheService = new CacheService("Game","getHotGame",$limit.$type);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			if($type==1)
			{
				$sub_sql='status=1 AND isHot=1 AND isOnline=1';
			}
			else
			{
				$sub_sql='status=1 AND isHot=1 AND isOnline=0';
			}
			$sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isOnline,isHot FROM c_game WHERE ".$sub_sql." ORDER BY date_of_hot DESC LIMIT ".$limit."";
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
    
    public function getLastestGameByCat($cat_id,$page,$num_per_page){
        $begin = ($page - 1) * $num_per_page;
        $cacheService = new CacheService("Game","getLastestGameByCat",$cat_id,$page.$num_per_page);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
        $cache=false;
        if ($cache == false) 
        {
            $connect =Yii::app()->db;
            $sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot,percent_wapmaster FROM c_game 
            WHERE categoryId=".$cat_id." AND status=1 ORDER BY create_date DESC LIMIT ".$begin.",".$num_per_page."";
            $command=$connect->createCommand($sql);
            $row = $command->queryAll();
            Yii::app()->cache->set($key, $row, ConstantsUtil::TIME_CACHE_86400);
        }
        else
        {
            $row=$cache;
        }
        return $row;
    }
    public function getManyDownloadGameByCat($cat_id,$page,$num_per_page){
        $begin = ($page - 1) * $num_per_page;
        $cacheService = new CacheService("Game","getManyDownloadGameByCat",$cat_id,$page.$num_per_page);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
        $cache=false;
        if ($cache == false) 
        {
            $connect =Yii::app()->db;
            $sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot,percent_wapmaster FROM c_game 
            WHERE categoryId=".$cat_id." AND status=1 ORDER BY download DESC LIMIT ".$begin.",".$num_per_page."";
            $command=$connect->createCommand($sql);
            $row = $command->queryAll();
            Yii::app()->cache->set($key, $row, ConstantsUtil::TIME_CACHE_86400);
        }
        else
        {
            $row=$cache;
        }
        return $row;
    }
    public function getDataGameOffline($page,$num_per_page){
        $begin = ($page - 1) * $num_per_page;
        $cacheService = new CacheService("Game","getDataGameOffline",$page.$num_per_page);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
        $cache=false;
        if ($cache == false) 
        {
            $connect =Yii::app()->db;
            $sql="SELECT count(*) as count FROM c_game 
            WHERE isOnline=0 AND status=1";
            $command=$connect->createCommand($sql);
            $row = $command->queryRow();
            $num_page=ceil($row["count"]/$num_per_page);
            $sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot,percent_wapmaster FROM c_game 
            WHERE isOnline=0 AND status=1 ORDER BY id DESC LIMIT ".$begin.",".$num_per_page."";
            $command=$connect->createCommand($sql);
            $row = $command->queryAll();
            $a = array($row,$num_page);
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