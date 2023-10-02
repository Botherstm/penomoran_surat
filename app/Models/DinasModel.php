<?php

namespace App\Models;

use CodeIgniter\Model;

class DinasModel extends Model
{
    public function get_data(){
        $apiUrl = 'https://egov.bulelengkab.go.id/api/instansi_utama';
    
        // Username dan Password untuk Basic Authentication
        $username = 'hadir_rapat';
        $password = '@rapatBuleleng1#';
    
        // Konfigurasi cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    
        // Eksekusi cURL
        $result = curl_exec($ch);
    
        // Cek jika ada error dalam pengambilan data
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }
    
        // Tutup koneksi cURL
        curl_close($ch);
        
        // Mengembalikan hasil dekode JSON
        return $result;
    }

    public function instansi()
    {
        return $this->hasMany('App\Models\AlbumModel', 'instansi_id');
    }
}