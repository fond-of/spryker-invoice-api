<?php

namespace FondOfSpryker\Zed\InvoiceApi\Business\Model;

use FondOfSpryker\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToApiFacadeInterface;
use FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeInterface;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;

class InvoiceApi implements InvoiceApiInterface
{
    /**
     * @var \FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToApiFacadeInterface
     */
    protected InvoiceApiToApiFacadeInterface $apiFacade;

    /**
     * @var \FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeInterface
     */
    protected InvoiceApiToInvoiceFacadeInterface $invoiceFacade;

    /**
     * @var \FondOfSpryker\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface
     */
    protected TransferMapperInterface $transferMapper;

    /**
     * @param \FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToApiFacadeInterface $apiFacade
     * @param \FondOfSpryker\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface $transferMapper
     * @param \FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeInterface $invoiceFacade
     */
    public function __construct(
        InvoiceApiToApiFacadeInterface $apiFacade,
        TransferMapperInterface $transferMapper,
        InvoiceApiToInvoiceFacadeInterface $invoiceFacade
    ) {
        $this->apiFacade = $apiFacade;
        $this->transferMapper = $transferMapper;
        $this->invoiceFacade = $invoiceFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $data = $apiDataTransfer->getData();

        $invoiceTransfer = $this->transferMapper->toTransfer($data);

        $invoiceResponseTransfer = $this->invoiceFacade->createInvoice(
            $invoiceTransfer,
        );

        $invoiceTransfer = $invoiceResponseTransfer->getInvoiceTransfer();

        if ($invoiceTransfer === null || $invoiceResponseTransfer->getIsSuccess() === false) {
            throw new EntityNotSavedException(
                'Could not save invoice.',
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiFacade->createApiItem(
            $invoiceTransfer,
            $invoiceTransfer->getIdInvoice(),
        );
    }
}
