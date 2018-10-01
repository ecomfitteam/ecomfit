<?php
/**
 * Created by PhpStorm.
 * User: locpx
 * Date: 08/09/2018
 * Time: 10:31
 */

namespace Ecomfit\Tracking\Setup;


use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\App\Config\ConfigResource\ConfigInterface;

class Uninstall implements \Magento\Framework\Setup\UninstallInterface
{
    /**
     * {@inheritdoc}
     */
    protected $scopeConfig;
    protected $curlClient;

    public function __construct(
        ConfigInterface $scopeConfig,
        \Magento\Framework\HTTP\Client\Curl $curl

    )

    {
        $this->scopeConfig = $scopeConfig;
        $this->curlClient = $curl;
    }

    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        //Uninstall logic
        $this->curlClient->post('http://localhost:4201/api/magento/uninstall', ['test']);
        $this->scopeConfig->deleteConfig('web_id');
    }
}