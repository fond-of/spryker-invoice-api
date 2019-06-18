<?php

namespace FondOfSpryker\Zed\InvoiceApi\Business\Mapper;

use Generated\Shared\Transfer\InvoiceTransfer;

class TransferMapper implements TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function toTransfer(array $data)
    {
        $invoiceTransfer = new InvoiceTransfer();
        $invoiceTransfer->fromArray($data, true);

        return $invoiceTransfer;
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer[]
     */
    public function toTransferCollection(array $data)
    {
        $transferList = [];
        foreach ($data as $itemData) {
            $transferList[] = $this->toTransfer($itemData);
        }

        return $transferList;
    }
}
