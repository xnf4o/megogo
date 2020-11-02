<?php

namespace xnf4o\Megogo;

use GuzzleHttp\Client;
use Psr\Http\Message\StreamInterface;

class Megogo
{
    protected $client;
    private $api_url = 'https://api.megogo.net/v1';
    private $bill_url = 'https://billing.megogo.net';

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
    public function getVideoInfo($id = '3950851', $token = null): StreamInterface
    {
        if ($token) {
            $data = [
                'id' => $id,
                'access_token' => $token,
            ];
            $response = $this->client->request('GET', $this->api_url . '/video/info', [
                'query' => [
                    'id' => $id,
                    'access_token' => $token,
                    'sign' => $this->makeHash($data),
                ],
            ]);
        } else {
            $data = [
                'id' => $id,
            ];
            $response = $this->client->request('GET', $this->api_url . '/video/info', [
                'query' => [
                    'id' => $id,
                    'sign' => $this->makeHash($data),
                ],
            ]);
        }

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
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $hash .= $key . '=' . $value;
            }
        }
        $hash .= config('megogo.private_key');

        return md5($hash) . config('megogo.public_key');
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
        $response = $this->client->request('GET', $this->api_url . '/search', [
            'query' => [
                'text' => $text,
                'limit' => $limit,
                'sign' => $this->makeHash($data),
            ],
        ]);

        return $response->getBody();
    }

    /**
     * @param null $token
     * @param string $sort
     * @param int $page
     * @param null $category_id
     * @param null $genre
     * @param null $country
     * @param null $year_min
     * @param null $year_max
     * @return StreamInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * Получение списка видео из определенной категории и сортировка контента для формирования различных вариантов выдачи пользователю
     */
    public function getVideo($token, $sort, $page, $category_id, $genre, $country, $year_min, $year_max)
    {
        $offset = 20 * $page;
        $data = [
            'offset' => $offset,
            'subscription_id' => 131,
        ];
        if ($category_id) {
            $data['category_id'] = $category_id;
        }
        if ($sort) {
            $data['sort'] = $sort;
        }
        if ($genre) {
            $data['genre'] = $genre;
        }
        if ($country) {
            $data['country'] = $country;
        }
        if ($year_min) {
            $data['year_min'] = $year_min;
        }
        if ($year_max) {
            $data['year_max'] = $year_max;
        }
        if ($token) {
            $data['access_token'] = $token;
        }
        $query = [
            'offset' => $offset,
            'subscription_id' => 131,
            'sign' => $this->makeHash($data)
        ];
        if ($category_id) {
            $query['category_id'] = $category_id;
        }
        if ($sort) {
            $query['sort'] = $sort;
        }
        if ($genre) {
            $query['genre'] = $genre;
        }
        if ($country) {
            $query['country'] = $country;
        }
        if ($year_min) {
            $query['year_min'] = $year_min;
        }
        if ($year_max) {
            $query['year_max'] = $year_max;
        }
        if ($token) {
            $query['access_token'] = $token;
        }

        $response = $this->client->request('GET', $this->api_url . '/video', [
            'query' => $query,
        ]);

        return $response->getBody();
    }

    /**
     * @return StreamInterface
     * Получение списка категорий видео для вывода на главной странице (выбор редакции, подборки, слайдер) (при необходимости)
     */
    public function getDigest(): StreamInterface
    {
        $response = $this->client->request('GET', $this->api_url . '/digest', [
            'query' => [
                'sign' => $this->makeHash(),
            ],
        ]);

        dd($this->makeHash());

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
        $response = $this->client->request('GET', $this->api_url . '/video/collection', [
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
        $response = $this->client->request('GET', $this->api_url . '/configuration', [
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
        $response = $this->client->request('GET', $this->api_url . '/collections', [
            'query' => [
                'sign' => $this->makeHash(),
            ],
        ]);

        return $response->getBody();
    }

    public function getStream($video_id = 4520825, $token = null): StreamInterface
    {
        if ($token) {
            $data = [
                'video_id' => $video_id,
                'access_token' => $token,
            ];
            $response = $this->client->request('GET', $this->api_url . '/stream', [
                'query' => [
                    'video_id' => $video_id,
                    'access_token' => $token,
                    'sign' => $this->makeHash($data),
                ],
            ]);

            return $response->getBody();
        }
        $data = [
            'video_id' => $video_id,
        ];
        $response = $this->client->request('GET', $this->api_url . '/stream', [
            'query' => [
                'video_id' => $video_id,
                'sign' => $this->makeHash($data),
            ],
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * @param string $identifier Уникальный идентификатор пользователя на стороне партнера (номер договора, лицевого счета, логин и т.п.)
     * @return string Внутренний идентификатор пользователя на MEGOGO
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function register($identifier)
    {
        $response = $this->client->request('GET', $this->bill_url . '/partners/' . config('megogo.partner_id') . '/user/create', [
            'query' => [
                'identifier' => $identifier,
            ],
        ]);
        return json_decode($response->getBody()->getContents())->uid;
    }

    /**
     * Авторизация на MEGOGO
     *
     * @param integer $id ID клиента MEGOGO
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function auth($id)
    {
        $data = [
            'isdn' => $id,
            'partner_key' => config('megogo.partner_id'),
            'token' => md5($id . config('megogo.partner_id') . config('megogo.salt')),
        ];
        $response = $this->client->request('GET', $this->api_url . '/auth/by_partners', [
            'query' => [
                'isdn' => $id,
                'partner_key' => config('megogo.partner_id'),
                'token' => md5($id . config('megogo.partner_id') . config('megogo.salt')),
                'sign' => $this->makeHash($data),
            ],
        ]);

        return json_decode($response->getBody()->getContents());
    }

    /**
     * Информация о доступных подписках
     *
     * @param null $token Токен, если есть
     * @return mixed
     */
    public function subscriptionInfo($token = null)
    {
        if ($token) {
            $data = [
                'access_token' => $token,
            ];
            $response = $this->client->request('GET', $this->api_url . '/subscription/info', [
                'query' => [
                    'access_token' => $token,
                    'sign' => $this->makeHash($data),
                ],
            ]);
        } else {
            $data = [];
            $response = $this->client->request('GET', $this->api_url . '/subscription/info', [
                'query' => [
                    'sign' => $this->makeHash($data),
                ],
            ]);
        }

        return json_decode($response->getBody()->getContents());
    }

    /**
     * Изменение статуса подписки пользователя
     *
     * @param string $action Операция, которую необходимо проделать с подпиской (subscribe, unsubscribe, suspend, resume)
     * @param integer $userId Уникальный идентификатор пользователя на стороне партнера (номер договора, лицевого счета, логин и т.п.)
     * @param string $id Идентификатор подписки на стороне партнера
     */
    public function buySubscription($action, $userId, $id)
    {
        $response = $this->client->request('GET', $this->bill_url . '/partners/' . config('megogo.partner_id') . '/subscription/' . $action, [
            'query' => [
                'serviceId' => $id,
                'userId' => $userId,
            ],
        ]);

        return json_decode($response->getBody()->getContents());
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function subscription($sort = 'popular', $page = 1, $category_id = null)
    {
        $offset = 20 * $page;
        $data = [
            'sort' => $sort,
            'offset' => $offset
        ];
        if ($category_id) {
            $data['category_id'] = $category_id;
        }
        $query = [
            'sort' => $sort,
            'offset' => $offset,
            'sign' => $this->makeHash($data)
        ];
        if ($category_id) {
            $query['category_id'] = $category_id;
        }
        $response = $this->client->request('GET', $this->api_url . '/subscription', [
            'query' => $query,
        ]);

        return json_decode($response->getBody()->getContents());
    }

    /**
     * @param $action
     * @param $userId
     * @param $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function userSubscription($userId)
    {
        $response = $this->client->request('GET', $this->bill_url . '/partners/' . config('megogo.partner_id') . '/user/subscriptions', [
            'query' => [
                'identifier' => $userId,
            ],
        ]);

        return json_decode($response->getBody()->getContents());
    }

    /**
     * @param $like
     * @param $video_id
     * @param $token
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addVote($like, $video_id, $token)
    {
        $data = [
            'like' => $like,
            'video_id' => $video_id,
            'access_token' => $token,
        ];
        $response = $this->client->request('GET', $this->api_url . '/vote/add', [
            'query' => [
                'like' => $like,
                'video_id' => $video_id,
                'access_token' => $token,
                'sign' => $this->makeHash($data),
            ],
        ]);
        return $response->getBody()->getContents();
    }
}
