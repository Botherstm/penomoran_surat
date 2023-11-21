<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\DinasModel;
use App\Models\UserModel;
use Ramsey\Uuid\Uuid;

class BidangController extends BaseController

{
    protected $dinas;
    protected $bidang;
    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
        $this->dinas = new DinasModel();
        $this->bidang = new BidangModel();
    }
     public function index()
    {
        header('Content-Type: application/json');

        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="Autentikasi API"');
            die('Tidak diizinkan');
        }
        $valid_username = $_ENV['username'];
        $valid_password = $_ENV['password'];
        if ($_SERVER['PHP_AUTH_USER'] !== $valid_username || $_SERVER['PHP_AUTH_PW'] !== $valid_password) {
            header('HTTP/1.1 401 Unauthorized');
            die('Kredensial tidak valid');
        }

  
            $bidang = $this->bidang->getAll();
             if (!$bidang) {
               echo json_encode([
                    'success' => false,
                    'data' => null,
                ]);
            } else {
                 echo json_encode([
                    'success' => true,
                    'data' => $bidang,
                ]);
            }
           

    }

    public function getOne()
    {
        header('Content-Type: application/json');

        // Check for basic authentication
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="Autentikasi API"');
            die('Tidak diizinkan');
        }

        // Get valid credentials from environment variables
        $valid_username = $_ENV['username'];
        $valid_password = $_ENV['password'];

        // Validate credentials
        if ($_SERVER['PHP_AUTH_USER'] !== $valid_username || $_SERVER['PHP_AUTH_PW'] !== $valid_password) {
            header('HTTP/1.1 401 Unauthorized');
            die('Kredensial tidak valid');
        }

        
        $slug = $this->request->getGet('slug');


          $bidang = $this->bidang->getBySlug($slug);
          if (!$bidang) {
               echo json_encode([
                    'success' => false,
                    'data' => null,
                ]);
            } else {
                 echo json_encode([
                    'success' => true,
                    'data' => $bidang,
                ]);
            }
  
    }

     public function getAllByInstansiId($instansi_id)
    {
        header('Content-Type: application/json');
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="Autentikasi API"');
            die('Tidak diizinkan');
        }

        // Get valid credentials from environment variables
        $valid_username = $_ENV['username'];
        $valid_password = $_ENV['password'];

        // Validate credentials
        if ($_SERVER['PHP_AUTH_USER'] !== $valid_username || $_SERVER['PHP_AUTH_PW'] !== $valid_password) {
            header('HTTP/1.1 401 Unauthorized');
            die('Kredensial tidak valid');
        }


            $bidangs = $this->bidang->getByInstansiId($instansi_id);
             if($bidangs){
                return json_encode($bidangs);
             }
            else{
               return json_encode([
                    'success' => false,
                    'data' => 'data tidak di temukan',
                ]);
             }
          
 
    }
    

    
    public function create(){
    header('Content-Type: application/json');

        // Check for basic authentication
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="Autentikasi API"');
            die('Tidak diizinkan');
        }

        // Get valid credentials from environment variables
        $valid_username = $_ENV['username'];
        $valid_password = $_ENV['password'];

        // Validate credentials
        if ($_SERVER['PHP_AUTH_USER'] !== $valid_username || $_SERVER['PHP_AUTH_PW'] !== $valid_password) {
            header('HTTP/1.1 401 Unauthorized');
            die('Kredensial tidak valid');
        }
        $uuid = Uuid::uuid4();
        $id = $uuid->toString();

        $instansi_id = $this->request->getGet('instansi_id');
        $slug = $this->request->getGet('slug');
        $name = $this->request->getGet('name');
        $kode = $this->request->getGet('kode');
        // Lakukan pemeriksaan apakah username sudah terdaftar
        $existingName = $this->bidang->where('name', $name)->first();
        $existingKode = $this->bidang->where('kode', $kode)->first();
        if ($existingName) {
        return json_encode([
            'success' => false,
            'data' => 'Nama sudah terdaftar',
        ]);
        }
        elseif($existingKode){
        return json_encode([
            'success' => false,
            'data' => 'Kode sudah terdaftar',
        ]);
        } else {
            // Lakukan registrasi user baru
            $bidangData = [
                'id' => $id,
                'instansi_id' => $instansi_id,
                'slug' => $slug,
                'name' => $name,
                'kode' => $kode,
            ];
             $result = $this->bidang->insert($bidangData);

                if (!$result) {
                    return json_encode([
                        'success' => true,
                        'data' => $bidangData,
                    ]);
                } else {
                    return json_encode([
                        'success' => false,
                        'data' => null,
                    ]);
                }
        }
    }
    public function update()
    {
        header('Content-Type: application/json');

        // Check for basic authentication
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="Autentikasi API"');
            die('Tidak diizinkan');
        }


        $valid_username = $_ENV['username'];
        $valid_password = $_ENV['password'];

        if ($_SERVER['PHP_AUTH_USER'] !== $valid_username || $_SERVER['PHP_AUTH_PW'] !== $valid_password) {
            header('HTTP/1.1 401 Unauthorized');
            die('Kredensial tidak valid');
        }

        $id = $this->request->getGet('id');
        $instansi_id = $this->request->getGet('instansi_id');
        $slug = $this->request->getGet('slug');
        $name = $this->request->getGet('name');
        $kode = $this->request->getGet('kode');

        $existingName = $this->bidang->where('name', $name)->where('id !=', $id)->first();
        $existingKode = $this->bidang->where('kode', $kode)->where('id !=', $id)->first();

        if ($existingName) {
            return json_encode([
                'success' => false,
                'data' => 'Nama sudah terdaftar',
            ]);
        } elseif ($existingKode) {
            return json_encode([
                'success' => false,
                'data' => 'Kode sudah terdaftar',
            ]);
        } else {
            // Lakukan update data bidang
            $bidangData = [
                'instansi_id' => $instansi_id,
                'slug' => $slug,
                'name' => $name,
                'kode' => $kode,
            ];

            $result = $this->bidang->update($id, $bidangData);

            if ($result) {
                return json_encode([
                    'success' => true,
                    'data' => $bidangData,
                ]);
            } else {
                return json_encode([
                    'success' => false,
                    'data' => null,
                ]);
            }
        }
    }

    public function delete()
    {
        header('Content-Type: application/json');

        // Check for basic authentication
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="Autentikasi API"');
            die('Tidak diizinkan');
        }

        // Get valid credentials from environment variables
        $valid_username = $_ENV['username'];
        $valid_password = $_ENV['password'];

        // Validate credentials
        if ($_SERVER['PHP_AUTH_USER'] !== $valid_username || $_SERVER['PHP_AUTH_PW'] !== $valid_password) {
            header('HTTP/1.1 401 Unauthorized');
            die('Kredensial tidak valid');
        }

        $id = $this->request->getGet('id');

        // Cek apakah data bidang dengan ID tertentu ada
        $existingBidang = $this->bidang->find($id);

        if (!$existingBidang) {
            return json_encode([
                'success' => false,
                'data' => 'Data bidang tidak ditemukan',
            ]);
        } else {
            // Lakukan delete data bidang
            $result = $this->bidang->delete($id);

            if ($result) {
                return json_encode([
                    'success' => true,
                    'data' => 'Data bidang berhasil dihapus',
                ]);
            } else {
                return json_encode([
                    'success' => false,
                    'data' => null,
                ]);
            }
        }
    }

}