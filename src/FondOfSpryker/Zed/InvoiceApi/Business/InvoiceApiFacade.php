<?php

namespace FondOfSpryker\Zed\InvoiceApi\Business;

use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\CreditmemoApi\Business\CreditmemoApiBusinessFactory getFactory()
 */
class InvoiceApiFacade extends AbstractFacade implements InvoiceApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function addInvoice(ApiDataTransfer $apiDataTransfer)
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
    public function validate(ApiDataTransfer $apiDataTransfer)
    {
        return $this->getFactory()
            ->createInvoiceApiValidator()
            ->validate($apiDataTransfer);
    }
}
