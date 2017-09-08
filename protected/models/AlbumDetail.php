<?php
class AlbumDetail extends CActiveRecord
{
    public function getAlbum($id)
    {
        $sql = "SELECT title, isHot, introtext FROM c_album WHERE id=" . $id;
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();
        return $rows;
    }
    
    public function getAllImageInAlbum($albumId)
    {
        $sql = "SELECT id, file, create_date FROM c_image WHERE albumId=" . $albumId;
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        return $rows;    
    }
}
?>
