<?php






Interface RepositoryInterface{

    public function getObject($id);
    public function getObjects();
    public function getObjectsById($id);

    public function deleteObject($id);
    public function createObject($id, $id1);
    public function changeObject($id, $text);

}