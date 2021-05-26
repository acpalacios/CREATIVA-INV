<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ContactsController extends Controller
{
  public function index()
  {
    return Inertia::render('Contacts/Index', [
      'filters' => Request::all('search', 'trashed'),
      'contacts' => Auth::user()
        ->account->contacts()
        ->with('organization')
        ->filter(Request::only('search', 'trashed'))
        ->paginate()
        ->withQueryString()
        ->through(function ($contact) {
          return [
            'id' => $contact->id,
            'name' => $contact->name,
            'phone' => $contact->phone,
            'email' => $contact->email,
            'address' => $contact->address,
            'city' => $contact->city,
            'deleted_at' => $contact->deleted_at,
            'organization' => $contact->organization ? $contact->organization->only('name') : null,
          ];
        }),
    ]);
  }

  public function create()
  {
    return Inertia::render('Contacts/Create', [
      'organizations' => Auth::user()
        ->account->organizations()
        ->orderBy('name')
        ->get()
        ->map->only('id', 'name'),
    ]);
  }

  public function store()
  {
    Auth::user()
      ->account->contacts()
      ->create(
        Request::validate([
          'name' => ['required', 'max:50'],
          'email' => ['required', 'max:50'],
          'phone' => ['nullable', 'max:50'],
          'address' => ['nullable', 'max:150'],
        ])
      );

    return Redirect::route('contacts')->with('success', 'Proveedor agregado.');
  }

  public function edit(Contact $contact)
  {
    return Inertia::render('Contacts/Edit', [
      'contact' => [
        'id' => $contact->id,
        'name' => $contact->name,
        'email' => $contact->email,
        'phone' => $contact->phone,
        'address' => $contact->address,
        'deleted_at' => $contact->deleted_at,
      ],
      'organizations' => Auth::user()
        ->account->organizations()
        ->orderBy('name')
        ->get()
        ->map->only('id', 'name'),
    ]);
  }

  public function update(Contact $contact)
  {
    $contact->update(
      Request::validate([
        'name' => ['required', 'max:50'],
        'email' => ['required', 'max:50'],
        'phone' => ['nullable', 'max:50'],
        'address' => ['nullable', 'max:150'],
      ])
    );

    return Redirect::back()->with('success', 'Proveedor actualizado.');
  }

  public function destroy(Contact $contact)
  {
    $contact->delete();

    return Redirect::back()->with('success', 'Proveedor eliminado.');
  }

  public function restore(Contact $contact)
  {
    $contact->restore();

    return Redirect::back()->with('success', 'Proveedor restored.');
  }
}
