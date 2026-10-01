<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompteComptable;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Tiers;

class ErpSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Comptes Comptables SYSCOHADA essentiels
        $comptes = [
            ['numero_compte' => '411000', 'intitule' => 'Clients', 'classe' => 4],
            ['numero_compte' => '401000', 'intitule' => 'Fournisseurs', 'classe' => 4],
            ['numero_compte' => '443100', 'intitule' => 'TVA facturée', 'classe' => 4],
            ['numero_compte' => '701000', 'intitule' => 'Ventes de marchandises', 'classe' => 7],
            ['numero_compte' => '601000', 'intitule' => 'Achats de marchandises', 'classe' => 6],
            ['numero_compte' => '521000', 'intitule' => 'Banque', 'classe' => 5],
            ['numero_compte' => '571000', 'intitule' => 'Caisse', 'classe' => 5],
        ];

        foreach ($comptes as $compte) {
            CompteComptable::firstOrCreate(
                ['numero_compte' => $compte['numero_compte']],
                $compte
            );
        }

        // 2. Catégorie et Produit de test
        $categorie = Categorie::firstOrCreate(
            ['libelle' => 'Général'],
            ['description' => 'Catégorie par défaut']
        );

        Produit::firstOrCreate(
            ['reference' => 'PROD-001'],
            [
                'category_id' => $categorie->id,
                'designation' => 'Article Test ERP',
                'prix_achat' => 5000,
                'prix_vente' => 8000,
                'stock_actuel' => 100,
                'seuil_alerte' => 10,
                'methode_valorisation' => 'CUMP',
            ]
        );

        // 3. Tiers de test (Client et Fournisseur)
        Tiers::firstOrCreate(
            ['nom' => 'Client Comptoir'],
            ['type' => 'client', 'telephone' => '+22501010101', 'adresse' => 'Abidjan', 'plafond_credit' => 500000]
        );

        Tiers::firstOrCreate(
            ['nom' => 'Fournisseur Global'],
            ['type' => 'fournisseur', 'telephone' => '+22502020202', 'adresse' => 'Bouaké', 'plafond_credit' => 1000000]
        );
    }
}