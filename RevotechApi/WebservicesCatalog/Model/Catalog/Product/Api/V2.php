<?php

class RevotechApi_WebservicesCatalog_Model_Catalog_Product_Api_V2 extends Mage_Catalog_Model_Product_Api_V2 {

public function getallkmh()
{
//fdksljfkds
}
    public function items($filters = null, $store = null) {
        $collection = Mage::getModel('catalog/product')->getCollection()
                ->addStoreFilter($this->_getStoreId($store))

                //    ->addAttributeToSelect(array('name', 'price', 'short_description', 'description', 'image', 'special_price'))
                ->addAttributeToSelect('*')
                ->joinField('qty', 'cataloginventory/stock_item', 'qty', 'product_id=entity_id', '{{table}}.stock_id=1', 'left')
                ->joinField('is_in_stock','cataloginventory/stock_item','is_in_stock','product_id=entity_id',null,'{{table}}.stock_id=1','left')

                ->joinField('manage_stock', 'cataloginventory/stock_item', 'manage_stock', 'product_id=entity_id', null, 'left');






        /** @var $apiHelper Mage_Api_Helper_Data */
        $apiHelper = Mage::helper('api');
        $filters = $apiHelper->parseFilters($filters, $this->_filtersMap);
        try {
            foreach ($filters as $field => $value) {
                $collection->addFieldToFilter($field, $value);
            }
        } catch (Mage_Core_Exception $e) {
            $this->_fault('filters_invalid', $e->getMessage());
        }
        $result = array();

        $resultImage = array();

        foreach ($collection as $product) {
            // $productQty = Mage::getModel('catalog/product')->load($product->getId());//product id here
            //$productQty = Mage::getModel('catalog/product')->loadByAttribute('sku', $product->getSku());
            $productQty = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product);


            /* foreach ($product->getMediaGalleryImages() as $image) {
              $resultImage= $image->getUrl();
              } */
         /*   $result[] = array(
                'product_id' => $product->getId(),
                'sku' => $product->getSku(),
                'name' => $product->getName(),
                'set' => $product->getAttributeSetId(),
                'type' => $product->getTypeId(),
                'category_ids' => $product->getCategoryIds(),
                'website_ids' => $product->getWebsiteIds(),
                'price' => $product->getPrice(),
                'qty' => $productQty->getQty(),
                // 'qtyMin' => $stock->getMinQty(),
                //  'qtyMinSale' => $stock->getMinSaleQty(),
                //   'qty' =>'need to fill',
                //  'manage_stock' => $product->getManageStock(),
                'manage_stock' => $productQty->getQty() > 0 ? 1 : 0,
                'short_description' => $product->getShortDescription(),
                'url_path' => $product->getImageUrl(),
                // 'special_price' => $product->getFinalPrice(),
                'special_price' => $product->getSpecialPrice(),
                // 'discount_price' => $product->getFinalPrice(),

                'discount_price' => $product->getFinalPrice()
            ); */

            if($productQty->getQty()>0 && $product->getIsInStock()==1)
            {
                    $result[] = array(
                'product_id' => $product->getId(),
                'sku' => $product->getSku(),
                'name' => $product->getName(),
                'set' => $product->getAttributeSetId(),
                'type' => $product->getTypeId(),
                'category_ids' => $product->getCategoryIds(),
                'website_ids' => $product->getWebsiteIds(),
                'price' => $product->getPrice(),
              // 'price' => number_format($product->getPrice(),2),
                'qty' => $productQty->getQty(),
                // 'qtyMin' => $stock->getMinQty(),
                //  'qtyMinSale' => $stock->getMinSaleQty(),
                //   'qty' =>'need to fill',
                 'manage_stock' => $product->getIsInStock(),
               // 'manage_stock' => $productQty->getQty() > 0 ? 1 : 0,
                'short_description' => $product->getShortDescription(),
                'url_path' => $product->getImageUrl(),
                 'special_price' => $product->getFinalPrice(),
               // 'special_price' => number_format($product->getSpecialPrice(),2),
                 'discount_price' => $product->getFinalPrice(),

                //'discount_price' =>number_format( $product->getFinalPrice(),2)
            );

            }



        }
        //error_log(print_r($result, true) . "\n", 3, "c:\log.txt");
        return $result;
    }

}
