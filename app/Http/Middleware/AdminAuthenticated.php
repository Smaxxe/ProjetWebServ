<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //On récupère le role de l'user qui fait la requete
        $role = Auth::user()->role;

        //Si son role est admin, on le laisse continuer
        if (strcmp($role,'admin') == 0) {
            return $next($request);
        }
        //Sinon, on le renvoie à l'acceuil
        return redirect('/')->with('droits', "Vous n avez pas les droits admin pour entrer sur cette page");
    }
}
