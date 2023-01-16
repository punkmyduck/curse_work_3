# Отчет о курсовой работе
### По курсу:
#### Основы программирования
### Работу выполнил:
#### Гулаков М.А., студент группы №3131



## Изучение предметной области

В каждом современном ресторане общественного питания существует киоск для заказа. 
Людям постоянно нужно заказывать еду, что с легкостью можно сделать через подобный киоск даже далекий от технологий пользователь.
Управляющим ресторана, в свою очередь, приходится контролировать меню, в котором содержатся все блюда: отредактировать, удалить добавить...
Целью стало создать интерфейс такого киоска, который объединяет в себе как возможность заказа еды, так и контроля состава меню.
    
## Задание
Создание интерфейса киоска для заказа еды, который будет включать в себя:
 - интерфейс для клиента ресторана:
   - добавление определенного количества блюд в корзину
   - просмотр корзины, ее редактирование
   - получение номера в очереди
 - интерфейс для управляющего составом меню:
   - авторизация администратора
   - добавить блюдо
   - редактировать блюдо
   - удалить блюдо
 - использование bootstrap для создания менее вырвиглазного дизайна, чем тот мог быть
 - использование AJAX для обновления меню/корзины
## Выбор технологий

#### Платформа:
Бесплатный хостинг sprinthost.ru
Ссылка на итоговый сайт, размещенный на данном хосте: http://f0767046.xsph.ru/
#### Среда разработки:
Visual Studio Code
#### Языки программирования:
JavaScript, PHP
#### Фреймворки:
Bootstrap

## Реализация

### Интерфейс:
- *концепт интерфейса основной страницы:*
   - ![](pics/1.jpg)

- *концепт интерфейса меню:*
   - ![](pics/2.jpg)

### Пользовательский сценарий:
Пользователь заходит на сайт, после видит приветствие и приглашение перейти в меню выбора или в меню для админа.

В меню выбора пользователь может:
- Выбрать блюдо и его количество
- Добавить выбранное в корзину
- Выйти на главный экран
- Перейти в корзину, в которой пользователь:
   - Перейти к оплате и узнать свой номер в очереди
   - Очистить корзину и вернуться на главную
   - вернуться в меню, чтобы дополнить корзину

В меню для админа пользователь видит страницу авторизации:
- Вернуться на главный экран
- Вводит занесенный в базу данных логин и пароль и переходит на страницу изменения меню:
   - Изменить блюдо
   - Удалить блюдо
   - Создать новое блюдо

### API сервера:

При авторизации администратора используется **fetch()**-запрос с методом **POST** и полями *login* и *password*

При добавлении блюда из меню выбора блюд в корзину используется **fetch()**-запрос с методом  **POST** и полями *user_id*, *product_id* и *count* (количество продукта)

При очищении корзины в меню выбора блюд используется **fetch()**-запрос с методом **POST** и полем *user_id*

На странице корзины используются два **fetch()**-запроса, оба с методом **POST**. Первый использует поля *product_id* и *user_id* для удаления определенного товара из корзины, второй использует поле *user_id* для полной очистки корзины.

На странице для изменения меню используется сразу три запроса **fetch()** с методами **POST**. Первый для изменения определенного блюда в меню, вторй для удаления блюда из меню, третий для создания нового блюда.

### Хореография

Пользователь попадает в **index.php**, где при нажатии кнопки *"меню для админа"* пользователь перенаправляется на страницу *"auth.php"*, где при успешной авторизации происходит перенаправление на *"editmenu.php"*, а при нажатии на кнопку *"cancel"* пользователь возвращается на главный экран. На странице *"editmenu.php"* есть кнопки:
- *"exit and go to main"*, которая возвращает пользователя на гланый экран
- *"создать"*, которая при заполнении всех данных посылает **fetch()**-запрос на **create_new_product.php**, где в базу данных при всех верных данных вносится добавленный продукт.
- *"изменить"*, которая при изменении данных посылает **fetch()**-запрос на **edit_menu_index.php**, где в базу данных вносятся изменения данного блюда.
- *"удалить"*, которая посылает **fetch()**-запрос на **delete_index.php**, где из базы данных удаляется данный продукт

Если же на главном экране пользователь выбирает кнопку *"Сделать заказ"*, то его перенаправляет в меню выбора блюд, где пользователь выбирает количество определенных блюд и при нажатии кнопки *"добавить"* отправляется **fetch()**-запрос на **add_to_cart.php**, что запоминает в базе данных для данного пользователя выбранный товар с его количеством. Кнопка *"На главную"* также отправит **fetch()**-запрос, но на **clear_cart.php**, где корзина данного пользователя очистится, а сам пользователь будет перенаправлен на главную. При нажатии на кнопку *"в корзину"* пользователь будет перенаправлен на страницу **cart.php**.

На странице **cart.php** пользователю представлен выбор его товара (или сообщение о его отсутствии) и возможности: кнопка *"Удалить"*, что посылает **fetch()**-запрос на **delete_from_cart.php**, что удаляет из корзины данный товар; кнопка *"в меню"*, что перенаправляет пользователя в меню выбора блюд; кнопка *"очистить корзину и вернуться на главную"*, название которой говорит само за себя; кнопка *"оплата"*, которая перенаправляет пользователя на **queue.php**, где пользователю представлены возможности вернуться на главный экран и увидеть свой номер в очереди.

### Структура базы данных

База данных состоит из трех таблиц:
- **admins**, со столбцами **id** (ключевой, автоинкремент), **login** (хранение логинов) и **password** (хранение паролей)
- **cart**, со столбцами **id** (ключевой, автоинкремент), **user_id** (хранение индекса определенного пользователя), **product_id** (хранение индекса выбранного продукта), **count** (количество выбранного продукта)
- **food_menu**, со столбцами **id** (ключевой, автоинкремент), **product_name** (хранение названия продукта), **product_text** (хранение описания продукта), **picture** (хранение картинки), **price** (хранение цены) 

### Алгоритмы

Алгоритм авторизации:

![3alg](https://user-images.githubusercontent.com/122292517/212717610-4e77bae6-256e-434b-9a93-91112d1be7c2.jpg)

### Значимые фрагменты кода

**fetch()**-запрос при авторизации:

        <script>
            document.getElementById("enter").addEventListener('click', () => {
                let login = document.getElementById('login').value;
                let password = document.getElementById('password').value;
                let create_data = new FormData();
                create_data.append('login', login);
                create_data.append('password', password);
                fetch('auth_index.php', {method: 'POST', body: create_data})
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

**fetch()**-запрос при изменении блюда в меню:

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
        fetch('edit_menu_index.php', {method: 'POST', body: create_data})
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
    
**fetch()**-запрос при удалении блюда из меню:

    <script>
        document.getElementById("delete_data<?= $row['id'] ?>").addEventListener('click', () => {
            let deleted_product_id=<?= $row['id'] ?>;
            let delete_data = new FormData();
            delete_data.append('id', deleted_product_id);
            fetch('delete_index.php', {method: 'POST', body: delete_data})
            document.getElementById("main_container<?= $row['id'] ?>").remove();
        })
    </script>
 
**fetch()**-запрос при добавлении блюда в меню

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
                fetch('create_new_product.php', {method: 'POST', body: create_new_product});
            })
        </script>
        
### Тестирование
Добавляем товары в корзину:

![menu](https://user-images.githubusercontent.com/122292517/212725847-8d6cd89a-47cc-4d96-8a35-a4200555d239.jpg)

Смотрим товары в корзине:

![cart](https://user-images.githubusercontent.com/122292517/212725885-9427104b-2586-410f-9754-d7110f4563ce.jpg)

Удаляем товар из корзины:

![delete_from_cart](https://user-images.githubusercontent.com/122292517/212725929-23130b12-5880-4e6f-a435-81863836107b.jpg)

Переходим в оплату:

![queue](https://user-images.githubusercontent.com/122292517/212726017-c8926a5c-7a1b-4476-b1e1-5a2ee16db75f.jpg)

Авторизация для администраторов:

![admin auth](https://user-images.githubusercontent.com/122292517/212726077-ba72da2f-4e0e-4392-b2d3-1c1cf47d38d4.jpg)

Удаление из меню блюд:

![admin delete](https://user-images.githubusercontent.com/122292517/212726303-c4c58930-7588-497e-9b34-19a12774c0d0.jpg)

Создаем обратно:

![admin create](https://user-images.githubusercontent.com/122292517/212726430-f17b2a4d-e4fb-4c83-ba2a-b24f90343355.jpg)

Успешно создано:

![admin created](https://user-images.githubusercontent.com/122292517/212726458-464eea71-e4f2-4754-8e1d-af96970fc854.jpg)

### Внедрение

#### Файлы на хостинге:

![hosting](https://user-images.githubusercontent.com/122292517/212727366-e261d854-9cf5-42b1-b27d-93b626a07619.jpg)

#### База данных на хостинге:

![bd](https://user-images.githubusercontent.com/122292517/212728089-8cc7a60e-a6f8-4b7c-842c-f49341d919ee.jpg)
