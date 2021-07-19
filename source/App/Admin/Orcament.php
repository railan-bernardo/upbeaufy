<?php

namespace Source\App\Admin;

use Source\Models\Budget;
use Source\Models\User;
use Source\Support\Pager;
use Source\Support\Thumb;
use Source\Support\Upload;

/**
 * Class Blog
 * @package Source\App\Admin
 */
class Orcament extends Admin
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
            echo json_encode(["redirect" => url("/admin/orcamento/home/{$s}/1")]);
            return;
        }

        $search = null;
        $posts = (new Budget())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $posts = (new Budget())->find("MATCH(first_name) AGAINST(:s)", "s={$search}");
            if (!$posts->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/orcamento/home");
            }
        }

        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/orcamento/home/{$all}/"));
        $pager->pager($posts->count(), 12, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Orçamentos",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/orcament/home", [
            "app" => "orcament/home",
            "head" => $head,
            "posts" => $posts->limit($pager->limit())->offset($pager->offset())->order("created_at DESC")->fetch(true),
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
     

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $postDelete = (new Budget())->findById($data["post_id"]);

            if (!$postDelete) {
                $this->message->error("Você tentou excluir um post que não existe ou já foi removido")->flash();
                echo json_encode(["reload" => true]);
                return;
            }


            $postDelete->destroy();
            $this->message->success("O post foi excluído com sucesso...")->flash();

            echo json_encode(["reload" => true]);
            return;
        }


        $postEdit = null;
        if (!empty($data["post_id"])) {
            $postId = filter_var($data["post_id"], FILTER_VALIDATE_INT);
            $postEdit = (new Budget())->findById($postId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | " . ($postEdit->first_name ?? "Orçamento"),
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/orcament/post", [
            "app" => "orcament/post",
            "head" => $head,
            "post" => $postEdit
        ]);
    }


   
}