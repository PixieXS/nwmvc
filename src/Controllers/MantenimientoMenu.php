<?php 
namespace Controllers;
use \Views\Renderer as Renderer;


class MantenimientoMenu extends PublicController
{
public function run() : void
{
    $arrMenus = [
        "items" => [
        [
            "label" => "Productos",
            "icon" => "",
            "url" => "index.php?page=Menu-Productos"
        ],
        [
            "label" => "Categorías",
            "icon" => "",
            "url" => "index.php?page=Menu-Categorías"
        ],
        [
            "label" => "Ofertas",
            "icon" => "",
            "url" => "index.php?page=Menu-Ofertas"
        ],
        [
            "label" => "Cupones",
            "icon" => "",
            "url" => "index.php?page=Menu-Cupones"
        ]
       ]
    ];

    Renderer::render("mantenimientos", $arrMenus);
}
}
?>