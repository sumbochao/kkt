<?php
    class Member extends CActiveRecord
    {
        public function getMember($array_input)
        {		
            $sub_sql='';
            $input_cache='';
            foreach($array_input as $key=>$value)
            {
                $sub_sql.=$key."='".$value."' AND ";
                $input_cache.=$value;
            }
            $sub_sql=rtrim($sub_sql,'AND ');
            //Cache
            $cacheService = new CacheService("Member","getUser",$input_cache);
            $key = $cacheService->createKey();
            $cache = Yii::app()->cache->get($key);
            $cache=false;
            if ($cache == false) 
            {
                $connect =Yii::app()->db;
                $sql="SELECT * FROM c_user WHERE ".$sub_sql."";
                $command=$connect->createCommand($sql);
                $row= $command->queryRow();
                Yii::app()->cache->set($key, $row, ConstantsUtil::TIME_CACHE_3600);
            }
            else
            {
                $row=$cache;
            }
            return $row;
        }

        public function getHtmlModule($module)
        {
            $cacheService = new CacheService("Member","getHtmlModule",$module);
            $key = $cacheService->createKey();
            $cache = Yii::app()->cache->get($key);
            $cache=false;
            if ($cache == false) 
            {
                $connect =Yii::app()->db;
                $sql="SELECT * FROM c_html WHERE module='".$module."'";
                $command=$connect->createCommand($sql);
                $row= $command->queryRow();
                $html=$row ? $row['content']:'';
                Yii::app()->cache->set($key, $html, ConstantsUtil::TIME_CACHE_900);
            }
            else
            {
                $html=$cache;
            }
            return $html;
        }

        /*Box kenh18 trang chu*/
        public function genHtmlBoxKenh18()
        {
            $connect =Yii::app()->db;
            $sub_sql='status=1';
            $sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_video WHERE ".$sub_sql." ORDER BY create_date DESC LIMIT 5";
            $command=$connect->createCommand($sql);
            $rows= $command->queryAll();
            $html = "";
            if($rows)
            {
                $html.='<div class="kenh18"><h2 class="bg_green"><strong>Video</strong></h2>';

                $html.='<div class="table list_table"><table width="100%" cellspacing="0" cellpadding="0" border="0">';
                $html.=Video::genHtmlVideo($rows);

                $link_kenh18=Url::createUrl('kktVideo/index');
                $html.='</table><div><span class="view_more" ><a href="'.$link_kenh18.'" class="clwhite">+ Xem tiếp</a></span></div></div>';

            } 
            $sql ="SELECT * FROM c_html WHERE module='mod_home_kenh18'";
            $command=$connect->createCommand($sql);
            $infor_module= $command->queryRow();
            if($infor_module)
            {
                $sql= "UPDATE c_html SET content='".trim(mysql_escape_string($html))."' WHERE id=".$infor_module['id'];
            }
            else
            {
                $sql= "INSERT INTO c_html(`module`, `content`) VALUES ('mod_home_kenh18','".trim(mysql_escape_string($html))."')";
            }
            $command=$connect->createCommand($sql);
            $result = $command->execute();
            /*Bao lai cache*/
            //SynCache::setCacheHtmlModule(array('module'=>'mod_latest_news'));
        }
        /*Box tin nong*/
        public function genHtmlBoxNews()
        {
            $connect =Yii::app()->db;
            $sub_sql='status=1 AND isHome=1';
            $sql="SELECT id,title,alias,introtext,picture,hit,create_date,isHot FROM c_news WHERE ".$sub_sql." ORDER BY date_of_home DESC LIMIT 5";
            $command=$connect->createCommand($sql);
            $rows= $command->queryAll();
            $html = "";
            if($rows){
                $html.='<div class="news_hot"><h2 class="bg_green"><strong>Tin hot</strong></h2>';
                if($rows)
                {
                    $html.='<div class="table list_table"><table width="100%" cellspacing="0" cellpadding="0" border="0">';
                    $html.=News::genHtmlNews($rows);
                }
                $link_news=Url::createUrl('kktNews/index');
                $html.='</table><div><span class="view_more" ><a href="'.$link_news.'" class="clwhite">+ Xem tiếp</a></span></div></div>';
            }
            $sql ="SELECT * FROM c_html WHERE module='mod_home_news'";
            $command=$connect->createCommand($sql);
            $infor_module= $command->queryRow();
            if($infor_module)
            {
                $sql= "UPDATE c_html SET content='".trim(mysql_escape_string($html))."' WHERE id=".$infor_module['id'];
            }
            else
            {
                $sql= "INSERT INTO c_html(`module`, `content`) VALUES ('mod_home_news','".trim(mysql_escape_string($html))."')";
            }
            $command=$connect->createCommand($sql);
            $result = $command->execute();
        }
        /*Box clip dang xem*/
        public function genHtmlBoxAlbum()
        {
            $connect =Yii::app()->db;
            $sub_sql='status=1 AND isHome=1';
            $sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_album WHERE ".$sub_sql." ORDER BY date_of_home DESC LIMIT 5";
            $command=$connect->createCommand($sql);
            $rows= $command->queryAll();
            $html = "";
            if($rows){
                $html.='<div class="clip_vewing bottom10"><h2 class="bg_green"><strong>Ảnh nóng</strong></h2>';

                $html.='<div class="table list_table"><table width="100%" cellspacing="0" cellpadding="0" border="0">';
                $html.=Album::genHtmlAlbum($rows);

                $link_album=Url::createUrl('kktAlbum/index');
                $html.='</table><div><span class="view_more" ><a href="'.$link_album.'" class="clwhite">+ Xem tiếp</a></span></div></div>';
            }
            $sql ="SELECT * FROM c_html WHERE module='mod_home_album'";
            $command=$connect->createCommand($sql);
            $infor_module= $command->queryRow();
            if($infor_module)
            {
                $sql= "UPDATE c_html SET content='".trim(mysql_escape_string($html))."' WHERE id=".$infor_module['id'];
            }
            else
            {
                $sql= "INSERT INTO c_html(`module`, `content`) VALUES ('mod_home_album','".trim(mysql_escape_string($html))."')";
            }
            $command=$connect->createCommand($sql);
            $result = $command->execute();

        }

        /*Box kenh18 trang kenh18*/
        public function genHtmlKenh18()
        {
            $html='';
            $module='';
            $connect =Yii::app()->db;
            $array_cat=Category::getCatKenh18();
            if($array_cat)
                foreach($array_cat as $row)
                {
                    $info=$row;
                    if($info['type']==2)//Video
                    {
                        $box_title='HÀNG MỚI VỀ';
                        $module='mod_kenh18_video';
                        $link_more=Url::createUrl('kktVideo/cat',array('cat_id'=>$info['id'],'alias'=>$info['alias']));
                        list($video,$paging)=Video::getVideoByCat($info['id'],$info['alias'],1,3);
                        $html_video=Video::genHtmlVideo($video);
                        $html='	<div class="clip_vewing"><h2 class="bg_green"><strong>'.$box_title.'</strong></h2>
                        <div class="table list_table">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0">'.$html_video.'</table>
                        <div><span class="view_more" ><a href="'.$link_more.'" class="clwhite">+ Xem tiếp</a></span>
                        </div>
                        </div>
                        </div>';
                    }
                    else if($info['type']==3)//Anh
                        {
                            $box_title='XINH KHÔNG CHỊU NỔI';
                            $module='mod_kenh18_album';
                            $link_more=Url::createUrl('kktAlbum/cat',array('cat_id'=>$info['id'],'alias'=>$info['alias']));
                            list($album,$paging)=Album::getAlbumByCat($info['id'],$info['alias'],1,3);
                            $html_album=Album::genHtmlAlbum($album);
                            $html='	<div class="clip_vewing"><h2 class="bg_green"><strong>'.$box_title.'</strong></h2>
                            <div class="table list_table">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">'.$html_album.'</table>
                            <div><span class="view_more" ><a href="'.$link_more.'" class="clwhite">+ Xem tiếp</a></span>
                            </div>
                            </div>
                            </div>';				
                        }
                        else if($info['type']==4)//Tin tuc
                            {
                                $box_title='TIN NÓNG HỔI';
                                $module='mod_kenh18_news';
                                $link_more=Url::createUrl('kktNews/cat',array('cat_id'=>$info['id'],'alias'=>$info['alias']));
                                list($news,$paging)=News::getNewsByCat($info['id'],$info['alias'],1,3);
                                $html_news=News::genHtmlNews($news);
                                $html='	<div class="clip_vewing"><h2 class="bg_green"><strong>'.$box_title.'</strong></h2>
                                <div class="table list_table">
                                <table width="100%" cellspacing="0" cellpadding="0" border="0">'.$html_news.'</table>
                                <div><span class="view_more" ><a href="'.$link_more.'" class="clwhite">+ Xem tiếp</a></span>
                                </div>
                                </div>
                                </div>';
                            }
                            if($module!='')
                    {
                        $sql ="SELECT * FROM c_html WHERE module='".$module."'";
                        $command=$connect->createCommand($sql);
                        $infor_module= $command->queryRow();
                        if($infor_module)
                        {
                            $sql= "UPDATE c_html SET content='".trim(mysql_escape_string($html))."' WHERE id=".$infor_module['id'];
                        }
                        else
                        {
                            $sql= "INSERT INTO c_html(`module`,`content`) VALUES ('".$module."','".trim(mysql_escape_string($html))."')";
                        }
                        $command=$connect->createCommand($sql);
                        $result = $command->execute();
                    }
            }
            /*Bao lai cache*/
            //SynCache::setCacheHtmlModule(array('module'=>'mod_latest_news'));
        }
        public function getAllUserByrefUID($refUID){
            $sql = "SELECT id FROM c_user WHERE refUID = ".intval($refUID);
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            $rows = array();
            foreach($data as $key=>$value){
                $rows[] = $value["id"];
            }
            return $rows;
        }
    }
?>