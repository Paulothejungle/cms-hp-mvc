<?php
require_once '../app/middleware/AuthMiddleware.php';
class CategoryController extends Controller {


    public function __construct() {
        AuthMiddleware::checkLogin();
        AuthMiddleware::checkRole('admin');
    }

    // Tampilkan semua kategori
    public function index() {
        $categoryModel = $this->model('Category');
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $keyword = $_GET['search'];
            $categories = $categoryModel->search($keyword);
        } else {
            $categories = $categoryModel->getAll();
        }

        $this->view('admin/category/index', [
            'title' => 'Daftar Kategori',
            'categories' => $categories
        ]);
    }

    // Tampilkan form tambah kategori
    public function create() {
        $this->view('admin/category/create', [
            'title' => 'Tambah Kategori'
        ]);
    }

    // Simpan kategori baru
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $image = $_FILES['image'];

            if(empty($name) || empty($image['name'])) {
                $this->view('admin/category/create', [
                    'title' => 'Tambah Kategori',
                    'error' => 'Nama dan gambar tidak boleh kosong'
                ]);
                return;
            }

            $imageName = time() . '_' . basename($image['name']);
            $targetPath = '../public/image/' . $imageName;

            if (move_uploaded_file($image['tmp_name'], $targetPath)) {
                $data = [
                    'name' => $name,
                    'image' => $imageName
                ];

                $categoryModel = $this->model('Category');
                $categoryModel->create($data);

                header('Location: ' . BASE_URL . '/category/index');
                exit;
            } else {
                $this->view('admin/category/create', [
                    'title' => 'Tambah Kategori',
                    'error' => 'Gagal upload gambar'
                ]);
            }
        }
    }


    // Tampilkan form edit kategori
    public function edit($id) {
        $categoryModel = $this->model('Category');
        $category = $categoryModel->findById($id);

        $this->view('admin/category/edit', [
            'title' => 'Edit Kategori',
            'category' => $category
        ]);
    }

    // Update data kategori
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $image = $_FILES['image'];

            $categoryModel = $this->model('Category');
            $category = $categoryModel->findById($id);

            $imageName = $category['image']; // default pakai yang lama

            // Cek jika ada gambar baru di-upload
            if (!empty($image['name'])) {
                $newImageName = time() . '_' . basename($image['name']);
                $targetPath = '../public/image/' . $newImageName;

                if (move_uploaded_file($image['tmp_name'], $targetPath)) {
                    $imageName = $newImageName;
                }
            }

            $data = [
                'name' => $name,
                'image' => $imageName
            ];

            $categoryModel->update($id, $data);

            header('Location: ' . BASE_URL . '/category/index');
            exit;
        }
    }


    // Hapus kategori
    public function delete($id) {
        $categoryModel = $this->model('Category');
        $categoryModel->delete($id);

        header('Location: ' . BASE_URL . '/category/index');
        exit;
    }
}
