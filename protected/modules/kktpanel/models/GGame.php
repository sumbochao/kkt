<?php
    class GGame extends MyActiveRecord
    {

        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function getName()
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT id,name FROM vtc_game_store.g_game";
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        public function getAllGam()
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_game ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = " SELECT * FROM vtc_game_store.g_game ";
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            
            return array($max_page,intval($data_count["count"]),$data);
        }

        public function getAllGame($hedieuhanh,$from_date,$to_date,$category_id,$publisher_id,$keyword,$type,$status,$orderBy,$compare,$page,$row_per_page)
        {
            /*
            if($category_id >= 1){
                $category_id_where = "category_id = '$category_id'";
            }
            else { $category_id_where = "";}
            
            
            
            if ($hedieuhanh >=1)
            {
                if ($hedieuhanh ==1){$hedieuhanh_where = "is_android = 1";}  else {
                            $hedieuhanh_where = "is_ios = 1";
                        }            
            }  else {
                $hedieuhanh_where = "";
            } 
            if ($publisher_id >0)
            {
                $publisher_id_where = " publisher_id ='$publisher_id'";
            }  else {
                $publisher_id_where ="";
            }
                    
            if($keyword!="" && $type>0)
            {
                if($type == 1)
                {
                    $keyword_where = " id = '$keyword'";
                }
                if($type == 2)
                {
                    
                   $keyword_where= "name = '$keyword')";
                   
                    //$keyword_where = " name = %'$keyword'%";
                   //$keyword_where = "array('like', 'name', '%$keyword%')";
                }
            }  else {
                $keyword_where = "";
            }
            
            if($status !=2)
            {
                $status_where = "status = '$status'";
            }  else {
                $status_where = "";
            }
            if ($compare == 1 )
            {
                $compare_where = " DESC";
            }  else {
                $compare_where = " ASC";
            }
            $aa = strtotime($from_date, $now);
           
            $from_date_model = date('Y-m-d',$aa );
            if ($from_date != "")
            {
                $from_date_where =" create_date >= '$from_date_model'";
            }  else {
                $from_date_where ="";
            }
             $aaa = strtotime($to_date, $now);
            $to_date_model = date('Y-m-d',$aaa );
          
            $to_date_model = date('Y-m-d', $to_date);
            if ($to_date != "" )
            {
                $to_date_where = " create_date <= '$to_date_model'";
            }  else {
                $to_date_where = "";
            }
            
           
            switch ($orderBy) 
            {
                case 1 : $orderby_where = "count_ios_download ".$compare_where;break;
                case 2:  $orderby_where ="count_android_download ".$compare_where;
                                        break;
                case 3:  $orderby_where = " id ".$compare_where;
                                        break;
            }
            
            
            
            $data = Yii::app()->db_gamestore->createCommand()
                    ->select('*')
                    ->from('vtc_game_store.g_game')
                    ->where($hedieuhanh_where)
                    ->andWhere($publisher_id_where)
                    ->andWhere($category_id_where)
                    
                    ->andWhere($keyword_where)
                    ->andWhere($status_where)
                    ->andWhere($from_date_where)
                    ->andWhere($to_date_where)
                    
                   ->order( $orderby_where)
                    
                   //->andWhere("category_id = '$category_id'")
                    
                    //->andWhere( array( 'in', 'create_date', array($from_date, $to_date)))
                   // ->andWhere('category_id =: category_id' ,array('catelogy_id' => $category_id ))
                   // ->andWhere('publisher_id =:publisher_id ',array('publisher_id' => $publisher_id));
                   ->queryAll();
           
            // $data= $command->queryAll();
          
            
             $data_count = count($data);          
            
             $max_page = ceil($data_count/$row_per_page);
             return array($max_page,$data_count,$data);
             
             */
 
            $str_sql = "";
            $str_order = "";
            switch($orderBy)
            {
                case 1: $str_order .= "ORDER BY count_ios_download";break;
                case 2: $str_order .= "ORDER BY count_android_download";break;
                case 3: $str_order .= "ORDER BY id";break;
            }

            if(intval($compare) == 1)
            {
                $str_order .= " DESC ";
            }
            else
            {
                $str_order .= " ASC ";
            }

            if($from_date != "")
            {
                $date = strtotime($from_date);
                $from_date = date('Y-m-d', $date);
                $str_sql .=" AND create_date>='".$from_date."'";
            }
            
            if($to_date != "")
            {
                $date = strtotime($to_date);
                $to_date = date('Y-m-d', $date);
                $str_sql .=" AND create_date<='". $to_date."'";
            }
            if($category_id > 0)
            {
                $str_sql .=" AND category_id=".$category_id;
            }
            if($publisher_id>0)
            {
                $str_sql .= " AND publisher_id=".$publisher_id;
            }
            if($keyword!="" && $type>0)
            {
                if($type == 1)
                {
                    $str_sql .= " AND id=".intval($keyword);
                }
                if($type == 2)
                {
                    $str_sql .= " AND name LIKE '%".$keyword."%' "; 
                }
            }
            
            if(intval($status) != 2){
                $str_sql .= " AND status = ".intval($status);
            }
            if(intval($hedieuhanh) == 1)
            {
                $str_sql .= " AND is_android = 1";
            }
            if(intval($hedieuhanh) == 2)
            {
                $str_sql .= " AND is_ios = 1";
            }
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_game WHERE 1 ".$str_sql."";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT * FROM vtc_game_store.g_game WHERE 1".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            //var_dump($sql);
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            //var_dump($data);
            return array($max_page,intval($data_count["count"]),$data);
            
        }
       
        public function getDataById($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT * FROM vtc_game_store.g_game WHERE id=$id";
           
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function getDataByName($name)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT * FROM vtc_game_store.g_game WHERE name='$name'";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }

        public function deleteGame($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "DELETE FROM vtc_game_store.g_game WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }

        public function quickUpdate($id,$status,$is_hot,$is_market,$is_play)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_game SET status=$status,is_hot=$is_hot,is_market=$is_market,is_play=$is_play    WHERE id=$id";
        
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }

        public function insertGame($banner,$url_scheme,$rate_view,$title_game,$description,$content,$picture,$images,$video_game,$category,$publisher,$version_ipa,$version_apk,$version_os_ipa,$version_os_apk,$size_ipa,$size_apk,$tags,$is_hot,$status,$time_now,$create_user,$is_ipa,$is_apk,$email,$website,$fanpage,$phone,$room_name,$room_pass,$bundle_id,$packet_id,$publisher_name,$itune_id)
        {
            $title_bundle = "";
            $value_bundle = "";
            $title_packet = "";
            $value_packet = "";
            $title_itune = "";
            $value_itune = "";
            
            $title_game = addslashes($title_game);
            $description = addslashes($description);
            $content = addslashes($content);
            
            if($bundle_id != "")
            {
                $title_bundle = ",bundle_id";
                $value_bundle = ",'$bundle_id'";
            }
            if($packet_id != "")
            {
                $title_packet = ",packet_id";
                $value_packet = ",'$packet_id'";
            }
            
            if($itune_id != "")
            {
                $title_itune = ",itune_id";
                $value_itune = ",'$itune_id'";
            }
           
            
            $connect = Yii::app()->db_gamestore;
            $sql = "INSERT INTO vtc_game_store.g_game(banner,url_scheme,rate_view,name,description,content,icon,images,video,category_id,publisher_id,version_ios,version_android,version_os_ios,version_os_android,size_ios,size_android,tags,is_ios,is_android,is_hot,status,create_date,create_user,email,website,fanpage,phone,room_name,room_password". $title_bundle ."". $title_packet."".$title_itune. ",publisher_name) 
            VALUES('$banner','$url_scheme','$rate_view','$title_game','$description','$content','$picture','$images','$video_game',$category,$publisher,'$version_ipa','$version_apk','$version_os_ipa','$version_os_apk','$size_ipa','$size_apk','$tags',$is_ipa,$is_apk,$is_hot,$status,'$time_now','$create_user','$email','$website','$fanpage','$phone','$room_name','$room_pass'". $value_bundle ."". $value_packet .$value_itune.",'$publisher_name') ";
          
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function updateGame($banner,$url_scheme,$rate_view,$id,$title_game,$description,$content,$picture,$images,$video_game,$category,$publisher,$version_ipa,$version_apk,$version_os_ipa,$version_os_apk,$size_ipa,$size_apk,$tags,$is_hot,$status,$time_now,$update_user,$is_ipa,$is_apk,$email,$website,$fanpage,$phone,$bundle_id,$packet_id,$publisher_name,$itune_id)
        {
            
            $sql_bundle = "";
            $sql_packet = "";
            $title_game = addslashes($title_game);
            $description = addslashes($description);
            $content = addslashes($content);
            
            if($bundle_id != "")
            {
                $sql_bundle = "bundle_id='$bundle_id',";
            }
            elseif($bundle_id == "")
            {
                $sql_bundle = "bundle_id=NULL,";
            }
            if($packet_id != "")
            {
                $sql_packet = "packet_id='$packet_id',";
            }
            elseif($packet_id == "")
            {
                $sql_packet = "packet_id=NULL,";
            }
            
            if($itune_id != "")
            {
                $sql_itune = "itune_id='$itune_id',";
            }
            elseif($itune_id == "")
            {
                $sql_itune = "itune_id=NULL,";
            }
            
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_game SET
            banner ='$banner',
            url_scheme ='$url_scheme',
            name='$title_game',
            rate_view='$rate_view',
            description='$description',
            content='$content',
            icon='$picture',
            images='$images',
            video='$video_game',
            category_id='$category',
            publisher_id='$publisher',
            tags='$tags',
            is_hot='$is_hot',
            is_ios='$is_ipa',
            is_android='$is_apk',
            status='$status',
            update_date='$time_now',
            update_user='$update_user',
            email='$email',
            website='$website',
            fanpage='$fanpage',
            phone='$phone',
            ". $sql_bundle ." ". $sql_packet ." ".$sql_itune."
            publisher_name='$publisher_name'
           
            WHERE id='$id'
            ";
           
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function countCategoryGame($category)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_game WHERE category_id=$category";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function countPublisherGame($publisher)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_game WHERE publisher_id=$publisher";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function createRoom($room_name,$room_pass)
        {
            $connect = Yii::app()->db_openfire;
            $sql = "CALL prc_create_muc_room('$room_name','$room_pass',@createResult)";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function updateVersionAndroid($id,$version,$version_os,$size)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_game SET version_android='$version',version_os_android='$version_os',size_android='$size' WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function updateVersionIos($id,$version,$version_os,$size)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_game SET version_ios='$version',version_os_ios='$version_os',size_ios='$size' WHERE id=$id";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function checkBundle($bundle_id)
        {
            $connect =  Yii::app()->db_gamestore;
            $sql = "SELECT * FROM vtc_game_store.g_game WHERE bundle_id='$bundle_id' ";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function checkPacket($packet_id)
        {
            $connect =  Yii::app()->db_gamestore;
            $sql = "SELECT * FROM vtc_game_store.g_game WHERE packet_id='$packet_id' ";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function getRelate($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT game_relate FROM vtc_game_store.g_game WHERE id=$id ";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function searchRelate($game,$publisher)
        {
        	$str_sql = "";
            if($publisher != 0)
            {
                $str_sql .= " AND publisher_id='$publisher'";
            }
            if($game != "")
            {
                $str_sql .= " AND name LIKE '%". $game ."%'";
            }
            $connect =  Yii::app()->db_gamestore;
            $sql = "SELECT * FROM vtc_game_store.g_game WHERE 1".$str_sql;
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public function updateRelate($id,$relate)
        {
            $connect =  Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_game SET game_relate='$relate' WHERE id=$id ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }

    }
?>
