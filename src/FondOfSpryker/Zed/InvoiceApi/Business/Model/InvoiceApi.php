<?php

namespace FondOfSpryker\Zed\InvoiceApi\Business\Model;

use FondOfSpryker\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeInterface;
use FondOfSpryker\Zed\InvoiceApi\Dependency\QueryContainer\InvoiceApiToApiQueryContainerInterface;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;

class InvoiceApi implements InvoiceApiInterface
{
    /**
     * @var \FondOfSpryker\Zed\InvoiceApi\Dependency\QueryContainer\InvoiceApiToApiQueryContainerInterface
     */
    protected $apiQueryContainer;

    /**
     * @var \FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeInterface
     */
    protected $invoiceFacade;

    /**
     * @var \FondOfSpryker\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface
     */
    protected $transferMapper;

    /**
     * InvoiceApi constructor.
     *
     * @param \FondOfSpryker\Zed\InvoiceApi\Dependency\QueryContainer\InvoiceApiToApiQueryContainerInterface $apiQueryContainer
     * @param \FondOfSpryker\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface $transferMapper
     * @param \FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeInterface $invoiceFacade
     */
    public function __construct(
        InvoiceApiToApiQueryContainerInterface $apiQueryContainer,
        TransferMapperInterface $transferMapper,
        InvoiceApiToInvoiceFacadeInterface $invoiceFacade
    ) {
        $this->apiQueryContainer = $apiQueryContainer;
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
        $data = (array)$apiDataTransfer->getData();

        $invoiceTransfer = $this->transferMapper->toTransfer($data);

        $invoiceResponseTransfer = $this->invoiceFacade->createInvoice(
            $invoiceTransfer
        );

        $invoiceTransfer = $invoiceResponseTransfer->getInvoiceTransfer();

        if ($invoiceTransfer === null || $invoiceResponseTransfer->getIsSuccess() === false) {
            throw new EntityNotSavedException(
                'Could not save invoice.',
                ApiConfig::HTTP_CODE_INTERNAL_ERROR
            );
        }

        return $this->apiQueryContainer->createApiItem(
            $invoiceTransfer,
            $invoiceTransfer->getIdInvoice()
        );
    }
}
