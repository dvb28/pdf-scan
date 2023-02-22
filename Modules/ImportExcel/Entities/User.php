<?php

namespace Modules\ImportExcel\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class User extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\ImportExcel\Database\factories\UserFactory::new();
    }

    public function insert($data) {

        // Import dữ liệu file excel
        try {
            DB::table('users')->insert($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        dd($request);
    }

}
