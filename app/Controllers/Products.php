<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\Files\UploadedFile;

class Products extends BaseController
{
    public function index(): string
    {
        $productModel = new ProductModel();

        return view('products/index', [
            'products' => $productModel
                ->orderBy('id', 'DESC')
                ->findAll()
        ]);
    }

    public function new(): string
    {
        return view('products/new');
    }

    public function create()
    {
        $rules = [
            'name' => 'required|max_length[100]',
            'price' => 'required|decimal|greater_than_equal_to[0]',
            'stock_quantity' => 'required|integer|greater_than_equal_to[0]'
        ];

        $image = $this->request->getFile('image');
        $hasImage = $image !== null
            && $image->getError() !== UPLOAD_ERR_NO_FILE;

        if ($hasImage) {
            $rules['image'] = [
                'label' => 'Product image',
                'rules' => [
                    'uploaded[image]',
                    'max_size[image,2048]',
                    'mime_in[image,image/jpeg,image/png]',
                    'ext_in[image,jpg,jpeg,png]'
                ]
            ];
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $imageName = null;

        if ($hasImage) {
            $imageName = $this->saveImage($image);
        }

        $productModel = new ProductModel();

        $productModel->insert([
            'name' => trim((string) $this->request->getPost('name')),
            'price' => (float) $this->request->getPost('price'),
            'stock_quantity' => (int) $this->request->getPost('stock_quantity'),
            'image' => $imageName,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(site_url('products'))
            ->with('success', 'Product added successfully.');
    }

    public function edit(int $id): string
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if ($product === null) {
            throw PageNotFoundException::forPageNotFound(
                'Product record not found.'
            );
        }

        return view('products/edit', [
            'product' => $product
        ]);
    }

    public function update(int $id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if ($product === null) {
            throw PageNotFoundException::forPageNotFound(
                'Product record not found.'
            );
        }

        $rules = [
            'name' => 'required|max_length[100]',
            'price' => 'required|decimal|greater_than_equal_to[0]',
            'stock_quantity' => 'required|integer|greater_than_equal_to[0]'
        ];

        $image = $this->request->getFile('image');
        $hasImage = $image !== null
            && $image->getError() !== UPLOAD_ERR_NO_FILE;

        if ($hasImage) {
            $rules['image'] = [
                'label' => 'Product image',
                'rules' => [
                    'uploaded[image]',
                    'max_size[image,2048]',
                    'mime_in[image,image/jpeg,image/png]',
                    'ext_in[image,jpg,jpeg,png]'
                ]
            ];
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'name' => trim((string) $this->request->getPost('name')),
            'price' => (float) $this->request->getPost('price'),
            'stock_quantity' => (int) $this->request->getPost('stock_quantity')
        ];

        if ($hasImage) {
            $newImageName = $this->saveImage($image);
            $this->removeImage($product['image']);
            $data['image'] = $newImageName;
        }

        $productModel->update($id, $data);

        return redirect()->to(site_url('products'))
            ->with('success', 'Product updated successfully.');
    }

    public function delete(int $id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if ($product === null) {
            throw PageNotFoundException::forPageNotFound(
                'Product record not found.'
            );
        }

        $this->removeImage($product['image']);
        $productModel->delete($id);

        return redirect()->to(site_url('products'))
            ->with('success', 'Product deleted successfully.');
    }

    private function saveImage(UploadedFile $image): string
    {
        $uploadPath = FCPATH . 'uploads/products';

        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0775, true);
        }

        $newName = $image->getRandomName();
        $image->move($uploadPath, $newName);

        service('image')
            ->withFile($uploadPath . DIRECTORY_SEPARATOR . $newName)
            ->fit(400, 400, 'center')
            ->save($uploadPath . DIRECTORY_SEPARATOR . $newName);

        return $newName;
    }

    private function removeImage(?string $imageName): void
    {
        if (empty($imageName)) {
            return;
        }

        $imagePath = FCPATH . 'uploads/products/'
            . basename($imageName);

        if (is_file($imagePath)) {
            unlink($imagePath);
        }
    }
}