<?php

namespace W4PLEGO\Base\Service;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Session as CatalogSession;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 *  CurrentProductDataProvider
 */
class GetCurrentProductService
{
    /**
     * Current Product
     *
     * @var ProductInterface
     */
    private $currentProduct;

    /**
     * Current Product ID
     *
     * @var int|null
     */
    private $productId;

    /**
     * @var CatalogSession
     */
    private $catalogSession;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @param CatalogSession $catalogSession
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        CatalogSession $catalogSession,
        ProductRepositoryInterface $productRepository
    ) {
        $this->catalogSession = $catalogSession;
        $this->productRepository = $productRepository;
    }

    /**
     * @return int|null
     */
    public function getProductId()
    {
        if (!$this->productId) {
            $productId = $this->catalogSession->getData('last_viewed_product_id');
            $this->productId = $productId ? (int)$productId : null;
        }

        return $this->productId;
    }

    /**
     * @return ProductInterface|null
     */
    public function getProduct()
    {
        if (!$this->currentProduct) {
            $productId = $this->getProductId();

            if (!$productId) {
                return null;
            }

            try {
                $this->currentProduct = $this->productRepository->getById($this->getProductId());
            } catch (NoSuchEntityException $e) {
                return null;
            }
        }

        return $this->currentProduct;
    }
}
