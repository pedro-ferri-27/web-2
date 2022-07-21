<?php

namespace APP\Controller;

use APP\Model\Address;
use APP\Model\DAO\AddressDAO;
use APP\Model\DAO\ProviderDAO;
use APP\Model\Provider;
use APP\Model\Validation;
use APP\Utils\Redirect;
use PDOException;

require '../../vendor/autoload.php';

if (empty($_POST)) {
    session_start();
    // Redirecionar o usuário
    Redirect::redirect(
        type: 'error',
        message: 'Requisição inválida!!!'
    );
}

$providerName = $_POST["name"];
$providerPhone = $_POST["phone"];
$providerCnpj = $_POST["cnpj"];
$providerPublicPlace = $_POST["publicPlace"];
$providerNumberOfStreet = $_POST["numberOfStreet"];
$providerComplement = $_POST["complement"];
$providerNeighborhood = $_POST["neighborhood"];
$providerCity = $_POST["city"];
$providerZipCode = $_POST["zipCode"];

$error = array();

if ($error) {
    Redirect::redirect(
        message: $error,
        type: 'warning'
    );
} else {
    $provider = new Provider(
        name: $providerName,
        phone: $providerPhone,
        cnpj: $providerCnpj,
        address: new Address(
            streetName: "Rua A",
            publicPlace: $providerPublicPlace,
            numberOfStreet: $providerNumberOfStreet,
            complement: $providerComplement,
            neighborhood: $providerNeighborhood,
            city: $providerCity,
            zipCode: $providerZipCode,
        )
    );
    try {
        $dao = new AddressDAO();
        $result = $dao->insert($provider->address);
        if ($result) {
            $data = $dao->findId();
            $provider->address->id = $data["id"];
            $dao = new ProviderDAO();
            $result = $dao->insert($provider);
            if ($result) {
                Redirect::redirect(
                    message: "O fornecedor $providerName foi cadastrado com sucesso!!!"
                );
            } else {
                Redirect::redirect(message: "Lamento, não foi possível cadastrar o fornecedor $providerName", type: 'error');
            }
        }
    } catch (PDOException $e) {
        // Redirect::redirect(message: "Lamento, houve um erro inesperado em nosso sistema!!!", type: 'error');
        var_dump($e->getMessage());
        // Notificar o desenvolvedor
    }
}
