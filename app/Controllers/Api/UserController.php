<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\DinasModel;
use App\Models\UserModel;
use Ramsey\Uuid\Uuid;

class UserController extends BaseController

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

       try {
            $users = $this->user->getAll();
            return json_encode($users);
        } catch (\Exception $e) {
            // Handle the exception (e.g., log the error, show a custom message, etc.)
            die("Error: " . $e->getMessage());
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
        try {
          $users = $this->user->getBySlug($slug);
            // Convert the result to JSON and echo it
            return json_encode($users);
        } catch (\Exception $e) {
            die("Error: " . $e->getMessage());
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

        try {
            $users = $this->user->getByInstansiId($instansi_id);
            // Convert the result to JSON and echo it
            return json_encode($users);
        } catch (\Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }
    

    public function login()
    {
        header('Content-Type: application/json');

        // Ambil data dari query string
        $username = $this->request->getGet('username');
        $password = $this->request->getGet('password');
            $user = $this->user->where('username', $username)->first();
            // Convert the result to JSON and echo it
            if ($user && password_verify($password, $user['password'])) {
                $userData = [
                    'id' => $user['id'],
                    'instansi_id' => $user['instansi_id'],
                    'bidang_id' => $user['bidang_id'],
                    'slug' => $user['slug'],
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'gambar' => $user['gambar'],
                    'no_hp' => $user['no_hp'],
                    'password' => $user['password'],
                    'level' => $user['level'],
                ];
                echo json_encode($userData);
            } else {
                // Login gagal
                echo json_encode([
                    'error' => 'Invalid credentials',
                ]);
            }
    }

    public function register(){
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
        $bidang_id = $this->request->getGet('bidang_id');
        $slug = $this->request->getGet('slug');
        $name = $this->request->getGet('name');
        $username = $this->request->getGet('username');
        $gambar = $this->request->getGet('gambar');
        $no_hp = $this->request->getGet('no_hp');
        $password = $this->request->getGet('password');
        $level = $this->request->getGet('level');

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Lakukan pemeriksaan apakah username sudah terdaftar
        $existingUser = $this->user->where('username', $username)->first();

        if ($existingUser) {
        echo json_encode([
            'success' => false,
            'message' => 'Email already exists.',
        ]);
        } else {
            // Lakukan registrasi user baru
            $userData = [
                'id' => $id,
                'instansi_id' => $instansi_id,
                'bidang_id' => $bidang_id,
                'slug' => $slug,
                'name' => $name,
                'username' => $username,
                'gambar' => $gambar,
                'no_hp' => $no_hp,
                'password' => $hashedPassword,
                'level' => $level,
            ];
             $result = $this->user->insert($userData);

              if (!$result) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Registration successful.',
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to register user.',
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
        $existingBidang = $this->user->find($id);

        if (!$existingBidang) {
            return json_encode([
                'success' => false,
                'data' => 'Data bidang tidak ditemukan',
            ]);
        } else {
            // Lakukan delete data bidang
            $result = $this->user->delete($id);

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