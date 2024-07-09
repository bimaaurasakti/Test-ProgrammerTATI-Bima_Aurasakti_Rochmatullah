<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        // dd($response->getContent());

        $fullMessage = $response->getContent() ?? '';
        $lines = explode("\n", $fullMessage);
        $truncatedMessage = implode("\n", array_slice($lines, 0, 15));

        if ($response->isServerError() || $response->isClientError()) {
            Log::channel('custom')->error('Error occurred during request processing.', [
                'host' => gethostname(),
                'protocol' => $request->server('SERVER_PROTOCOL'),
                'remote_address' => $request->server('REMOTE_ADDR'),
                'endpoint' => $request->url(),
                'input' => $request->all(),
                'message' => $response->exception ?? $truncatedMessage,
                'full_message' => $truncatedMessage
            ]);
        }

        return $response;
    }
}
