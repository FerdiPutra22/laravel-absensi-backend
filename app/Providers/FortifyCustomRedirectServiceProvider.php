<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;

class FortifyCustomRedirectServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Redirect setelah login sukses
        Fortify::authenticateUsing(function (Request $request) {
            // Login logic di sini (kalau mau custom login, misalnya status user)
            return \App\Models\User::where('email', $request->email)->first();
        });

        // Redirect setelah login berhasil
        $this->app->singleton(\Laravel\Fortify\Contracts\LoginResponse::class, function () {
            return new class implements \Laravel\Fortify\Contracts\LoginResponse {
                public function toResponse($request)
                {
                    return redirect('/users'); // Ganti dengan halaman tujuanmu
                }
            };
        });
    }
}
