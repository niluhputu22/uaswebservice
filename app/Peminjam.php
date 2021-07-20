<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class peminjam extends Model
{
    protected $table = 'peminjams';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['nim','nama','semester','jurusan','tgl_pinjam','tgl_kembali'];

    public function buku()
    {
        return $this->hasMany(Buku::class);
    }
}
