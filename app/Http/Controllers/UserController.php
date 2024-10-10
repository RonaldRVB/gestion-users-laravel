<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) // Ajoutez le paramètre $request ici
    {
        $query = User::query(); // Créez une requête sur le modèle User
    
        // Vérifiez si le paramètre de recherche est présent
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
    
        // Récupérez les utilisateurs avec pagination
        $users = $query->paginate(10);
    
        return view('users.index', ['users' => $users]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin',
        ]);
    
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
        ]);
    
        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Récupérer l'utilisateur par son ID
        $user = User::findOrFail($id);

        // Transmettre l'utilisateur à la vue
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id); // Récupérer l'utilisateur ou échouer
        return view('users.edit', compact('user')); // Passer l'utilisateur à la vue
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            // Validation des données
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'role' => 'required|string',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    // Récupération de l'utilisateur
    $user = User::findOrFail($id);

    // Mise à jour des informations de l'utilisateur
    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;
    
    
    // Si un nouveau mot de passe est fourni, le hacher et l'attribuer
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save(); // Sauvegarder les modifications

    // Redirection avec un message de succès
    return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id); // Récupérer l'utilisateur
        $user->delete(); // Supprimer l'utilisateur
    
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
