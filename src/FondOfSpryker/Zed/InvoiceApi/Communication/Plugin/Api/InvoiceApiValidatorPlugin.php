<?php

namespace FondOfSpryker\Zed\InvoiceApi\Communication\Plugin\Api;

use FondOfSpryker\Zed\InvoiceApi\InvoiceApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;
use Spryker\Zed\Api\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\InvoiceApi\Business\InvoiceApiFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\InvoiceApi\Business\InvoiceApiBusinessFactory getFactory()
 */
class InvoiceApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @api
     *
     * @return string
     */
    public function getResourceName()
    {
        return InvoiceApiConfig::RESOURCE_INVOICE;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiValidationErrorTransfer[]
     */
    public function validate(ApiDataTransfer $apiDataTransfer)
    {
        return $this->getFacade()->validate($apiDataTransfer);
    }
}
