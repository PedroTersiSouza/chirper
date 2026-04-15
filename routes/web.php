<?php

use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\ChirpController;
use App\Models\User;
use App\Models\Chirp;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// PÁGINA INICIAL
Route::get('/', [ChirpController::class, 'index']);

// ROTAS PROTEGIDAS (PRECISA ESTAR LOGADO)
Route::middleware('auth')->group(function () {

    // Operações dos Chirps
    Route::post('/chirps', [ChirpController::class, 'store']);
    Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit']);
    Route::put('/chirps/{chirp}', [ChirpController::class, 'update']);
    Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy']);

    // Rota de Curtida (Like/Unlike)
    Route::post('/chirps/{chirp}/like', function (Chirp $chirp) {
        $chirp->likers()->toggle(auth()->user());
        return back();
    })->name('chirps.like');

    // Rota de Busca (Pesquisar usuários e mensagens)
    Route::get('/search', function (Request $request) {
        $term = $request->input('query');

        $chirps = Chirp::with('user')
            ->where('message', 'LIKE', "%{$term}%")
            ->orWhereHas('user', function ($query) use ($term) {
                $query->where('name', 'LIKE', "%{$term}%");
            })
            ->latest()
            ->get();

        return view('search-results', [
            'chirps' => $chirps,
            'term' => $term
        ]);
    })->name('search');

    // Perfil do Usuário
    Route::get('/profile/{user}', function (User $user) {
        return view('profile.show', [
            'user' => $user,
            'chirps' => $user->chirps()->with('user')->latest()->get(),
        ]);
    })->name('profile.show');

});

// ROTAS DE AUTENTICAÇÃO (REGISTER)
Route::view('/register', 'auth.register')->middleware('guest')->name('register');
Route::post('/register', Register::class)->middleware('guest');

// LOGOUT
Route::post('/logout', Logout::class)->middleware('auth')->name('logout');

// LOGIN
Route::view('/login', 'auth.login')->middleware('guest')->name('login');
Route::post('login', Login::class)->middleware('guest');