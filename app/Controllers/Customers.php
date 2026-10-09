<?php

namespace App\Controllers;
use App\Models\CustomerModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Customers extends BaseController
{
    public function index(): string
    {
        $customerModel = new CustomerModel();

        return view('customers/index', [
            'customers' => $customerModel->findAll()
        ]);
    }

    public function new(): string
    {
        return view('customers/new');
    }

    public function create()
    {
        $rules = [
            'full_name' => 'required|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $customerModel = new CustomerModel();

        $customerModel->insert([
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'phone'     => trim((string) $this->request->getPost('phone'))
        ]);

        return redirect()->to('/customers')
            ->with('success', 'Customer added successfully.');
    }

    public function edit(int $id): string
    {
        $customerModel = new CustomerModel();
        $customer = $customerModel->find($id);

        if ($customer === null) {
            throw PageNotFoundException::forPageNotFound(
                'Customer record not found.'
            );
        }

        return view('customers/edit', [
            'customer' => $customer
        ]);
    }

    public function update(int $id)
    {
        $rules = [
            'full_name' => 'required|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone' => [
            'label' => 'Phone number',
            'rules' => 'permit_empty|regex_match[/^09[0-9]{9}$/]',
            'errors' => [
                'regex_match' => 'Enter an 11-digit Philippine mobile number starting with 09.'
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $customerModel = new CustomerModel();

        if ($customerModel->find($id) === null) {
            throw PageNotFoundException::forPageNotFound(
                'Customer record not found.'
            );
        }

        $customerModel->update($id, [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'phone'     => trim((string) $this->request->getPost('phone'))
        ]);

        return redirect()->to('/customers')
            ->with('success', 'Customer updated successfully.');
    }
}