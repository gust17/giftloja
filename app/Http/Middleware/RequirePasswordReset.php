<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequirePasswordReset
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $route = $request->route()->getName();

        // Verifica se o usuário está autenticado, se a rota não é 'trocar-senha'
        // e se a coluna senha_alterada está definida como false
        if ($request->user() && $route !== 'trocar-senha' && $route !== 'salvar-nova-senha' && !$request->user()->senha_alterada) {
            return redirect()->route('trocar-senha');
        }

        return $next($request);
    }
}
