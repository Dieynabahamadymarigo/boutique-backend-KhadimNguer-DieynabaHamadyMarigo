<?php
namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: "API Documentation",
    version: "1.0.0",
    description: "API REST - Catégories, Produits et Acheteurs",
)]
#[OA\Server(
    url: "http://localhost:8000",
    description: "Serveur local"
)]
class ApiDocumentation
{
    // Class vide: sert uniquement à contenir les annotations OpenAPI pour la documentation de l'API.
}
