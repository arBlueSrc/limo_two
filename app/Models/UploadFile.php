<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    use HasFactory;
    protected $table = 'upload_file';
    protected $fillable = ['single_result_id', 'path', 'type'];

    public function singleResultItem()
    {
        return SingleResult::find($this->single_result_id);
    }
}
