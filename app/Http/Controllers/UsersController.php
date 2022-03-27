<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    // sleep(5);
    return Inertia::render('Users/Index', [
        // 'users' => User::all()->map(fn($user) => [
        //     'id' => $user->id,
        //     'name' => $user->name
        // ])
        // 'users' => User::paginate(10)
        'users' => User::query()
                        ->when(request('search'), function ($query, $search) {
                            $query->where('name', 'like', "%{$search}%");
                        })
                        ->paginate(10)
                        ->withQueryString()
                        ->through(fn($user) => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'can' => [
                                'edit' => Auth::user()->can('edit', User::class),
                                'delete' => Auth::user()->can('delete', User::class),
                            ]
                        ]),
        'filters' => request()->only(['search']),
        'can' => [
            'createUser' => Auth::user()->can('create', User::class)
        ]
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postData = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        User::create($postData);

        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $postData = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email,'.$user->id],
            // 'password' => 'required'
        ]);

        if ($request->filled('password')) {

            $request->validate([
                'password' => 'required',
            ]);

            $postData['password'] = $request->password;
        }

        $user->update($postData);

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users');
    }
}
