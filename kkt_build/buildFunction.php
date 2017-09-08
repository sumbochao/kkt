<?php
  function deleteDirectory($dir) {
    if (!file_exists($dir)) return true;
    if (!is_dir($dir) || is_link($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!deleteDirectory($dir . "/" . $item)) {
                chmod($dir . "/" . $item, 0777);
                if (!deleteDirectory($dir . "/" . $item)) return false;
            };
        }
        return rmdir($dir);
    } 
    
   function createFileRefcode($fileRefcode,$refcode)
   {
         //$myFile = "refcode.txt";
         $fh = fopen($fileRefcode, 'w') or die("can't open file");
         $stringData = $refcode."\n";
         fwrite($fh, $stringData);
         fclose($fh);
   }
   
   function extractRefcode($fileZip,$fileExtract,$extractTo){
        $zip = new ZipArchive;
        $res = $zip->open($fileZip);
        if ($res === TRUE) {
            $zip->extractTo($extractTo, array($fileExtract));
            $zip->close();
        } else {
        }
   }

   function addFileRefcode($fileIpa,$fileRefcode,$fileRefcodeDes){
            $zip = new ZipArchive;
            if ($zip->open($fileIpa) === TRUE) {
                $zip->addFile($fileRefcode, $fileRefcodeDes);
                $zip->close();
            } else {
            }
   }        
           
  function extractFileZip($fileZip,$extractTo){
    $zip = new ZipArchive;
    if ($zip->open($fileZip) === true) {
        for($i = 0; $i < $zip->numFiles; $i++) {
            $zip->extractTo($extractTo, array($zip->getNameIndex($i)));
        }
        $zip->close();
    }
  }

   function downloadFile($path){
        if(file_exists($path) && is_readable($path) && file_exists($path)){
             header("Content-Disposition: attachment; filename=".basename(str_replace(' ', '_', $path)));
             header("Content-Type: application/force-download");
             header("Content-Type: application/octet-stream");
             header("Content-Type: application/download");
             header("Content-Description: File Transfer");
             header("Content-Length: " . filesize($path));
             flush(); // this doesn't really matter.

             $fp = fopen($path, "r");
             while (!feof($fp))
             {
                 echo fread($fp, 65536);
                 flush(); // this is essential for large downloads
             }
             fclose($fp);
         exit;
    } 
   } 

	 function downloadFile2($url_file,$fileName,$fileExtension){
           header("Pragma: public");
            if($fileExtension=="jad"){
                header("Content-type: text/vnd.sun.j2me.app-descriptor");    
            } else if($fileExtension=="jar"){
                header("Content-type: application/java-archive;");    
            } else if($fileExtension=="apk"){
                header("Content-type: application/vnd.android.package-archive");        
            }

            header('Content-Disposition: attachment; filename="' . $fileName . "." . $fileExtension . '"');                
            ob_clean();
            flush();
            $content = Common::cUrl($url_file);
            echo $content;

            exit();
   }  
  
?>
