<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class tache extends Model
{

    use Notifiable;


    protected $table='taches';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'project_id',
        'name',
         'datedebut',
        'datefin',	
        'description',
        'etat_tache'
    ];

    /**
     * Get the user that owns the tache
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    
     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }
   
    public function project(): BelongsTo
    {
        return $this->belongsTo(project::class, 'foreign_key', 'other_key');
    }
    
}
