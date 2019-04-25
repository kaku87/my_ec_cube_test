<?php

namespace Plugin\LineLoginIntegration\Entity;

use Eccube\Entity\AbstractEntity;

class LineLoginIntegration extends AbstractEntity
{

    private $customer_id;
    private $line_user_id;
    private $Customer;

    public function getCustomerId()
    {
        return $this->customer_id;
    }

    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
        return $this;
    }

    public function getLineUserId()
    {
        return $this->line_user_id;
    }

    public function setLineUserId($line_user_id)
    {
        $this->line_user_id = $line_user_id;
        return $this;
    }

    public function setCustomer(\Eccube\Entity\Customer $customer = null)
    {
        $this->Customer = $customer;

        return $this;
    }

    public function getCustomer()
    {
        return $this->Customer;
    }
}
