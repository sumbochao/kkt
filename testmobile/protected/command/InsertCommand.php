<?php
public class InsertCommand extends CConsoleCommand
{
	public function run($ketqua)
	{
		$file=file_get_contents("http://ketquaveso.com/");
		$subject=$file;
		$pattern = '/\<strong\sclass="s16"\>[\d]+\<\/strong\>/';
		preg_match_all($pattern, $subject, $subpatterns);
		$subpatterns=$subpatterns[0];
		$sub[]=array(27);
	
		for($i=0;$i<count($subpatterns);$i++)
		{
			$sub[$i]=$subpatterns[$i];
			$sub[$i]=str_replace("<strong class=\"s16\">","",$sub[$i]);
			$sub[$i]=str_replace("</strong>","",$sub[$i]);
				
		}
		$pattern1 = '/\<strong\>[\d]+\<\/strong\>/';
		preg_match_all($pattern1, $subject, $subpatterns1);

		$sub[$i]=$subpatterns1[0][0];
		
		$sub[$i]=str_replace("<strong>","",$sub[$i]);
		$sub[$i]=str_replace("</strong>","",$sub[$i]);
		
		$row=Model::insertResult($sub);	
	}
}
?>