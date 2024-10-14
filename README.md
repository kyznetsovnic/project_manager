### Старт приложения:

- docker compose up -d
- docker compose exec -it app bash

    ```
    composer install
    bin/console doctrine:migrations:migrate -q
    bin/console doctrine:fixtures:load -q
    ```

### API:
    localhost:8070/api/v1

#### Разработчики:

1. Добавление нового разработчика:
    ```
       POST /developers
       payload:
           {
                "name": "Валентин",
                "surname": "Дмитриевич",
                "patronymic": "Стрижов",
                "position": 1,
                "email": "strigov@mail.com",
                "age": 25,
                "phone": "67-15-55",
                "project": 1 // не обязательное поле. Указывается какой проект добавить
           }
    ```
   
2. Изменение данных разработчика:
    ```
       PATCH /developers/{id}
       payload:
           {
                "removeProject": true // не обязательное поле по умолчанию false,
                "project": 1 // Указывается какой проект добавить или удалить
           }
    ``` 

3. Увольнение разработчика:
    ```
       DELETE /dismiss/{id}
    ```   

4. Список разработчиков:
    ```
       GET /developers
    ```  
   
3. Данные одного разработчика:
    ```
       GET /developers/{id}
    ```  


#### Проекты:

1. Создание нового проекта:
    ```
       POST /projects
       payload:
           {
                "name": "Project new",
                "customer": 1,
                "developer": 4 // не обязательное поле
           }
    ```

2. Изменение данных проекта:
    ```
       PATCH /projects/{id}
       payload:
           {
                "developer": 4, // Указывается какого разработчика добавить или удалить
                "removeDeveloper": true // не обязательное поле по умолчанию false
           }
    ``` 

3. Закрыть проект:
    ```
       DELETE /close/{id}
    ```   

4. Список проектов:
    ```
       GET /projects
    ```  

3. Данные одного проекта:
    ```
       GET /projects/{id}
    ```  

#### Заказчики:

1. Список заказчиков:
    ```
       GET /customers
    ```  

2. Данные одного заказчика:
    ```
       GET /customers/{id}


#### Позициии разработчика:

1. Список позиций:
    ```
       GET /positions
    ```  

2. Данные одной позиции:
    ```
       GET /positions/{id}
