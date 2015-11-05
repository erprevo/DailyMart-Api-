<?php

class RevotechApi_WebservicesCatalog_Model_Catalog_Product_Link_Api_V2 extends Mage_Catalog_Model_Product_Link_Api_V2 {

    public function items($type, $productId, $identifierType = null) {
        $typeId = $this->_getTypeId($type);

        $product = $this->_initProduct($productId, $identifierType);

        $link = $product->getLinkInstance()
                ->setLinkTypeId($typeId);

        // $collection = $this->_initCollection($link, $product);
        $collection = $this->_initCollection($link, $product)
                // ->addAttributeToSelect(array('name', 'price','short_description','description', 'image', 'special_price'))
                ->addAttributeToSelect('*')
                ->joinField('qty', 'cataloginventory/stock_item', 'qty', 'product_id=entity_id', '{{table}}.stock_id=1', 'left')
                ->joinField('is_in_stock', 'cataloginventory/stock_item', 'is_in_stock', 'product_id=entity_id', null, '{{table}}.stock_id=1', 'left')
                ->joinField('manage_stock', 'cataloginventory/stock_item', 'manage_stock', 'product_id=entity_id', null, 'left');
        //var_dump($collection);
        // exit();
        $result = array();

        foreach ($collection as $linkedProduct) {
            if ($linkedProduct->getQty() > 0 && $linkedProduct->getIsInStock() == 1) {
                $row = array(
                    'product_id' => $linkedProduct->getId(),
                    'type' => $linkedProduct->getTypeId(),
                    'set' => $linkedProduct->getAttributeSetId(),
                    'sku' => $linkedProduct->getSku(),
                    'name' => $linkedProduct->getName(),
                    'category_ids' => $linkedProduct->getCategoryIds(),
                    'website_ids' => $linkedProduct->getWebsiteIds(),
                    //'price' => $linkedProduct->getPrice(),
                     'price' => number_format($linkedProduct->getPrice(),2),
                    'qty' => $linkedProduct->getQty(),
                    // 'manage_stock' => $linkedProduct->getManageStock(),
                    'manage_stock' => $linkedProduct->getIsInStock(),
                    'short_description' => $linkedProduct->getShortDescription(),
                    'url_path' => $linkedProduct->getImageUrl(),
                    'special_price' => number_format($linkedProduct->getSpecialPrice(),2),
                    'discount_price' => number_format($linkedProduct->getFinalPrice(),2),
                );
                foreach ($link->getAttributes() as $attribute) {
                    $row[$attribute['code']] = $linkedProduct->getData($attribute['code']);
                }
                $result[] = $row;
            }
        }

        return $result;
    }

}