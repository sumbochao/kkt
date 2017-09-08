<?php
class KktAlbumDetailController extends Controller
{
    public $layout = false;
    public function actionIndex()
    {
        $albumId = isset($_GET["id"]) ? Common::decodeHex($_GET["id"]) : "";
        $dataDownloadId = isset($_GET["dataId"]) ? Common::decodeHex($_GET["dataId"]) : "";
        if(empty($albumId) || empty($dataDownloadId)){
            throw new CHttpException(404, "Trang yêu cầu không tồn tại");
        }
        
        /* Lấy thông tin album */
        $album = AlbumDetail::getAlbum($albumId);
        if(empty($album)){
            throw new CHttpException(404, "Trang yêu cầu không tồn tại");
        }
        
        /* Lấy tất cả ảnh trong album */
        $image = AlbumDetail::getAllImageInAlbum($albumId);
        
        $this->render(
            "index"
            , array(
                "album"=>$album
                , "image"=>$image
                , "dataDownloadId"=>$dataDownloadId
            )
        );
    }    
}  
?>