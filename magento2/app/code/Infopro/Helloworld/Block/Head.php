<?php
namespace Infopro\Helloworld\Block;
class Head extends \Magento\Framework\View\Element\Template{
	public $assetRepository;
    public function __construct(
    	 \Magento\Framework\View\Element\Template\Context $context, 
        array $data = [],    
        \Magento\Framework\View\Asset\Repository $assetRepository
    )
    {
        $this->assetRepository = $assetRepository;
        return parent::__construct($context, $data);
    }
}