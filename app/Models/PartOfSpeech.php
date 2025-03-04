<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartOfSpeech extends Model
{
    /** @use HasFactory<\Database\Factories\PartOfSpeechFactory> */
    use HasFactory;

    protected $table = 'parts_of_speech';
}
