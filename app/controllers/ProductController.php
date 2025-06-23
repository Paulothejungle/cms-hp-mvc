<?php
require_once '../app/middleware/AuthMiddleware.php';

class ProductController extends Controller
{
    // Tampilkan semua produk
    public function index()
    {
        AuthMiddleware::checkLogin();
        AuthMiddleware::checkRole('admin');   
        $productModel = $this->model('Product');
        
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $keyword = $_GET['search'];
            $products = $productModel->search($keyword);
        } else {
            $products = $productModel->getAll();
        }

        $this->view('admin/product/index', [
            'title' => 'Daftar Produk',
            'products' => $products
        ]);
    }

    // Tampilkan form tambah produk
    public function create()
    {
        $categoryModel = $this->model('Category');
        $categories = $categoryModel->getAll();

        $this->view('admin/product/create', [
            'title' => 'Tambah Produk',
            'categories' => $categories
        ]);
    }

    // Simpan produk baru
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_id = trim($_POST['category_id']);
            $name = trim($_POST['name']);
            $price = trim($_POST['price']);
            $stock = trim($_POST['stock']);
            $description = trim($_POST['description']);
            $image = $_FILES['image'];

            // Validasi form kosong
            if (empty($name) || empty($price) || empty($category_id) || empty($stock) || empty($description) || empty($image['name'])) {
                $categoryModel = $this->model('Category');
                $categories = $categoryModel->getAll();

                $this->view('admin/product/create', [
                    'title' => 'Tambah Produk',
                    'error' => 'Semua field harus diisi',
                    'categories' => $categories
                ]);
                return;
            }

            // Proses upload gambar
            $imageName = time() . '_' . $image['name'];
            $targetPath = '../public/image/' . $imageName;

            if (move_uploaded_file($image['tmp_name'], $targetPath)) {
                $data = [
                    'category_id' => $category_id,
                    'name' => $name,
                    'price' => $price,
                    'stock' => $stock,
                    'image' => $imageName,
                    'description' => $description
                ];

                $productModel = $this->model('Product');
                $productModel->create($data);

                header('Location: ' . BASE_URL . '/product/index');
                exit;
            } else {
                $categoryModel = $this->model('Category');
                $categories = $categoryModel->getAll();

                $this->view('admin/product/create', [
                    'title' => 'Tambah Produk',
                    'error' => 'Gagal upload gambar',
                    'categories' => $categories
                ]);
            }
        }
    }

    // Tampilkan form edit produk
    public function edit($id)
    {
        $productModel = $this->model('Product');
        $product = $productModel->findById($id);

        $categoryModel = $this->model('Category');
        $categories = $categoryModel->getAll();

        $this->view('admin/product/edit', [
            'title' => 'Edit Produk',
            'product' => $product,
            'categories' => $categories
        ]);
    }

    // Update produk
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_id = trim($_POST['category_id']);
            $name = trim($_POST['name']);
            $price = trim($_POST['price']);
            $stock = trim($_POST['stock']);
            $description = trim($_POST['description']);
            $image = $_FILES['image'];

            $productModel = $this->model('Product');
            $product = $productModel->findById($id);

            $imageName = $product['image']; // Default: gambar lama

            // Cek apakah upload gambar baru
            if (!empty($image['name'])) {
                $newImageName = time() . '_' . $image['name'];
                $targetPath = '../public/image/' . $newImageName;

                if (move_uploaded_file($image['tmp_name'], $targetPath)) {
                    $imageName = $newImageName;
                }
            }

            $data = [
                'category_id' => $category_id,
                'name' => $name,
                'price' => $price,
                'stock' => $stock,
                'image' => $imageName,
                'description' => $description
            ];

            $productModel->update($id, $data);

            header('Location: ' . BASE_URL . '/product/index');
            exit;
        }
    }

    // Hapus produk
    public function delete($id)
    {
        $productModel = $this->model('Product');
        $productModel->delete($id);

        header('Location: ' . BASE_URL . '/product/index');
        exit;
    }
}

?>
