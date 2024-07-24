<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesmen extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'code', 'parent_id', 'level'
    ];

    public function children()
    {
        return $this->hasMany(Salesmen::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Salesmen::class, 'parent_id', 'id');
    }
    public function parentsUpToLevel($level)
    {
        $query = $this->newQuery();

        for ($i = 1; $i <= $level; $i++) {
            $query->with('parent');
            $query->whereHas('parent');
        }

        return $query;
    }
}
