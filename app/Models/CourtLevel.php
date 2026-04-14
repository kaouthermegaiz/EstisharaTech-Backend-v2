<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourtLevel extends Model
{
  public function courts() { return $this->hasMany(Court::class, 'level_id'); }
}
