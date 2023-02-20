<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','title', 'logo', 'tags', 'company', 'location', 'email', 'website', 'description'];

    public function scopeFilter($query, array $filters) {
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . $filters['tag'] . '%');
        }
        
        if($filters['search'] ?? false) {
            $query->where('tags', 'like', '%' . $filters['search'] . '%')
                ->orwhere('title', 'like', '%' . $filters['search'] . '%')
                ->orwhere('company', 'like', '%' . $filters['search'] . '%')
                ->orwhere('location', 'like', '%' . $filters['search'] . '%')
                ->orWhere('description', 'like', '%' . $filters['search'] . '%');
        }
    }

    // Relatoinship to User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
