<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class views extends Model
{
    use HasFactory;
    protected $table='views';

    public function incrementviewCount() {
        $view = $this::where('id' , '1')->first();
        $view->views += 1;
        return $view->save();
    }
}
