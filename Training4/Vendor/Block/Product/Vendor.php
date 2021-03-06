<?php
namespace Training4\Vendor\Block\Product;


use Magento\Framework\View\Element\Template;

/**
 * Class Vendor
 *
 * @package Training4\Vendor\Block\Product
 */
class Vendor extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Training4\Vendor\Model\VendorRepositoryFactory
     */
    protected $_repositoryFactory;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $_searchCriteriaBuilder;

    /**
     * @var \Magento\Framework\Api\FilterBuilder
     */
    protected $_filterBuilder;

    /**
     * @var
     */
    protected $_coreRegistry;

    /**
     * @param Template\Context $context
     * @param array $data
     * @param \Training4\Vendor\Model\VendorRepositoryFactory $repository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param \Magento\Framework\Api\FilterBuilder $filterBuilder
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        Template\Context $context,
        array $data = [],
        \Training4\Vendor\Model\VendorRepositoryFactory $repository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Framework\Registry $coreRegistry
    ) {
        parent::__construct($context, $data);
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_repositoryFactory = $repository;
        $this->_filterBuilder = $filterBuilder;
        $this->_coreRegistry = $coreRegistry;
    }

    /**
     * @return mixed
     */
    public function getProductVendors()
    {
        $vendors = [];
        /** @var \Magento\Catalog\Model\Product $product */
        $product = $this->_coreRegistry->registry('current_product');

        if ($product && $product->getId()) {
            $productId = $product->getId();
            /** @var \Training4\Vendor\Model\VendorRepository $repository */
            $repository = $this->_repositoryFactory
                ->create();
            // Add product id filter
            $filters[] = $this->_filterBuilder
                ->setField('product_id')
                ->setConditionType('eq')
                ->setValue($productId)
                ->create();
            //Set filter to search criteria
            $searchCriteria = $this->_searchCriteriaBuilder
                ->addFilters($filters)
                ->create();
            //Pass order criteria with filters to the repository
            $vendors = $repository->getList($searchCriteria)->getItems();
        }
        return $vendors;
    }
}
