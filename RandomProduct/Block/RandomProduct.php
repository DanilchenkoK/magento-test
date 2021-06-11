<?php
declare(strict_types=1);

namespace Kirill\RandomProduct\Block;


class RandomProduct extends \Magento\Framework\View\Element\Template
{
    protected $_imageHelper;
    protected $_productCollectionFactory;

    public function __construct( 
        \Magento\Catalog\Helper\Image $imageHelper,
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,        
        array $data = []
    )
    {    
        $this->_imageHelper = $imageHelper;
        $this->_productCollectionFactory = $productCollectionFactory;    
        parent::__construct($context, $data);
    }
    
    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setPageSize(3);  
        $collection->getSelect()->orderRand(); 
        $collection->setVisibility([\Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH]);    
        
        return $collection;
    } 
   
    public function getImageUrl($product)
    {
        return $this->_imageHelper->init($product, 'product_thumbnail_image')->getUrl();
    }   
}