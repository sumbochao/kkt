<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="noindex,nofollow" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params["static_url"];?>css/style.css" media="all" />
        <title><?php echo $album["title"];?></title>
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <div class="main clearfix">
                    <div class="album-pic pad10">
                        <h2 class="clorage">
                            <strong><?php echo $album["title"];?></strong>
                            <?php if($album["isHot"]==1){ ?>
                            &nbsp;<img alt="icon hot" src="<?php echo Yii::app()->params["static_url"];?>images/icon_hot.gif">
                            <?php } ?>
                        </h2>
                        <span><?php echo $album["introtext"];?></span>
                        
                        <?php if(!empty($image)) { ?>
                        <div class="list_item pad10">
                            <div class="table pad_btt0">
                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                        <?php foreach($image as $row):?>
                                        <tr>
                                            <td width="50%">
                                                <a href="<?php echo Url::createUrl("kktDownload/image", array("id"=>Common::encodeHex($row["id"]), "dataId"=>Common::encodeHex($dataDownloadId)));?>" title="pic">
                                                    <img src="<?php echo Common::getImage($row["file"], "image", $row["create_date"]);?>" width="100%">
                                                </a>
                                            </td>
                                            <td class="item_data">
                                                <a class="download clorage" href="<?php echo Url::createUrl("kktDownload/image", array("id"=>Common::encodeHex($row["id"]), "dataId"=>Common::encodeHex($dataDownloadId)));?>">Download</a>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                        <?php } ?>                   
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
