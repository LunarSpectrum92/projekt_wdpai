<?php






Interface RepositoryInterface{

    public function getObject($id);
    public function getObjects();
    public function getObjectsById($id);

    public function deleteObject($id);
    public function createObject();
    public function changeObject($id, $text);

}