<?php

namespace FondOfSpryker\Zed\InvoiceApi\Business\Model;

use Generated\Shared\Transfer\ApiDataTransfer;

interface InvoiceApiInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer);
}
