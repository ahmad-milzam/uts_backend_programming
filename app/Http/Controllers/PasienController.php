<?php

namespace App\Http\Controllers;

use App\Models\pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    //
    public function index()
    {
        # menggunakan model pasien untuk select data
        $pasien = pasien::all();

        if ($pasien) {
            $data = [
                'message' => 'Get All Resource',
                'data' => $pasien
            ];

            # mengirim data (json) dan kode 200
            return response()->json($data, 200);
        } else {
            $data_empty = [
                'message' => 'Data is empty'
            ];
            # mengirim data (json) dan kode 200
            return response()->json($data_empty, 200);
        }
    }

    public function store(Request $request)
    {
        $pasien = array(
            'name' => "required",
            'phone' => "required|numeric",
            'address' => "required",
            'status' => "required",
            'in_date_at' => "required"
        );
        $validator = Validator::make($request->all(), $pasien);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else {
            $input = [
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => $request->status,
                'in_date_at' => $request->in_date_at,
                'out_date_at' => $request->out_date_at
            ];
            $result= pasien::create($input);
            if ($result) {
                $data = [
                    "Result" => "Resource is added successfully",
                    "Data" => $result
                ];
                return response()->json($data, 201);
            } else {
                return ["Result" => "Operation Failed"];
            }
        }
        // $validated = $request->safe()->only(['name', 'phone', 'address', '']);
    }
    public function show ($id)
    {
        # menggunakan model pasien untuk select data by id
        $pasien = pasien::find($id);

        if ($pasien){
            // echo 'data ada';
            $data = [
                'message' => 'Get Detail Resource',
                'data' => $pasien
            ];
            # mengembalikan data (json) dan kode 200
            return response()->json($data, 200);
        } else {
            // echo 'data tidak ada';
            $data = [
                'message' => 'Resource Not Found'
            ];
            # mengembalikan data (json) dan kode 404
            return response()->json($data, 404);
        }
    }
        # method update
        public function update(Request $request, $id)
        {
            # cari id pasien yang ingin diupdate
            $pasien = pasien::find($id);
    
            if ($pasien) {
                # menangkap data request
                $input = [
                    'name' => $request->name ?? $pasien->name,
                    'phone' => $request->phone ?? $pasien->phone,
                    'address' => $request->address ?? $pasien->address,
                    'status' => $request->status ?? $pasien->status,
                    'in_date_at' => $request->in_date_at ?? $pasien->in_date_at,
                    'out_date_at' => $request->out_date_at ?? $pasien->out_date_at
                ];
    
                # melakukan update data
                $pasien->update($input);
    
                $data = [
                    'message' => 'Resource is update successfully',
                    'data' => $pasien
                ];
    
                # mengembalikan data (json) dan kode 200
                return response()->json($data, 200);
            } else {
                $data = [
                    'message' => 'Resource not found'
                ];
                # mengembalikan data (json) dan kode 404
                return response()->json($data, 404);
            }
        }

        public function destroy($id)
        {
            # cari id pasien yang ingin dihapus
            $pasien = pasien::find($id);
    
            if ($pasien) {
                # hapus pasien tersebut
                $pasien->delete();
    
                $data = [
                    'message' => 'Resource is deleted succesfully'
                ];
    
                # mengembalikan data (json) dan kode 200
                return response()->json($data, 200);
            } else {
                $data = [
                    'message' => 'Resource is not found'
                ];
    
                return response()->json($data, 404);
            }
        }

        public function search($name)
        {
            # menggunakan model pasien untuk select data
            $pasien = pasien::where('name', $name)->get() ;
    
            if($pasien->isNotEmpty()) {
                $data = [
                    'message' => 'Get searched resource',
                    'data' => $pasien
                ];
                # mengirim data (json) dan kode 200
                return response()->json($data, 200);
            }else {
                $data = [
                    'message' => 'Resource not found'
                ];
                # mengirim data (json) dan kode 404
                return response()->json($data, 404);
            }

            // echo $pasien;
        }

        public function positive()
        {
            # menggunakan model pasien untuk select data
            $pasien = pasien::where('status', 'positive')->get(); //get pasien status = 'positive'
            $count = pasien::where('status', 'positive')->count(); //hitung data
    
            if($pasien->isNotEmpty()) {
                $data = [
                    'message' => 'Get searched resource',
                    'total' => $count,
                    'data' => $pasien
                ];
                # mengirim data (json) dan kode 200
                return response()->json($data, 200);
            }else {
                $data = [
                    'message' => 'Resource not found'
                ];
                # mengirim data (json) dan kode 404
                return response()->json($data, 404);
            }

            // echo $pasien;
        }

        public function recovered()
        {
            # menggunakan model pasien untuk select data
            $pasien = pasien::where('status', 'negative')->get(); //get pasien status 'negative'
            $count = pasien::where('status', 'negative')->count(); //hitung data
    
            if($pasien->isNotEmpty()) {
                $data = [
                    'message' => 'Get searched resource',
                    'total' => $count,
                    'data' => $pasien
                ];
                # mengirim data (json) dan kode 200
                return response()->json($data, 200);
            }else {
                $data = [
                    'message' => 'Resource not found'
                ];
                # mengirim data (json) dan kode 404
                return response()->json($data, 404);
            }

            // echo $pasien;
        }

        public function dead()
        {
            # menggunakan model pasien untuk select data
            $pasien = pasien::where('status', 'dead')->get(); //get pasien status = 'dead'
            $count = pasien::where('status', 'dead')->count(); //hitung data
    
            if($pasien->isNotEmpty()) {
                $data = [
                    'message' => 'Get searched resource',
                    'total' => $count,
                    'data' => $pasien
                ];
                # mengirim data (json) dan kode 200
                return response()->json($data, 200);
            }else {
                $data = [
                    'message' => 'Resource not found'
                ];
                # mengirim data (json) dan kode 404
                return response()->json($data, 404);
            }

            // echo $pasien;
        }
}
