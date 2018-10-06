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
    protected $getConfigVal;
    protected $ecomfitAPI;

    public function __construct(
        ConfigInterface $scopeConfig,
        \Magento\Framework\HTTP\Client\Curl $curl,
        \Magento\Framework\App\Config\ScopeConfigInterface $getConfig,
        \Ecomfit\Tracking\Block\Ecomfit $ecomfit

    )

    {
        $this->scopeConfig = $scopeConfig;
        $this->curlClient = $curl;
        $this->getConfigVal = $getConfig;
        $this->ecomfitAPI = $ecomfit::ECOMFIT_URL_API;
    }

    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        //Uninstall logic

        $this->curlClient->post($this->ecomfitAPI . '/magento/uninstall',
            ['webId' => $this->getConfigVal->getValue('web_id'),
                'token' => $this->getConfigVal->getValue('token')]);
        $this->scopeConfig->deleteConfig('web_id');
        $this->scopeConfig->deleteConfig('token');
    }
}