<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\Acheteur;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Acheteurs', description: 'Gestion des acheteurs et achats')]
class AcheteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OA\Get(
        path: '/api/acheteurs',
        summary: 'Listes des acheteurs',
        tags: ['Acheteurs'],
        responses: [
            new OA\Response(
                response: 200,
                description: "Liste des acheteurs"
            ),
        ]
    )]
    public function index(): JsonResponse
    {
        //
        $acheteurs = Acheteur::query()->orderBy('nom')->get();

        return response()->json($acheteurs);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OA\Post(
        path: '/api/acheteurs',
        summary: 'Créer un acheteur',
        tags: ['Acheteurs'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["nom", "email"],
                properties: [
                    new OA\Property(property: "nom", type: "string"),
                    new OA\Property(property: "email", type: "email"),
                    new OA\Property(property: "telephone", type: "string"),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Acheteur crée"
            ),
            new OA\Response(
                response: 422,
                description: "Erreurs de validation"
            ),
        ]
    )]
    public function store(Request $request): JsonResponse
    {
        //
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:acheteurs,email'],
            'telephone' => ['nullable', 'string', 'max:20'],
        ]);

        $acheteur = Acheteur::create($validated);

        return response()->json($acheteur, 201);
    }

    /**
     * Display the specified resource.
     */
    #[OA\Get(
        path: '/api/acheteurs/{id}',
        summary: 'Detail d\'un acheteur',
        tags: ['Acheteurs'],
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
                description: "Acheteur trouvé"
            ),
            new OA\Response(
                response: 404,
                description: "Acheteur non trouvé"
            ),
        ]
    )]
    public function show(Acheteur $id): JsonResponse
    {
        //
        $id->load('produits');

        return response()->json($id);
    }


    /**
     * Update the specified resource in storage.
     */
    #[OA\Put(
        path: '/api/acheteurs/{id}',
        summary: 'Mettre à jour un acheteur',
        tags: ['Acheteurs'],
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
                    new OA\Property(property: "email", type: "email"),
                    new OA\Property(property: "telephone", type: "string"),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Acheteur mise à jour"
            ),
            new OA\Response(
                response: 422,
                description: "Erreurs de validation"
            ),
        ]
    )]
    public function update(Request $request, Acheteur $id)
    {
        //
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:acheteurs,email,' . $id->id],
            'telephone' => ['nullable', 'string', 'max:20'],
        ]);

        $id->update($validated);

        return response()->json($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OA\Delete(path: '/api/acheteurs/{acheteur}', summary: 'Supprimer un acheteur', tags: ['Acheteurs'],
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
                description: "Acheteur supprimé"
            ),
        ]
    )]
    public function destroy(Acheteur $id)
    {
        //
        $id->delete();

        return response()->json(['message'=>'Acheteur supprimé']);
    }

    // Enregistre un achat
    #[OA\Post(
        path:'/api/acheteurs/{id}/acheter',
        summary: 'Enregistrer un achat',
        tags: ['Acheteurs'],
        requestBody: new OA\RequestBody(
            required:true,
            content: new OA\JsonContent(
                required: ['produit_id','quantite','date_achat'],
                properties:[
                    new OA\Property(property:'produit_id', type:'integer'),
                    new OA\Property(property:'quantite', type:'integer'),
                    new OA\Property(property:'date_achat', type:'string', format:'date'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Achat enregistré"
            ),
            new OA\Response(
                response: 422,
                description: "Erreurs de validation"
            ),
        ]
    )]

    public function acheter(Request $request, Acheteur $id):JsonResponse
    {
        $validated = $request->validate([
            'produit_id'=>['required','exists:produits,id'],
            'quantite'=>['required','integer','min:1'],
            'date_achat'=>['required','date'],
        ]);

        $id->produits()->attach($validated['produit_id'],[
            'quantite'=>$validated['quantite'],
            'date_achat'=>$validated['date_achat'],
        ]);

        $id->load('produits');

        return response()->json([
            'message'=>'Achat enregistré',
            'acheteur'=>$id,
        ],201);
    }
}
