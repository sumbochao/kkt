<?php
    class BoxHot extends CPortlet
    {
        protected function renderContent()  
        {
            $controler=Yii::app()->controller->id;
            $action=Yii::app()->controller->action->id;
            $html='';
            switch($controler)
            {
                default:
                case "kenh18":
                    $data=Game::getHotGame(1,1);
                    if(!empty($data))
                    {
                        $data=$data[0];
                        $game_file=Game::getGameFileByID($data['id']);
                        $link_detail=Url::createUrl('kktGame/download',array('game_id'=>$data['id'],'alias'=>$data['alias']));
                        if($game_file)
                        {
                            $file=$game_file[0];
                            $link_detail=Common::getImage($file['filename'],'game',$data['create_date'],'');
                        }
                        //$link_detail=Url::createUrl('kktGame/download',array('game_id'=>$data['id'],'alias'=>$data['alias']));										
                    }
                    break;
                case "game":
                    if($action=='gameOnline' || $action=='hotGameOnline' || $action=='latestGameOnline')
                    {
                        $data=Game::getHotGame(1,1);
                    }
                    else
                    {
                        $data=Game::getHotGame(1,2);
                    }
                    if(!empty($data))
                    {
                        $data=$data[0];
                        if($data['isOnline']==1)
                        {
                            $game_file=Game::getGameFileByID($data['id']);
                            $link_detail=Url::createUrl('kktGame/download',array('game_id'=>$data['id'],'alias'=>$data['alias']));
                            if($game_file)
                            {
                                $file=$game_file[0];
                                $link_detail=Common::getImage($file['filename'],'game',$data['create_date'],'');
                            }
                        }
                        else
                        {
                            $link_detail=Url::createUrl('kktGame/gameKDDetail',array('game_id'=>$data['id'],'alias'=>$data['alias']));
                        }
                    }
                    break;
                case "video":
                    list($data,$paging)=Video::getHotVideo(1,1);
                    if(!empty($data))
                    {
                        $data=$data[0];
                        $link_detail=Url::createUrl('kktVideo/detail',array('video_id'=>$data['id'],'alias'=>$data['alias']));
                    }
                    break;
                case "album":
                    $data=Album::getHotAlbum(1);
                    if(!empty($data))
                    {
                        $data=$data[0];
                        $link_detail=Url::createUrl('kktAlbum/detail',array('album_id'=>$data['id'],'alias'=>$data['alias']));
                    }
                    break;
                case "news":
                    $data=News::getHotNews(1);
                    if(!empty($data))
                    {
                        $data=$data[0];
                        $link_detail=Url::createUrl('kktAlbum/detail',array('album_id'=>$data['id'],'alias'=>$data['alias']));
                    }
                    break;
            }
            if(!empty($data))
            {
                if($controler != "game"){
                    $html='	<div class="news_new">
                    Hàng mới ra lò: <a class="clorage" href="'.$link_detail.'"> <strong>'.$data['title'].'</strong></a>&nbsp;<img alt="icon new" src="'.Yii::app()->params['static_url'].'/images/ic_new.gif">
                    </div>';
                }else{
                    $html = '<div class="news pad10 bg_orage3">
                    <span class="s14">Hot: <a href="'.$link_detail.'" class="clorage"><strong>'.$data['title'].'</strong></a> <img src="'.Yii::app()->params['static_url'].'/images/icon_new2.png" alt="icon new"></span> <br>
                    </div>';
                }
            }
            echo $html;
        }
    }
?>