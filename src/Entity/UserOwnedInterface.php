<?php

namespace App\Entity;

interface UserOwnedInterface
{
    public function getCustomer();

    public function setCustomer(Customer $customer): self;

}
