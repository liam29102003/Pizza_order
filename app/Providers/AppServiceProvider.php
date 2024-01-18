<?php

namespace App\Providers;


use App\Models\Contact;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
// use Illuminate\Contracts\Pagination\Paginator;

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
        Paginator::useBootstrapFive();
        
        $rawData = Contact::orderBy('id','desc');
        $unRead = $rawData->where('view','=','no')->get();
        $unReadCount = count($unRead->toArray());
        View::share('count',$unReadCount);
    }
}
