<?php
    class Common
    {

        public static function pageDetail($total_page,$page,$link,$id)
        {
            $paging = "";
            $cur_page = $page;
            $back = 1;
            if($total_page<=3)
            {
                for($i=1;$i<=$total_page;$i++)
                {
                    $paging .= '<a id='. $i .' class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$i,'id'=>$id)).'">'.$i.'</a>&nbsp;&nbsp;';  
                }
            }
            else
            {
                if($page<4)
                {
                    for($i=1;$i<=3;$i++)
                    {
                        $paging .= '<a id='. $i .' class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$i,'id'=>$id)).'">'.$i.'</a>&nbsp;&nbsp;';  
                    }
                    $paging .= '<a id='. 4 .' class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>4,'id'=>$id)).'">'. ">" .'</a>&nbsp;&nbsp;'; 
                    $paging .= '<a id='. $total_page .' class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$total_page,'id'=>$id)).'">'. ">>" .'</a>&nbsp;&nbsp;';
                }
                if($page>=4 && $page<$total_page-3)
                {
                    $paging .= '<a id='. 1 .' class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>1,'id'=>$id)).'">'."<<".'</a>&nbsp;&nbsp;';
                    $paging .= '<a  class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$page-1,'id'=>$id)).'">'."<".'</a>&nbsp;&nbsp;';
                    $paging .= '<a  class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$page,'id'=>$id)).'">'.$page.'</a>&nbsp;&nbsp;';
                    $paging .= '<a  class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$page+1,'id'=>$id)).'">'.">".'</a>&nbsp;&nbsp;';
                    $paging .= '<a  class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$total_page,'id'=>$id)).'">'.">>".'</a>&nbsp;&nbsp;';
                }
                if($page>=$total_page-2)
                {
                    $paging .= '<a id='. 1 .' class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>1,'id'=>$id)).'">'."<<".'</a>&nbsp;&nbsp;';
                    $paging .= '<a  class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$page-3,'id'=>$id)).'">'."<".'</a>&nbsp;&nbsp;';
                    for($i=$total_page-2;$i<=$total_page;$i++)
                    {
                        $paging .= '<a id='. $i .' class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$i,'id'=>$id)).'">'.$i.'</a>&nbsp;&nbsp;';  
                    }
                }
                
            }

            return $paging;

        }

        public static function pageHot($total_page,$page,$link)
        {
            $paging = "";
            $cur_page = $page;
            $back = 1;
            if($total_page<=3)
            {
                for($i=1;$i<=$total_page;$i++)
                {
                    $paging .= '<a id='. $i .' class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$i)).'">'.$i.'</a>&nbsp;&nbsp;';  
                }
            }
            else
            {
                if($page<4)
                {
                    for($i=1;$i<=3;$i++)
                    {
                        $paging .= '<a id='. $i .' class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$i)).'">'.$i.'</a>&nbsp;&nbsp;';  
                    }
                    $paging .= '<a id='. 4 .' class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>4)).'">'. ">" .'</a>&nbsp;&nbsp;'; 
                    $paging .= '<a id='. $total_page .' class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$total_page)).'">'. ">>" .'</a>&nbsp;&nbsp;';
                }
                if($page>=4 && $page<$total_page-3)
                {
                    $paging .= '<a id='. 1 .' class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>1)).'">'."<<".'</a>&nbsp;&nbsp;';
                    $paging .= '<a  class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$page-1)).'">'."<".'</a>&nbsp;&nbsp;';
                    $paging .= '<a  class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$page)).'">'.$page.'</a>&nbsp;&nbsp;';
                    $paging .= '<a  class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$page+1)).'">'.">".'</a>&nbsp;&nbsp;';
                    $paging .= '<a  class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$total_page)).'">'.">>".'</a>&nbsp;&nbsp;';
                }
                if($page>=$total_page-2)
                {
                    $paging .= '<a id='. 1 .' class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>1)).'">'."<<".'</a>&nbsp;&nbsp;';
                    $paging .= '<a  class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$page-3)).'">'."<".'</a>&nbsp;&nbsp;';
                    for($i=$total_page-2;$i<=$total_page;$i++)
                    {
                        $paging .= '<a id='. $i .' class="numbertrang" href="'.Yii::app()->createUrl($link,array('page'=>$i)).'">'.$i.'</a>&nbsp;&nbsp;';  
                    }
                }
                
            }

            return $paging;

        }

        public static function pageSomo($total_page,$page)
        {
            $paging = "";
            $cur_page = $page;
            $back = 1;


            if($total_page<=4)
            {
                for($i=1;$i<=$total_page;$i++)
                {
                    $paging .= '<a id='. $i .' class="numbertrang" href="'.Yii::app()->createUrl('tienich/somo',array('page'=>$i)).'">'.$i.'</a>&nbsp;&nbsp;';
                }
            }
            else
            {
                if($page<=3)
                {
                    for($i=1;$i<=3;$i++)
                    {
                        $paging .= '<a id='. $i .' class="numbertrang" href="'.Yii::app()->createUrl('tienich/somo',array('page'=>$i)).'">'.$i.'</a>&nbsp;&nbsp;';
                    }
                    $paging .= '<a id='. 4 .' class="numbertrang" href="'.Yii::app()->createUrl('tienich/somo',array('page'=>4)).'">'. ">" .'</a>&nbsp;&nbsp;';
                    $paging .= '<a id='. $total_page .' class="numbertrang" href="'.Yii::app()->createUrl('tienich/somo',array('page'=>$total_page)).'">'. ">>" .'</a>&nbsp;&nbsp;';
                }
                if($page>=4&& $page<$total_page-2)
                {
                    $paging .= '<a id='. $back .' class="numbertrang" href="'.Yii::app()->createUrl('tienich/somo',array('page'=>$back)).'">'."<<".'</a>&nbsp;&nbsp;';
                    $paging .= '<a class="numbertrang" href="'.Yii::app()->createUrl('tienich/somo',array('page'=>$page-1)).'">'."<".'</a>&nbsp;&nbsp;';
                    $paging .= '<a id='. $page .' class="numbertrang" href="'.Yii::app()->createUrl('tienich/somo',array('page'=>$page)).'">'.$page.'</a>&nbsp;&nbsp;';
                    $paging .= '<a class="numbertrang" href="'.Yii::app()->createUrl('tienich/somo',array('page'=>$page+1)).'">'.">".'</a>&nbsp;&nbsp;';
                    $paging .= '<a id='. $total_page .' class="numbertrang" href="'.Yii::app()->createUrl('tienich/somo',array('page'=>$total_page)).'">'.">>".'</a>&nbsp;&nbsp;';
                }
                if($page>=$total_page-2)
                {
                    $paging .= '<a id='. $back .' class="numbertrang" href="'.Yii::app()->createUrl('tienich/somo',array('page'=>$back)).'">'."<<".'</a>&nbsp;&nbsp;';
                    $paging .= '<a class="numbertrang" href="'.Yii::app()->createUrl('tienich/somo',array('page'=>$total_page-3)).'">'."<".'</a>&nbsp;&nbsp;';
                    for($i=$total_page-2;$i<=$total_page;$i++)
                    {
                        $paging .= '<a id='. $i .' class="numbertrang" href="'.Yii::app()->createUrl('tienich/somo',array('page'=>$i)).'">'.$i.'</a>&nbsp;&nbsp;';
                    }
                }
            }

            return $paging;
        }

        public static function pageSearch($total_page,$page,$search)
        {
            $paging = "";
            $cur_page = $page;
            $next = $cur_page+1;
            $last = $cur_page-1;
            $last1 = $total_page-3;
            $pun = "'";

            if($total_page<=3)
            {
                for($i=1;$i<=$total_page;$i++)
                {
                    $paging .= '<a id='. $i .' class="numbertrang" href="'.Yii::app()->createUrl('tienich/search',array('page'=>$i,'search'=>$search)).'">'.$i.'</a>&nbsp;&nbsp;';  
                }
            }
            else
            {
                if($cur_page<=3)
                {
                    for($i=1;$i<=3;$i++)
                    {
                        $paging .= '<a id='. $i .' class="numbertrang" href="'.Yii::app()->createUrl('tienich/search',array('page'=>$i,'search'=>$search)).'">'.$i.'</a>&nbsp;&nbsp;';   
                    }
                    $paging .= '<a id='. 4 .' class="numbertrang" href="'.Yii::app()->createUrl('tienich/search',array('page'=>4,'search'=>$search)).'">'. ">" .'</a>&nbsp;&nbsp;'; 
                    $paging .= '<a id='. $total_page .' class="numbertrang" href="'.Yii::app()->createUrl('tienich/search',array('page'=>$total_page,'search'=>$search)).'">'.">>".'</a>&nbsp;&nbsp;'; 
                }
                if($cur_page>=4 && $cur_page<$total_page-2)
                {
                    $paging .= '<a id='. 1 .' class="numbertrang" href="'.Yii::app()->createUrl('tienich/search',array('page'=>1,'search'=>$search)).'">'. "<<" .'</a>&nbsp;&nbsp;'; 
                    $paging .= '<a class="numbertrang" href="'.Yii::app()->createUrl('tienich/search',array('page'=>$last,'search'=>$search)).'">'. "<" .'</a>&nbsp;&nbsp;'; 
                    $paging .= '<a class="numbertrang" href="'.Yii::app()->createUrl('tienich/search',array('page'=>$cur_page,'search'=>$search)).'">'. $cur_page .'</a>&nbsp;&nbsp;'; 
                    $paging .= '<a class="numbertrang" href="'.Yii::app()->createUrl('tienich/search',array('page'=>$next,'search'=>$search)).'">'. ">" .'</a>&nbsp;&nbsp;'; 
                    $paging .= '<a class="numbertrang" href="'.Yii::app()->createUrl('tienich/search',array('page'=>$total_page,'search'=>$search)).'">'. ">>" .'</a>&nbsp;&nbsp;';
                }
                if($cur_page>=$total_page-2)
                {
                    $paging .= '<a id='. 1 .' class="numbertrang" href="'.Yii::app()->createUrl('tienich/search',array('page'=>1,'search'=>$search)).'">'. "<<" .'</a>&nbsp;&nbsp;'; 
                    $paging .= '<a class="numbertrang" href="'.Yii::app()->createUrl('tienich/search',array('page'=>$last1,'search'=>$search)).'">'. "<" .'</a>&nbsp;&nbsp;';
                    for($i=$total_page-2;$i<=$total_page;$i++)
                    {
                        $paging .= '<a id='. $i .' class="numbertrang" href="'.Yii::app()->createUrl('tienich/search',array('page'=>$i,'search'=>$search)).'">'.$i.'</a>&nbsp;&nbsp;'; 
                    }
                }
            }

            return $paging;
        }

    }
?>
