<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    protected $table='projects';
    protected $fillable=[ 
        'user_id',
        'name',	
        'datedebut',
         'datefin',
         'categorie_id',
        'description',
        'statu'
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }
    public function tache(){
        return $this->hasOne('App\tache');
    }
    /**
     * Get the user that owns the project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
   
}
