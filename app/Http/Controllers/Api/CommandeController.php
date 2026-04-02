<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Http\Requests\CommandeRequest; 
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{

public function index()
    {
       
        return response()->json(Commande::with('produits')->get(), 200);
    }
    
    public function store(CommandeRequest $request) 
    {
        try {
            return DB::transaction(function () use ($request) {
                
               
                $validated = $request->validated();

                
                $commande = Commande::create([
                    'reference'     => $validated['reference'],
                    'date_commande' => $validated['date_commande'],
                    'client_id'     => $validated['client_id'],
                ]);

                
                foreach ($validated['produits'] as $item) {
                    $commande->produits()->attach($item['id'], [
                        'quantite' => $item['qte']
                    ]);
                }

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Commande #'.$commande->id.' enregistrée',
                    'data'    => $commande->load('produits')
                ], 201);
            });

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Échec de la commande',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $commande = Commande::with(['produits', 'client'])->find($id);

        if (!$commande) {
            return response()->json(['message' => 'Commande introuvable'], 404);
        }

        return response()->json($commande, 200);
    }
    
    public function update(CommandeRequest $request, $id) 
    {
        $commande = Commande::find($id);
        if (!$commande) return response()->json(['message' => 'Introuvable'], 404);

        $validated = $request->validated();

       
        $commande->update($validated);

        
        if (isset($validated['produits'])) {
            $syncData = [];
            foreach ($validated['produits'] as $item) {
                $syncData[$item['id']] = ['quantite' => $item['qte']];
            }
            $commande->produits()->sync($syncData);
        }

        return response()->json(['message' => 'Commande mise à jour']);
    }

    public function destroy($id)
    {
        $commande = Commande::find($id);

        if (!$commande) {
            return response()->json(['message' => 'Commande introuvable'], 404);
        }

        // Le delete supprimera la commande (pense à configurer le onDelete('cascade') dans ta migration)
        $commande->delete();

        return response()->json(['message' => 'Commande supprimée'], 200);
    }
}