# Megogo

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]

Laravel MeGoGo API integration

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


## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [xnf4o][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/xnf4o/megogo.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/xnf4o/megogo.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/xnf4o/megogo/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/xnf4o/megogo
[link-downloads]: https://packagist.org/packages/xnf4o/megogo
[link-travis]: https://travis-ci.org/xnf4o/megogo
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/xnf4o
[link-contributors]: ../../contributors
