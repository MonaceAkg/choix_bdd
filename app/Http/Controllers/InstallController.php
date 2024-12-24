<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class InstallController extends Controller
{
    //

    public function showForm(){
        return view('install');
    }


    // public function processForm(Request $request)
    // {
    //     // Validation des données du formulaire
    //     $request->validate([
    //         'db_connection' => 'required|in:sqlsrv,mysql',
    //         'db_host' => 'required',
    //         'db_port' => 'required',
    //         'db_database' => 'required',
    //         'db_username' => 'required',
    //         'db_password' => 'nullable',
    //     ]);
    
    //     // Lire le contenu actuel du fichier .env
    //     $envPath = base_path('.env');
    //     $envContent = File::get($envPath);
    
    //     // Mettre à jour ou ajouter les paramètres de connexion
    //     $envContent = preg_replace('/^DB_CONNECTION=.*/m', 'DB_CONNECTION=' . $request->db_connection, $envContent);
    //     $envContent = preg_replace('/^DB_HOST=.*/m', 'DB_HOST=' . $request->db_host, $envContent);
    //     $envContent = preg_replace('/^DB_PORT=.*/m', 'DB_PORT=' . $request->db_port, $envContent);
    //     $envContent = preg_replace('/^DB_DATABASE=.*/m', 'DB_DATABASE=' . $request->db_database, $envContent);
    //     $envContent = preg_replace('/^DB_USERNAME=.*/m', 'DB_USERNAME=' . $request->db_username, $envContent);
    //     $envContent = preg_replace('/^DB_PASSWORD=.*/m', 'DB_PASSWORD=' . ($request->db_password ?: ''), $envContent);
    
    //     // Écrire le contenu modifié dans le fichier .env
    //     File::put($envPath, $envContent);
    
    //     // Exécuter les migrations après avoir écrit le fichier .env
    //     Artisan::call('migrate');
    
    //     // return redirect('/')->with('success', 'Installation terminée !');
    //     return view('install')->with('success', 'Installation terminée !');
        
    // }



    public function processForm(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'db_connection' => 'required|in:sqlsrv,mysql',
            'db_host' => 'required',
            'db_port' => 'required',
            'db_database' => 'required',
            'db_username' => 'required',
            'db_password' => 'nullable',
        ]);
    
        // Configuration dynamique de la connexion à la base de données
        Config::set('database.connections.custom', [
            'driver' => $request->db_connection,
            'host' => $request->db_host,
            'port' => $request->db_port,
            'database' => $request->db_database,
            'username' => $request->db_username,
            'password' => $request->db_password,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => true,
        ]);
    
        // Tester la connexion à la base de données
        try {
            DB::purge('custom'); // Purge les connexions précédentes
            DB::connection('custom')->getPdo(); // Essayer d'obtenir le PDO pour vérifier la connexion
    
            // Si la connexion est réussie, retourner un message de succès
            // return view('moa')->with('message', 'Connexion à la base de données réussie !');
            dd('Connexion à la base de données réussie !');
            
        } catch (\Exception $e) {
            // Gérer l'erreur de connexion et retourner un message d'erreur
            // return view('moa')->with('message', 'Impossible de se connecter à la base de données : ' . $e->getMessage());
            dd('Impossible de se connecter à la base de données');
        }

    
    }

}
