<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class GuestController extends BaseController
{
    public function __construct(){
        $this->orders = new \App\Models\OrderModel();
        $this->produk = new \App\Models\ProdukModel();
        $this->kategori = new \App\Models\CategoryModel();
    }

    public function index()
{
    $data = $this->produk->findAll();
    $categories = $this->kategori->findAll();
    $activeCategory = 'all'; // Tambahkan variabel ini

    return view('guest/index', [
        'menus' => $data,
        'categories' => $categories,
        'activeCategory' => $activeCategory
    ]);
}


    public function menuByCategory($category_id)
{
    $data = $this->produk->where('Category_id', $category_id)->findAll();
    $categories = $this->kategori->findAll();
    $activeCategory = $category_id; // Tambahkan variabel ini

    return view('guest/index', [
        'menus' => $data,
        'categories' => $categories,
        'activeCategory' => $activeCategory
    ]);
}


    public function detailProduct()
    {
        $id = $this->request->getGet('id');
        $data = $this->produk->where('Produk_id', $id)->first();
        return view('guest/detail', ['data' => $data]);
    }

    public function cartList()
    {
        return view('guest/cart');
    }

    public function receipt()
    {
        $id = $this->request->getGet('order_id');

        $this->orders->select('orders.Order_Code, orders.Order_Date, detail_orders.Jumlah_Produk, products.Nama_Produk, products.Harga');
        $this->orders->join('detail_orders', 'detail_orders.Order_id = orders.Order_id');
        $this->orders->join('products', 'detail_orders.Produk_id = products.Produk_id');
        $this->orders->where('orders.Order_id', $id);
        $orderDetails = $this->orders->findAll();

        // Hitung subtotal: jumlah tiap produk dikalikan dengan harga produk per unit
        $subtotal = 0;
        foreach ($orderDetails as $detail) {
            $subtotal += $detail['Jumlah_Produk'] * $detail['Harga'];
        }
        $tax         = $subtotal * 0.10;
        $final_total = $subtotal + $tax;

        $responseData = [
            'order_code'  => $orderDetails[0]['Order_Code'],
            'order_date'  => $orderDetails[0]['Order_Date'],
            'details'     => $orderDetails,
            'subtotal'    => $subtotal,
            'tax'         => $tax,
            'final_total' => $final_total,
        ];

        return view('guest/receipt' , $responseData);
    }

    public function status()
    {
        $id = urldecode($this->request->getGet('id'));

        $this->orders->select('orders.Order_Code, orders.Order_Date, orders.Status, detail_orders.Jumlah_Produk, products.Harga');
        $this->orders->join('detail_orders', 'detail_orders.Order_id = orders.Order_id');
        $this->orders->join('products', 'detail_orders.Produk_id = products.Produk_id');
        $this->orders->where('orders.Order_Code', $id);
        $orderDetails = $this->orders->findAll();

        // Hitung subtotal: jumlah tiap produk dikalikan dengan harga produk per unit
        $subtotal = 0;
        foreach ($orderDetails as $detail) {
            $subtotal += $detail['Jumlah_Produk'] * $detail['Harga'];
        }
        $tax         = $subtotal * 0.10;
        $final_total = $subtotal + $tax;

        $responseData = [
            'order_code'  => $orderDetails[0]['Order_Code'],
            'order_date'  => $orderDetails[0]['Order_Date'],
            'subtotal'    => $subtotal,
            'tax'         => $tax,
            'final_total' => $final_total,
            'status'      => $orderDetails[0]['Status'],
        ];

        return view('guest/status', $responseData);
    }

    public function printReceipt()
    {
        $id = $this->request->getGet('order_id');
        if (!$id) {
            $id = session()->getFlashdata('order_id');
        }
        if (!$id) {
            return redirect()->to('/');
        }

        $this->orders->select('orders.Order_Code, orders.Order_Date, detail_orders.Jumlah_Produk, products.Nama_Produk, products.Harga');
        $this->orders->join('detail_orders', 'detail_orders.Order_id = orders.Order_id');
        $this->orders->join('products', 'detail_orders.Produk_id = products.Produk_id');
        $this->orders->where('orders.Order_id', $id);
        $orderDetails = $this->orders->findAll();

        if (empty($orderDetails)) {
            return redirect()->to('/')->with('error', 'Order tidak ditemukan.');
        }

        $subtotal = 0;
        foreach ($orderDetails as $detail) {
            $subtotal += $detail['Jumlah_Produk'] * $detail['Harga'];
        }
        $tax = $subtotal * 0.10;
        $final_total = $subtotal + $tax;

        $data = [
            'order_code'  => $orderDetails[0]['Order_Code'],
            'order_date'  => $orderDetails[0]['Order_Date'],
            'details'     => $orderDetails,
            'subtotal'    => $subtotal,
            'tax'         => $tax,
            'final_total' => $final_total,
            'formatted_date' => date("M d, Y | h:i:s A", strtotime($orderDetails[0]['Order_Date']))
        ];

        $html = view('kasir/receipt_pdf', $data);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream("receipt_$id.pdf", ["Attachment" => false]);
    }

    public function history(){
        $data = $this->orders->orderBy('Order_id', 'DESC')->findAll();
        return view('guest/history', ['activePage' => 'history', 'data' => $data]); 
    }
}
