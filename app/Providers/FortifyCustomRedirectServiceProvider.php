<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class FortifyCustomRedirectServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Custom login logic: autentikasi dengan email dan password
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            return null; // login gagal jika user tidak ditemukan atau password salah
        });

        // Redirect setelah login berhasil
        $this->app->singleton(\Laravel\Fortify\Contracts\LoginResponse::class, function () {
            return new class implements \Laravel\Fortify\Contracts\LoginResponse {
                public function toResponse($request)
                {
                    return redirect('/users'); // Redirect ke halaman sesuai kebutuhan
                }
            };
        });
    }
}
