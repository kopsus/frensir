<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MidtransCTL extends BaseController
{
    public function __construct()
    {
        // $this->db = \Config\Database::connect();
        // $this->builder = $this->db->table('order');

        \Midtrans\Config::$serverKey = getenv('ServerKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $this->produk = new \App\Models\ProdukModel();
        $this->Orders = new \App\Models\OrderModel();
        $this->DetailOrder = new \App\Models\OrderDetailsModel();
        $this->sales = new \App\Models\SalesModel();
        $this->sales_detail = new \App\Models\SalesDetailsModel();
    }

    public function index(){
        $order_id = $this->request->getPost('order_id');
        if (!$order_id) {
            return $this->response->setJSON(['error' => 'Order ID wajib diisi']);
        }

        $orderData  =  $this->Orders->find($order_id);
        if (!$orderData) {
            return $this->response->setJSON(['error' => 'Data Order tidak ditemukan']);
        }

        // Ambil data detail order berdasarkan order_id
        $orderDetails = $this->DetailOrder->where('Order_id', $order_id)->findAll();
        if (!$orderDetails) {
            return $this->response->setJSON(['error' => 'Order Details tidak ditemukan']);
        }

        $totalHarga = 0;
        $salesDetailsData = [];
        
        foreach ($orderDetails as $detail) {
            $produk = $this->produk->find($detail['Produk_id']);
            if (!$produk) {
                continue;
            }
            $subtotal = $detail['Jumlah_Produk'] * $produk['Harga'];
            $totalHarga += $subtotal;

            $salesDetailsData[] = [
                'Jumlah_Produk' => $detail['Jumlah_Produk'],
                'Produk_id'     => $detail['Produk_id']
            ];
        }


        $totalHarga = $totalHarga + $totalHarga * 0.10;

        // Process Midtrans
        $transaction_details = array (
            'order_id' => $order_id,
            'gross_amount' => $totalHarga, //must rounded
        );

        $billing_address = array(
            'first_name'    => 'FRENSIR CASHIER',
            'last_name'     => 'FRENSIR CASHIER',
            'address'       => 'address here',
            'city'          => "Jakarta",
            'postal_code'   => "12240",
            'phone'         => '08111111111',
            'country_code'  => 'IDN'
        );

        $customer_details = array(
            'first_name'    => 'FRENSIR CASHIER',
            'last_name'     => 'FRENSIR CASHIER',
            'email'         => 'frensir@yopmail.com',
            'phone'         => '08111111111',
            'billing_address'  => $billing_address,
        );

        $transaction = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
        );

        error_log(json_encode($transaction));
        $snapToken = \Midtrans\Snap::getSnapToken($transaction);
        error_log($snapToken);
        echo $snapToken;
    }

    public function finisTransaction()
    {
        $order_status = $this->request->getPost('status');
        $order_id = $this->request->getPost('order_id');

        if (!$order_id) {
            return $this->response->setJSON(['error' => 'Order ID wajib diisi']);
        }

        $this->Orders->where('order_id', $order_id)->set(['Status' => $order_status])->update();

        $orderData  =  $this->Orders->find($order_id);
        if (!$orderData) {
            return $this->response->setJSON(['error' => 'Data Order tidak ditemukan']);
        }

        // Ambil data detail order berdasarkan order_id
        $orderDetails = $this->DetailOrder->where('Order_id', $order_id)->findAll();
        if (!$orderDetails) {
            return $this->response->setJSON(['error' => 'Order Details tidak ditemukan']);
        }

        $totalHarga = 0;
        $salesDetailsData = [];
        
        foreach ($orderDetails as $detail) {
            $produk = $this->produk->find($detail['Produk_id']);
            if (!$produk) {
                continue;
            }
            $subtotal = $detail['Jumlah_Produk'] * $produk['Harga'];
            $totalHarga += $subtotal;

            // Kurangi stok produk
            $newStock = $produk['Stok'] - $detail['Jumlah_Produk'];
            if ($newStock < 0) {
                return $this->response->setJSON(['error' => 'Stok tidak cukup untuk produk ' . $produk['Nama_Produk']]);
            }

            $salesDetailsData[] = [
                'Jumlah_Produk' => $detail['Jumlah_Produk'],
                'Produk_id'     => $detail['Produk_id']
            ];
        }

        $totalHarga = $totalHarga * 0.10;
        $salesData = [
            'Order_id'          => $order_id,
            'Tanggal_Penjualan' => date('Y-m-d H:i:s'),
            'Total_Harga'       => $totalHarga
        ];
        $this->sales->insert($salesData);
        $sales_id = $this->sales->getInsertID();

        foreach ($salesDetailsData as $detailData) {
            $detailData['Penjualan_id'] = $sales_id;
            $this->sales_detail->insert($detailData);
        }
    }

}
