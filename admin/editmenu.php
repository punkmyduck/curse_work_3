<pre>
    <?php
        require_once('../config/connection.php');
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
        $sql = "SELECT *  FROM `food_menu`;";
        $result=mysqli_query($connection, $sql);
        if ($result==false){
            mysqli_error($connection);
        }
        $row=mysqli_fetch_assoc($result);
        while ($row){
        ?>
        <div id="super_puper_main_div">
        <div class="container text-center durak" style="margin-bottom: 40px" id="main_container<?= $row['id'] ?>">
            <div class="row justify-content-center">
                <div class="col">
                    <img src="../<?= $row['picture'] ?>" class="img-fluid" id="menu_picture<?= $row['id'] ?>">
                </div>
                <div class="col">
                    <div class="container text-center">
                        <div class="row justify-content-center">
                            <div class="col" style="font-size: 40px" id="menu_product_name<?= $row['id'] ?>">
                                <?= $row['product_name'] ?>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col" id="menu_price<?= $row['id'] ?>">
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
                                            <div class="accordion-body" id="menu_product_text<?= $row['id'] ?>">
                                                <?= $row['product_text'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="container text-center" style="margin-top: 40px">
                        <div class="row justify-content-center">
                            <div class="col-4"></div>
                            <button class="btn col-4 btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $row['id'] ?>">
                                Изменить
                            </button>
                            <div class="col-4"></div>
                        </div>


                        <div class="modal fade" id="exampleModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Заголовок модального окна</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" class="form-control" placeholder="Название продукта" id="product_name<?=$row['id']?>" style="margin-bottom: 10px">
                                    <input type="text" class="form-control" placeholder="Цена" id="price<?=$row['id']?>" style="margin-bottom: 10px">
                                    <input type="text" class="form-control" placeholder="Описание" id="product_text<?=$row['id']?>" style="margin-bottom: 10px">
                                    <input type="file" class="form-control" placeholder="Картинка" id="product_picture<?= $row['id'] ?>" style="margin-bottom: 10px">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-4"></div>
                                            <div class="col-4" id="message_for_user<?= $row['id'] ?>">pizda</div>
                                            <div class="col-4"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить изменения</button>
                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="save_changes<?= $row['id'] ?>">Сохранить изменения</button>
                                </div>

                                <script>
                                    document.getElementById("save_changes<?= $row['id'] ?>").addEventListener('click', () => {
                                        let product_name = document.getElementById("product_name<?= $row['id'] ?>").value,
                                            price = document.getElementById("price<?= $row['id'] ?>").value,
                                            product_text = document.getElementById("product_text<?= $row['id'] ?>").value,
                                            product_picture = document.getElementById("product_picture<?= $row['id'] ?>").value,
                                            product_id = <?= $row['id'] ?>;
                                        let create_data = new FormData();
                                        create_data.append('product_name', product_name);
                                        create_data.append('price', price);
                                        create_data.append('product_text', product_text);
                                        create_data.append('product_picture', product_picture);
                                        create_data.append('id', product_id);

                                        fetch('http://cursework/admin/edit_menu_index.php', {method: 'POST', body: create_data})
                                        .then( resp => {
                                            return resp.text();
                                        })
                                        .then( (msg) => {
                                            flag = msg;
                                            if(flag == -1) {
                                                new_content="не все поля введены";
                                                document.getElementById('message_for_user<?= $row['id'] ?>').innerHTML = new_content;
                                            }
                                            else if (flag == 1) {
                                                document.getElementById("menu_product_name<?= $row['id'] ?>").innerHTML = product_name;
                                                document.getElementById("menu_price<?= $row['id'] ?>").innerHTML = price;
                                                document.getElementById("menu_product_text<?= $row['id'] ?>").innerHTML = product_text;

                                            }
                                        }) 
                                    })
                                </script>

                                </div>
                            </div>
                        </div>


                        <div class="row justify-content-center" style="margin-top: 10px">
                            <div class="col-4">

                            </div>    
                            <button type="button" class="btn col-4 btn-danger" data-bs-toggle="modal" data-bs-target="#are_you_sure<?= $row['id'] ?>">
                                Удалить
                            </button>
                            <div class="col-4">

                            </div>   
                        </div>
                        <div class="modal fade" id="are_you_sure<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                        </div>
                                    <div class="modal-body">
                                        Вы уверены, что хотите удалить данный продукт?
                                    </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Отменить</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="delete_data<?= $row['id'] ?>">Удалить</button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <script>
                            document.getElementById("delete_data<?= $row['id'] ?>").addEventListener('click', () => {
                                let deleted_product_id=<?= $row['id'] ?>;
                                let delete_data = new FormData();
                                delete_data.append('id', deleted_product_id);
                                fetch('http://cursework/admin/delete_index.php', {method: 'POST', body: delete_data})
                                document.getElementById("main_container<?= $row['id'] ?>").remove();
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>
        </div>
        
        <?php
        $row=mysqli_fetch_assoc($result);
        }
        ?>

        <div class="container text-center border bg-light fixedmenu">
            <div class="row justify-content-center">
                <button class="btn col-3 btn-danger" id="go_to_main">
                    exit and go to main
                </button>
                <script>
                    document.getElementById("go_to_main").addEventListener('click', () => {
                        window.location.href='../index.php';
                    })
                </script>
                <div class="col-6">
                </div>
                <button type="button" class="btn btn-success col-3" data-bs-toggle="modal" data-bs-target="#create_new_product">
                    создать
                </button>
            </div>
        </div>
        <div class="modal fade" id="create_new_product" tabindex="-1" aria-labelledby="create_new_productLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="create_new_productLabel">Создать новый продукт</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Название продукта" id="new_product_name" style="margin-bottom: 10px">
                        <input type="text" class="form-control" placeholder="Цена" id="new_price" style="margin-bottom: 10px">
                        <input type="text" class="form-control" placeholder="Описание" id="new_product_text" style="margin-bottom: 10px">
                        <input type="file" class="form-control" placeholder="Картинка" id="new_product_picture" style="margin-bottom: 10px">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="create_new_product_one">Сохранить изменения</button>
                    </div>
                    </div>
                </div>
        </div>
        <script>
            document.getElementById('create_new_product_one').addEventListener('click', () => {
                let new_product_name=document.getElementById('new_product_name').value,
                    new_price=document.getElementById('new_price').value,
                    new_product_text=document.getElementById('new_product_text').value,
                    new_picture=document.getElementById('new_product_picture').value;
                let create_new_product= new FormData();
                create_new_product.append('product_name', new_product_name);
                create_new_product.append('price', new_price);
                create_new_product.append('product_text', new_product_text);
                create_new_product.append('picture', new_picture);
                fetch('http://cursework/admin/create_new_product.php', {method: 'POST', body: create_new_product});
            })
        </script>
    </body>
</html>