<div align="center">
      <h1> <img src="https://blog.megogo.net/wp-content/uploads/2021/01/logo-full-01-1-300x300.png" width="80px"><br/>Laravel megogo</h1>
     </div>
     
# Description
Laravel MeGoGo API integration

# Tech Used
 ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white) 
      
## Установка

Через Composer

``` bash
$ composer require xnf4o/megogo
```

## Подключение

Изначально, нужно провести инициализацию, объявляем:

```php
use xnf4o\Megogo\Megogo;
```

затем

```php
protected $megogo;
```

Затем в __construct

```php
$this->megogo = new Megogo();
```

## Методы

### Используется для получения информации о видео. 
```php
getVideoInfo($id, $token);
```
Для того, чтобы получить информацию о видео, нужно в параметрах указать указать id - идентификатор видео, и если нужно токен пользователя.

### Запрос на поиск 
```php
search($text, $limit);
```
Используется для получения списка видео по заданным параметрам

### Запрос на список видео для категории
```php
getVideo($token, $sort, $page, $category_id, $genre, $country, $year_min, $year_max);
```
Используется для получения списка видео для категории. К примеру, на получения списка мультфильмов, сериалов, тв и шоу...

Для того, чтобы получить список видео, для конкретной категории, нужно в параметрах указать  id - идентификатор категории.

Для того, чтобы получить видео для выбранного жанра (жанров) нужно в запросе указать еще й id выбранных жанров

### Запрос для получения информации которая отображается на главной странице 
```php
getDigest();
```
Запрос для получения категорий всех видео, которые нужно отображать на главной странице. В том числе: выбор редакции, подборки, слайдер

### Запрос на список подборок 
```php
getCollections();
```
Используется для получения списка всех подборок (коллекций) 

Для того, чтобы получить список подборок конкретной категории (фильмов, мультфильмов...) нужно в параметрах указать  category_id

### Запрос для получения изначальной конфигурации
```php
getConfiguration();
```
Запрос выполняется при старте приложения и нужен  для получения изначальной конфигурации нужен для построения связи между id категорий, названием, жанрами. Мы изначально запрашиваем информацию у сервера и кешируем ее.

### Запрос на список видео для подборки 
```php
getVideoCollections($token, $id, $sort, $page, $category_id, $genre, $country, $year_min, $year_max);
```
Используется для получения списка видео, которые входят в подборку

Для того, чтобы получить список видео, для конкретной подборки нужно в параметрах указать  id - идентификатор подборки

### Запрос на стрим видео
```php
getStream($id, $token);
```
Используется для получения стрима на видео

В параметрах передаем id видео, чтобы получить ссылку на видеопоток

### Регистрация нового пользователя
```php
register($id)
```
Регистрация нового пользователя в системе.

### Запрос для авторизации пользователя
```php
auth($id)
```
Запрос для авторизации пользователя в системе.

### Регистрация нового пользователя
```php
register($id)
```
Регистрация нового пользователя в системе.
    
