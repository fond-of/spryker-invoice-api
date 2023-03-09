<?php

namespace FondOfSpryker\Zed\InvoiceApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

interface InvoiceApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array;
}
