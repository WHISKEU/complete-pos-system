<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\SaleModel;

class Sales extends BaseController
{
    public function index(): string
    {
        $saleModel = new SaleModel();

        return view('sales/index', [
            'sales' => $saleModel->getSalesWithDetails()
        ]);
    }

    public function new(): string
    {
        $productModel = new ProductModel();
        $customerModel = new CustomerModel();

        return view('sales/new', [
            'products' => $productModel
                ->where('stock_quantity >', 0)
                ->orderBy('name', 'ASC')
                ->findAll(),

            'customers' => $customerModel
                ->orderBy('full_name', 'ASC')
                ->findAll()
        ]);
    }

    public function create()
    {
        $rules = [
            'product_id' => 'required|integer',
            'customer_id' => 'permit_empty|integer',
            'quantity' => 'required|integer|greater_than[0]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $productId = (int) $this->request->getPost('product_id');
        $customerInput = $this->request->getPost('customer_id');
        $customerId = $customerInput === '' ? null : (int) $customerInput;
        $quantity = (int) $this->request->getPost('quantity');

        $productModel = new ProductModel();
        $saleModel = new SaleModel();

        $product = $productModel->find($productId);

        if ($product === null) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Product not found.');
        }

        if ($quantity > (int) $product['stock_quantity']) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Not enough stock available. Only '
                    . $product['stock_quantity']
                    . ' item(s) remaining.'
                );
        }

        $totalPrice = (float) $product['price'] * $quantity;

        $db = db_connect();
        $db->transStart();

        $saleModel->insert([
            'product_id' => $productId,
            'customer_id' => $customerId,
            'sold_by' => (int) session()->get('user_id'),
            'quantity' => $quantity,
            'total_price' => $totalPrice,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $productModel
            ->set(
                'stock_quantity',
                'stock_quantity - ' . $quantity,
                false
            )
            ->where('id', $productId)
            ->where('stock_quantity >=', $quantity)
            ->update();

        $db->transComplete();

        if (! $db->transStatus()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Sale could not be recorded.');
        }

        return redirect()->to(site_url('sales'))
            ->with('success', 'Sale recorded successfully.');
    }
}