<?php

$installer = $this;

/* @var $installer Mage_Core_Model_Resource_Setup */
/* $installer Mage_Catalog_Model_Resource_Eav_Mysql4_Setup */

$installer->startSetup();

$row = Mage::getSingleton('core/resource')->getConnection('core_read')->addColumn(Mage::getSingleton('core/resource')->getTableName('sales/order'), 'survey', 'TEXT NULL');

$attribute  = array(
  'type'          => 'static',
  'label'         => 'Survey',
  'visible'       => false,
  'required'      => true,
  'user_defined'  => false,
  'searchable'    => false,
  'filterable'    => false,
  'comparable'    => false,
);

$installer->addAttribute('order', 'survey', $attribute);

$installer->endSetup();
