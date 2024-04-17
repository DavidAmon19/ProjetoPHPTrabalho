<?php

include "../vendor/autoload.php";
use App\Controller\Translator;

session_start();

/**
 Eu manteria a responsabilidade o maximo possivel dentro do App\Controller\Translator

function translate(string $key)
{
    $translator = Translator::getInstance($pathOndeTaOsArquivosDeTradução);
    return $translator->translate($key);

    Dentro do getInstance da pra deixar isso aqui

    $lang = $_SESSION['language'] ?? 'pt-br';
    $translations = include "../translations/{$lang}.php";
    $translator->loadTranslations($translations);

    na hora do include da pra puxar o path recebido com o que ta na session

}

 */

$routes = include "../config/routes.php";
$translator = Translator::getInstance();

// Carrega as traduções correspondentes à linguagem atual
$lang = $_SESSION['language'] ?? 'pt-br';
$translations = include "../translations/{$lang}.php";
$translator->loadTranslations($translations);

// Função para traduzir chaves de idioma
function translate(string $key)
{
    global $translator;
    return $translator->translate($key);
}

$url = explode('?', $_SERVER['REQUEST_URI'])[0];

if (false === isset($routes[$url])) {
    header('location: /erro-404');
    exit;
}

$controller = $routes[$url][0];
$method = $routes[$url][1];

(new $controller())->$method();
