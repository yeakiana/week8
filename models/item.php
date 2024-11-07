<?php
class items extends db
{
    public function getAllItem()
    {
        $sql = self::$connection->prepare("SELECT * FROM `items`");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getNewItem($start, $count)
    {
        $sql = self::$connection->prepare("SELECT * FROM `items` ORDER BY `created_at` DESC LIMIT ?,?");
        $sql->bind_param("ii", $start, $count);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }


    public function getFeatureItem($start, $count)
    {
        $sql = self::$connection->prepare("SELECT * FROM 'items' WHERE 'featured' = 1 ORDER BY 'created_at' DESC LIMIT ?,?");
        $sql->bind_param("ii", $start, $count);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function search($keyword, $start, $count)
    {
        $sql = self::$connection->prepare("SELECT * FROM 'item' WHERE `content` LIKE ? LIMIT ?,? ");
        $sql->bind_param("sii", $keyword, $start, $count);
        $keyword = "%$keyword%";
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function searchCount($keyword)
    {
        $sql = self::$connection->prepare("SELECT * FROM 'item' WHERE `content` LIKE ?");
        $sql->bind_param("s", $keyword);
        $keyword = "%$keyword%";
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
}
