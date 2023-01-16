<pre>
    <?php
    require_once('config/connection.php');
    ?>
</pre>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="file.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col">
                    <img src="images/main.png" class="img-fluid">
                </div>
            </div>
            <div class="row mt-5 justify-content-center">
                <button class="btn col-4 border btn-success" id="open_menu">
                    <div class="text-light" style="font-size: 30px"><b>Сделать заказ</b></div>
                </button>
                <script>
                    document.getElementById('open_menu').addEventListener('click', () => {window.location.href='order/menu.php'});
                </script>
            </div>
            <div class="row mt-5">
                <button class="btn col-3 justyfy-content-start border btn-light" id="open_admin">
                    <div class="text-dark">Меню для админа</div>
                </button>
                <script>
                    document.getElementById('open_admin').addEventListener('click', ()=>{window.location.href='admin/auth.php'})
                </script>
            </div>
        </div>
    </body>
</html>