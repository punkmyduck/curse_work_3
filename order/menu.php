<pre>
<?php
require_once('../config/connection.php');
if (!isset($_COOKIE['user_id'])){
    $user_id=rand(1, 1000);
    setcookie('user_id', $user_id);
}
else $user_id=$_COOKIE['user_id'];
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
        $sql='SELECT * FROM `food_menu`';
        $result=mysqli_query($connection, $sql);
        if ($reslut==false) {
            mysqli_error($connection);
        }
        $row=mysqli_fetch_assoc($result);
        while ($row){
        ?>
        <div class="container text-center" style="margin-bottom: 40px">
            <div class="row justify-content-center">
                <div class="col">
                    <img src="../<?= $row['picture'] ?>" class="img-fluid">
                </div>
                <div class="col">
                    <div class="container text-center">
                        <div class="row justify-content-center">
                            <div class="col" style="font-size:40px">
                                <?= $row['product_name'] ?>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col" style="margin-bottom: 10px" style="margin-top: 10px">
                                <?= $row['price'] ?> ₽
                            </div>
                        </div>
                        <div class=row justify-content-center">
                            <div class="col">
                                <div class="accordion" id="accordion<?= $row['id'] ?>">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading<?= $row['id'] ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $row['id'] ?>" aria-expanded="false" aria-controls="collapseOne">
                                                Описание
                                            </button>
                                        </h2>
                                        <div id="collapse<?= $row['id'] ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $row['id'] ?>" data-bs-parent="#accordion<?= $row['id'] ?>">
                                            <div class="accordion-body">
                                                <?= $row['product_text'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col" style="margin-top: 50px">
                    <div class="container text-center">
                        <div class="row justify-content-center" style="margin-bottom: 20px">
                            <div class="col-3"></div>
                            <button class="btn col-1 justify-content-center border-dark" id="less_product<?php  echo($row['id']) ?>"">
                                -
                            </button>
                            <div class="col justify-content-center">
                                <div id="count_of_product<?php  echo($row['id']) ?>">
                                    0
                                </div>
                            </div>
                            <button class="btn col-1 justify-content-center border-dark" id="more_product<?php  echo($row['id']) ?>"">
                                +
                            </button>
                            <div class="col-3"></div>
                        </div>
                        <script>
                            document.getElementById("more_product<?php  echo($row['id']) ?>").addEventListener('click', () => {
                                document.getElementById("count_of_product<?= $row['id'] ?>").innerHTML++;
                            })
                            document.getElementById("less_product<?php  echo($row['id']) ?>").addEventListener('click', () => {
                                if (document.getElementById("count_of_product<?= $row['id'] ?>").innerHTML!=0)
                                    document.getElementById("count_of_product<?= $row['id'] ?>").innerHTML--
                            })
                        </script>

                        <div class="row justify-content-center">
                            <div class="col"></div>
                            <button class="btn col justify-content-center btn-success text-light" id="add_to_cart<?= $row['id'] ?>" style="font-size: 20px">
                                    добавить
                            </button>
                            <div class="col"></div>
                        </div>
                        <script>
                            document.getElementById("add_to_cart<?= $row['id'] ?>").addEventListener('click', () => {
                                document.getElementById("add_to_cart<?= $row['id'] ?>").disabled=true;

                                let user_id = <?= $user_id ?>;
                                let product_id = <?= $row['id'] ?>;
                                let count = document.getElementById("count_of_product<?= $row['id'] ?>").innerHTML;
                                let new_data = new FormData();
                                new_data.append('user_id', user_id);
                                new_data.append('product_id', product_id);
                                new_data.append('count', count);
                                fetch('http://cursework/order/add_to_cart.php', {method: 'POST', body: new_data});
                                

                                
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $row=mysqli_fetch_assoc($result);
        }
        ?>
        <div class="container text-center border fixedmenu">
            <div class="row justify-content-center">
                <button class="btn col-3 btn-danger text-light" id="clear_and_back" style="font-size: 30px">
                    На главную
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
                <button class="btn col-3 btn-success text-light" id="go_to_cart" style="font-size: 30px">
                    В корзину
                </button>

                <script>
                    document.getElementById('go_to_cart').addEventListener('click', () => {
                        window.location.href='cart.php';
                    })
                </script>

            </div>
        </div>
    </body>
</html>