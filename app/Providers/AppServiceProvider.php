<?php

namespace App\Providers;

use App\Models\Basket;
use App\Models\BasketDetails;
use App\Models\Comment;
use App\Models\Contact;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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

        View::composer('admin.layouts.header', function ($view) {
            $view->with('CommentDraft', Comment::getAllUserCommentDraft());
            $view->with('ContactMessages', Contact::getAllUserContactMessages());
        });

        View::composer('home.layouts.header', function ($view) {
            $basketCount = 0;

            if (Auth::check()) {
                $basketCount = Basket::where('user_id', Auth::id())->count();
            }

            $view->with('orderCount', $basketCount);
        });
    }
}


