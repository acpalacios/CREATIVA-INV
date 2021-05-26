<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
  use SoftDeletes;

  public function organization()
  {
    return $this->belongsTo(Organization::class);
  }

  public function scopeFilter($query, array $filters)
  {
    $query
      ->when($filters['search'] ?? null, function ($query, $search) {
        $query->where(function ($query) use ($search) {
          $query
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhereHas('organization', function ($query) use ($search) {
              $query->where('name', 'like', '%' . $search . '%');
            });
        });
      })
      ->when($filters['trashed'] ?? null, function ($query, $trashed) {
        if ($trashed === 'with') {
          $query->withTrashed();
        } elseif ($trashed === 'only') {
          $query->onlyTrashed();
        }
      });
  }
}
