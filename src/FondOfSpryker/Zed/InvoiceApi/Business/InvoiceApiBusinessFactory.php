<?php

namespace FondOfSpryker\Zed\InvoiceApi\Business;

use FondOfSpryker\Zed\InvoiceApi\Business\Mapper\TransferMapper;
use FondOfSpryker\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\InvoiceApi\Business\Model\InvoiceApi;
use FondOfSpryker\Zed\InvoiceApi\Business\Model\InvoiceApiInterface;
use FondOfSpryker\Zed\InvoiceApi\Business\Model\Validator\InvoiceApiValidator;
use FondOfSpryker\Zed\InvoiceApi\Business\Model\Validator\InvoiceApiValidatorInterface;
use FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToApiFacadeInterface;
use FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeInterface;
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
    public function createInvoiceApi(): InvoiceApiInterface
    {
        return new InvoiceApi(
            $this->getApiFacade(),
            $this->createTransferMapper(),
            $this->getInvoiceFacade(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface
     */
    protected function createTransferMapper(): TransferMapperInterface
    {
        return new TransferMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\InvoiceApi\Business\Model\Validator\InvoiceApiValidatorInterface
     */
    public function createInvoiceApiValidator(): InvoiceApiValidatorInterface
    {
        return new InvoiceApiValidator();
    }

    /**
     * @return \FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToApiFacadeInterface
     */
    protected function getApiFacade(): InvoiceApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(InvoiceApiDependencyProvider::FACADE_API);
    }

    /**
     * @return \FondOfSpryker\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeInterface
     */
    protected function getInvoiceFacade(): InvoiceApiToInvoiceFacadeInterface
    {
        return $this->getProvidedDependency(InvoiceApiDependencyProvider::FACADE_CREDIT_MEMO);
    }
}
