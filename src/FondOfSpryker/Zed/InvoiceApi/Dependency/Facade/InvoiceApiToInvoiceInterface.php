<?php

namespace FondOfSpryker\Zed\InvoiceApi\Dependency\Facade;

use Generated\Shared\Transfer\InvoiceResponseTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;

interface InvoiceApiToInvoiceInterface
{
    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     * @param array $invoiceItemCollection
     *
     * @return \Generated\Shared\Transfer\InvoiceResponseTransfer
     */
    public function addInvoice(InvoiceTransfer $invoiceTransfer, array $invoiceItemCollection): InvoiceResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     * 
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function findInvoiceById(InvoiceTransfer $invoiceTransfer): InvoiceTransfer;
}
