<?php

namespace Source\App\Admin;

use Source\Core\Save;
use Source\Models\Gallerys;
use Source\Models\AbountGallery;
use Source\Models\PostSize;
use Source\Models\Service;
use Source\Models\Subcategory;
use Source\Models\ServiceCategory;
use Source\Models\User;
use Source\Support\Pager;
use Source\Support\Thumb;
use Source\Support\Upload;
use Source\Support\Media;
/**
 * Class Blog
 * @package Source\App\Admin
 */
class Services extends Admin
{
    /**
     * Blog constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array|null $data
     */
    public function home(?array $data): void
    {
        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo json_encode(["redirect" => url("/admin/products/home/{$s}/1")]);
            return;
        }

        $search = null;
        $posts = (new Service())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $posts = (new Service())->find("MATCH(title, subtitle) AGAINST(:s)", "s={$search}");
            if (!$posts->count()) {
                $this->message->info("Your search returned no results.")->flash();
                redirect("/admin/products/home");
            }
        }

        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/products/home/{$all}/"));
        $pager->pager($posts->count(), 12, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Services",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/service/home", [
            "app" => "service/home",
            "head" => $head,
            "posts" => $posts->limit($pager->limit())->offset($pager->offset())->order("post_at DESC")->fetch(true),
            "paginator" => $pager->render(),
            "search" => $search
        ]);
    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function post(?array $data): void
    {
        //MCE Upload
        if (!empty($data["upload"]) && !empty($_FILES["image"])) {
            $files = $_FILES["image"];
            $upload = new Upload();
            $image = $upload->image($files, "post-" . time());

            if (!$image) {
                $json["message"] = $upload->message()->render();
                echo json_encode($json);
                return;
            }

            $json["mce_image"] = '<img style="width: 100%;" src="' . url("/storage/{$image}") . '" alt="{title}" title="{title}">';
            echo json_encode($json);
            return;
        }

        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $content = $data["content"];
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $postCover = new Gallerys();
            $postCreate = new Service();
            $postCreate->category = $data["category"];
            $postCreate->subcategory = $data["subcategory"];
            $postCreate->title = $data["title"];
            $postCreate->uri = str_slug($postCreate->title);
            $postCreate->subtitle = $data["subtitle"];
            $postCreate->content = str_replace(["{title}"], [$postCreate->title], $content);
            $postCreate->status = $data["status"];
            $postCreate->post_at = date_fmt_back($data["post_at"]);



            //upload cover
            if (!empty($_FILES["cover"])) {
                $files = $_FILES["cover"];
                $upload = new Upload();
                $image = $upload->image($files, $postCreate->title);

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $postCreate->cover = $image;
            }

            if (!$postCreate->save()) {
                $json["message"] = $postCreate->message()->render();
                echo json_encode($json);
                return;
            }

            if(!empty($_FILES['cover_img'])){
                $images = $_FILES['cover_img'];
                $upload = new Upload();
                for ($i = 0; $i < count($images['type']); $i++) {
                    foreach (array_keys($images) as $keys) {
                        $imageFiles[$i][$keys] = $images[$keys][$i];
                    }

                }

            $a = 1;
                foreach ($imageFiles as $file) {
                    $img = $upload->imageAll($file, time().$postCreate->title."-".$a);

                if (!$img) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }
     
                     $postCover->cover_img = $img;
                    $postCover->idservice = $postCreate->id;
                    $save = new Save();

                   $create = $save->create($postCover->cover_img, $postCover->idservice);
            
                    $a++;
                     
                }
            }
            
           
            if (!$create) {
                $json["message"] = $postCover->message()->render();
                echo json_encode($json);
                return;
            }


            $this->message->success("Post published successfully...")->flash();
            $json["redirect"] = url("/admin/product/post/{$postCreate->id}");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $content = $data["content"];
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $postEdit = (new Service())->findById($data["post_id"]);

            if (!$postEdit) {
                $this->message->error("You tried to update a post that doesn't exist or has been removed")->flash();
                echo json_encode(["redirect" => url("/admin/products/home")]);
                return;
            }

            $postEdit->category = $data["category"];
            $postEdit->subcategory = $data["subcategory"];
            $postEdit->title = $data["title"];
            $postEdit->uri = str_slug($postEdit->title);
            $postEdit->subtitle = $data["subtitle"];
            $postEdit->content = str_replace(["{title}"], [$postEdit->title], $content);
            $postEdit->status = $data["status"];
            $postEdit->post_at = date_fmt_back($data["post_at"]);


            //upload cover
            if (!empty($_FILES["cover"])) {
                if ($postEdit->cover && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$postEdit->cover}")) {
                    unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$postEdit->cover}");
                    (new Thumb())->flush($postEdit->cover);
                }

                $files = $_FILES["cover"];
                $upload = new Upload();
                $image = $upload->image($files, $postEdit->title);

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $postEdit->cover = $image;
            }

            if (!$postEdit->save()) {
                $json["message"] = $postEdit->message()->render();
                echo json_encode($json);
                return;
            }


            $this->message->success("Post updated successfully...")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $postDelete = (new Service())->findById($data["post_id"]);

            if (!$postDelete) {
                $this->message->error("You tried to delete a post that doesn't exist or has already been removed")->flash();
                echo json_encode(["reload" => true]);
                return;
            }

            if ($postDelete->cover && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$postDelete->cover}")) {
                unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$postDelete->cover}");
                  //unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$postDelete->video}");
                (new Thumb())->flush($postDelete->cover);
            }

            $tm = (new Gallerys())->find()->fetch(true);

            foreach ($tm as $value) {
               
               if($postDelete->id == $value->idservice){
   
                        unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$value->cover_img}");
                        (new Thumb())->flush($value->cover_img);

                    $value->destroy();

               }

            }

        

            $postDelete->destroy();
            $this->message->success("Post was deleted successfully...")->flash();

            echo json_encode(["reload" => true]);
            return;
        }

        $postEdit = null;
        if (!empty($data["post_id"])) {
            $postId = filter_var($data["post_id"], FILTER_VALIDATE_INT);
            $postEdit = (new Service())->findById($postId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | " . ($postEdit->title ?? "New Service"),
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/service/post", [
            "app" => "service/post_size",
            "head" => $head,
            "post" => $postEdit,
            "categories" => (new ServiceCategory())->find("type = :type", "type=post")->order("title")->fetch(true),
              "subcategories" => (new Subcategory())->find("type = :type", "type=post")->order("title")->fetch(true)
        ]);
    }

    /**
        SubCategory
    **/

    /**
     * @param array|null $data
     */
    public function subcategories(?array $data): void
    {
        $categories = (new Subcategory())->find();
        $pager = new Pager(url("/admin/product/subcategories/"));
        $pager->pager($categories->count(), 6, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " | SubCategories",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/service/subcategories", [
            "app" => "service/subcategories",
            "head" => $head,
            "categories" => $categories->order("title")->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "paginator" => $pager->render()
        ]);
    }






    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function subcategory(?array $data): void
    {
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $categoryCreate = new Subcategory();
            $categoryCreate->title = $data["title"];
            $categoryCreate->idcategory = $data['idcategory'];
            $categoryCreate->uri = str_slug($categoryCreate->title);
            $categoryCreate->description = $data["description"];

            //upload cover
            if (!empty($_FILES["cover"])) {
                $files = $_FILES["cover"];
                $upload = new Upload();
                $image = $upload->image($files, $categoryCreate->title);

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $categoryCreate->cover = $image;
            }

            if (!$categoryCreate->save()) {
                $json["message"] = $categoryCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("SubCategory successfully created...")->flash();
            $json["redirect"] = url("/admin/product/subcategory/{$categoryCreate->id}");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $categoryEdit = (new Subcategory())->findById($data["subcategory_id"]);

            if (!$categoryEdit) {
                $this->message->error("You tried to edit a subcategory that doesn't exist or has been removed")->flash();
                echo json_encode(["redirect" => url("/admin/product/subcategories")]);
                return;
            }

            $categoryEdit->title = $data["title"];
            $categoryEdit->uri = str_slug($categoryEdit->title);
            $categoryEdit->description = $data["description"];

            //upload cover
            if (!empty($_FILES["cover"])) {
                if ($categoryEdit->cover && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$categoryEdit->cover}")) {
                    unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$categoryEdit->cover}");
                    (new Thumb())->flush($categoryEdit->cover);
                }

                $files = $_FILES["cover"];
                $upload = new Upload();
                $image = $upload->image($files, $categoryEdit->title);

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $categoryEdit->cover = $image;
            }

            if (!$categoryEdit->save()) {
                $json["message"] = $categoryEdit->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("SubCategory successfully updated...")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $categoryDelete = (new Subcategory())->findById($data["subcategory_id"]);

            if (!$categoryDelete) {
                $json["message"] = $this->message->error("Subcategory does not exist or has been deleted before")->render();
                echo json_encode($json);
                return;
            }

            if ($categoryDelete->posts()->count()) {
                $json["message"] = $this->message->warning("It is not possible to remove as there are registered posts")->render();
                echo json_encode($json);
                return;
            }

            if ($categoryDelete->cover && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$categoryDelete->cover}")) {
                unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$categoryDelete->cover}");
                (new Thumb())->flush($categoryDelete->cover);
            }

            $categoryDelete->destroy();

            $this->message->success("Subcategory was deleted successfully...")->flash();
            echo json_encode(["reload" => true]);

            return;
        }

        $categoryEdit = null;
        if (!empty($data["subcategory_id"])) {
            $categoryId = filter_var($data["subcategory_id"], FILTER_VALIDATE_INT);
            $categoryEdit = (new Subcategory())->findById($categoryId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | SubCategory",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/service/subcategory", [
            "app" => "service/subcategory",
            "head" => $head,
            "category" => $categoryEdit,
            "categories" => (new ServiceCategory())->find("type = :type", "type=post")->order("title")->fetch(true)
        ]);
    }

/**
*Category
**/

    /**
     * @param array|null $data
     */
    public function categories(?array $data): void
    {
        $categories = (new ServiceCategory())->find();
        $pager = new Pager(url("/admin/product/categories/"));
        $pager->pager($categories->count(), 6, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Categorys",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/service/categories", [
            "app" => "service/categories",
            "head" => $head,
            "categories" => $categories->order("title")->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function category(?array $data): void
    {
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $categoryCreate = new ServiceCategory();
            $categoryCreate->title = $data["title"];
            $categoryCreate->uri = str_slug($categoryCreate->title);
            $categoryCreate->description = $data["description"];

            //upload cover
            if (!empty($_FILES["cover"])) {
                $files = $_FILES["cover"];
                $upload = new Upload();
                $image = $upload->image($files, $categoryCreate->title);

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $categoryCreate->cover = $image;
            }

            if (!$categoryCreate->save()) {
                $json["message"] = $categoryCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Category created successfully...")->flash();
            $json["redirect"] = url("/admin/product/category/{$categoryCreate->id}");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $categoryEdit = (new ServiceCategory())->findById($data["category_id"]);

            if (!$categoryEdit) {
                $this->message->error("You tried to edit a category that doesn't exist or has been removed")->flash();
                echo json_encode(["redirect" => url("/admin/product/categories")]);
                return;
            }

            $categoryEdit->title = $data["title"];
            $categoryEdit->uri = str_slug($categoryEdit->title);
            $categoryEdit->description = $data["description"];

            //upload cover
            if (!empty($_FILES["cover"])) {
                if ($categoryEdit->cover && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$categoryEdit->cover}")) {
                    unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$categoryEdit->cover}");
                    (new Thumb())->flush($categoryEdit->cover);
                }

                $files = $_FILES["cover"];
                $upload = new Upload();
                $image = $upload->image($files, $categoryEdit->title);

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $categoryEdit->cover = $image;
            }

            if (!$categoryEdit->save()) {
                $json["message"] = $categoryEdit->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Category updated successfully...")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $categoryDelete = (new ServiceCategory())->findById($data["category_id"]);

            if (!$categoryDelete) {
                $json["message"] = $this->message->error("Category does not exist or has been deleted before")->render();
                echo json_encode($json);
                return;
            }

            if ($categoryDelete->posts()->count()) {
                $json["message"] = $this->message->warning("It is not possible to remove as there are registered posts")->render();
                echo json_encode($json);
                return;
            }

            if ($categoryDelete->cover && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$categoryDelete->cover}")) {
                unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$categoryDelete->cover}");
                (new Thumb())->flush($categoryDelete->cover);
            }

            $categoryDelete->destroy();

            $this->message->success("The category was successfully deleted...")->flash();
            echo json_encode(["reload" => true]);

            return;
        }

        $categoryEdit = null;
        if (!empty($data["category_id"])) {
            $categoryId = filter_var($data["category_id"], FILTER_VALIDATE_INT);
            $categoryEdit = (new ServiceCategory())->findById($categoryId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Category",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/service/category", [
            "app" => "service/categories",
            "head" => $head,
            "category" => $categoryEdit
        ]);
    }


}