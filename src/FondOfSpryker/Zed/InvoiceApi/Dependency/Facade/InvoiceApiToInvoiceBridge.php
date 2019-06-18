<?php

namespace FondOfSpryker\Zed\InvoiceApi\Dependency\Facade;


use Generated\Shared\Transfer\InvoiceResponseTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;

class InvoiceApiToInvoiceBridge implements InvoiceApiToInvoiceInterface
{
    /**
     * @var \Spryker\Zed\Invoice\Business\InvoiceFacadeInterface
     */
    protected $invoiceFacade;

    /**
     * @param \Spryker\Zed\Invoice\Business\InvoiceFacadeInterface $invoiceFacade
     */
    public function __construct($invoiceFacade)
    {
        $this->invoiceFacade = $invoiceFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     * @param array $invoiceItemCollection
     *
     * @return \Generated\Shared\Transfer\InvoiceResponseTransfer
     */
    public function addInvoice(InvoiceTransfer $invoiceTransfer, array $invoiceItemCollection): InvoiceResponseTransfer
    {
        return $this->invoiceFacade->addInvoice($invoiceTransfer, $invoiceItemCollection);
    }

    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     * 
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function findInvoiceById(InvoiceTransfer $invoiceTransfer): InvoiceTransfer
    {
        return $this->invoiceFacade->findInvoiceById($invoiceTransfer);
    }
}
