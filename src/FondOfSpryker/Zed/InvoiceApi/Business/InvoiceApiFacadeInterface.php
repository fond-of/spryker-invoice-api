<?php

namespace FondOfSpryker\Zed\InvoiceApi\Business;

use Generated\Shared\Transfer\ApiDataTransfer;

/**
 * @method \FondOfSpryker\Zed\InvoiceApi\Business\InvoiceApiBusinessFactory getFactory()
 */
interface InvoiceApiFacadeInterface
{
    /**
     * Specification:
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function addInvoice(ApiDataTransfer $apiDataTransfer);

    /**
     * Specification:
     * - Validates the given API data and returns an array of errors if necessary.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer);
}
