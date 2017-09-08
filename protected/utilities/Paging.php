<?php
class Paging
{
	public static function show_paging($num_page,$page,$iSEGSIZE,$url,$url1='')
	{
		$cur_page = $page;
		$lastpage = $num_page;
		$seg_size = $iSEGSIZE;
		$alink = '';
		$seg_page = '';
		$seg_num = ceil($num_page / $seg_size);
		$seg_cur = ceil(($page+1) / $seg_size);
		//echo $seg_cur;
		$first_page = 1;
		$back_page = $page - 1;
		//so trang tren moi phan doan
		$n = ($seg_cur * $seg_size <= $lastpage)?$seg_cur * $seg_size:$lastpage;
		//in ra cac trang trong moi phan doan
		if($seg_cur ==1)
		for($p = ($seg_cur - 1) * $seg_size +1; $p <= $n; $p++) {
			$seg_page[] = $p;
		}
		else
		for($p = ($page - 4); $p <= ($page+4<=$lastpage?$page+4:$lastpage); $p++) {
			$seg_page[] = $p;
		}
		//show/hide back
		$next_page = $page + 1;
		$last_page = $lastpage;
		if($seg_cur > 1) {
			$back = $cur_page - 1;
            if(!empty($url1)){
                $alink.='<li><a href="'.$url.$back.'.html'.$url1.'"><span class="nomal">Trước</span></a></li>';   
            } else {
                $alink.='<li><a href="'.$url.$back.'.html"><span class="nomal">Trước</span></a></li>';    
            }			
		}
		else {
			$back = $cur_page - 1;
			if($back>0){
                if(!empty($url1)){
                    $alink.='<li><a href="'.$url.$back.'.html'.$url1.'"><span class="nomal">Trước</span></a></li>';
                } else {
                    $alink.='<li><a href="'.$url.$back.'.html"><span class="nomal">Trước</span></a></li>';
                }
            }				
		}

		if(count($seg_page) <= 0) return;
		if($seg_page)
		foreach($seg_page as $page) {
			if($page == $cur_page) {				
                if(!empty($url1)){
                    $alink.='<li><a href="'.$url.$page.'.html'.$url1.'" class="active">'.$page.'</a></li>';
                } else {
                    $alink.='<li><a href="'.$url.$page.'.html" class="active">'.$page.'</a></li>';
                }
			}
			else {				
                if(!empty($url1)){
                    $alink .= "<li><a href='$url$page.html".$url1."'>$page</a></li>";
                } else {
                    $alink .= "<li><a href='$url$page.html'>$page</a></li>";
                }                                    
			}
		}
		//show/hide next
		if($seg_cur <= $seg_num && $cur_page<$num_page) {
			$next = $cur_page + 1;
            if(!empty($url1)){
                $alink .= "<li><a href='$url$next.html".$url1."'><span class='nomal'>Sau</span></a></li>";
            } else {
                $alink .= "<li><a href='$url$next.html'><span class='nomal'>Sau</span></a></li>";
            }			
		}

		return $alink;
	}
    public static function show_paging_search($num_page,$page,$iSEGSIZE,$url,$url1='')
	{
		$cur_page = $page;
		$lastpage = $num_page;
		$seg_size = $iSEGSIZE;
		$alink = '';
		$seg_page = '';
		$seg_num = ceil($num_page / $seg_size);
		$seg_cur = ceil(($page+1) / $seg_size);
		//echo $seg_cur;
		$first_page = 1;
		$back_page = $page - 1;
		//so trang tren moi phan doan
		$n = ($seg_cur * $seg_size <= $lastpage)?$seg_cur * $seg_size:$lastpage;
		//in ra cac trang trong moi phan doan
		if($seg_cur ==1)
		for($p = ($seg_cur - 1) * $seg_size +1; $p <= $n; $p++) {
			$seg_page[] = $p;
		}
		else
		for($p = ($page - 4); $p <= ($page+4<=$lastpage?$page+4:$lastpage); $p++) {
			$seg_page[] = $p;
		}
		//show/hide back
		$next_page = $page + 1;
		$last_page = $lastpage;
		if($seg_cur > 1) {
			$back = $cur_page - 1;
			$alink.='<li><a href="'.$url.$back.'" class="back1"></a></li>';
		}
		else {
			$back = $cur_page - 1;
			if($back>0)
				$alink.='<li><a href="'.$url.$back.'" class="back1"></a></li>';
		}

		if(count($seg_page) <= 0) return;
		if($seg_page)
		foreach($seg_page as $page) {
			if($page == $cur_page) {
				$alink.='<li><a href="'.$url.$page.'" class="active"><span>'.$page.'</span></a></li>';
			}
			else {
				if ($url1 && $page==1)
					$alink .= "<li><a href='$url1'><span>$page</span></a></li>";
				else
					$alink .= "<li><a href='$url$page'><span>$page</span></a></li>";
			}
		}
		//show/hide next
		if($seg_cur <= $seg_num && $cur_page<$num_page) {
			$next = $cur_page + 1;
			$alink .= "<li><a class='next1' href='$url$next'></a></li>";
		}

		return $alink;
	}
    public static function show_paging_ajax($funcName,$num_page,$page,$iSEGSIZE,$url,$url1='')
    {
        $cur_page = $page;
        $lastpage = $num_page;
        $seg_size = $iSEGSIZE;
        $alink = '';
        $seg_page = '';
        $seg_num = ceil($num_page / $seg_size);
        $seg_cur = ceil(($page+1) / $seg_size);
        //echo $seg_cur;
        $first_page = 1;
        $back_page = $page - 1;
        //so trang tren moi phan doan
        $n = ($seg_cur * $seg_size <= $lastpage)?$seg_cur * $seg_size:$lastpage;
        //in ra cac trang trong moi phan doan
        if($seg_cur ==1)
        for($p = ($seg_cur - 1) * $seg_size +1; $p <= $n; $p++) {
            $seg_page[] = $p;
        }
        else
        for($p = ($page - 4); $p <= ($page+4<=$lastpage?$page+4:$lastpage); $p++) {
            $seg_page[] = $p;
        }
        //show/hide back
        $next_page = $page + 1;
        $last_page = $lastpage;
        if($seg_cur > 1) {
            $back = $cur_page - 1;
            $alink.='<li><a href="javascript:'.$funcName."(".$back.')"><span class="nomal">Trước</span></a></li>';
        }
        else {
            $back = $cur_page - 1;
            if($back>0)
                $alink.='<li><a href="javascript:'.$funcName.'('.$back.')"><span class="nomal">Trước</span></a></li>';
        }

        if(count($seg_page) <= 0) return;
        if($seg_page)
        foreach($seg_page as $page) {
            if($page == $cur_page) {
                $alink.='<li><a href="javascript:void(0)" class="active">'.$page.'</a></li>';
            }
            else {
                if ($url1 && $page==1)
                    $alink .= "<li><a href='javascript:".$funcName."(".$url1.")'>$page</a></li>";
                else
                    $alink .= "<li><a href='javascript:".$funcName."(".$page.")'>$page</a></li>";
            }
        }
        //show/hide next
        if($seg_cur <= $seg_num && $cur_page<$num_page) {
            $next = $cur_page + 1;
            $alink .= "<li><a href='javascript:".$funcName."(".$next.")'><span class=\"nomal\">Sau</span></a></li>";
        }

        return $alink;
    }
    
    public static function show_paging_cp($maxPage,$currentPage, $path = '',$object = '',$first = '',$last = '') {
        $url = new Url();        
        if($maxPage <=1){
            $html = "";return $html;
        }
        $nav = array(
            // bao nhiêu trang bên trái currentPage
            'left' => 2,
            // bao nhiêu trang bên phải currentPage
            'right' => 2,
        );

        // nếu maxPage < currentPage thì cho currentPage = maxPage
        if ($maxPage < $currentPage) {
            $currentPage = $maxPage;
        }

        // số trang hiển thị
        $max = $nav['left'] + $nav['right'];

        // phân tích cách hiển thị
        if ($max >= $maxPage) {
            $start = 1;
            $end = $maxPage;
        } elseif ($currentPage - $nav['left'] <= 0) {
            $start = 1;
            $end = $max + 1;
        } elseif (($right = $maxPage - ($currentPage + $nav['right'])) <= 0) {
            $start = $maxPage - $max;
            $end = $maxPage;
        } else {
            $start = $currentPage - $nav['left'];
            if ($start == 2) {
                $start = 1;
            }

            $end = $start + $max;
            if ($end == $maxPage - 1) {
                ++$end;
            }
        }

        $navig = '';
        if ($currentPage >= 2) {
            // thêm nút "Trước"
            $navig .= '<li><a href="' . $path . 'page'.$object.'=' . ceil($currentPage - 1) . '"><span class="nomal">Trước</span></a></li>';
            if ($currentPage >= $nav['left']) {
                if ($currentPage - $nav['left'] > 2 && $max < $maxPage) {
                    // thêm nút "1"
                    $navig .= '<li><a href="' . $path . 'page'.$object.'=1' . '">'. $first .'1'. $last .'</a></li>';
                    $navig .= '<li>...</li>';
                }
            }
        }

        for ($i = $start; $i <= $end; $i++) {
            // trang hiện tại
            if ($i == $currentPage) {
                $navig .= '<li><a href="' . $path . 'page'.$object.'=' . $i . '" class="active">'. $first . $i . $last .'</a></li>';
            }
            // trang khác
            else {
                //     $pg_link = $path.'page='.$i;
                $navig .= '<li><a href="' . $path . 'page'.$object.'=' . $i . '">'. $first . $i . $last .'</a></li>';
            }
        }

        if ($currentPage <= $maxPage - 1) {
            if ($currentPage + $nav['right'] < $maxPage - 1 && $max + 1 < $maxPage) {
                // trang cuoi
                $navig .= '<li>...</li>';
                $navig .= '<li><a href="' . $path . 'page'.$object.'=' . $maxPage . '">'. $first . $maxPage . $last .'</a></li>';
            }
            $navig .= '<li><a href="' . $path . 'page'.$object.'=' . ($currentPage + 1) . '"><span class="nomal">Sau</span></a></li>';
        }

        // hiển thị kết quả
        return $navig;
    }
    public static function show_paging_ajax_array($funcName,$variable=array(),$num_page,$page,$iSEGSIZE,$url,$url1='')
    {
        $vari = "";
        if(isset($variable)){
            foreach($variable as $var){
                $vari .= '"'.$var.'",';
            }
        }
        $vari = rtrim($vari, ",");
        $cur_page = $page;
        $lastpage = $num_page;
        $seg_size = $iSEGSIZE;
        $alink = '';
        $seg_page = '';
        $seg_num = ceil($num_page / $seg_size);
        $seg_cur = ceil(($page+1) / $seg_size);
        //echo $seg_cur;
        $first_page = 1;
        $back_page = $page - 1;
        //so trang tren moi phan doan
        $n = ($seg_cur * $seg_size <= $lastpage)?$seg_cur * $seg_size:$lastpage;
        //in ra cac trang trong moi phan doan
        if($seg_cur ==1)
        for($p = ($seg_cur - 1) * $seg_size +1; $p <= $n; $p++) {
            $seg_page[] = $p;
        }
        else
        for($p = ($page - 4); $p <= ($page+4<=$lastpage?$page+4:$lastpage); $p++) {
            $seg_page[] = $p;
        }
        //show/hide back
        $next_page = $page + 1;
        $last_page = $lastpage;
        if($seg_cur > 1) {
            $back = $cur_page - 1;            
            $alink .= "<li><a href='javascript:".$funcName."(".$vari.",".$back.")' class='back1' ><span class='nomal'>Trước</span></a></li>";
        }
        else {
            $back = $cur_page - 1;
            if($back>0)                
                $alink .= "<li><a href='javascript:".$funcName."(".$vari.",".$back.")' class='back1' ><span class='nomal'>Trước</span></a></li>";
        }

        if(count($seg_page) <= 0) return;
        if($seg_page)
        foreach($seg_page as $page) {
            if($page == $cur_page) {
                $alink.='<li><a href="javascript:void(0)" class="active"><span>'.$page.'</span></a></li>';
            }
            else {
                if ($url1 && $page==1)
                    $alink .= "<li><a href='javascript:".$funcName."(".$vari.",".$url1.")'><span>$page</span></a></li>";
                else
                    $alink .= "<li><a href='javascript:".$funcName."(".$vari.",".$page.")'><span>$page</span></a></li>";
            }
        }
        //show/hide next
        if($seg_cur <= $seg_num && $cur_page<$num_page) {
            $next = $cur_page + 1;
            $alink .= "<li><a class='next1' href='javascript:".$funcName."(".$vari.",".$next.")'><span class='nomal'>Sau</span></a></li>";
        }

        return $alink;
    }
	public function show_paging_wap($num_page,$page,$url,$url1='')
	{
		$cur_page = $page;
		$alink = '';
		if($page>1)
		{
			$back = $cur_page - 1;
			$alink.='<a href="'.$url.$back.'">« Trước</a>&nbsp;|&nbsp;';
		}
		else
		{
			$alink.='<a href="'.$url1.'">« Trước</a>&nbsp;|&nbsp;';
		}
		$alink.='<span>Trang '.$page.' trong '.$num_page.'</span>';
		
		$next = $cur_page + 1;
		if($next<$num_page)
		{
			$alink.='&nbsp;|&nbsp;<a href="'.$url.$next.'">Sau »</a>';
		}
		else
		{
			if($num_page>0)
			{
				$next=$num_page;
				$alink.='&nbsp;|&nbsp;<a href="'.$url.$next.'">Sau »</a>';
			}
		}
		return $alink;
	}
    public function show_paging_wap_user($maxPage,$currentPage, $url,$url1=''){     
            if($maxPage <=1){$html = "";return $html;}
            $nav = array('left' => 1,'right' => 1,);
            if ($maxPage < $currentPage) {
                $currentPage = $maxPage;
            }
            $max = $nav['left'] + $nav['right'];
            if ($max >= $maxPage) {
                $start = 1;$end = $maxPage;
            } elseif ($currentPage - $nav['left'] <= 0) {
                $start = 1;$end = $max + 1;
            } elseif (($right = $maxPage - ($currentPage + $nav['right'])) <= 0) {
                $start = $maxPage - $max;$end = $maxPage;
            } else {
                $start = $currentPage - $nav['left'];
                if ($start == 2) {$start = 1;}
                $end = $start + $max;
                if ($end == $maxPage - 1) {++$end;}   
            }
            $navig = '';
            if ($currentPage >= 2) {
                // thêm nút "Trước"
                $navig .= '<li class="fl"><a href="' . $url . ceil($currentPage - 1) . '">Trước</a></li>';
                if ($currentPage >= $nav['left']) {
                    if ($currentPage - $nav['left'] > 2 && $max < $maxPage) {
                        // thêm nút "1"
                        $navig .= '<li class="fl"><a href="' . $url.'1' . '">1</a></li>';
                        $navig .= '<li class="fl"><a href="#"><strong>...</strong></a></li>';
                    }
                }
            }
            for ($i = $start; $i <= $end; $i++) {
                // trang hiện tại
                if ($i == $currentPage) {
                    $navig .= '<li class="fl active"><a href="' . $url . $i . '" >'. $i .'</a></li>';
                }
                // trang khác
                else {
                    //     $pg_link = $path.'page='.$i;
                    $navig .= '<li class="fl"><a href="' . $url . $i . '">'. $i .'</a></li>';
                }
            }

            if ($currentPage <= $maxPage - 1) {
                if ($currentPage + $nav['right'] < $maxPage - 1 && $max + 1 < $maxPage) {
                    // trang cuoi
                    $navig .= '<li class="fl"><a href="#"><strong>...</strong></a></li>';
                    $navig .= '<li class="fl"><a href="' . $url . $maxPage . '">'. $maxPage .'</a></li>';
                }
                $navig .= '<li class="fl end"><a href="' . $url . ($currentPage + 1) . '">Sau</a></li>';
            }

            // hiển thị kết quả
            return $navig;
        }
}
?>
