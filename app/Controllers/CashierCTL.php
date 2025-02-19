<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class CashierCTL extends BaseController
{
    public function __construct(){
        $this->Orders = new \App\Models\OrderModel();
        $this->produk = new \App\Models\ProdukModel();
        $this->kategori = new \App\Models\CategoryModel();
    }

    public function index()
    {
        $data = $this->produk->findAll();
        $categories = $this->kategori->findAll();
        return view('kasir/index', ["menus" => $data, "categories" => $categories]);
    }

    public function getKategori($id)
    {
        $category = $this->kategori->find($id);

        if ($category) {
            return $this->response->setJSON(['success' => true, 'category' => $category]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Kategori tidak ditemukan']);
        }
    }

    public function menuByCategory($category_id)
    {
        $data = $this->produk->where('Category_id', $category_id)->findAll();
        $categories = $this->kategori->findAll();
        $currentCategoryId = $category_id;
        return view('kasir/index', ["menus" => $data, "categories" => $categories, "currentCategoryId" => $currentCategoryId]);
    }

    public function menuList()
    {
        $menus = $this->produk->findAll();
        $categories = $this->kategori->findAll();
        return view('kasir/menuList', ["menus" => $menus, "categories" => $categories]);
    }

    public function receipt()
    {
        $id = $this->request->getGet('order_id');
        if(!$id){
            $id = session()->getFlashdata('order_id');
        }
        if(!$id){
            return redirect()->to('/');
        }

        $this->Orders->select('orders.Order_Code, orders.Order_Date, detail_orders.Jumlah_Produk, products.Nama_Produk, products.Harga');
        $this->Orders->join('detail_orders', 'detail_orders.Order_id = orders.Order_id');
        $this->Orders->join('products', 'detail_orders.Produk_id = products.Produk_id');
        $this->Orders->where('orders.Order_id', $id);
        $orderDetails = $this->Orders->findAll();

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


        return view('kasir/receipt_cashier', $responseData);
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

        $this->Orders->select('orders.Order_Code, orders.Order_Date, detail_orders.Jumlah_Produk, products.Nama_Produk, products.Harga');
        $this->Orders->join('detail_orders', 'detail_orders.Order_id = orders.Order_id');
        $this->Orders->join('products', 'detail_orders.Produk_id = products.Produk_id');
        $this->Orders->where('orders.Order_id', $id);
        $orderDetails = $this->Orders->findAll();

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

    public function kategoriList()
    {
        $categories = $this->kategori->findAll();
        return view('kasir/kategoriList', ["categories" => $categories]);
    }

    public function kategoriAdd()
    {
        $data = [
            'Category_name' => $this->request->getPost('Category_name')
        ];

        if ($this->kategori->insert($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Kategori berhasil ditambahkan']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menambahkan kategori']);
        }
    }

    public function kategoriUpdate()
    {
        $id = $this->request->getPost('Category_id');
        $data = [
            'Category_name' => $this->request->getPost('Category_name')
        ];

        if ($this->kategori->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Kategori berhasil diperbarui']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui kategori']);
        }
    }

    public function kategoriDelete($id)
    {
        if ($this->kategori->delete($id)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Kategori berhasil dihapus']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus kategori']);
        }
    }

    public function history()
    {
        $orders = $this->Orders->findAll();
        return view('kasir/history', ["orders" => $orders]);
    }
}
