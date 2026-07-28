<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Tag(name:'Produits', description: 'Gestion des produits')]
class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    #[OA\Get(path:'/api/produits',summary:'Listes des produits', tags:['Produits'], responses: [
        new OA\Response(
            response: 200,
            description: "Liste des produits"
        ),
    ]
    )]
    public function index():JsonResponse
    {
        //
        $produits = Produit::with('categorie')->orderBy('nom')->get();

        return response()->json($produits);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OA\Post(path:'/api/produits', summary:'Créer un produit', tags:['Produits'],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ["nom","prix","stock","categories_id"],
            properties: [
                new OA\Property(property: "nom", type: "string"),
                new OA\Property(property: "prix", type: "numeric"),
                new OA\Property(property: "stock", type: "integer"),
                new OA\Property(property: "description", type: "string"),
                new OA\Property(property: "categories_id", type: "exists:categories,id"),
            ]
        )
    ),
    responses: [
        new OA\Response(
            response: 201,
            description: "Produit crée"
        ),
        new OA\Response(
            response: 422,
            description: "Erreurs de validation"
        ),
    ]
        )]
    public function store(Request $request):JsonResponse
    {
        //
        $validated = $request->validate([
            'nom'=>['required','string','max:255'],
            'prix'=>['required','numeric','min:0'],
            'stock'=>['required','integer','min:0'],
            'description'=>['nullable','string'],
            'categories_id'=>['required','exists:categories,id'],
        ]);

        $produit =Produit::create($validated);

        return response()->json($produit->load('categorie'),201);
    }

    /**
     * Display the specified resource.
     */
    #[OA\Get(path:'/api/produits/{id}', summary:'Detail d\'un produit', tags:['Produits'],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer"),
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Produit trouvé"
            ),
            new OA\Response(
                response: 404,
                description: "Produit non trouvé"
            ),
        ]
        )]
    public function show(Produit $id):JsonResponse
    {
        //
        $id->load('categorie','acheteurs');

        return response()->json($id);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OA\Put(path: '/api/produits/{id}', summary: 'Mettre à jour un produit', tags: ['Produits'],
        parameters: [
            new OA\Parameter(
                name: "id",
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
                    new OA\Property(property: "prix", type: "numeric"),
                    new OA\Property(property: "stock", type: "integer"),
                    new OA\Property(property: "description", type: "string"),
                    new OA\Property(property: "categories_id", type: "exists:categories,id"),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Produit mise à jour"
            ),
            new OA\Response(
                response: 422,
                description: "Erreurs de validation"
            ),
        ]
        )]
    public function update(Request $request, Produit $id):JsonResponse
    {
        //
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prix' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'categories_id' => ['required', 'exists:categories,id'],
        ]);

        $id->update($validated);

        return response()->json($id->load('categorie'));
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OA\Delete(path: '/api/produits/{id}', summary: 'Supprimer un produit', tags: ['Produits'],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer"),
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Produit supprimé"
            ),
        ]
        )]
    public function destroy(Produit $id)
    {
        //
        $id->delete();

        return response()->json(['message'=>'Produit supprimé']);
    }
}
