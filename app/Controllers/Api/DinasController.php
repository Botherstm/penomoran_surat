<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\DinasModel;
use App\Models\UserModel;
use Ramsey\Uuid\Uuid;

class DinasController extends BaseController

{
    protected $dinas;
    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
        $this->dinas = new DinasModel();
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


            $dinas = $this->dinas->getAll();
             if (!$dinas) {
               echo json_encode([
                    'success' => false,
                    'data' => null,
                ]);
            } else {
                 echo json_encode([
                    'success' => true,
                    'data' => $dinas,
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


          $dinas = $this->dinas->getBySlug($slug);
          if (!$dinas) {
               echo json_encode([
                    'success' => false,
                    'data' => null,
                ]);
            } else {
                 echo json_encode([
                    'success' => true,
                    'data' => $dinas,
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
        $urutan = $this->request->getGet('urutan');
        // Lakukan pemeriksaan apakah username sudah terdaftar
        $existingName = $this->dinas->where('name', $name)->first();
        $existingKode = $this->dinas->where('kode', $kode)->first();
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
                'urutan' => $urutan,
            ];
             $result = $this->dinas->insert($bidangData);

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
        $urutan = $this->request->getGet('urutan');

        $existingName = $this->dinas->where('name', $name)->where('id !=', $id)->first();
        $existingKode = $this->dinas->where('kode', $kode)->where('id !=', $id)->first();

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
            // Lakukan update data dinas
            $bidangData = [
                'slug' => $slug,
                'name' => $name,
                'kode' => $kode,
                'urutan' => $urutan,
            ];

            $result = $this->dinas->update($id, $bidangData);

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
        $existingBidang = $this->dinas->find($id);
        if (!$existingBidang) {
            return json_encode([
                'success' => false,
                'data' => 'Data dinas tidak ditemukan',
            ]);
        } else {
            // Lakukan delete data dinas
            $result = $this->dinas->delete($id);

            if ($result) {
                return json_encode([
                    'success' => true,
                    'data' => 'Data dinas berhasil dihapus',
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