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
        <div class="container text-center">
            <div class="row" style="margin-top: 300px">
                <div class="col">
                    <input type="text" placeholder="login" style="font-size: 30px" id="login">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="password" placeholder="password" style="font-size: 30px" id="password">
                </div>
            </div>
            <div class="row">
                <div class="col text-danger" id="message">

                </div>
            </div>
            <div class="row" style="margin-top: 250px">
                <button class="btn col btn-danger border-dark" style="font-size: 30px" id="cancel">
                    cancel
                </button>
                <script>
                    document.getElementById("cancel").addEventListener('click', () => {
                        window.location.href='../index.php';
                    })
                </script>
                <div class="col"></div>
                <button class="btn col btn-success border-dark" style="font-size: 30px" id="enter">
                    enter
                </button>
                <script>
                    document.getElementById("enter").addEventListener('click', () => {
                        let login = document.getElementById('login').value;
                        let password = document.getElementById('password').value;
                        let create_data = new FormData();
                        create_data.append('login', login);
                        create_data.append('password', password);
                    
                        fetch('http://cursework/admin/auth_index.php', {method: 'POST', body: create_data})
                        .then( resp => {
                            return resp.text();
                        })
                        .then( msg => {
                            flag = msg;
                            if(flag == -1) {
                                document.getElementById("message").innerHTML='incorrect login or password, try again';
                            }
                            else if (flag == 1) {
                                window.location.href = 'editmenu.php';
                            }
                        }) 
                    })
                </script>
            </div>
        </div>
    </body>
</html>