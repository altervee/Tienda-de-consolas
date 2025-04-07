<?php
define("KEY_TOKEN", "APR.wqc-345*");
define("MONEDA", "€");// para que sea sencillo cambiarlo a otra moneda y hacerse mas dinamico
session_start();
$num_cart = 0;
if(isset( $_SESSION['carrito']['productos'])){
    $num_cart = count( $_SESSION['carrito']['productos']);
}
?>