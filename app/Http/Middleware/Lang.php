<?php

namespace App\Http\Middleware;

use Closure;
use JavaScript;
use App;
use Auth;
class Lang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('lang')) {
            App::setLocale(session()->get('lang'));
        }
        $trans = [
            'Edit' => trans('glopal.Edit'),
            'success' => trans('glopal.success'),
            'SelectRiquired' => trans('glopal.SelectRiquired'),
        ];
        JavaScript::put([
            'trans' => $trans,
        ]);
        // dd($trans);
        #Auth::user()->Warehouse
        return $next($request);
    }
}
