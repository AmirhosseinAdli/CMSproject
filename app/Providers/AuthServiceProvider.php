<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        /**
//         * permissions
//         */
//        Gate::define('delete-user', function (User $auth, User $user) {
//            if (($user->role == 'author' || $user->role == 'publisher' || $user->role == 'guest') || ($auth->role == 'super-admin' && $auth->id != $user->id)) return true;
//        });
//        Gate::define('activate-user',function (User $auth,User $user){
//            if (($user->role == 'author' || $user->role == 'publisher' || $user->role == 'guest') || ($auth->role == 'super-admin' && $auth->id != $user->id)) return true;
//        });
//        Gate::define('give-role',function (User $auth,User $user){
//            if (($user->role == 'author' || $user->role == 'publisher' || $user->role == 'guest') || ($auth->role == 'super-admin' && $auth->id != $user->id)) return true;
//        });
//        Gate::define('create-post',function (User $user,Post $post){
//            if (($user->id == $post->author()->id && $user->role == 'author') || str_contains($user->role, 'admin')) return true;
//        });
//        Gate::define('publish-post',function (User $user){
////            if (($user->id == $post->author()->id && $user->role == 'publisher') || str_contains($user->role, 'admin')) return true;
//            return false;
//       });
//        Gate::define('view-user',function (User $user,Post $post){
//            return $user->rele != 'guest';
//        });
//
//        /**
//         * roles
//         */
//        Gate::define('super_admin',function (User $user){
//            return $user->id == 1 && $user->role == 'super_admin';
//        });
//        Gate::define('admin',function (User $user){
//            return $user->role == 'admin';
//        });
//        Gate::define('author',function (User $user){
//            return $user->role == 'author';
//        });
//        Gate::define('publisher',function (User $user){
//            return $user->role == 'publisher';
//        });
//        Gate::define('guest',function (User $user){
//        return $user->role == 'guest';
//    });
    }
}
