<?php
 namespace Plugin\AmazonPayments\Repository; use Doctrine\ORM\EntityRepository; class AmazonOrderRepository extends EntityRepository { public $config; protected $app; public function setApplication($app) { $this->app = $app; } public function setConfig(array $config) { $this->config = $config; } public function getAmazonOrderByOrderDataForAdmin($Orders) { $AmazonOrders = array(); foreach ($Orders as $Order) { $AmazonOrder = $this->findby(array('Order' => $Order)); if (!empty($AmazonOrder)) { $AmazonOrders[] = $AmazonOrder[0]; } } return $AmazonOrders; } } 