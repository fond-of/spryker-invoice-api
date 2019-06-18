<?php

namespace FondOfSpryker\Zed\InvoiceApi\Business;

use FondOfSpryker\Zed\InvoiceApi\Business\Mapper\EntityMapper;
use FondOfSpryker\Zed\InvoiceApi\Business\Mapper\TransferMapper;
use FondOfSpryker\Zed\InvoiceApi\Business\Model\InvoiceApi;
use FondOfSpryker\Zed\InvoiceApi\Business\Model\Validator\InvoiceApiValidator;
use FondOfSpryker\Zed\InvoiceApi\InvoiceApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\InvoiceApi\InvoiceApiConfig getConfig()
 */
class InvoiceApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\InvoiceApi\Business\Model\InvoiceApiInterface
     */
    public function createInvoiceApi()
    {
        return new InvoiceApi(
            $this->getApiQueryContainer(),
            $this->createEntityMapper(),
            $this->createTransferMapper(),
            $this->getInvoiceFacade(),
            $this->getProductFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\InvoiceApi\Business\Mapper\EntityMapper
     */
    public function createEntityMapper()
    {
        return new EntityMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\InvoiceApi\Business\Mapper\TransferMapper
     */
    public function createTransferMapper()
    {
        return new TransferMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\InvoiceApi\Business\Model\Validator\InvoiceApiValidator
     */
    public function createInvoiceApiValidator()
    {
        return new InvoiceApiValidator();
    }

    /**
     * @return \FondOfSpryker\Zed\InvoiceApi\Dependency\QueryContainer\InvoiceApiToApiInterface
     */
    protected function getApiQueryContainer()
    {
        return $this->getProvidedDependency(InvoiceApiDependencyProvider::QUERY_CONTAINER_API);
    }

    /**
     * @return \FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceInterface
     */
    protected function getInvoiceFacade()
    {
        return $this->getProvidedDependency(InvoiceApiDependencyProvider::FACADE_INVOICE);
    }

    /**
     * @return \FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToProductInterface
     */
    protected function getProductFacade()
    {
        return $this->getProvidedDependency(InvoiceApiDependencyProvider::FACADE_PRODUCT);
    }
}
