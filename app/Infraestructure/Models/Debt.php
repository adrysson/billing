<?php

namespace App\Infraestructure\Models;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $fillable = [
        'id',
        'amount',
        'due_date',
        'debtor_name',
        'debtor_email',
        'debtor_government_id',
        'status',
];

    protected function casts(): array
    {
        return [
            'created_at' => 'date',
        ];
    }
}
