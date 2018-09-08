<?php

namespace Ecomfit\Tracking\Controller\Adminhtml\Manager;


use Magento\Framework\App\Config\ScopeConfigInterface;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    protected $configWriter;
    protected $scopeConfig;
    protected $cache;
    protected $_coreSession;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\App\Config\Storage\WriterInterface $configWriter
     * @param \Magento\Framework\Session\SessionManagerInterface $coreSession
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        ScopeConfigInterface $scopeConfig,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\App\Config\Storage\WriterInterface $configWriter
    )
    {
        $this->configWriter = $configWriter;
        $this->scopeConfig = $scopeConfig;
        $this->resultPageFactory = $resultPageFactory;

//        $this->cache = $cache;
        parent::__construct($context);
    }

    /**
     * Load the page defined in view/adminhtml/layout/exampleadminnewpage_helloworld_index.xml
     *
     */
//    public function setValue()
//    {
//        $this->_coreSession->start();
//        $this->_coreSession->setName('success');
//    }
//
//    public function getValueSession()
//    {
//        $this->_coreSession->start();
//        return $this->_coreSession->getName();
//    }
//
//    public function unSetValue()
//    {
//        $this->_coreSession->start();
//        return $this->_coreSession->clearStorage();
//    }

    public function execute()
    {
//        echo $this->scopeConfig->getValue('web_id', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);die;
        $post = $this->getRequest()->getPostValue();
        if ($post) {
            $_SESSION['webId'] = $post['webId'];
            $this->configWriter->save('web_id', $post['webId'], $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);
            echo "<pre>";
            print_r($post);
            die;
        }
        return $resultPage = $this->resultPageFactory->create();
    }
//    private function cleanMageCache(){
//        return $this->cache->clean(\Zend_Cache::CLEANING_MODE_ALL, array('FPC'));
//    }
}
