<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Plugin;

use Inviqa\Zed\SprykerDebug\Business\Model\Inspector\Report;
use Inviqa\Zed\SprykerDebug\Communication\Model\Cast;
use Orm\Zed\Product\Persistence\SpyProduct;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class ProductEntityReportPlugin extends AbstractPlugin implements Report
{
    public function accepts(object $entity): bool
    {
        return $entity instanceof SpyProduct;
    }

    public function render(object $entity): string
    {
        assert($entity instanceof SpyProduct);
        return implode(PHP_EOL, [
            sprintf('id: %s', $entity->getIdProduct()),
            sprintf('sku: %s', $entity->getSku()),
            sprintf('fk_product_abstract: %s', $entity->getFkProductAbstract()),
            sprintf('attributes: %s', $entity->getAttributes()),
            sprintf('is_active: %s', $entity->getIsActive()),
            sprintf('created_at: %s', Cast::toString($entity->getCreatedAt('c'))),
            sprintf('updated_at: %s', Cast::toString($entity->getUpdatedAt('c'))),
        ]);
    }
}
