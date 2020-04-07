<?php

namespace FondOfSpryker\Zed\InvoiceApi\Business;

use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;

/**
 * @method \FondOfSpryker\Zed\InvoiceApi\Business\InvoiceApiBusinessFactory getFactory()
 */
class InvoiceApiFacade implements InvoiceApiFacadeInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function addInvoice(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()
            ->createInvoiceApi()
            ->add($apiDataTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return $this->getFactory()
            ->createInvoiceApiValidator()
            ->validate($apiDataTransfer);
    }
}
