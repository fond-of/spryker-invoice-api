<?php

namespace FondOfSpryker\Zed\InvoiceApi\Business\Mapper;

interface TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function toTransfer(array $data);

    /**
     * @param array $invoiceEntityCollection
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer[]
     */
    public function toTransferCollection(array $invoiceEntityCollection);
}
