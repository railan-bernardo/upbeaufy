<?php
ob_start();

require __DIR__ . "/vendor/autoload.php";

/**
 * BOOTSTRAP
 */

use CoffeeCode\Router\Router;
use Source\Core\Session;

$session = new Session();
$route = new Router(url(), ":");
$route->namespace("Source\App");

/**
 * WEB ROUTES
 */
$route->group(null);
$route->get("/", "Web:home");




//PRODUCTS
$route->group("/services");
$route->get("/", "Web:products");
$route->get("/p/{page}", "Web:products");


// $route->get("/subcategories/{uri}", "Web:allsubCategory");
// $route->get("/subcategories/{uri}/{page}", "Web:allsubCategory");
// $route->get("/{uri}", "Web:servicePost");
// $route->get("/category/{category}", "Web:serviceCategory");
// $route->get("/category/{category}/{page}", "Web:serviceCategory");
// $route->get("/category/{category}/{subcategory}", "Web:serviceSubCategory");
// $route->get("/category/{category}/{subcategory}/{page}", "Web:serviceSubCategory");

//PRODUCT
$route->group("/service");
$route->get("/{uri}", "Web:productDetail");
$route->post("/{uri}", "Web:budgetPost");
//$route->get("/{uri}/{page}", "Web:products");


//about
$route->group("/about");
$route->get("/", "Web:about");


//Contact
$route->group("/contact");
$route->get("/", "Web:contact");
$route->post("/post", "Web:contactpost");



//services
$route->group(null);
$route->get("/termos", "Web:terms");


/**
 * ADMIN ROUTES
 */
$route->namespace("Source\App\Admin");
$route->group("/admin");

//login
$route->get("/", "Login:root");
$route->get("/login", "Login:login");
$route->post("/login", "Login:login");

//dash
$route->get("/dash", "Dash:dash");
$route->get("/dash/home", "Dash:home");
$route->post("/dash/home", "Dash:home");
$route->get("/logoff", "Dash:logoff");

//service
$route->get("/products/home", "Services:home");
$route->post("/products/home", "Services:home");
$route->get("/products/home/{search}/{page}", "Services:home");
$route->get("/product/post", "Services:post");
$route->post("/product/post", "Services:post");
$route->get("/product/post/{post_id}", "Services:post");
$route->post("/product/post/{post_id}", "Services:post");

//product size
$route->get("/product/post_size", "Services:postSize");
$route->post("/product/post_size", "Services:postSize");
$route->get("/product/post_size/{post_id}", "Services:postSize");
$route->get("/product/post_size_up/{post_id}", "Services:postSizeHome");
$route->get("/product/post_size_update/{post_id}", "Services:postSizeUp");
$route->post("/product/post_size_update/{post_id}", "Services:postSizeUp");

$route->get("/product/categories", "Services:categories");
$route->get("/product/categories/{page}", "Services:categories");
$route->get("/product/category", "Services:category");
$route->post("/product/category", "Services:category");
$route->get("/product/category/{category_id}", "Services:category");
$route->post("/product/category/{category_id}", "Services:category");

$route->get("/product/subcategories", "Services:subcategories");
$route->get("/product/subcategories/{page}", "Services:subcategories");
$route->get("/product/subcategory", "Services:subcategory");
$route->post("/product/subcategory", "Services:subcategory");
$route->get("/product/subcategory/{subcategory_id}", "Services:subcategory");
$route->post("/product/subcategory/{subcategory_id}", "Services:subcategory");

$route->get("/product/uploads", "Services:uploads");
$route->get("/product/uploads/{page}", "Services:uploads");
$route->get("/product/upload", "Services:upload");
$route->post("/product/upload", "Services:upload");
$route->get("/product/upload/{upload_id}", "Services:upload");
$route->post("/product/upload/{upload_id}", "Services:upload");




//whyus
$route->get("/about/home", "About:home");
$route->get("/about/home/{page}", "About:home");
$route->get("/about/post", "About:post");
$route->post("/about/post", "About:post");
$route->get("/about/post/{post_id}", "About:post");
$route->post("/about/post/{post_id}", "About:post");

$route->get("/about/img/delete/{img_id}", "About:img");
$route->post("/about/img/delete/{img_id}", "About:img");

//footer
$route->get("/footer/home", "SiteInfo:home");
$route->get("/footer/home/{page}", "SiteInfo:home");
$route->get("/footer/post", "SiteInfo:post");
$route->post("/footer/post", "SiteInfo:post");
$route->get("/footer/post/{post_id}", "SiteInfo:post");
$route->post("/footer/post/{post_id}", "SiteInfo:post");

//site home
$route->get("/home/home", "Home:home");
$route->get("/home/post", "Home:post");
$route->post("/home/post", "Home:post");
$route->get("/home/post/{post_id}", "Home:post");
$route->post("/home/post/{post_id}", "Home:post");

//contact
$route->get("/contact/home", "Contact:home");
$route->get("/contact/home/{page}", "Contact:home");
$route->post("/contact/post/{post_id}", "Contact:post");



//banner admin
$route->get("/slide/home", "Banner:home");
$route->get("/slide/post", "Banner:posts");
$route->post("/slide/post", "Banner:posts");
$route->get("/slide/post/{post_id}", "Banner:posts");
$route->post("/slide/post/{post_id}", "Banner:posts");

//users
$route->get("/users/home", "Users:home");
$route->post("/users/home", "Users:home");
$route->get("/users/home/{search}/{page}", "Users:home");
$route->get("/users/user", "Users:user");
$route->post("/users/user", "Users:user");
$route->get("/users/user/{user_id}", "Users:user");
$route->post("/users/user/{user_id}", "Users:user");

//notification center
$route->post("/notifications/count", "Notifications:count");
$route->post("/notifications/list", "Notifications:list");

//END ADMIN
$route->namespace("Source\App");

/**
 * PAY ROUTES
 */
$route->group("/pay");
$route->post("/create", "Pay:create");
$route->post("/update", "Pay:update");

/**
 * ERROR ROUTES
 */
$route->group("/ops");
$route->get("/{errcode}", "Web:error");

/**
 * ROUTE
 */
$route->dispatch();

/**
 * ERROR REDIRECT
 */
if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();