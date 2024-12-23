<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = ['report_id', 'response_status', 'response_progress'];

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class);
    }

    public function progress()
    {
        return $this->hasMany(ResponseProgress::class);
    }
}