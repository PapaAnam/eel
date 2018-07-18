<?php

namespace App\Models\Altius;

use Illuminate\Database\Eloquent\Model;

class MasterDraftSO extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'dbo.MasterDraftSO';
}
