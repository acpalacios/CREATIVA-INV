<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProductsController extends Controller
{

    public function index()
    {
        return Inertia::render('Products/Index', [
            'filters' => Request::all('search', 'trashed'),
            'products' => Auth::user()->account->organizations()
                ->orderBy('name')
                ->filter(Request::only('search', 'trashed'))
                ->paginate()
                ->withQueryString()
                ->through(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'quantity' => $product->quantity,
                        'description' => $product->description,
                        'unit_cost' => $product->unit_cost,
                        'total_cost' => $product->total_cost,
                        'notes' => $product->notes,
                        'contact' => $product->contact ? $product->contact->only('name') : null,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Products/Create');
    }

    public function store()
    {
        Auth::user()->account->products()->create(
            Request::validate([
                'name' => ['required', 'max:25'],
                'contact_id' => ['nullable'],
                'quantity' => ['required'],
                'description' => ['nullable', 'max:50'],
                'unit_cost' => ['required'],
                'total_cost' => ['required'],
                'notes' => ['nullable', 'max:150'],
            ])
        );

        return Redirect::route('products')->with('success', 'Product created.');
    }
}
