<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;

class PagesController extends Controller
{
    public function index() 
    { 
        return Inertia::render('Landing/Index'); // resources\js\Pages\Landing\Index.vue
    }

    
    public function about()  
    {  
        return Inertia::render('Landing/About');  // resources\js\Pages\Landing\About.vue
    }
}
