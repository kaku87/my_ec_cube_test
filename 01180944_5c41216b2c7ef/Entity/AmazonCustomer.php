<?php
 namespace Plugin\AmazonPayments\Entity; use Eccube\Entity\Customer; class AmazonCustomer extends \Eccube\Entity\AbstractEntity { private $customer_id; private $Customer; private $amazon_user_id; public function __construct() { } public function setCustomerId($customerId) { $this->customer_id = $customerId; } public function getCustomerId() { return $this->customer_id; } public function setCustomer(\Eccube\Entity\Customer $Customer) { $this->Customer = $Customer; return $this; } public function getCustomer() { return $this->Customer; } public function setAmazonUserId($amazonUserId) { $this->amazon_user_id = $amazonUserId; return $this; } public function getAmazonUserId() { return $this->amazon_user_id; } } 