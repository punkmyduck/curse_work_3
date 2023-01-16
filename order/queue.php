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
        <div class="container text-center" style="margin-top: 200px">
            <div class="row">
                <div class="col-4"></div>
                <div class="btn col-4 border-dark bg-success text-light">
                    ваш номер в очереди: <?= $user_id ?>
                </div>
                <div class="col-4"></div>
            </div>
            <div class="row" style="margin-top: 300px">
                <div class="col-4"></div>
                <button class="btn col-4 btn-danger text-light" id="clear_and_back">
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
            </div>
        </div>
    </body>
</html>
