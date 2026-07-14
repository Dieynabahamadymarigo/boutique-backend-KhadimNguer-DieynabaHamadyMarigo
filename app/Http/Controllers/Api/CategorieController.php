<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Categories",
    description: "Gestion des catégories de produits"
)]

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OA\Get(
        path: "/api/categories",
        summary: "Lister les catégories",
        tags: ["Categories"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Liste des catégories"
            ),
        ]
    )]

    public function index():JsonResponse
    {
        $categories = Categorie::query()->orderBy('nom')->get();

        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OA\Post(
        path: "/api/categories",
        summary: "Créer une catégorie",
        tags: ["Categories"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["nom"],
                properties: [
                    new OA\Property(property: "nom", type: "string", example: "Café"),
                    new OA\Property(property: "description", type: "string", example: "Une catégorie pour les produits de café"),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Catégorie créée"
            ),
            new OA\Response(
                response: 422,
                description: "Erreurs de validation"
            ),
        ]
    )]

    public function store(Request $request):JsonResponse
    {
        // Verifie les données du formulaire avant insertion
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:100', 'unique:categories,nom'],
            'description' => ['nullable', 'string'],
        ]);

        $categorie = Categorie::create($validated);

        return response()->json($categorie, 201);
    }

    /**
     * Display the specified resource.
     */
    #[OA\Get(
        path: "/api/categories/{categorie}",
        summary: "Détails d'une catégorie avec ses produits",
        tags: ["Categories"],
        parameters: [
            new OA\Parameter(
                name: "categorie",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer"),
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Catégorie trouvée"
            ),
            new OA\Response(
                response: 404,
                description: "Catégorie non trouvée"
            ),
        ]
    )]

    public function show(Categorie $categorie): JsonResponse
    {
        // load
        $categorie->load('produits');

        return response()->json($categorie);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OA\Put(
        path: "/api/categories/{categorie}",
        summary: "Mettre à jour une catégorie",
        tags: ["Categories"],
        parameters: [
            new OA\Parameter(
                name: "categorie",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer"),
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "nom", type: "string"),
                    new OA\Property(property: "description", type: "string"),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Catégorie mise à jour"
            ),
            new OA\Response(
                response: 422,
                description: "Erreurs de validation"
            ),
        ]
    )]
    public function update(Request $request, Categorie $categorie): JsonResponse
    {
        // Verifie les données du formulaire avant insertion
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:100', 'unique:categories,nom,' . $categorie->id],
            'description' => ['nullable', 'string'],
        ]);

        $categorie->update($validated);

        return response()->json($categorie);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OA\Delete(
        path: "/api/categories/{categorie}",
        summary: "Supprimer une catégorie",
        tags: ["Categories"],
        parameters: [
            new OA\Parameter(
                name: "categorie",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer"),
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Catégorie supprimée"
            ),
        ]
    )]
    public function destroy(Categorie $categorie): JsonResponse
    {
        //
        $categorie->delete();

        return response()->json(['message' => 'Catégorie supprimée avec succès.']);
    }
}
