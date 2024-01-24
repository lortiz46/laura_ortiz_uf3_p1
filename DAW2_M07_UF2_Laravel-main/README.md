Analysis
1. Routes
    1.1. What are they and their purpose?
        Son servicios que proporciona el backend (ENDPOINTS)
    1.2. Where are they defined?
        Dentro de routes/web.php(devolver pg. web) o routes/api.php(devolver valores)
    1.3. How many are there?
        Hay 4 rutas (en web.php)
    1.4. How do they group?
        Bajo un prefijo
    1.5. Which prefix do they use?
        Filmout
    1.6. Which parameters do they use?
        El año y el genero. El '?' significa que es opcional


2. Middleware
    2.1. What are they and their purpose?
        Validadores de los datos de entrada a la peticion
    2.2. Where are they defined?
        En la carpeta app/Http/Middleware
    2.3. How many are there?
        Hay 10
    2.4. Which parameters do they use?
        El año
    2.5. When are they invoked?
        Puede ser o antes o despues de las rutas. routes/web.php
            middleware('year')->group(function(){})
        Debemos ponerlo dentro del Kernel para poder invocarlo.


3. Data
    3.1. Where are they defined?
        En storage/app/public/films.json
    3.2. How are they read?
        En el Controller/FilmController.php con la function readFilms(). Transforma el json en un array


4. Controller
    4.1. What are they and their purpose?
        Recibir peticiones dirigirlas a la funcion configurada y devolverr datos a la vista 'return View();'
    4.2. Where are they defined?
        app/http/FilmController.php
    4.3. How many are there?
        Hay 2:
            - (por defecto)
            - Film
            - Actores(FALTA)



5. View
    5.1. What are they and their purpose?
        Plantillas para generar html y su proposito es recibir datos y enviarselo al cte como html 
    5.2. Where are they defined?
        views/films/list.blade.php
    5.3. How many are there?
        2 vistas:
            - Welcome (por defecto)
            - Peliculas

Implementation
1. add fields country(string) and duration(int) to current data and adapt all components required to list them.
    storage/app/public/films.json
    resources\views\films\list.blade.php
2. split current route 'films/{year?}/{genre?}' in two new routes filmsByYear and filmsByGenre, every one only receives its corresponding parameter
    routes/web.php
3. adapt current function listFilms in FilmController to have listFilmsByYear and listFilmsByGenre for previous defined routes.
    app/http/FilmController.php
4. create a new route 'sortFilms' to list all films sorted by year descending, from newest to oldest.
    routes/web.php -
    app/http/FilmController.php -
    resources/views/films/list.blade.php
5. create a new route 'countFilms' to return total number of films on a new view counter
    routes/web.php
    resources/views/films/list.blade.php
    app/http/NewController.php

