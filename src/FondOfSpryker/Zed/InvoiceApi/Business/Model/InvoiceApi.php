<?php

namespace FondOfSpryker\Zed\InvoiceApi\Business\Model;

use FondOfSpryker\Zed\InvoiceApi\Business\Mapper\EntityMapperInterface;
use FondOfSpryker\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceInterface;
use FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToProductInterface;
use FondOfSpryker\Zed\InvoiceApi\Dependency\QueryContainer\InvoiceApiToApiInterface;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\InvoiceItemTransfer;
use Generated\Shared\Transfer\InvoiceResponseTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Spryker\Zed\Availability\Persistence\AvailabilityQueryContainerInterface;

class InvoiceApi implements InvoiceApiInterface
{
    /**
     * @var \FondOfSpryker\Zed\InvoiceApi\Dependency\QueryContainer\InvoiceApiToApiInterface
     */
    protected $apiQueryContainer;

    /**
     * @var \FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceInterface
     */
    protected $invoiceFacade;

    /**
     * @var \FondOfSpryker\Zed\InvoiceApi\Business\Model\TransferMapperInterface
     */
    protected $transferMapper;

    /**
     * @var \FondOfSpryker\Zed\InvoiceApi\Business\Model\EntityMapperInterface
     */
    protected $entityMapper;

    /**
     * @var \FondOfSpryker\Zed\InvoiceApi\Business\Model\InvoiceApiToProductInterface
     */
    protected $productFacade;

    /**
     * InvoiceApi constructor.
     *
     * @param \FondOfSpryker\Zed\InvoiceApi\Dependency\QueryContainer\InvoiceApiToApiInterface $apiQueryContainer
     * @param \FondOfSpryker\Zed\InvoiceApi\Business\Model\EntityMapperInterface $entityMapper
     * @param \FondOfSpryker\Zed\InvoiceApi\Business\Model\TransferMapperInterface $transferMapper
     * @param \FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceInterface $invoiceFacade
     * @param \FondOfSpryker\Zed\InvoiceApi\Business\Model\InvoiceApiToProductInterface $productFacade
     */
    public function __construct(
        InvoiceApiToApiInterface $apiQueryContainer,
        EntityMapperInterface $entityMapper,
        TransferMapperInterface $transferMapper,
        InvoiceApiToInvoiceInterface $invoiceFacade,
        InvoiceApiToProductInterface $productFacade
    ) {
        $this->apiQueryContainer = $apiQueryContainer;
        $this->invoiceFacade = $invoiceFacade;
        $this->entityMapper = $entityMapper;
        $this->transferMapper = $transferMapper;
        $this->productFacade = $productFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $data = (array)$apiDataTransfer->getData();

        $invoiceTransfer = new InvoiceTransfer();
        $invoiceTransfer->fromArray($data, true);

        $invoiceItemsCollection = [];

        if (!isset($data['items'])) {
            $data['items'] = [];
        }

        foreach ($data['items'] as $invoiceItem) {
            $invoiceItemsCollection[] = (new InvoiceItemTransfer())->fromArray($invoiceItem, true);
        }

        $invoiceResponseTransfer = $this->invoiceFacade->addInvoice($invoiceTransfer, $invoiceItemsCollection);

        $invoiceTransfer = $this->getInvoiceFromResponse($invoiceResponseTransfer);

        return $this->apiQueryContainer->createApiItem($invoiceTransfer, $invoiceTransfer->getIdInvoice());
    }

    /**
     * @param \Generated\Shared\Transfer\InvoiceResponseTransfer $invoiceResponseTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    protected function getInvoiceFromResponse(InvoiceResponseTransfer $invoiceResponseTransfer): InvoiceTransfer
    {
        $invoiceTransfer = $invoiceResponseTransfer->getInvoiceTransfer();

        if (!$invoiceTransfer) {
            $errors = [];
            foreach ($invoiceResponseTransfer->getErrors() as $error) {
                $errors[] = $error->getMessage();
            }

            throw new EntityNotSavedException('Could not save creditmemo: ' . implode(',', $errors));
        }

        return $this->invoiceFacade->findInvoiceById($invoiceTransfer);
    }
}
