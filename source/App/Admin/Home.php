<?php

namespace Source\App\Admin;

use Source\Models\PageHome;
use Source\Models\User;
use Source\Support\Thumb;
use Source\Support\Upload;
use Source\App\Admin\Admin;

class Home extends Admin{

    public function __construct(){
        parent::__construct();
    }

    /**
     * @param array|null $data
     */
    public function home(?array $data): void
    {

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Home",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/home/home", [
            "app" => "home/home",
            "head" => $head,
            "posts" =>(new PageHome())->find()->fetch(true)
        ]);

    }

    /**
     * @param array|null $data
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
    

            //update
            if (!empty($data["action"]) && $data["action"] == "update") {
                $content = $data["content"];
                $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
                $postEdit = (new PageHome())->findById($data["post_id"]);
    
                if (!$postEdit) {
                    $this->message->error("You tried to update a post that doesn't exist or has been removed")->flash();
                    echo json_encode(["redirect" => url("/admin/home/home")]);
                    return;
                }

                $postEdit->title = $data["title"];
                $postEdit->subtitle = $data["subtitle"];
                $postEdit->content = str_replace(["{title}"], [$postEdit->title], $content);
                $postEdit->description = $data["description"];
    
    
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
        }


}

?>