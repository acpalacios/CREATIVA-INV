<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ReportsController extends Controller
{
  public function index()
  {
    return Inertia::render('Reports/Index', [
      'products' => Auth::user()
        ->account->products()
        ->orderBy('name')
        ->filter(Request::only('search'))
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
            'material' => $product->material,
            'unity' => $product->unity,
            'color' => $product->color,
            'classification' => $product->classification,
            'notes' => $product->notes,
            'contact' => $product->contact ? $product->contact->only('name') : null,
          ];
        }),
    ]);
  }
}
