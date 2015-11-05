<?php

class RevotechApi_WebservicesCatalog_Model_Category_Api_V2 extends Mage_Catalog_Model_Category_Api_V2 {

    /**
     * Retrieve list of assigned products to category
     *
     * @param int $categoryId
     * @param string|int $store
     * @return array
     */
    public function assignedProducts($categoryId, $store = null) {
        // $category = $this->_initCategory($categoryId);
        $category = $this->_initCategory($categoryId, $store);

        $storeId = $this->_getStoreId($store);
        $collection = $category->setStoreId($storeId)
                // $collection = $category->setStoreId('4')
                ->getProductCollection()
                // ->addAttributeToSelect(array('name', 'price','tier_price','short_description','description', 'image', 'special_price', 'special_from_date', 'special_to_date'))
                ->addAttributeToSelect('*')
                ->joinField('qty', 'cataloginventory/stock_item', 'qty', 'product_id=entity_id', '{{table}}.stock_id=1', 'left')
                ->joinField('is_in_stock', 'cataloginventory/stock_item', 'is_in_stock', 'product_id=entity_id', null, '{{table}}.stock_id=1', 'left')
                ->joinField('manage_stock', 'cataloginventory/stock_item', 'manage_stock', 'product_id=entity_id', null, 'left');


        ($storeId == 0) ? $collection->addOrder('position', 'asc') : $collection->setOrder('position', 'asc');


        $result = array();

        foreach ($collection as $product) {
            if ($product->getQty() > 0 && $product->getIsInStock() == 1) {



                $result[] = array(
                    'product_id' => $product->getId(),
                    'type' => $product->getTypeId(),
                    'set' => $product->getAttributeSetId(),
                    'sku' => $product->getSku(),
                    'position' => $product->getCatIndexPosition(),
                    //  'position'=> $product->getIsInStock(),
                    'category_ids' => $product->getCategoryIds(),
                    'website_ids' => $product->getWebsiteIds(),
                    'dis_message' => $product->getData('new'),
                   'price' => $product->getPrice(),
                //    'price' => number_format($product->getPrice(),2),
                    //  'price' => $product->getAttributeText('139') ,
                    'tier_price' => $product->getTierPrice(),
                   // 'special_price' => number_format($product->getSpecialPrice(),2),
                     'special_price' => $product->getSpecialPrice(),
                    'special_from_date' => $product->getSpecialFromDate(),
                    'special_to_date' => $product->getSpecialToDate(),
                    'description' => $product->getDescription(),
                    'short_description' => $product->getShortDescription(),
                    'name' => $product->getName(),
                    'qty' => $product->getQty(),
                    'url_path' => $product->getImageUrl(),
                    // 'manage_stock' => $product->getIsInStock(),
                   // 'discount_price' => number_format($product->getFinalPrice(),2)
                      'discount_price' => $product->getFinalPrice()
                );
            }
        }

        return $result;
    }

}