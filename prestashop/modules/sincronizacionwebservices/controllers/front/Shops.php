<?php

require_once _PS_MODULE_DIR_ . 'rvproductstab/rvproductstab.php';
        
class sincronizacionwebservicesShopsModuleFrontController extends ModuleFrontController {

    public $log = null;

    public function initContent() {
    	parent::initContent();


        $id_shop = Tools::getValue('id_shop');
        if (!$id_shop){
            $shops = $this->getShopsFull();
        } else {
            $shops = $this->getShopsFull($id_shop);
        }
        

        echo json_encode($shops);

    	exit;
    	$this->setTemplate('productos.tpl');
    }

    public function getShopsFull($id_shop=false) {
        //15 payment payphone
        $cadena = "
        SELECT ps.id_shop, ps.name, psu.domain, psu.domain_ssl, psu.virtual_uri, psl.address1, psl.hours, pst.city, pst.postcode, pst.latitude, pst.longitude, pst.phone, pst.email
        FROM `ps_shop` as ps
        INNER JOIN `ps_shop_url` as psu
        ON ps.`id_shop` = psu.`id_shop`
        INNER JOIN `ps_store_shop` as pss
        ON ps.`id_shop` = pss.`id_shop`
        INNER JOIN `ps_store_lang` as psl
        ON pss.`id_store` = psl.`id_store`
        INNER JOIN `ps_store` as pst
        ON psl.`id_store` = pst.`id_store`
        WHERE ps.`active` = 1 AND pst.`active`=1";

        if ($id_shop) {
            $cadena = $cadena . " AND ps.id_shop = " . $id_shop;
        }

        $shops = Db::getInstance()->executeS($cadena) ;

        return $shops;
    }


}

