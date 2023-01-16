<pre>
<?php
require_once('../config/connection.php');
$user_id=$_COOKIE['user_id'];
?>
</pre>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../file.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
        $sql_for_cart = "SELECT *  FROM `cart` WHERE `user_id` = $user_id;";
        $result_for_cart=mysqli_query($connection, $sql_for_cart);
        if ($result_for_cart==false){
            mysqli_error($connection);
        }
        $row_for_cart=mysqli_fetch_assoc($result_for_cart);
        $allprice=0;
        if ($row_for_cart){
        while ($row_for_cart){
            $product_id=$row_for_cart['product_id'];
            $id=$row_for_cart['id'];
            $sql_for_menu = "SELECT *  FROM `food_menu` WHERE `id` = $product_id;";
            $result_for_menu=mysqli_query($connection, $sql_for_menu);
            if ($result_for_menu==false){
                mysqli_error($connection);
            }
            $menu=mysqli_fetch_assoc($result_for_menu);
            $allprice=$allprice + $row_for_cart['count'] * $menu['price'];
        ?>
        <div class="container text-center" style="margin-bottom: 40px" id="one_of_order<?= $row_for_cart['id'] ?>">
            <div class="row justify-content-center">
                <div class="col">
                    <img src="../<?= $menu['picture'] ?>" class="img-fluid">
                </div>
                <div class="col">
                    <div class="container text-center">
                        <div class="row justify-content-center" style="font-size: 40px">
                            <div class="col">
                                <?= $menu['product_name'] ?>
                            </div>
                        </div>
                        <div class="row justify-content-center" style="margin-top: 10px">
                            <div class="col">
                                <?= $menu['price'] ?> ₽
                            </div>
                        </div>
                        <div class=row justify-content-center">
                            <div class="col">
                                <div class="accordion" id="accordion<?= $menu['id'] ?>">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading<?= $menu['id'] ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $menu['id'] ?>" aria-expanded="false" aria-controls="collapseOne">
                                                Описание
                                            </button>
                                        </h2>
                                        <div id="collapse<?= $menu['id'] ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $menu['id'] ?>" data-bs-parent="#accordion<?= $menu['id'] ?>">
                                            <div class="accordion-body">
                                                <?= $menu['product_text'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="container text-center">
                        <div class="row justify-content-center" style="margin-top: 40px">
                            <div class="col" style="font-size: 30px">
                                Количество: <?= $row_for_cart['count'] ?>
                            </div>
                        </div>
                        <div class="row justify-content-center" style="margin-top: 10px">
                            <div class="col-4"></div>
                            <button class="btn col btn-danger text-light" id="delete_from_cart<?= $row_for_cart['product_id'] ?>">
                                Удалить
                            </button>

                            <script>
                                document.getElementById('delete_from_cart<?= $row_for_cart['product_id'] ?>').addEventListener('click', () => {
                                    let id = <?= $id ?>;
                                    let new_data = new FormData();
                                    new_data.append('id', id);
                                    fetch('http://cursework/order/delete_from_cart.php', {method: 'POST', body: new_data});
                                    document.getElementById('one_of_order<?= $row_for_cart['id'] ?>').remove();
                                })
                            </script>

                            <div class="col-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $row_for_cart=mysqli_fetch_assoc($result_for_cart);
            }
        }
        else echo '<div class="container text-dark text-center" style="font-size: 40px"> Корзина пуста </div>';
        ?>
        <div class="container text-center fixedmenu">
            <div class="row" style="margin-bottom: 50px">
                <div class="col-4"></div>
                <button class="btn col btn-success text-light" id="payment">
                    Оплата
                </button>
                <div class="col-4"></div>
                <script>
                    document.getElementById("payment").addEventListener('click', () => {
                        window.location.href='queue.php';
                    })
                </script>
            </div>
            <div class="row">
                <button class="btn col-3 btn-danger text-light" id="clear_and_back">
                    Очистить корзину и вернуться на главную
                </button>

                <script>
                    document.getElementById("clear_and_back").addEventListener('click', () => {
                        let user_id = <?= $user_id ?>;
                        let new_data = new FormData();
                        new_data.append('user_id', user_id);
                        fetch('http://cursework/order/clear_cart.php', {method: 'POST', body: new_data});
                        window.location.href='../index.php';
                    })
                </script>
                <div class="col-6">
                </div>
                <button class="btn col btn-warning text-dark" id="go_to_menu" style="font-size: 30px">
                    В меню
                </button>
                <script> 
                    document.getElementById("go_to_menu").addEventListener('click', () => {
                        window.location.href='menu.php';
                    })
                </script>
            </div>
        </div>
    </body>
</html>