<?php

class DetailController extends Controller
{
    public function detail($id)
    {
        $productModel = $this->model('Product');
        $product = $productModel->findById($id);

        if (!$product) {
            header('Location: ' . BASE_URL . '/dashboardcustomer/products');
            exit;
        }

        $this->view('customer/product_detail', [
            'title' => 'Detail Produk',
            'product' => $product
        ]);
    }

    public function viewAll($id)
    {
        $categoryModel = $this->model('Category');
        $productModel = $this->model('Product');

        $category = $categoryModel->findById($id);
        $products = $productModel->getProductByCategory($id);

        $this->view('customer/view_all', [
            'category' => $category,
            'products' => $products
        ]);
    }
}


?>