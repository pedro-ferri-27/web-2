<?php

namespace APP\Model;

class Provider
{
    private int $id;
    private string $cnpj;
    private string $name;
    private ?string $phone;
    private ?Address $address;

    public function __construct(
        string $cnpj,
        string $name,
        ?string $phone = null,
        ?Address $address = null
    ) {
        $this->cnpj = $cnpj;
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
    }

    public function __get($attribute)
    {
        return $this->$attribute;
    }
}
