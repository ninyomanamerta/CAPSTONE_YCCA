<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\peminjaman_buku_pengayaan;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $today = Carbon::now();
            $terlambatCount = peminjaman_buku_pengayaan::where('status', 'dipinjam')
                ->whereDate('tgl_pinjam', '<=', $today->subDays(7))
                ->count();

            $view->with('terlambatCount', $terlambatCount);
        });
    }
}
