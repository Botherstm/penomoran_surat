<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\PerihalModel;
use Ramsey\Uuid\Uuid;

class PerihalController extends BaseController

{
    protected $perihal;

    public function __construct()
    {
        $this->perihal = new PerihalModel();
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


            $perihal = $this->perihal->getAll();
             if (!$perihal) {
               return json_encode([
                    'success' => false,
                    'data' => null,
                ]);
            } else {
                 return json_encode([
                    'success' => true,
                    'data' => $perihal,
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
        $perihal = $this->perihal->getBySlug($slug);
        if (!$perihal) {
            return json_encode([
                'success' => false,
                'data' => null,
            ]);
        } else {
             return json_encode([
                'success' => true,
                'data' => $perihal,
            ]);
        }

    }

    public function getAllByDetailId()
    {
        // header('Content-Type: application/json');
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
            $perihal = $this->perihal->getByKategori_id($id);
             if($perihal){
                 return json_encode([
                    'success' => true,
                    'data' => $perihal,
                ]);
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
        $detail_id = $this->request->getGet('detail_id');
        $slug = $this->request->getGet('slug');
        $name = $this->request->getGet('name');
        $kode = $this->request->getGet('kode');
       
        // Lakukan pemeriksaan apakah username sudah terdaftar
        $existingName = $this->perihal->where('name', $name)->first();
        $existingKode = $this->perihal->where('kode', $kode)->first();
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
            $perihalData = [
                'id' => $id,
                'detail_id' => $detail_id,
                'slug' => $slug,
                'name' => $name,
                'kode' => $kode,
            ];
             $result = $this->perihal->insert($perihalData);

                if (!$result) {
                    return json_encode([
                        'success' => true,
                        'data' => $perihalData,
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
        $detail_id = $this->request->getGet('detail_id');
        $slug = $this->request->getGet('slug');
        $name = $this->request->getGet('name');
        $kode = $this->request->getGet('kode');
       

        $existingName = $this->perihal->where('name', $name)->where('id !=', $id)->first();
        $existingKode = $this->perihal->where('kode', $kode)->where('id !=', $id)->first();

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
            $bidangData = [
                'detail_id' => $detail_id,
                'slug' => $slug,
                'name' => $name,
                'kode' => $kode,
            ];

            $result = $this->perihal->update($id, $bidangData);

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
        $existingBidang = $this->perihal->find($id);
        if (!$existingBidang) {
            return json_encode([
                'success' => false,
                'data' => 'Data perihal tidak ditemukan',
            ]);
        } else {
            // Lakukan delete data perihal
            $result = $this->perihal->delete($id);

            if ($result) {
                return json_encode([
                    'success' => true,
                    'data' => 'Data perihal berhasil dihapus',
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