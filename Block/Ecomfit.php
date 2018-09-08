<?php

namespace Ecomfit\Tracking\Block;


use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\Cache\Frontend\Pool;

class Ecomfit extends \Magento\Framework\View\Element\Template
{
    /**
     * @return $this
     */
    protected $scopeConfig;
    protected $authSession;
    protected $_cacheFrontendPool;
    protected $_cacheTypeList;
    protected $_coreSession;

    const ECOMFIT_WEBSITE = "https://ecomfit.com/";
    const ECOMFIT_URL = "https://app-test.ecomfit.com/";

    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function __construct(Context $context,
                                ScopeConfigInterface $scopeConfig,
                                \Magento\Backend\Model\Auth\Session $authSession,
                                Pool $cacheFrontendPool,
                                \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
    )

    {
        $this->scopeConfig = $scopeConfig;
        $this->authSession = $authSession;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        $this->_cacheTypeList = $cacheTypeList;
        parent::__construct($context);
    }


    public function getWebId()
    {
        $types = array('config', 'layout', 'block_html', 'collections');
        foreach ($types as $type) {
            $this->_cacheTypeList->cleanType($type);
        }
        foreach ($this->_cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
        return $this->scopeConfig->getValue('web_id', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getCurrentUser()
    {
        $types = array('config', 'layout', 'block_html', 'collections');
        foreach ($types as $type) {
            $this->_cacheTypeList->cleanType($type);
        }
        foreach ($this->_cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
        return $this->authSession->getUser();
    }

    public function checkSession()
    {
        if (isset($_SESSION['webId'])) {
            return true;
        } else {
            return false;
        }
    }
}
