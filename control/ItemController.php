<?php
require_once  "model/Item.php";

class ItemController {
/**
 * 
 */
    private $twig;
    private  Item $item;
    
    /**
     * __construct
     * set the properties of Class Item into construct
     * @return void
     */
    public function __construct() {

        $this->item = new Item;
        
        $this->item->setIdPue($_GET["idPue"] ?? 0 );
        $this->item->setIdIte($_GET["idIte"] ?? 0 ); 
        $this->item->setItem($_POST["item"] ?? 0 );
        $this->item->setStock($_POST["stock"] ?? 0 );

        require_once 'vendor/autoload.php';

        $loader = new \Twig\Loader\FilesystemLoader('./view');
        $this->twig = new \Twig\Environment($loader);
    }
    
    /**
     * selectID
     *  select items and show view
     * @return void
     */
    public function selectID() {

        echo $this->twig->render("mostrarItems.php.twig",

        [
            "titulo" => "Item List",
            "infoItem" => $this->item->selectId() 
        ]);

        
    } 
    /**
     * selectID
     *  remove item and call selectID method to show the view 
     * @return void
     */
    public function remove() {
        $removeReturnId =$this->item->removeItem();
        $idReturn = $removeReturnId[0]->getIdPue();
        $this->selectID($this->item->getIdPue());
    }    
    /**
     * showForm
     * show the same view but different structure, if idPue is not set, the script call to method to show items 
     * properties into  form inputs  
     * @return void
     */
    public function showForm() {
        if($this->item->getIdPue() != 0): echo $this->twig->render("formItems.php.twig",
        [
            "titulo" => "Create Item ",
            "infoIdItem" => $this->item->selectId() 
        ]);
        else: echo $this->twig->render("formItems.php.twig",
        [
            "titulo" => "Update Item",
            "infoItem" => $this->item->selectId(2) 
        ]);
        endif;
    }    
    /**
     * update
     *  update items and show the view of items by selectID method
     * @return void
     */
    public function update() {
        $updateReturnId = $this->item->updateItem();
        $idReturn = $updateReturnId[0]->getIdPue();
        $this->selectID();

    }
    
    /**
     * create
     *  create item and show item list view
     * @return void
     */
    public function create() {
        $this->item->createItem();
        $idReturn = $this->item->getIdPue();
        $this->selectID();
    }



}