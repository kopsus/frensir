<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminDashboardCTL extends BaseController
{
    public function __construct(){
        $this->account = new \App\Models\UserModel();
        $this->produk = new \App\Models\ProdukModel();
        $this->order = new  \App\Models\OrderModel();
        $this->detail_order = new \App\Models\OrderDetailsModel();
    }

    public function index()
    {
        return view('admin/dashboard', ['activePage' => 'dashboard']);
    }

    public function account()
    {
        $data = $this->account->findAll();
        return view('admin/account', ['activePage' => 'account', 'data' => $data]); 
    }

    public function getAccount(){
        $id = $this->request->getPost();
        $data =  $this->account->find($id);

        if($data){
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Account berhasil ditemukan',
                'data'    => $data
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'failed',
            'message' => 'Account tidak ditemukan'
        ]);
    }

    public function createAccount(){
        $data = $this->request->getPost();
        $columns = [
            'Username'  => $data['username'] ?? '',
            'Email'     => $data['email'] ?? '',
            'Role'      => $data['role'],
            'Password'  => password_hash($data['password'], PASSWORD_DEFAULT) ?? 0,
        ];

        $insert = $this->account->insert($columns);
        
        if ($insert) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Account berhasil dibuat',
                'insert_id' => $this->account->getInsertID()
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Account gagal dibuat'
            ]);
        }
    }

    public function updateAccount(){
        $data = $this->request->getPost();

        if (empty($data['user_id'])) {
            return $this->response->setJSON([
                'status'  => 'failed',
                'message' => 'Account ID tidak ditemukan'
            ]);
        }

        $updateData = [
            'Username'  => $data['username'] ?? '',
            'Email'     => $data['email'] ?? '',
            'Role'      => $data['role'],
            'Password'  => password_hash($data['password'], PASSWORD_DEFAULT) ?? 0,
        ];

        $updated = $this->account->update($data['user_id'], $updateData);
        if ($updated) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Account berhasil diubah'
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => 'failed',
                'message' => 'Account gagal diubah'
            ]);
        }
    }

    public function deleteAccount($id){
        $account = $this->account->find($id); 
        if (!$account) {  
            return $this->response->setJSON([  
                'status'  => 'failed',   
                'message' => 'Account tidak ditemukan'  
            ]);  
        }
        try {  
            $result = $this->account->delete($id);  

            if ($result) {  
                return $this->response->setJSON([  
                    'status'  => 'success',    
                    'message' => 'Account berhasil dihapus'  
                ]);  
            } else {  
                return $this->response->setJSON([  
                    'status'  => 'failed',   
                    'message' => 'Account menghapus produk'  
                ]);  
            }  
        } catch (\Exception $e) {  
                return $this->response->setJSON([  
                    'status'  => 'failed',  
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()  
                ]);  
        }
    }

    public function menu(){
        $data = $this->produk->findAll();
        return view('admin/menu', ['activePage' => 'menu', 'data' => $data]); 
    }

    public function payment(){
        $data = $this->order->orderBy('Order_id', 'DESC')->findAll();
        return view('admin/payment', ['activePage' => 'payment', 'data' => $data]); 
    }

    // public function getDetailPayment()
    // {
    //     if(!$this->request->isAJAX()){
    //         return redirect()->to('/');
    //     }
        
    //     $orderCode = $this->request->getPost('order_code');
    //     if(empty($orderCode)){
    //         return $this->response->setStatusCode(400)->setBody('Order code tidak valid');
    //     }
        
    //     $order = $this->order->where('Order_Code', $orderCode)->first();
    //     if(!$order){
    //         return $this->response->setStatusCode(404)->setBody('Order tidak ditemukan');
    //     }
        
    //     $orderId = $order['Order_id'];
    //     $details = $this->detail_order->where('Order_id', $orderId)->findAll();
    //     $detailsData = [];
    //     foreach ($details as $detail) {
    //         $produk = $this->produk->find($detail['Produk_id']);
    //         if ($produk) {
    //             $detailsData[] = [
    //                 'namaProduk' => $produk['Nama_Produk'],
    //                 'harga'      => $produk['Harga'],
    //                 'jumlah'     => $detail['Jumlah_Produk'],
    //                 'total'      => $produk['Harga'] * $detail['Jumlah_Produk'],
    //             ];
    //         }
    //     }
    //     return $this->response->setJSON($detailsData);
    // }

    public function getDetailPayment()
    {
        if(!$this->request->isAJAX()){
            return redirect()->to('/');
        }
        
        $orderCode = $this->request->getPost('order_code');
        if(empty($orderCode)){
            return $this->response->setStatusCode(400)->setBody('Order code tidak valid');
        }
        
        $order = $this->order->where('Order_Code', $orderCode)->first();
        if(!$order){
            return $this->response->setStatusCode(404)->setBody('Order tidak ditemukan');
        }
        
        $orderId = $order['Order_id'];
        $details = $this->detail_order->where('Order_id', $orderId)->findAll();
        
        $detailsData = [];
        $subtotal = 0;
        
        foreach ($details as $detail) {
            $produk = $this->produk->find($detail['Produk_id']);
            if ($produk) {
                $totalItem = $produk['Harga'] * $detail['Jumlah_Produk'];
                $subtotal += $totalItem;
                
                $detailsData[] = [
                    'namaProduk' => $produk['Nama_Produk'],
                    'harga'      => $produk['Harga'],
                    'jumlah'     => $detail['Jumlah_Produk'],
                    'total'      => $totalItem,
                ];
            }
        }

        $tax = $subtotal * 0.10;
        $total = $subtotal + $tax;

        return $this->response->setJSON([
            'details'  => $detailsData,
            'subtotal' => $subtotal,
            'tax'      => $tax,
            'total'    => $total
        ]);
    }

    public function history(){
        $data = $this->order->orderBy('Order_id', 'DESC')->findAll();
        return view('admin/history', ['activePage' => 'history', 'data' => $data]); 
    }

    public function getDetailHistory()
    {
        if(!$this->request->isAJAX()){
            return redirect()->to('/');
        }
        
        $orderCode = $this->request->getPost('order_code');
        if(empty($orderCode)){
            return $this->response->setStatusCode(400)->setBody('Order code tidak valid');
        }
        
        $order = $this->order->where('Order_Code', $orderCode)->first();
        if(!$order){
            return $this->response->setStatusCode(404)->setBody('Order tidak ditemukan');
        }
        
        $orderId = $order['Order_id'];
        $details = $this->detail_order->where('Order_id', $orderId)->findAll();
        $detailsData = [];
        foreach ($details as $detail) {
            $produk = $this->produk->find($detail['Produk_id']);
            if ($produk) {
                $detailsData[] = [
                    'namaProduk' => $produk['Nama_Produk'],
                    'harga'      => $produk['Harga'],
                    'jumlah'     => $detail['Jumlah_Produk'],
                    'total'      => $produk['Harga'] * $detail['Jumlah_Produk'],
                ];
            }
        }
        return $this->response->setJSON($detailsData);
    }
}
