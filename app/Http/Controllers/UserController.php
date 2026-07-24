<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    // crud users
    public function index(): View
    {
        //liste des users, triés par ordre
        $users = User::query()->orderBy('name')->get();

        return view('users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return View('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        //Vérifie les données du formulaire avant insertion
        $validated = $request->validate([
            'name'=>['required', 'string', 'max:255'],
            'email' =>['required', 'email', 'max:255', 'unique:users,email'],
            'password' =>['required', 'string', 'min:8'],
            'role' =>['required', 'in:employe,gestionnaire,admin']
        ]);

        User::create($validated);

        return Redirect()->route('users.index')->with('succes','Utisateur crée');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        //
        return view('users.show',['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user):View
    {
        //
        return view('users.edit', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user):RedirectResponse
    {
        //
        $validated=$request->validate([
            'name'=>['required','string','max:255'],
            'email'=>['required', 'email', 'max:255', 'unique:users,email,' .$user->id],
            'role'=>['required', 'in:employe,gestionnaire,admin'],
        ]);

        $user->update($validated);

        return Redirect::route('users.index')->with('success','Utilisateur mise à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user):RedirectResponse
    {
        //
        $user->delete();

        return Redirect::route('users.index')->with('success','Utilisateur supprimé');
    }
}
