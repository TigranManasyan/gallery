<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\Image;

class ImageController extends Controller {

    protected function upload($file) {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $new_file_name = time() . rand(1, 100) . '.' . $ext;
        $upload_file = "./uploads/$new_file_name";
        if(move_uploaded_file($file['tmp_name'], $upload_file)) {
            return $new_file_name;
        }

        return '';

    }

    public function index() {
        $this->render("photos", ['title' => 'Photos']);
    }

    public function get_images() {
        echo $_GET['page'];
        die;
        $image = new Image();
        $user = $_SESSION['user'];
        $response = [];
        $response['total'] = $image->getCountRows("images", "created_by = {$user['id']}");
        $limit = 4;
        $page = 1;
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $offset = 0;
        if($page > 1) {
            $offset = ceil($limit * ($page - 1));
        }
        $response['current_page'] = $page;
        $response['images'] = $image->
        custom_query("SELECT images.*, users.id AS user_id, users.name AS 'by' FROM images INNER JOIN users ON images.created_by = users.id WHERE created_by = {$user['id']} LIMIT $limit OFFSET $offset");

        echo json_encode($response);
    }

    public function store() {
        $image = new Image();
        $user = $_SESSION['user'];
        $file = $_FILES['image'];
        $file_name = $this->upload($file);


        if(!empty($file_name)) {
            $store = $image
                ->create(
                    ['title', 'image', 'alt_text', 'created_by'],
                    [$_POST['title'], $file_name, $_POST['alt_text'], $user['id']],
                    "images"
                );

            if($store) {
                echo json_encode([
                    'success' => true,
                    'msg' => 'Post successfully created'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'msg' => 'Post not created'
                ]);
            }
        }
    }


}