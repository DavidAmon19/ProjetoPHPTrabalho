<?php

declare(strict_types=1);

namespace App\Controller;

class Translator
{
    private static ?Translator $instance = null;
    private array $translations;

    private function __construct()
    {
        // Construtor privado para impedir a instanciação direta
        $this->translations = [];
    }

    public static function getInstance(): Translator
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function translate(string $key): string
    {
        return $this->translations[$key] ?? $key;
    }

    public function loadTranslations(array $translations): void
    {
        $this->translations = $translations;
    }
}