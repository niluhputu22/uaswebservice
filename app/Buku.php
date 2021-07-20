<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    protected $table = 'bukus';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['judul','penerbit','pengarang','tahun','peminjam_id'];

    public function pinjam()
    {
        return $this->belongsTo(Peminjam::class,'peminjam_id');
    }
}
