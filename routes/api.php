<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


Route::get("/cep/{cep}", function (string $cep) {
    $response = Http::get("http://viacep.com.br/ws/{$cep}/json/");
    return "Fernando Lindo";

    if ($response->status() != 200) {
        return "Ooops! CEP não encontrado";
    }

    $responseObj = $response->object();

    $address = implode(", ", [
        $responseObj->logradouro,
        $responseObj->complemento ?: "- ",
        $responseObj->bairro,
        "{$responseObj->localidade}/{$responseObj->uf}",
        $responseObj->cep,
    ]);

    return "Endereço: {$address}";
});
