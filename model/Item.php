<?php
require "libs/Database.php";

/**
 * Item
 */
class Item
{
    private int $idIte;
    private int $idPue;
    private string $item;
    private $stock;
    private string $alta;

    /**
     * Get the value of idIte
     */
    public function getIdIte()
    {
        return $this->idIte;
    }

    /**
     * Set the value of idIte
     *
     * @return  self
     */
    public function setIdIte($idIte)
    {
        $this->idIte = $idIte;

        return $this;
    }

    /**
     * Get the value of idPue
     */
    public function getIdPue()
    {
        return $this->idPue;
    }

    /**
     * Set the value of idPue
     *
     * @return  self
     */
    public function setIdPue($idPue)
    {
        $this->idPue = $idPue;

        return $this;
    }

    /**
     * Get the value of item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set the value of item
     *
     * @return  self
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get the value of stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get the value of alta
     */
    public function getAlta()
    {
        return $this->alta;
    }

    /**
     * Set the value of alta
     *
     * @return  self
     */
    public function setAlta($alta)
    {
        $this->alta = $alta;

        return $this;
    }

    /**
     * selectId
     *  query to items by id, the results depends of operation called $op
     * op 1 using idPue, if it is different, the operation using idIte
     *
     * @param  int $id
     * @param  int $op
     * @return array|int
     */
    public function selectId(int $op = 1)
    {

        $db = Database::getInstance();
        if ($op == 1): $db->query("select * from items where idPue=$this->idPue");
        else:$db->query("select * from items where idIte=$this->idIte");
        endif;
        $data = [];
        while ($rows = $db->getRow("Item")) {
            array_push($data, $rows);

        }
        if (empty($data)): return $this->idPue;
        endif;

        return $data;

    }

    /**
     * removeItem
     *remove a row of item using id item
     *
     * @return array
     */
    public function removeItem(): array
    {

        $db = Database::getInstance();
        $db->query("delete from items where idIte=$this->idIte");
        return $this->selectId();
    }

    /**
     * updateItem
     * update item using idIte, and after  catch and return data items usint idPue like  entry parameter  ;
     *
     * @return array
     */
    public function updateItem(): array
    {

        $db = Database::getInstance();
        $db->query("update  items set item='$this->item', stock = $this->stock  where idIte=$this->idIte ");
        return $this->selectId(2);
    }

    /**
     * createItem
     * create  item  and set current date with a var called alta
     *
     * @return void
     */
    public function createItem()
    {

        $db = Database::getInstance();
        $alta = date("Y-m-d");
        $db->query("insert into items (idPue, item, stock, alta) values($this->idPue, '$this->item', $this->stock, '$alta'  ) ");
    }
}
