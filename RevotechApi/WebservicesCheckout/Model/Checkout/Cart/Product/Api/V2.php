<?php

class RevotechApi_WebservicesCheckout_Model_Checkout_Cart_Product_Api_V2 extends Mage_Checkout_Model_Cart_Product_Api_V2 {

    /**
     * @param  $quoteId
     * @param  $store
     * @return array
     */
    /*   public function items($quoteId, $store = null) {
      $quote = $this->_getQuote($quoteId, $store);
      if (empty($store)) {
      $store = $quote->getStoreId();
      }

      if (!$quote->getItemsCount()) {
      return array();
      }

      $productsResult = array();
      foreach ($quote->getAllItems() as $item) {
      /** @var $item Mage_Sales_Model_Quote_Item */
    /*     $product = $item->getProduct();


      // $quote = Mage::getModel('sales/quote')->load($quoteId);
      $store = Mage::getSingleton('core/store')->load($store);

      $quote = Mage::getModel('sales/quote')->setStore($store)->load($quoteId);
      $salesQuoteItem = Mage::getModel('sales/quote_item')->getCollection()
      ->setQuote($quote)
      ->addFieldToFilter('quote_id', $quoteId)
      ->addFieldToFilter('product_id', $product->getId())
      ->getFirstItem();

      $custom = Mage::getModel('catalog/product')->load($salesQuoteItem->getProductId());

      $productsResult[] = array(// Basic product data
      'product_id' => $product->getId(),
      'sku' => $product->getSku(),
      'name' => $product->getName(),
      'set' => $product->getAttributeSetId(),
      'type' => $product->getTypeId(),
      'category_ids' => $product->getCategoryIds(),
      'website_ids' => $product->getWebsiteIds(),
      'price' => $product->getPrice(),
      'short_description' => $custom->getShortDescription(),
      // 'qty'         => $salesQuoteItem->getQty(),
      'qty' => $salesQuoteItem->getQty(),
      'manage_stock' => $salesQuoteItem->getManageStock(),
      'url_path' => $custom->getImageUrl(),
      'special_price' => $product->getSpecialPrice(),
      'discount_price' => $product->getFinalPrice(),
      );
      }



      return $productsResult;
      } */
    public function items($quoteId, $store = null) {
        $quote = $this->_getQuote($quoteId, $store);
        if (empty($store)) {
            $store = $quote->getStoreId();
        }

        if (!$quote->getItemsCount()) {
            return array();
        }



        $productsResult = array();
        foreach ($quote->getAllItems() as $item) {
            /** @var $item Mage_Sales_Model_Quote_Item */
            $product = $item->getProduct();
            $salesQuoteItem = Mage::getModel('sales/quote_item')->getCollection()
                    ->setQuote($quote)
                    ->addFieldToFilter('quote_id', $quoteId)
                    ->addFieldToFilter('product_id', $product->getId())
                    ->getFirstItem();
            $custom = Mage::getModel('catalog/product')->load($salesQuoteItem->getProductId());
            $productsResult[] = array(// Basic product data
                'product_id' => $product->getId(),
                'sku' => $product->getSku(),
                'name' => $product->getName(),
                'set' => $product->getAttributeSetId(),
                'type' => $product->getTypeId(),
                'category_ids' => $product->getCategoryIds(),
                'website_ids' => $product->getWebsiteIds(),
                'price' => $product->getPrice(),
                // 'price' => number_format($product->getPrice(), 2),

                'short_description' => $custom->getShortDescription(),
                'qty' => $salesQuoteItem->getQty(),
                'manage_stock' => $salesQuoteItem->getQty() > 0 ? 1 : 0,
                'url_path' => $custom->getImageUrl(),
                //'special_price' => number_format($product->getSpecialPrice(), 2),
                'special_price' => $product->getSpecialPrice(),
                // 'discount_price' => number_format($product->getFinalPrice(), 2),
                'discount_price' => $product->getFinalPrice(),
            );
        }

        return $productsResult;
    }

}