<?php

namespace App\Models;

use CodeIgniter\Model;

class DinasModel extends Model
{
    // public function get_data(){
    //     $apiUrl = 'https://egov.bulelengkab.go.id/api/instansi_utama';
    
    //     // Username dan Password untuk Basic Authentication
    //     $username = 'hadir_rapat';
    //     $password = '@rapatBuleleng1#';
    
    //     // Konfigurasi cURL
    //     $ch = curl_init($apiUrl);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //     curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    
    //     // Eksekusi cURL
    //     $result = curl_exec($ch);
    
    //     // Cek jika ada error dalam pengambilan data
    //     if (curl_errno($ch)) {
    //         echo 'Error: ' . curl_error($ch);
    //     }
    
    //     // Tutup koneksi cURL
    //     curl_close($ch);
    //     // Mengembalikan hasil dekode JSON
    //     return $result;
    // }


    // public function get_instansi_by_id($instansi_id){
    //     $apiUrl = 'https://egov.bulelengkab.go.id/api/instansi_utama';
        
    //     // Username dan Password untuk Basic Authentication
    //     $username = 'hadir_rapat';
    //     $password = '@rapatBuleleng1#';
        
    //     // Konfigurasi cURL
    //     $ch = curl_init($apiUrl);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //     curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        
    //     // Eksekusi cURL
    //     $result = curl_exec($ch);
        
    //     // Cek jika ada error dalam pengambilan data
    //     if (curl_errno($ch)) {
    //         echo 'Error: ' . curl_error($ch);
    //     }
        
    //     curl_close($ch);
        
    //     // Mendecode hasil respons JSON
    //     $data = json_decode($result);
        
    //     // Cari data instansi berdasarkan instansi_id
    //     $instansi = null;
    //     foreach ($data->data as $item) {
    //         if ($item->id_instansi == $instansi_id) {
    //             $instansi = $item;
    //             break;
    //         }
    //     }
        
    //     return $instansi;
    // }

    //  public function getByKet_org($ket_uorg){
    //     $apiUrl = 'https://egov.bulelengkab.go.id/api/instansi_utama';
        
    //     // Username dan Password untuk Basic Authentication
    //     $username = 'hadir_rapat';
    //     $password = '@rapatBuleleng1#';
        
    //     // Konfigurasi cURL
    //     $ch = curl_init($apiUrl);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //     curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        
    //     // Eksekusi cURL
    //     $result = curl_exec($ch);
        
    //     // Cek jika ada error dalam pengambilan data
    //     if (curl_errno($ch)) {
    //         echo 'Error: ' . curl_error($ch);
    //     }
        
    //     curl_close($ch);
        
    //     // Mendecode hasil respons JSON
    //     $data = json_decode($result);
        
    //     // Cari data instansi berdasarkan instansi_id
    //     $instansi = null;
    //     foreach ($data->data as $item) {
    //         if ($item->ket_uorg == $ket_uorg) {
    //             $instansi = $item;
    //             break;
    //         }
    //     }
    //     return $instansi;
    // }
    


    protected $table = 'instansi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','slug', 'name','kode','create_at','update_at'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    
    //cari semua
    public function getAll(){
        
        return $this->findAll();
    }

     public function getById($id)
    {
        return $this->where('id', $id)->first();
    }


    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function getOne(){
        return $this->first();
    }

    public function getKategoriByid($kode)
    {
        return $this->where('kode', $kode)->first();
    }
    public function getAllWithInstansi()
    {
        return $this->db->table($this->table)
            ->select('instansi.*, bidang.nama_perihal')
            ->join('bidang', 'bidang.instansi_id = instansi.id', 'left')
            ->get()
            ->getResultArray();
    }
}