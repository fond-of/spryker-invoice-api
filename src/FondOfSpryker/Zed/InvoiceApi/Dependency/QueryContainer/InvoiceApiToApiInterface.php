<?php

namespace FondOfSpryker\Zed\InvoiceApi\Dependency\QueryContainer;

interface InvoiceApiToApiInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function createApiCollection(array $data);

    /**
     * @param array|\Spryker\Shared\Kernel\Transfer\AbstractTransfer $data
     * @param int|null $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function createApiItem($data, $id = null);
}
