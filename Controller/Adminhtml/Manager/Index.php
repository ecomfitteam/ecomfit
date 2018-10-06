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
    protected $ecomfit;
    protected $curlClient;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\App\Config\Storage\WriterInterface $configWriter
     * @param \Ecomfit\Tracking\Block\Ecomfit $ecomfit
     * @param \Magento\Framework\HTTP\Client\Curl $curl
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        ScopeConfigInterface $scopeConfig,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\App\Config\Storage\WriterInterface $configWriter,
        \Ecomfit\Tracking\Block\Ecomfit $ecomfit,
        \Magento\Framework\HTTP\Client\Curl $curl

    )
    {
        $this->configWriter = $configWriter;
        $this->scopeConfig = $scopeConfig;
        $this->resultPageFactory = $resultPageFactory;
        $this->ecomfit = $ecomfit;
        $this->curlClient = $curl;

//        $this->cache = $cache;
        parent::__construct($context);
    }

    /**
     * Load the page defined in view/adminhtml/layout/exampleadminnewpage_helloworld_index.xml
     *
     */
    public function execute()
    {
        $this->curlClient->post('http://localhost:4201/api/magento/uninstall',
            ['webId' => $this->scopeConfig->getValue('web_id'),
                'token' => $this->scopeConfig->getValue('token')]);
        $post = $this->getRequest()->getPostValue();
        if ($post) {
            $this->ecomfit->setValue($post['webId']);
            $this->configWriter->save('web_id', $post['webId'], $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);
            $this->configWriter->save('token', $post['token'], $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);

            print_r($post);
//            return true;
        }

        return $resultPage = $this->resultPageFactory->create();
    }
}
