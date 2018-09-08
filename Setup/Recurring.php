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

class Recurring implements \Magento\Framework\Setup\InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        //Recurring schema event logic
    }
}