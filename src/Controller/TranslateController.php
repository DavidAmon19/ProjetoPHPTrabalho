<?php


declare(strict_types=1);

namespace App\Controller;

use App\Controller\Translator;

class TranslateController extends AbstractController
{
    public function translate(): void
    {
        // Verifica se o parâmetro 'lang' está presente na solicitação
        if (isset($_GET['lang'])) {
            $_SESSION['language'] = $_GET['lang'];
        } else {
            // Define uma linguagem padrão caso 'lang' não esteja definido
            $_SESSION['language'] = 'pt-br';
        }

        // Carrega o arquivo de traduções com base na linguagem definida
        $translations = include "../translations/{$_SESSION['language']}.php";

        // Obtém a instância única do tradutor
        $translator = Translator::getInstance();

        // Carrega as traduções na instância do tradutor
        $translator->loadTranslations($translations);

        // Redireciona de volta para a página anterior
        $previousRoute = $_SERVER['HTTP_REFERER'];
        parent::redirect($previousRoute);
    }
}