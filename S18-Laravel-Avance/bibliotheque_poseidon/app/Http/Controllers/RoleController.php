<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd("je suis dans le store du controller Role");
        // $role = new Role;
        // $role->name = $request->name;

        // $request->validate([
        //     'name' => 'required|min:3|max:50'
        // ]);

        $validated = $request->validate([
            'name' => [
                'required',
                'min:3',
                'max:50',
                'unique:roles'
            ],

        ], [
            "name.required" => "Le nom du rôle est obligatoire",
            "name.unique" => "Ce rôle existe déjà",
        ]);

        // dd($validated);


        // Role::create([
        //     'name' => $validated['name']
        // ]);
        Role::create($validated);
        return redirect()->route('roles.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
