<?php

namespace SwedbankPaymentPortal\SharedEntity\Type;

/**
 * Abstract status.
 */
class AbstractStatus extends AbstractEnumerableType
{
    /**
     * Returns whether the query was successful.
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->id() == 1;
    }
}
