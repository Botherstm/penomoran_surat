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


    public function get_instansi_by_id($instansi_id){
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
        
        // Mendecode hasil respons JSON
        $data = json_decode($result);
        
        // Cari data instansi berdasarkan instansi_id
        $instansi = null;
        foreach ($data->data as $item) {
            if ($item->id_instansi == $instansi_id) {
                $instansi = $item;
                break; // Data ditemukan, keluar dari loop
            }
        }
        
        // Mengembalikan data instansi
        return $instansi;
    }


    public function get_one_instansi_by_id($instansi_id) {
        $apiUrl = 'https://egov.bulelengkab.go.id/api/instansi_utama';
        $username = 'hadir_rapat';
        $password = '@rapatBuleleng1#';
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        $result = curl_exec($ch);
        
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }
        
        curl_close($ch);
        
        $data = json_decode($result);
        
        $instansi = null;
        
        foreach ($data->data as $item) {
            if ($item->id_instansi == $instansi_id) {
                $instansi = $item; // Mengambil nama instansi
                break;
            }
        }

        return $instansi;
    }
    
}