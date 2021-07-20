<?php

namespace App\Http\Controllers\API;
use App\Peminjam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PeminjamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Peminjam::with('buku')->get();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data'  => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(),[
            "nim"       => "required",
            "nama"      => "required",
            "semester"  => "required|integer",
            "jurusan"   => "required",
            "tgl_pinjam"=> "required",
            "tgl_kembali"=> "required"
        ]);

        if ($validasi->passes()){
            $data = Peminjam::create($request->all());
            return response()->json([
                'pesan' => 'Data Berhasil Ditambahkan',
                'data'  => $data
            ], 200);
        }
        return response()->json([
            'pesan' => 'Data Gagal Ditambahkan',
            'data'  => $validasi->errors()->all()
        ], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Peminjam::where('id', $id)->first();
        if(empty($data)){
            return response()->json([
                'pesan' => 'Data Tidak Ditemukan',
                'data'  => ''
            ], 404);
        }
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data'  => $data
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $data = Peminjam::where('id',$id)->first();
      
      if (empty($data)){
          return response()->json([
              'pesan' => 'Data Tidak Ditemukan',
              'data'  => ''
          ], 404);
      } else {
        $validasi = Validator::make($request->all(),[
            "nim"       => "required",
            "nama"      => "required",
            "semester"  => "required|integer",
            "jurusan"   => "required",
            "tgl_pinjam"=> "required",
            "tgl_kembali"=> "required"
        ]);

        if ($validasi->passes()){
            $data->update($request->all());
            return response()->json([
                'pesan' => "Data Berhasil Disimpan",
                'data'  => $data
            ],200);
        }else{
            return response()->json([
                'pesan' => 'Data Gagal di Update',
                'data'  => $validasi->errors()->all()
            ], 404);        
            }
         } 
      }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Peminjam::where('id',$id)->first();
        if(empty($data)){
            return response()->json([
                'pesan' => 'Data Tidak Ditemukan',
                'data'  => ''
            ], 404);
        }
        $data->delete();
        return response()->json([
            'pesan' => 'Data Berhasil Dihapus',
            'data'  => $data
        ], 200);
    }
}
