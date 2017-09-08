<?php
    class KktGameController extends Controller
    {
        public $layout='main_member';
        public $device;
        public $cats;
        public $domain;
        public function init()
        {
            $this->cats=Category::getCatByType(1);//Danh sach danh muc cua game
            $this->device=Common::detectMobile();//Kiem tra thiet bi mobile su dung

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

        public function actionGameOnline()
        {

            $this->metaTitle = "[Games Mobile] hay nhat, vui nhat, noi bat nhat ";
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
            $data_seo = ShopSeo::getDataByUsernameAndType($username,1);
            if($data_seo){
                $this->metaTitle = $data_seo["metaTitle"];
                $this->metaDescription = $data_seo["metaDescription"];
                $this->metaKeywords = $data_seo["metaKeyword"];
            }
            $page = isset($_GET['page']) ? intval($_GET['page']):1;
            $num_per_page=5;
            $device=$this->device;
            list($hot_games,$hot_games_file,$paging)=Game::getHotGameOnline($page,$num_per_page);// Danh sach game hot                                                                                                                             
            list($latest_games,$latest_games_file,$paging)=Game::getLatestGameOnline($page,$num_per_page);//Danh sach game moi nhat
            $this->render("game_online",
            array("hot_games"=>$hot_games,"hot_games_file"=>$hot_games_file,
            "latest_games"=>$latest_games,"latest_games_file"=>$latest_games_file,
            "cats"=>$this->cats,
            "device"=>$device,
            "user"=>$this->domain
            ));
        }
        public function actionHotGameOnline()
        {
            $this->metaTitle = "[Games online] hot nhat ";
            $page = isset($_GET['page']) ? intval($_GET['page']):1;
            $num_per_page=5;
            $device=$this->device;
            list($hot_games,$hot_games_file,$paging)=Game::getHotGameOnline($page,$num_per_page);// Danh sach game hot
            foreach( $hot_games as $key=>$value){
                $this->metaTitle .= '' . $value["title"] . ', ';
            }
            $this->render("hot_game_online",
            array("hot_games"=>$hot_games,"hot_games_file"=>$hot_games_file,'paging'=>$paging,
            "cats"=>$this->cats,
            "device"=>$device,
            "user"=>$this->domain
            ));
        }
        public function actionLatestGameOnline()
        {

            $page = isset($_GET['page']) ? intval($_GET['page']):1;
            $num_per_page=5;
            $device=$this->device;
            list($latest_games,$latest_games_file,$paging)=Game::getLatestGameOnline($page,$num_per_page);//Danh sach game moi nhat
            $this->metaTitle = "[Games online] moi nhat ";
            foreach( $latest_games as $key=>$value){
                $this->metaTitle .= '' . $value["title"] . ', ';
            }
            $this->render("latest_game_online",
            array("latest_games"=>$latest_games,'latest_games_file'=>$latest_games_file,'paging'=>$paging,
            "cats"=>$this->cats,
            "device"=>$device,
            "user"=>$this->domain
            ));
        }
        public function actionCatGameOnline()
        {
            $page = isset($_GET['page']) ? intval($_GET['page']):1;
            $num_per_page=5;
            $device=$this->device;
            $cat_id = isset($_GET['cat_id']) ? intval($_GET['cat_id']):0;
            $info=Category::getCatInfo($cat_id);
            if($info)
            {
                list($games,$game_file,$paging)=Game::getGameOnlineByCat($cat_id,$info['alias'],$page,$num_per_page);
            }
            else
            {
                $link_error=Url::createUrl('kktMember/error');
                header('Location:'.$link_error);
                exit();		
            }
            $html=Game::genHtmlGameOnline($games,$game_file,$device);//Gen HTML tu danh sach game online
            $game_hot=Game::getHotGameByCat(0,$cat_id,2,1);
            $this->render("cat",
            array("games"=>$games,'html'=>$html,'paging'=>$paging,'info'=>$info,
            "cats"=>$this->cats,'game_hot'=>$game_hot,
            "device"=>$device,
            "user"=>$this->domain
            ));
        }
        public function actionGameOnlineDetail()
        {
            $page = isset($_GET['page']) ? intval($_GET['page']):1;
            $num_per_page=3;
            $game_id = isset($_GET['game_id']) ? intval($_GET['game_id']):0;
            $detail=Game::getGameById($game_id);
            $this->metaTitle = '[Game Online] '.$detail["title"];
            $cat_id=isset($detail['categoryId']) ? intval($detail['categoryId']):0;
            $info=Category::getCatInfo($cat_id);
            $cat_alias=isset($info) ? $info['alias']:'';
            if(!$detail)
            {
                $link_error=Url::createUrl('kktMember/error');
                header('Location:'.$link_error);
                exit();
            }
            Game::updateHitDownload($game_id);//Update luot view
            $game_hot=Game::getHotGameByCat($game_id,$cat_id,2,1);
            $game_file=Game::getGameFileByID($game_id);
            $this->render("game_online_detail",array('detail'=>$detail,'info'=>$info,'game_hot'=>$game_hot,'game_file'=>$game_file,'user'=>$this->domain));
        }
        public function actionCatGameKD()
        {
            $page = isset($_GET['page']) ? intval($_GET['page']):1;
            $num_per_page=5;
            $device=$this->device;
            $cat_id = isset($_GET['cat_id']) ? intval($_GET['cat_id']):0;
            $info=Category::getCatInfo($cat_id);
            if($info)
            {
                list($games,$paging)=Game::getGameKDByCat($cat_id,$info['alias'],$page,$num_per_page);
            }
            else
            {
                $link_error=Url::createUrl('kktMember/error');
                header('Location:'.$link_error);
                exit();		
            }
            $html=Game::genHtmlGameKD($games);//Gen HTML tu danh sach game kinh dien
            $game_hot=Game::getHotGameByCat(0,$cat_id,2,2);
            $this->render("cat",
            array("games"=>$games,'html'=>$html,'paging'=>$paging,'info'=>$info,
            "cats"=>$this->cats,'game_hot'=>$game_hot,
            "device"=>$device
            ));
        }
        /*Game Kinh dien*/
        public function actionGameKD()
        {
            $this->metaTitle = "Game mobile kinh dien, game mobile offline";
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
            $data_seo = ShopSeo::getDataByUsernameAndType($username,5);
            if($data_seo){
                $this->metaTitle = $data_seo["metaTitle"];
                $this->metaDescription = $data_seo["metaDescription"];
                $this->metaKeywords = $data_seo["metaKeyword"];
            }
            $page = isset($_GET['page']) ? intval($_GET['page']):1;
            $num_per_page=5;
            $device=$this->device;
            list($hot_games,$paging)=Game::getHotGameKD($page,$num_per_page);// Danh sach game hot
            list($latest_games,$paging)=Game::getLatestGameKD($page,$num_per_page);//Danh sach game moi nhat
            $this->render("game_kd",
            array("hot_games"=>$hot_games,
            "latest_games"=>$latest_games,
            "cats"=>$this->cats,
            "device"=>$device
            ));
        }
        public function actionHotGameKD()
        {
            $page = isset($_GET['page']) ? intval($_GET['page']):1;
            $num_per_page=5;
            $device=$this->device;
            list($hot_games,$paging)=Game::getHotGameKD($page,$num_per_page);// Danh sach game hot
            $this->metaTitle = "[Games offline] moi nhat ";
            foreach( $hot_games as $key=>$value){
                $this->metaTitle .= '' . $value["title"] . ', ';
            }
            $this->render("hot_game_kd",
            array("hot_games"=>$hot_games,'paging'=>$paging,
            "cats"=>$this->cats,
            "device"=>$device
            ));
        }
        public function actionLatestGameKD()
        {
            $page = isset($_GET['page']) ? intval($_GET['page']):1;
            $num_per_page=5;
            $device=$this->device;
            list($latest_games,$paging)=Game::getLatestGameKD($page,$num_per_page);// Danh sach game hot
            $this->metaTitle = "[Games offline] moi nhat ";
            foreach( $latest_games as $key=>$value){
                $this->metaTitle .= '' . $value["title"] . ', ';
            }
            $this->render("latest_game_kd",
            array("latest_games"=>$latest_games,'paging'=>$paging,
            "cats"=>$this->cats,
            "device"=>$device
            ));
        }
        public function actionGameKDDetail()
        {
            $page = isset($_GET['page']) ? intval($_GET['page']):1;
            $num_per_page=3;
            $game_id = isset($_GET['game_id']) ? intval($_GET['game_id']):0;
            $detail=Game::getGameById($game_id);
            $this->metaTitle = '[Game Offline] '.$detail["title"];
            $cat_id=isset($detail['categoryId']) ? intval($detail['categoryId']):0;
            $info=Category::getCatInfo($cat_id);
            $cat_alias=isset($info) ? $info['alias']:'';
            if(!$detail)
            {
                $link_error=Url::createUrl('kktMember/error');
                header('Location:'.$link_error);
                exit();
            }
            Game::updateHitDownload($game_id);//Update luot view
            list($game_cat,$paging)=Game::getGameKDByCat($cat_id,$cat_alias,$page,$num_per_page);
            $game_hot=Game::getHotGameByCat($game_id,$cat_id,2,2);
            $this->render("game_kd_detail",array('detail'=>$detail,'game_cat'=>$game_cat,'info'=>$info,'game_hot'=>$game_hot));
        }
        public function actionDownload()
        {
            $game_id = isset($_GET['game_id']) ? intval($_GET['game_id']):0;
            $detail=Game::getGameById($game_id);
            /*Lay duong danh file app*/
            $file_name=Common::genFilenameApp(1);
            $extension=Common::detectFileExtension();
            if(empty($extension) || $extension=="ipa"){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
                echo "Hiện tại chúng tôi chưa hỗ trợ cho dòng máy này. Chúng tôi sẽ cập nhật trong thời gian tới";   
            }else{
                $orginal_filename=$file_name.'.'.$extension;
                Home::updateTimeDownload($game_id,1);
                $url_download=Common::getApp($this->domain,$orginal_filename);
                header('Location:'.$url_download);
                exit();
            }
            /*
            if($detail)
            {
            //$a=Game::updateHitDownload($game_id);//Update luot view, download
            header("Content-disposition: attachment; filename=".$detail['alias'].".jad");
            header('Content-type: application/octet-stream');
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