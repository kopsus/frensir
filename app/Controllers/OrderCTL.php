<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class OrderCTL extends BaseController
{
    public function __construct()
    {
        $this->Orders = new \App\Models\OrderModel();
        $this->DetailOrder = new \App\Models\OrderDetailsModel();
    }

    protected function checkOrderCode()
    {
        do {
            $randomNumber = mt_rand(0, 999999999);
            $orderCode    = '#F' . str_pad($randomNumber, 8, '0', STR_PAD_LEFT);
            $existing     = $this->Orders->where('Order_Code', $orderCode)->first();
        } while ($existing !== null);
        return $orderCode;
    }

    public function getOrder(){
        if (!$this->request->isAJAX()){
            return redirect()->to('/');
        }

        $orderCode = $this->request->getPost('order_code');

        if(empty($orderCode)){
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Order code tidak valid']);
        }
        
        $order = $this->Orders->where('Order_Code', $orderCode)->first();
        if(!$order){
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Order tidak ditemukan']);
        }

        $orderId = $order['Order_id'];
        session()->setFlashdata('order_id', $orderId);
        return $this->response->setJSON(['redirect' => "receipt", 'order_id' => $orderId]);
    }

    public function createOrders(){
        $orders = $this->request->getJSON(true);

        if (!$orders) {
            return $this->response->setJSON(['error' => 'No orders data provided'])->setStatusCode(400);
        }

        $orderCode = $this->checkOrderCode();
        $orderData = [
            'Order_Code' => $orderCode,
            'Order_Date' => date('Y-m-d H:i:s'),
            'Status'     => 'pending'
        ];
        $this->Orders->insert($orderData);
        $order_id = $this->Orders->getInsertID();
        foreach ($orders as $item) {
            $detailData = [
                'Order_id'      => (int) $order_id,
                'Produk_id'     => $item['id'],
                'Jumlah_Produk' => $item['quantity'] 
            ];
            $this->DetailOrder->insert($detailData);
        }

        return $this->response->setJSON(['order_id' => $order_id]);
    }
}
