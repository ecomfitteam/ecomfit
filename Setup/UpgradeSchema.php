<?php
/**
 * Created by PhpStorm.
 * User: locpx
 * Date: 08/09/2018
 * Time: 10:26
 */

namespace Ecomfit\Tracking\Setup;


use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        //Upgrade schema logic
    }
}