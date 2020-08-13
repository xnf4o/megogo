<?php

namespace xnf4o\Megogo;

use GuzzleHttp\Client;
use Psr\Http\Message\StreamInterface;

class Megogo
{
    private $api_url = 'https://api.megogo.net/v1';

    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Используется для получения информации о видео.
     *
     * @param string $id
     * @return StreamInterface
     * Получение списка видео из определенной категории и сортировка контента для формирования различных вариантов выдачи пользователю
     */
    public function getVideoInfo($id = '3950851'): StreamInterface
    {
        $data = [
            'id' => $id,
        ];
        $response = $this->client->request('GET', $this->api_url.'/video/info', [
            'query' => [
                'id' => $id,
                'sign' => $this->makeHash($data),
            ],
        ]);

        return $response->getBody();
    }

    /**
     * @param $text
     * @param int $limit
     * @return mixed
     */
    public function search($text, $limit = 20)
    {
        $data = [
            'text' => $text,
            'limit' => $limit,
        ];
        $response = $this->client->request('GET', $this->api_url.'/search', [
            'query' => [
                'text' => $text,
                'limit' => $limit,
                'sign' => $this->makeHash($data),
            ],
        ]);

        return $response->getBody();
    }

    /**
     * @param string $sort
     * @return StreamInterface
     * Получение списка видео из определенной категории и сортировка контента для формирования различных вариантов выдачи пользователю
     */
    public function getVideo($category_id, $sort = 'popular'): StreamInterface
    {
        $data = [
            'sort' => $sort,
            'category_id' => $category_id,
        ];
        $response = $this->client->request('GET', $this->api_url.'/video', [
            'query' => [
                'sort' => $sort,
                'category_id' => $category_id,
                'sign' => $this->makeHash($data),
            ],
        ]);

        return $response->getBody();
    }

    /**
     * @param null $data
     * @param null $hash
     * @return string
     * Генерация подписи
     */
    private function makeHash($data = null, $hash = null): string
    {
        if (! empty($data)) {
            foreach ($data as $key => $value) {
                $hash .= $key.'='.$value;
            }
        }
        $hash .= config('megogo.private_key');

        return md5($hash).config('megogo.public_key');
    }

    /**
     * @return StreamInterface
     * Получение списка категорий видео для вывода на главной странице (выбор редакции, подборки, слайдер) (при необходимости)
     */
    public function getDigest(): StreamInterface
    {
        $response = $this->client->request('GET', $this->api_url.'/digest', [
            'query' => [
                'sign' => $this->makeHash(),
            ],
        ]);

        return $response->getBody();
    }

    /**
     * @param int $id
     * @param int $limit
     * @return StreamInterface
     * Получение доступных TVOD объектов
     */
    public function getVideoCollections($id = 21571, $limit = 500): StreamInterface
    {
        $data = [
            'id' => $id,
            'limit' => $limit,
        ];
        $response = $this->client->request('GET', $this->api_url.'/video/collection', [
            'query' => [
                'id' => $id,
                'limit' => $limit,
                'sign' => $this->makeHash($data),
            ],
        ]);

        return $response->getBody();
    }

    /**
     * @return StreamInterface
     * Получение данных конфигурации для построения связей между id категорий, названиями, жанрами (при необходимости)
     */
    public function getConfiguration(): StreamInterface
    {
        $response = $this->client->request('GET', $this->api_url.'/configuration', [
            'query' => [
                'sign' => $this->makeHash(),
            ],
        ]);

        return $response->getBody();
    }

    /**
     * @return StreamInterface
     * Получение списка доступных подборок видео
     */
    public function getCollections(): StreamInterface
    {
        $response = $this->client->request('GET', $this->api_url.'/collections', [
            'query' => [
                'sign' => $this->makeHash(),
            ],
        ]);

        return $response->getBody();
    }

    public function getStream($video_id = 4520825): StreamInterface
    {
        $data = [
            'video_id' => $video_id,
        ];
        $response = $this->client->request('GET', $this->api_url.'/stream', [
            'query' => [
                'video_id' => $video_id,
                'sign' => $this->makeHash($data),
            ],
        ]);

        return $response->getBody();
    }

    public function auth()
    {

    }
}
