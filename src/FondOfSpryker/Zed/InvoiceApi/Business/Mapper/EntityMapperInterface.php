<?php

namespace FondOfSpryker\Zed\InvoiceApi\Business\Mapper;

interface EntityMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Orm\Zed\Invoice\Persistence\FosInvoice
     */
    public function toEntity(array $data);

    /**
     * @param array $invoiceApiDataCollection
     *
     * @return \Orm\Zed\Invoice\Persistence\FosInvoice[]
     */
    public function toEntityCollection(array $invoiceApiDataCollection);
}
