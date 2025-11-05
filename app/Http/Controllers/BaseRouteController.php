<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseRouteController extends Controller
{
    public function page($slug = null)
    {
        // Define your slug → view name mappings (SEO-friendly aliases)
        $pages = [
            null           => 'index',
            '/'            => 'index',
            'home'         => 'index',
            'about'        => 'about',
            'about-us'     => 'about',
            'services'     => 'services',
            'our-services' => 'services',
            'portfolio'    => 'portfolio',
            'projects'     => 'portfolio',
            'contact'      => 'contact',
            'contact-us'   => 'contact',
        ];

        // Check if the slug exists in the mapping
        if (array_key_exists($slug, $pages)) {
            return view($pages[$slug]);
        }

        // Check if a view with the same name exists (fallback)
        if ($slug && view()->exists($slug)) {
            return view($slug);
        }

        // Otherwise, 404
        abort(404);
    }
}
