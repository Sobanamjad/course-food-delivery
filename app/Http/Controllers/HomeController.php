<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $restaurants = Restaurant::all();

        return Inertia::render('Home', [
            'restaurants' => $restaurants,
        ]);
    }
}
