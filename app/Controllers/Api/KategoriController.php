<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\KategoryModel;
use App\Models\UserModel;
use Ramsey\Uuid\Uuid;

class KategoriController extends BaseController

{
    protected $kategori;

    public function __construct()
    {
        $this->kategori = new KategoryModel();
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


            $kategori = $this->kategori->getAll();
             if (!$kategori) {
               return json_encode([
                    'success' => false,
                    'data' => null,
                ]);
            } else {
                 return json_encode([
                    'success' => true,
                    'data' => $kategori,
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
        $kategori = $this->kategori->getBySlug($slug);
        if (!$kategori) {
            return json_encode([
                'success' => false,
                'data' => null,
            ]);
        } else {
             return json_encode([
                'success' => true,
                'data' => $kategori,
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
        $slug = $this->request->getGet('slug');
        $name = $this->request->getGet('name');
        $kode = $this->request->getGet('kode');
       
        // Lakukan pemeriksaan apakah username sudah terdaftar
        $existingName = $this->kategori->where('name', $name)->first();
        $existingKode = $this->kategori->where('kode', $kode)->first();
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
                'slug' => $slug,
                'name' => $name,
                'kode' => $kode,
            ];
             $result = $this->kategori->insert($bidangData);

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
        $slug = $this->request->getGet('slug');
        $name = $this->request->getGet('name');
        $kode = $this->request->getGet('kode');
       

        $existingName = $this->kategori->where('name', $name)->where('id !=', $id)->first();
        $existingKode = $this->kategori->where('kode', $kode)->where('id !=', $id)->first();

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
            // Lakukan update data kategori
            $bidangData = [
                'slug' => $slug,
                'name' => $name,
                'kode' => $kode,
            ];

            $result = $this->kategori->update($id, $bidangData);

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
        $existingBidang = $this->kategori->find($id);
        if (!$existingBidang) {
            return json_encode([
                'success' => false,
                'data' => 'Data kategori tidak ditemukan',
            ]);
        } else {
            // Lakukan delete data kategori
            $result = $this->kategori->delete($id);

            if ($result) {
                return json_encode([
                    'success' => true,
                    'data' => 'Data kategori berhasil dihapus',
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