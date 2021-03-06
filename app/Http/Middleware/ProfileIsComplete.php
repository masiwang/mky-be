<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class ProfileIsComplete
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    $user = Auth::user();
    if(!$user){
      return redirect('/login');
    }
    if($user->level <5){
      return redirect('/mulai'); 
    }
    return $next($request);
  }
}
