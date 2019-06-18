<?php

namespace FondOfSpryker\Zed\InvoiceApi\Business\Mapper;


use Orm\Zed\Invoice\Persistence\FosInvoice;

class EntityMapper implements EntityMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Orm\Zed\Invoice\Persistence\FosInvoice
     */
    public function toEntity(array $data)
    {
        $invoiceEntity = new FosInvoice();
        $invoiceEntity->fromArray($data);

        return $invoiceEntity;
    }

    /**
     * @param array $data
     *
     * @return \Orm\Zed\Invoice\Persistence\FosInvoice[]
     */
    public function toEntityCollection(array $data)
    {
        $entityList = [];
        foreach ($data as $itemData) {
            $entityList[] = $this->toEntity($itemData);
        }

        return $entityList;
    }
}
