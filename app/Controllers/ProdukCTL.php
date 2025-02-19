<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProdukModel;

class ProdukCTL extends BaseController
{
    public function __construct()
    {
        $this->produk = new ProdukModel();
    }

    public function getDetails(){
        $id = $this->request->getPost();

        $data =  $this->produk->find($id);

        if($data){
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Data berhasil ditemukan',
                'data'    => $data
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'failed',
            'message' => 'Data tidak ditemukan'
        ]);
        
    }

    public function addMenu(){
        $data = $this->request->getPost();

        // Contoh: Akses data individual
        // $namaProduk = $data['Nama_Produk'];
        // $rasa       = $data['Rasa'];
        // ... dan seterusnya

        // Lakukan proses validasi, penyimpanan ke database, dsb.
        // Misalnya: $this->itemsModel->save($data);

        $file = $this->request->getFile('Gambar_Produk');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('images/', $newName);
        } else {
            $newName = 'sample-food.png';
        }

        $data['Gambar_Produk'] = $newName;

        $insert = $this->produk->insert($data);
        
        if ($insert) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Data berhasil disimpan',
                'insert_id' => $this->produk->getInsertID()
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Data gagal disimpan'
            ]);
        }
    }

    public function updateProduk(){
        $data = $this->request->getPost();
        if (empty($data['Produk_id'])) {
            return $this->response->setJSON([
                'status'  => 'failed',
                'message' => 'Produk ID tidak ditemukan'
            ]);
        }

        $produkLama = $this->produk->find($data['Produk_id']);
        $gambarLama = $produkLama['Gambar_Produk'];

        $file = $this->request->getFile('Gambar_Produk');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (file_exists('images/' . $gambarLama)) {
                unlink('images/' . $gambarLama);
            }

            $newName = $file->getRandomName();
            $file->move('images/', $newName);
            $data['Gambar_Produk'] = $newName;
        } else {
            $data['Gambar_Produk'] = $gambarLama;
        }

        $updateData = [
            'Nama_Produk' => $data['Nama_Produk'] ?? '',
            'Rasa'        => $data['Rasa'] ?? '',
            'Harga'       => $data['Harga'] ?? 0,
            'Star'        => $data['Star'] ?? 0,
            'Deskripsi'   => $data['Deskripsi'] ?? '',
            'Waktu'       => $data['Waktu'] ?? 0,
            'Category_id' => $data['Category_id'] ?? 0,
            'Stok'        => $data['Stok'] ?? 0,
            'Gambar_Produk' => $data['Gambar_Produk'],
        ];

        $updated = $this->produk->update($data['Produk_id'], $updateData);
        if ($updated) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Produk berhasil diubah'
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => 'failed',
                'message' => 'Produk gagal diubah'
            ]);
        }
    }

    public function deleteProduk($id){
        $product =  $this->produk->find($id);  
        if (!$product) {  
            return $this->response->setJSON([  
                'status'  => 'failed',   
                'message' => 'Produk tidak ditemukan'  
            ]);  
        }

        $gambarProduk = $product['Gambar_Produk'];
        if ($gambarProduk) {
            if ($gambarProduk !== 'sample-food.png') {
                $pathGambar = 'images/' . $gambarProduk;
                if (file_exists($pathGambar)) {
                    unlink($pathGambar);
                }
            }
        }

        try {  
            $result = $this->produk->delete($id);  

            if ($result) {  
                return $this->response->setJSON([  
                    'status'  => 'success',    
                    'message' => 'Produk berhasil dihapus'  
                ]);  
            } else {  
                return $this->response->setJSON([  
                    'status'  => 'failed',   
                    'message' => 'Gagal menghapus produk'  
                ]);  
            }  
        } catch (\Exception $e) {  
                return $this->response->setJSON([  
                    'status'  => 'failed',  
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()  
                ]);  
        }
    }
}
