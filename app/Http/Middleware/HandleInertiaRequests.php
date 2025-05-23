<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $data = array_merge(parent::share($request), []);
        
        $data['flash'] = [];
        foreach (Session::all() as $key => $value) {
            $data['flash'][$key] = $value;
        }

        $data['auth'] = [
            'user' => auth()->user() ?? null,
        ];

        $data['ziggy'] = array_merge((new Ziggy)->toArray(), [
            'location' => $request->url(),
        ]);
        return $data;
    }
}
