<?php

namespace Database\Seeders;

use App\Tbuy\Menu\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    protected array $menus = [
        [
            'menu' => [
                'name' => 'Товары',
                'slug' => 'Products',
                'is_active' => false,
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Новые Товары',
                        'slug' => 'New Products',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Отклоненные товары',
                        'slug' => 'Rejected Products',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Отклоненные бренды',
                        'slug' => 'Rejected Brands',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Последние 100 одобренные товары',
                        'slug' => 'Last 100 Approved Products',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Все активне товары',
                        'slug' => 'All Active Products',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Аналогические товары',
                        'slug' => 'Analogous Products',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Товары С нулевым остатком',
                        'slug' => 'Zero Stock Products',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Неактивные товары',
                        'slug' => 'Inactive Products',
                        'is_active' => false
                    ],
                    'children' => []
                ],
            ]
        ],
        [
            'menu' => [
                'name' => 'Проверка товаров',
                'slug' => 'Product Check',
                'is_active' => false,
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Наличие бренда в модели',
                        'slug' => 'Brand Presence in Model',
                        'is_active' => false,
                    ],
                    'children' => [],
                ],
                [
                    'menu' => [
                        'name' => 'С повторяющимися именами',
                        'slug' => 'Products with Repeating Names',
                        'is_active' => false,
                    ],
                    'children' => [],
                ],
                [
                    'menu' => [
                        'name' => 'Товары с длинными именами',
                        'slug' => 'Products with Long Names',
                        'is_active' => false,
                    ],
                    'children' => [],
                ],
                [
                    'menu' => [
                        'name' => 'Товары с одинаковым названием, но разными фильтрами',
                        'slug' => 'Products with Same Name but Different Filters',
                        'is_active' => false,
                    ],
                    'children' => [],
                ],
                [
                    'menu' => [
                        'name' => 'Обязательная отметка с меньшим количеством фильтров',
                        'slug' => 'Mandatory Label with Fewer Filters',
                        'is_active' => false,
                    ],
                    'children' => [],
                ],
                [
                    'menu' => [
                        'name' => 'Содержит одинаковые фото',
                        'slug' => 'Contains Identical Photos',
                        'is_active' => false,
                    ],
                    'children' => [],
                ],
                [
                    'menu' => [
                        'name' => 'С меньшим, чем минимальное изображение',
                        'slug' => 'With Smaller than Minimum Image',
                        'is_active' => false,
                    ],
                    'children' => [],
                ],
                [
                    'menu' => [
                        'name' => 'Фото плохого качества',
                        'slug' => 'Poor Quality Photos',
                        'is_active' => false,
                    ],
                    'children' => [],
                ],
                [
                    'menu' => [
                        'name' => 'Содержит взаимосвязанные фильтры',
                        'slug' => 'Contains Interrelated Filters',
                        'is_active' => false,
                    ],
                    'children' => [],
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Аналитика товаров',
                'slug' => 'Product Analytics',
                'is_active' => false
            ],
            'children' => []
        ],
        [
            'menu' => [
                'name' => 'Аналитика рекламных товаров',
                'slug' => 'Advertising Product Analytics',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Специальное предложение',
                        'slug' => 'Special Offer',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Акция с подарком',
                        'slug' => 'Gift with Purchase Promotion',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Скидка',
                        'slug' => 'Discount',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Срочные акции',
                        'slug' => 'Urgent Promotions',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Дерево категорий товаров',
                'slug' => 'Product Category Tree',
                'is_active' => false,
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Настройки категории',
                        'slug' => 'Category Settings',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Проверка категорий товаров',
                        'slug' => 'Category Product Check',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Фильтры товаров',
                'slug' => 'Product Filters',
                'is_active' => false,
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Добавить новый фильтр',
                        'slug' => 'Add New Filter',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Бренды:',
                        'slug' => 'Brands',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Глобальные фильтры',
                        'slug' => 'Global Filters',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Все фильтры',
                        'slug' => 'All Filters',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Меры измерения',
                        'slug' => 'Measurement Units',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Типы фильтров',
                        'slug' => 'Filter Types',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Определение контента 18+ по категориям',
                        'slug' => 'Category Content 18+ Determination',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Страны-производители:',
                        'slug' => 'Countries of Origin',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Марки и модели автомобилей',
                        'slug' => 'Car Brands and Models',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Проверка фильтра товаров',
                        'slug' => 'Product Filter Check',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Аналитика категорий',
                        'slug' => 'Category Analytics',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Аналитика фильтров',
                        'slug' => 'Filter Analytics',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Подарочная карта онлайн',
                'slug' => 'Online Gift Card',
                'is_active' => false,
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Покупка',
                        'slug' => 'Purchase',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Активный',
                        'slug' => 'Active',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Купленные/подаренные карты',
                        'slug' => 'Purchased/Gifted Cards',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Загрузить/архив шаблона',
                        'slug' => 'Upload/Archive Template',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Пожертвования',
                        'slug' => 'Donations',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Переподарено',
                        'slug' => 'Re-gifted',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Настройки подарочных карт',
                        'slug' => 'Gift Card Settings',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Аналитика подарочных карт',
                        'slug' => 'Gift Card Analytics',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Сравнительная аналитика',
                'slug' => 'Comparative Analytics',
                'is_active' => false,
            ],
            'children' => []
        ],
        [
            'menu' => [
                'name' => 'Аналитика лайков',
                'slug' => 'Likes Analytics',
                'is_active' => false,
            ],
            'children' => []
        ],
        [
            'menu' => [
                'name' => 'Аналитика комментариев',
                'slug' => 'Comments Analytics',
                'is_active' => false,
            ],
            'children' => []
        ],
        [
            'menu' => [
                'name' => 'Аналитика товаров в корзине',
                'slug' => 'Cart Products Analytics',
                'is_active' => false,
            ],
            'children' => []
        ],
        [
            'menu' => [
                'name' => 'Главый Банер Домашней страница',
                'slug' => 'Homepage Main Banner',
                'is_active' => false,
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Новый Банер',
                        'slug' => 'New Banner',
                        'is_active' => false,
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Отклоненные',
                        'slug' => 'Rejected',
                        'is_active' => false,
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Активный/архивный',
                        'slug' => 'Active/Archived',
                        'is_active' => false,
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход возрастное ограничение',
                        'slug' => 'Age Restriction Entry',
                        'is_active' => false,
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход в регион',
                        'slug' => 'Region Entry',
                        'is_active' => false,
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход по полу',
                        'slug' => 'Gender Entry',
                        'is_active' => false,
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Cat-Fish Банер',
                'slug' => 'Cat-Fish Banner',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Новый Cat-Fish Банер',
                        'slug' => 'New Cat-Fish Banner',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Отклоняено Cat-Fish',
                        'slug' => 'Rejected Cat-Fish',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Активный/архивный',
                        'slug' => 'Active/Archived',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход возрастное ограничение',
                        'slug' => 'Age Restriction Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход в регион',
                        'slug' => 'Region Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход по полу',
                        'slug' => 'Gender Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Рекламные СМС сообщения',
                'slug' => 'Advertising SMS Messages',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Новое уведомление',
                        'slug' => 'New Notification',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Отклоненные',
                        'slug' => 'Rejected',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Активный/архивный',
                        'slug' => 'Active/Archived',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход возрастное ограничение',
                        'slug' => 'Age Restriction Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход в регион',
                        'slug' => 'Region Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход по полу',
                        'slug' => 'Gender Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Рассылки Viber',
                'slug' => 'Viber Mailings',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Новое Рассылкa',
                        'slug' => 'New Mailing',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Отклоненные',
                        'slug' => 'Rejected',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Активный/архивный',
                        'slug' => 'Active/Archived',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход возрастное ограничение',
                        'slug' => 'Age Restriction Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход в регион',
                        'slug' => 'Region Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход по полу',
                        'slug' => 'Gender Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Рассылки Telegram',
                'slug' => 'Telegram Mailings',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Новое Рассылкa',
                        'slug' => 'New Mailing',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Отклоненные',
                        'slug' => 'Rejected',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Активный/архивный',
                        'slug' => 'Active/Archived',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход возрастное ограничение',
                        'slug' => 'Age Restriction Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход в регион',
                        'slug' => 'Region Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход по полу',
                        'slug' => 'Gender Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Рассылки WhatsApp',
                'slug' => 'WhatsApp Mailings',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Новое Рассылкa',
                        'slug' => 'New Mailing',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Отклоненные',
                        'slug' => 'Rejected',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Активный/архивный',
                        'slug' => 'Active/Archived',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход возрастное ограничение',
                        'slug' => 'Age Restriction Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход в регион',
                        'slug' => 'Region Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход по полу',
                        'slug' => 'Gender Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Рассылки на Email',
                'slug' => 'Email Mailings',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Новое Рассылкa',
                        'slug' => 'New Mailing',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Отклоненные',
                        'slug' => 'Rejected',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Активный/архивный',
                        'slug' => 'Active/Archived',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход возрастное ограничение',
                        'slug' => 'Age Restriction Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход в регион',
                        'slug' => 'Region Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход по полу',
                        'slug' => 'Gender Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Реклама Промо Рассылки',
                'slug' => 'Promo Advertising Mailings',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Новое Рассылкa',
                        'slug' => 'New Mailing',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Отклоненные',
                        'slug' => 'Rejected',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Активный/архивный',
                        'slug' => 'Active/Archived',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход возрастное ограничение',
                        'slug' => 'Age Restriction Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход в регион',
                        'slug' => 'Region Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вход по полу',
                        'slug' => 'Gender Entry',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Маркетинг',
                'slug' => 'Marketing',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Дня Рождения',
                        'slug' => 'Birthday',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Настройки Дня рождения',
                        'slug' => 'Birthday Settings',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Аналитика Дня рождения',
                        'slug' => 'Birthday Analytics',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'TBUY Настройки годового планирования сайта',
                        'slug' => 'TBUY Site Annual Planning Settings',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Аналитика годового планирования для сайта TBUY',
                        'slug' => 'TBUY Site Annual Planning Analytics',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Создать рекламы на сайте TBUY',
                'slug' => 'Create Ads on TBUY Site',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Создать новый главный обои',
                        'slug' => 'Create New Main Wallpaper',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Архив всех Банеров на главной странице TBUY',
                        'slug' => 'Archive of All Banners on TBUY Home Page',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Cat-Fish новые баннер',
                        'slug' => 'Cat-Fish New Banners',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'TBUY Архив всех баннеров Cat-Fish',
                        'slug' => 'TBUY Archive of All Cat-Fish Banners',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Архив все обоев организации',
                        'slug' => 'Archive of All Organization Wallpapers',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Аналитика банера в странице организации',
                        'slug' => 'Analytics of Banner on Organization Page',
                        'is_active' => false
                    ],
                    'children' => []
                ],
            ]
        ],
        [
            'menu' => [
                'name' => 'Рассылки Отправленые с TBUY',
                'slug' => 'Mailings Sent from TBUY',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'SMS',
                        'slug' => 'SMS',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Viber',
                        'slug' => 'Viber',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'WhatsApp',
                        'slug' => 'WhatsApp',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Telegram',
                        'slug' => 'Telegram',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Promo',
                        'slug' => 'Promo',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Email',
                        'slug' => 'Email',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Аналитикa Рассылок от TBUY',
                        'slug' => 'TBUY Mailings Analytics',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Вакансии в TBUY',
                'slug' => 'Job Vacancies at TBUY',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Создать новое заявки',
                        'slug' => 'Create New Job Posting',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Все объявления о вакансии работодателей в TBUY',
                        'slug' => 'All Job Postings by Employers at TBUY',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Аналитика вакансий в TBUY',
                        'slug' => 'TBUY Job Vacancies Analytics',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Обжалование',
                'slug' => 'Appeals',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Новое обжалование',
                        'slug' => 'New Appeal',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Текущие обжалование',
                        'slug' => 'Current Appeals',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Архив жалоб',
                        'slug' => 'Complaints Archive',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Аналитика обжалование',
                        'slug' => 'Appeals Analytics',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Настройки обжалования',
                        'slug' => 'Appeals Settings',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Словарь и языки',
                'slug' => 'Dictionary and Languages',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Слова страницы компании',
                        'slug' => 'Company Page Words',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Тексты страницы компании',
                        'slug' => 'Company Page Texts',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Слова веб-сайта TBUY',
                        'slug' => 'TBUY Website Words',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Тексты веб-сайта TBUY',
                        'slug' => 'TBUY Website Texts',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Статические слова и тексты в приложении TBUY',
                        'slug' => 'Static Words and Texts in TBUY App',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Коммерческие слова и тексты',
                        'slug' => 'Commercial Words and Texts',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Слова доставки и тексты',
                        'slug' => 'Delivery Words and Texts',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Вставка слов и текстов',
                        'slug' => 'Insert Words and Texts',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Категории товаров',
                        'slug' => 'Product Categories',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Категории услуг',
                        'slug' => 'Service Categories',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Услуги',
                        'slug' => 'Services',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Настройки категорий услуг',
                                'slug' => 'Service Category Settings',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика категории услуг',
                                'slug' => 'Services Category Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Проверка категории услуг',
                                'slug' => 'Services Category Check',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Сервисные фильтры',
                        'slug' => 'Service Filters',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Добавить фильтр',
                                'slug' => 'Add Filter',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Все фильтры',
                                'slug' => 'All Filters',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Типы фильтров',
                                'slug' => 'Filter Types',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Глобальный фильтр',
                                'slug' => 'Global Filter',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Проверка фильтров услуг',
                                'slug' => 'Service Filters Check',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика фильтров услуг',
                                'slug' => 'Service Filters Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Объявления на услуг',
                        'slug' => 'Service Ads',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Новый',
                                'slug' => 'New',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Последние 100',
                                'slug' => 'Last 100',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Отклоненные услуги',
                                'slug' => 'Rejected Services',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Активные',
                                'slug' => 'Active',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Неактивные',
                                'slug' => 'Inactive',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика услуг',
                                'slug' => 'Services Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Дерево категорий вакансий',
                        'slug' => 'Job Category Tree',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Настройки Категории Вакансии',
                                'slug' => 'Job Category Settings',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Проверка категорий вакансий',
                                'slug' => 'Job Category Check',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика категорий вакансий',
                                'slug' => 'Job Category Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Фильтры категорий вакансий',
                        'slug' => 'Job Category Filters',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Добавить фильтр',
                                'slug' => 'Add Filter',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Все фильтры',
                                'slug' => 'All Filters',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Типы фильтров',
                                'slug' => 'Filter Types',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Глобальный фильтр',
                                'slug' => 'Global Filter',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Проверка фильтров вакансий',
                                'slug' => 'Job Filters Check',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика фильтров вакансий',
                                'slug' => 'Job Filters Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                    ]
                ], [
                    'menu' => [
                        'name' => 'Пользователи',
                        'slug' => 'Users',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Все пользователи',
                                'slug' => 'All Users',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Способ покупки',
                        'slug' => 'Payment Method',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Все покупки',
                                'slug' => 'All Purchases',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'С кредитом',
                                'slug' => 'Credit Purchases',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'С платежными системами',
                                'slug' => 'Payment System Purchases',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Банковская картой',
                                'slug' => 'Credit Card Purchases',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Наличные',
                                'slug' => 'Cash Purchases',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Трансфером',
                                'slug' => 'Transfer Purchases',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Аналитика покупок',
                        'slug' => 'Purchase Analytics',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Региональная аналитика',
                                'slug' => 'Regional Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Финансовый аналитика',
                                'slug' => 'Financial Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Сезонность',
                                'slug' => 'Seasonality',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'По категориям',
                                'slug' => 'Category-wise Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Продавец: Физическое лицо',
                        'slug' => 'Seller: Individual',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Новая заявка на регистрацию',
                                'slug' => 'New Registration Request',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Отклоненные',
                                'slug' => 'Rejected',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Последние 50 одобренные',
                                'slug' => 'Last 50 Approved',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Все продающие физические лица',
                                'slug' => 'All Selling Individuals',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Ежедневные источники дохода в кошельке Физ. лиц',
                                'slug' => 'Daily Income Sources for Individuals',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Расход средств с кошельков',
                        'slug' => 'Wallet Expenses',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Покупка тарифного пакета',
                                'slug' => 'Package Purchase',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'СМС-сообщение',
                                'slug' => 'SMS Message',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Сообщение в Viber',
                                'slug' => 'Viber Message',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Сообщение в WhatsApp',
                                'slug' => 'WhatsApp Message',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Программа Telegram',
                                'slug' => 'Telegram Program',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Сообщение Email',
                                'slug' => 'Email Message',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Promo программа',
                                'slug' => 'Promo Program',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Покупка акций',
                                'slug' => 'Stock Purchase',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Обновления продуктов',
                                'slug' => 'Product Updates',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ], [
                    'menu' => [
                        'name' => 'Аналитика продавца физических лиц',
                        'slug' => 'Seller Analytics: Individuals',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Аналитика продаж',
                                'slug' => 'Sales Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика страницы физ.лиц в TBUY',
                                'slug' => 'Individuals Page Analytics in TBUY',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Тарифный пакет',
                                'slug' => 'Tariff Package',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Объявления',
                                'slug' => 'Announcements',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Рассылки',
                                'slug' => 'Mailings',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Подписчики',
                                'slug' => 'Subscribers',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Социальное: сети',
                                'slug' => 'Social Networks',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Восполнимость страницы',
                                'slug' => 'Page Recovery',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Источники кликов для категорий товаров, продаваемых по количеству',
                                'slug' => 'Click Sources for Quantity-Sold Categories',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Количество добавлений товаров в категорию по времени',
                                'slug' => 'Number of Item Additions to Categories Over Time',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Объявления о вакансиях',
                        'slug' => 'Job Vacancy Announcements',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Новые заявки',
                                'slug' => 'New Applications',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Отклоненные заявки',
                                'slug' => 'Rejected Applications',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Архив о заявлениях на работу',
                                'slug' => 'Job Application Archive',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Проверка поиска работы',
                                'slug' => 'Job Search Verification',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика поиска работы',
                                'slug' => 'Job Search Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Устройства доступа',
                        'slug' => 'Access Devices',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'IMEI и модель телефона устройств, к которым осуществляется доступ',
                                'slug' => 'IMEI and Phone Model of Access Devices',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Расположение устройств, к которым осуществляется доступ, по времени',
                                'slug' => 'Location of Access Devices Over Time',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'MAC-адрес модуля WIFI устройства',
                                'slug' => 'MAC Address of WIFI Module of Device',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'MAC-адрес WIFI, к которому он подключен',
                                'slug' => 'MAC Address of WIFI Its Connected to',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'MAC-адрес Bluetooth-устройства',
                                'slug' => 'MAC Address of Bluetooth Device',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Название и версия браузера',
                                'slug' => 'Browser Name and Version',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Время показания на устройстве',
                                'slug' => 'Device Display Time',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Выходной IP устройства',
                                'slug' => 'Devices Exit IP',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Доступ с WIFI-а или нет?',
                                'slug' => 'Access from WIFI or Not?',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Номер или номера, установленные на устройстве',
                                'slug' => 'Numbers Set on the Device',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ], [
                    'menu' => [
                        'name' => 'Отгрузка',
                        'slug' => 'Shipping',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Регистрация грузоотправителей',
                                'slug' => 'Shipper Registration',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Кошельки грузоотправителей',
                                'slug' => 'Shipper Wallets',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Отправлено по названию компании',
                                'slug' => 'Shipped by Company Name',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Заказы, отправленные с опозданием компанией TBUY',
                                'slug' => 'Orders Shipped with TBUY Delays',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Аналитика доставки',
                        'slug' => 'Delivery Analytics',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Принятие доставки',
                                'slug' => 'Delivery Acceptance',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Ежечасно',
                                'slug' => 'Hourly',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Загрузка и удаление приложений',
                        'slug' => 'App Download and Removal',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => '24 часа заявки TBUY',
                                'slug' => 'TBUY Application Requests in 24 Hours',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => '24 часа установки модуля',
                                'slug' => 'Module Installation in 24 Hours',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Модуль доставки 24 часа',
                                'slug' => 'Delivery Module in 24 Hours',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => '24 часа коммерческого модуля',
                                'slug' => 'Commercial Module in 24 Hours',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => '24 часа модуля резюме',
                                'slug' => 'Resume Module in 24 Hours',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => '24 часа ресторанного модуля',
                                'slug' => 'Restaurant Module in 24 Hours',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Продавец Индивидуальный модуль 24 часа',
                                'slug' => 'Individual Seller Module in 24 Hours',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Модуль 24 часа объявлений',
                                'slug' => 'Ad Module in 24 Hours',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Настройки приложения',
                                'slug' => 'App Settings',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика приложений',
                                'slug' => 'App Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Организации',
                        'slug' => 'Organizations',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Список филиалов',
                                'slug' => 'Branch List',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Новый филиал',
                                'slug' => 'New Branch',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Новый магазины',
                                'slug' => 'New Stores',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Новый компании услуг',
                                'slug' => 'New Service Companies',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Отклоненные Магазины',
                                'slug' => 'Declined Stores',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Отклоненные компании услуг',
                                'slug' => 'Declined Service Companies',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Последние 50 Магазины',
                                'slug' => 'Last 50 Stores',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Последние 50 компании услуг',
                                'slug' => 'Last 50 Service Companies',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Новый представитель бренда',
                                'slug' => 'New Brand Representative',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Все представителы брендов',
                                'slug' => 'All Brand Representatives',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Отклоненные представительство',
                                'slug' => 'Declined Brand Representatives',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Неактивные магазины',
                                'slug' => 'Inactive Stores',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Неактивные компании услуг',
                                'slug' => 'Inactive Service Companies',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Активные магазины',
                                'slug' => 'Active Stores',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Активные компании услуг',
                                'slug' => 'Active Service Companies',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Настройки внутренней страницы организации',
                        'slug' => 'Organization Internal Page Settings',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Редактирование Тарифного пакета магазинов',
                                'slug' => 'Edit Store Tariff Package',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Редактирование Тарифного пакета компании услуг',
                                'slug' => 'Edit Service Company Tariff Package',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Редактирование договоров и соглашений',
                                'slug' => 'Edit Contracts and Agreements',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ], [
                    'menu' => [
                        'name' => 'Аналитика организации',
                        'slug' => 'Organization Analytics',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Внутренняя аналитика программы',
                                'slug' => 'Internal Program Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика продаж',
                                'slug' => 'Sales Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика своей веб-страницы',
                                'slug' => 'Website Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика тарифных планов',
                                'slug' => 'Tariff Plan Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Сервисная аналитика',
                                'slug' => 'Service Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика рекламы сома для организации',
                                'slug' => 'Soma Advertising Analytics for Organization',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Анализ банеров на странице компании в TBUY-е',
                                'slug' => 'Banner Analysis on Company Page in TBUY',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика рекламы на главной странице TBUY по организациям',
                                'slug' => 'Advertising Analytics on TBUY Main Page for Organizations',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика объявлений о вакансиях',
                                'slug' => 'Job Ads Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Поставки, осуществляемые организацией',
                                'slug' => 'Organization Deliveries',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Онлайн-аналитика подарочных карт организации',
                                'slug' => 'Organization Gift Card Online Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика записей организации',
                                'slug' => 'Organization Records Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Отсутствие товара у Организации на момент продажи',
                                'slug' => 'Out of Stock at Time of Sale for Organization',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика социальных сетей организации',
                                'slug' => 'Organization Social Media Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика занятости страниц',
                                'slug' => 'Page Engagement Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Внутренняя аналитика администратора',
                                'slug' => 'Admin Internal Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Источники кликов из категорий, где он продае',
                                'slug' => 'Click Sources in Categories Where It Sells',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Количество добавлений товаров в категорию по времени',
                                'slug' => 'Number of Product Additions to Category Over Time',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Кошельки организации',
                        'slug' => 'Organization Wallets',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Записи и источники в кошельки организации',
                                'slug' => 'Records and Sources in Organization Wallets',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Вывод средств с кошельков организаций',
                        'slug' => 'Withdrawal from Organization Wallets',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Покупка тарифного пакета',
                                'slug' => 'Purchase of Tariff Package',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Для покупки банеров в Главней странице',
                                'slug' => 'For Banner Purchase on Main Page',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Cat-Fish банеров',
                                'slug' => 'Cat-Fish Banners',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'СМС-сообщение',
                                'slug' => 'SMS Message',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Сообщение в Viber',
                                'slug' => 'Viber Message',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Сообщение в WhatsApp',
                                'slug' => 'WhatsApp Message',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Программа Telegram',
                                'slug' => 'Telegram Program',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Сообщение Email',
                                'slug' => 'Email Message',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Promo',
                                'slug' => 'Promo',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Покупка акций',
                                'slug' => 'Stock Purchase',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Обновления',
                                'slug' => 'Updates',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Вакансии организации',
                        'slug' => 'Organization Vacancies',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Новое приложение',
                                'slug' => 'New Applications',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Отклоненные заявки',
                                'slug' => 'Rejected Applications',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Архив Вакансии',
                                'slug' => 'Vacancies Archive',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Проверки вакансий',
                                'slug' => 'Vacancy Audits',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика вакансий',
                                'slug' => 'Vacancy Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Аналитика посещений TBUY',
                        'slug' => 'TBUY Visits Analytics',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Источники и их среднее время',
                                'slug' => 'Sources and Their Average Time',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Вторичные входы',
                                'slug' => 'Secondary Entrances',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика аномальных пиков',
                                'slug' => 'Anomalous Peaks Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Обнаружение ботов',
                                'slug' => 'Bot Detection',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Гугл Аналитика',
                        'slug' => 'Google Analytics',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Яндекс Метрики',
                        'slug' => 'Yandex Metrics',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Кредитно-идентификационный модуль',
                        'slug' => 'Credit Identification Module',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Загрузите и отредактируйте банковские данные и логотип',
                                'slug' => 'Upload and Edit Bank Data and Logo',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Банковская аналитика',
                                'slug' => 'Banking Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'База данных электронных подписей и их кодов',
                                'slug' => 'Electronic Signature and Code Database',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика блока идентификации',
                                'slug' => 'Identification Block Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Настройки блока идентификации',
                                'slug' => 'Identification Block Settings',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Статистика сбоев',
                        'slug' => 'Failure Statistics',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Отключение Интернета',
                                'slug' => 'Internet Disconnection',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Сбой модуля',
                                'slug' => 'Module Failure',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Сбой приложений',
                                'slug' => 'App Failure',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Поиски',
                        'slug' => 'Search',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Настройки поиска в реальном времени',
                                'slug' => 'Real-Time Search Settings',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Настройки результатов поиска',
                                'slug' => 'Search Results Settings',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Aналитика поиска в реальном времени',
                                'slug' => 'Real-Time Search Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика результатов поиска',
                                'slug' => 'Search Results Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Внутренний чат',
                        'slug' => 'Internal Chat',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Активные чаты',
                                'slug' => 'Active Chats',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Архив внутреннего чата',
                                'slug' => 'Internal Chat Archive',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Аналитика чата',
                                'slug' => 'Chat Analytics',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Настройки чата',
                                'slug' => 'Chat Settings',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Настройки в TBUY',
                        'slug' => 'TBUY Settings',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Настройки модуля уставоки',
                                'slug' => 'Settings Module Settings',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Страна/провинция/город/изменить',
                                'slug' => 'Country/Province/City/Change',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ],
                [
                    'menu' => [
                        'name' => 'Все настройки уведомлений в TBUY',
                        'slug' => 'All Notification Settings in TBUY',
                        'is_active' => false
                    ],
                    'children' => [
                        [
                            'menu' => [
                                'name' => 'Продающим организациям',
                                'slug' => 'Selling Organizations',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Компания услуг',
                                'slug' => 'Service Companies',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Персоналу TBUY',
                                'slug' => 'TBUY Personnel',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'покупателям',
                                'slug' => 'Buyers',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Индивидуальные продавцы',
                                'slug' => 'Individual Sellers',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Грузоотправителям',
                                'slug' => 'Shippers',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Коммерческие менеджеры',
                                'slug' => 'Commercial Managers',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Уведомления для установщиков',
                                'slug' => 'Installer Notifications',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Уведомления о подарочной карте',
                                'slug' => 'Gift Card Notifications',
                                'is_active' => false
                            ],
                            'children' => []
                        ],
                        [
                            'menu' => [
                                'name' => 'Электронные письма с подписки на странице TBUY',
                                'slug' => 'Emails from Subscription Page on TBUY',
                                'is_active' => false
                            ],
                            'children' => []
                        ]
                    ]
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Определения тарифных значений',
                'slug' => 'Tariff Definitions',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Цена акций',
                        'slug' => 'Stock Prices',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Установка тарифов на доставку',
                        'slug' => 'Setting Delivery Tariffs',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Стоимость и срок обновления',
                        'slug' => 'Cost and Update Period',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Редактирование тарифных пакетов и установка цен',
                        'slug' => 'Editing Tariff Packages and Price Setting',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Установление цен на рассылки',
                        'slug' => 'Setting Prices for Mailings',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Установка тарифов на установки',
                        'slug' => 'Setting Installation Tariffs',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Установка расценок на рекламу по таргетингу',
                        'slug' => 'Setting Prices for Targeted Advertising',
                        'is_active' => false
                    ],
                    'children' => []
                ],
            ]
        ],
        [
            'menu' => [
                'name' => 'Промо-страницы',
                'slug' => 'Promo-Pages',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Вход на промо-страницу',
                        'slug' => 'Entry-to-Promo-Page',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Редактирование промо-страниц',
                        'slug' => 'Edit-Promo-Pages',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Аналитика промо-страниц',
                        'slug' => 'Promo-Page-Analytics',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Определение рейтингов',
                'slug' => 'Rating-Definition',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Продукт',
                        'slug' => 'Product',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Марка',
                        'slug' => 'Brand',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'В продающую организацию',
                        'slug' => 'Into-Selling-Organization',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Сервисная организация',
                        'slug' => 'Service-Organization',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Продавец физическое лицо',
                        'slug' => 'Individual-Seller',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Категория',
                        'slug' => 'Category',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Банки',
                        'slug' => 'Banks',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Мастер Установщик',
                        'slug' => 'Installer-Master',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Аналитика рейтингов',
                'slug' => 'Analytics',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Товар',
                        'slug' => 'Product',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Бренд',
                        'slug' => 'Brand',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'В продающую организацию',
                        'slug' => 'Selling-Organization',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Сервисная организация',
                        'slug' => 'Service-Organization',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Продавец физическое лицо',
                        'slug' => 'Individual-Seller',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Категория',
                        'slug' => 'Category',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Банки',
                        'slug' => 'Banks',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Мастер Установщик',
                        'slug' => 'Installer-Master',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'SEO-система',
                'slug' => 'SEO-System',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'SEO статических страниц',
                        'slug' => 'SEO-Static-Pages',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Алгоритмы и предложения SEO категории продукта',
                        'slug' => 'SEO-Algorithms-Product',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Категория продукта и 1 фильтр SEO',
                        'slug' => 'Product-Category-1-Filter',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Категория продукта и 2 фильтра SEO',
                        'slug' => 'Product-Category-2-Filter',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Категория продукта и 3 фильтра SEO',
                        'slug' => 'Product-Category-3-Filter',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO-алгоритмы и предложения категории услуг',
                        'slug' => 'SEO-Algorithms-Service',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Категория услуги и 1 фильтр SEO',
                        'slug' => 'Service-Category-1-Filter',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Категория услуги и 2 фильтра SEO',
                        'slug' => 'Service-Category-2-Filter',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Категория услуги и 3 фильтра SEO',
                        'slug' => 'Service-Category-3-Filter',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO-алгоритмы и предложения для категории вакансий',
                        'slug' => 'SEO-Algorithms-Job',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'СТРАНИЦА организации SEO',
                        'slug' => 'Organization-Page-SEO',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO СТРАНИЦЫ организации и ее товарных категорий',
                        'slug' => 'Organization-Page-Product-Category-SEO',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO СТРАНИЦЫ организации и ее категорий услуг',
                        'slug' => 'Organization-Page-Service-Category-SEO',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO изображений',
                        'slug' => 'Image-SEO',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Часто задаваемые вопросы по SEO',
                        'slug' => 'FAQ-SEO',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO промо-страниц',
                        'slug' => 'SEO-Promo-Pages',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO-продвижение продукта',
                        'slug' => 'SEO-Product-Promotion',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO-аналитика',
                        'slug' => 'SEO-Analytics',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Проблемы с SEO-страницами',
                        'slug' => 'SEO-Page-Issues',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Добавьте SEO-чекеры с API для анализа',
                        'slug' => 'Add-SEO-Checkers-with-API',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO-анализ, созданный на других языках',
                        'slug' => 'SEO-Analysis-in-Other-Languages',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Количество проиндексированных страниц в день/ google/yandex',
                        'slug' => 'Indexed-Pages-per-Day',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Аналитика рейтингов',
                'slug' => 'Analytics',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Товар',
                        'slug' => 'Product',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Бренд',
                        'slug' => 'Brand',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'В продающую организацию',
                        'slug' => 'Selling-Organization',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Сервисная организация',
                        'slug' => 'Service-Organization',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Продавец физическое лицо',
                        'slug' => 'Individual-Seller',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Категория',
                        'slug' => 'Category',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Банки',
                        'slug' => 'Banks',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Мастер Установщик',
                        'slug' => 'Installer-Master',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'SEO-система',
                'slug' => 'SEO-System',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'SEO статических страниц',
                        'slug' => 'SEO-Static-Pages',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Алгоритмы и предложения SEO категории продукта',
                        'slug' => 'SEO-Algorithms-Product',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Категория продукта и 1 фильтр SEO',
                        'slug' => 'Product-Category-1-Filter',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Категория продукта и 2 фильтра SEO',
                        'slug' => 'Product-Category-2-Filter',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Категория продукта и 3 фильтра SEO',
                        'slug' => 'Product-Category-3-Filter',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO-алгоритмы и предложения категории услуг',
                        'slug' => 'SEO-Algorithms-Service',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Категория услуги и 1 фильтр SEO',
                        'slug' => 'Service-Category-1-Filter',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Категория услуги и 2 фильтра SEO',
                        'slug' => 'Service-Category-2-Filter',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Категория услуги и 3 фильтра SEO',
                        'slug' => 'Service-Category-3-Filter',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO-алгоритмы и предложения для категории вакансий',
                        'slug' => 'SEO-Algorithms-Job',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'СТРАНИЦА организации SEO',
                        'slug' => 'Organization-Page-SEO',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO СТРАНИЦЫ организации и ее товарных категорий',
                        'slug' => 'Organization-Page-Product-Category-SEO',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO СТРАНИЦЫ организации и ее категорий услуг',
                        'slug' => 'Organization-Page-Service-Category-SEO',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO изображений',
                        'slug' => 'Image-SEO',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Часто задаваемые вопросы по SEO',
                        'slug' => 'FAQ-SEO',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO промо-страниц',
                        'slug' => 'SEO-Promo-Pages',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO-продвижение продукта',
                        'slug' => 'SEO-Product-Promotion',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO-аналитика',
                        'slug' => 'SEO-Analytics',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Проблемы с SEO-страницами',
                        'slug' => 'SEO-Page-Issues',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Добавьте SEO-чекеры с API для анализа',
                        'slug' => 'Add-SEO-Checkers-with-API',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'SEO-анализ, созданный на других языках',
                        'slug' => 'SEO-Analysis-in-Other-Languages',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Количество проиндексированных страниц в день/ google/yandex',
                        'slug' => 'Indexed-Pages-per-Day',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Кошелек TBUY',
                'slug' => 'TBUY-Wallet',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Общий отчет по кошельку TBUY',
                        'slug' => 'TBUY-Wallet-Total-Report',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Вводы из других кошельков в кошелек TBUY',
                'slug' => 'Transfers-from-Other-Wallets-to-TBUY-Wallet',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Магазина',
                        'slug' => 'Store',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Компания услуг',
                        'slug' => 'Service-Company',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Физ.лицо продавец',
                        'slug' => 'Individual-Seller',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Грузоотправителей',
                        'slug' => 'Freight-Carriers',
                        'is_active' => false
                    ],
                    'children' => []
                ],
            ]
        ],
        [
            'menu' => [
                'name' => 'Переводы на кошельки коммерческих сотрудников',
                'slug' => 'Transfers-to-Commercial-Employee-Wallets',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Трансферы (24 часа)',
                        'slug' => 'Transfers-24-Hours',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'В ожидании перевода',
                        'slug' => 'Waiting-for-Transfer',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Заявление о переводах',
                        'slug' => 'Transfer-Requests',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Переводы монтажникам',
                'slug' => 'Transfers-to-Installers',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Трансферы (24 часа)',
                        'slug' => 'Transfers-24-Hours',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'В ожидании перевода',
                        'slug' => 'Waiting-for-Transfer',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Заявление о переводах',
                        'slug' => 'Transfer-Requests',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Переводы на счет организации',
                'slug' => 'Transfers-to-Organization-Account',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Трансферы (24 часа)',
                        'slug' => 'Transfers-24-Hours',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'В ожидании перевода',
                        'slug' => 'Waiting-for-Transfer',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Заявление о переводах',
                        'slug' => 'Transfer-Requests',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Переводы на счет сотрудников TBUY',
                'slug' => 'Transfers-to-TBUY-Employee-Accounts',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Трансферы (24 часа)',
                        'slug' => 'Transfers-24-Hours',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'В ожидании перевода',
                        'slug' => 'Waiting-for-Transfer',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Заявление о переводах',
                        'slug' => 'Transfer-Requests',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Переводы отмененных транзакций',
                'slug' => 'Canceled-Transaction-Transfers',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Пользователи отмененных покупок',
                        'slug' => 'Canceled-Purchase-Users',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Пользователям отмененных установок',
                        'slug' => 'Canceled-Installation-Users',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Возвраты покупателям',
                        'slug' => 'Purchase-Refunds',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Продавец на физические кошельки Переводы',
                'slug' => 'Seller-to-Physical-Wallet-Transfers',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Осуществленные переводы (в течение 24 часов)',
                        'slug' => 'Completed-Transfers-Within-24-Hours',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'В ожидании перевода',
                        'slug' => 'Transfers-Waiting-for-Approval',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Аналитика сделок продавцов',
                        'slug' => 'Seller-Transaction-Analytics',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Доход TBUY по типу',
                'slug' => 'TBUY-Income-by-Type',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Агент по продажам',
                        'slug' => 'Sales-Agent',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Продажа Организация. продажа тарифных пакетов.',
                        'slug' => 'Organization-Sales-Tariff-Packages',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Слуга. Организация: продажа тарифных пакетов.',
                        'slug' => 'Service-Organization-Tariff-Packages',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Из премиального пакета Продавца Индивидуального',
                        'slug' => 'From-Premium-Package-Individual-Seller',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'От комиссий из TBUY установок',
                        'slug' => 'From-Installations-Commissions',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'От комиссионных с продаж до частных лиц',
                        'slug' => 'From-Sales-Commissions-to-Individuals',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Брокер подарочных карт онлайн',
                        'slug' => 'Online-Gift-Card-Broker',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Из поставок',
                        'slug' => 'From-Supplies',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Брокер рекламных объявлений',
                        'slug' => 'Advertising-Broker',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Из обновлений',
                        'slug' => 'From-Updates',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Из рекламных акций',
                        'slug' => 'From-Advertising-Promotions',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Аналитика финансовых затрат',
                'slug' => 'Financial-Expenditure-Analytics',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Заработная плата',
                        'slug' => 'Salary-Expenditure',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Транспортные расходы',
                        'slug' => 'Transport-Expenditure',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Маркетинговые расходы',
                        'slug' => 'Marketing-Expenditure',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Налоги и расходы',
                        'slug' => 'Tax-and-Expenditure',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Незапланированный',
                        'slug' => 'Unplanned-Expenditure',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Приобретение оборудования',
                        'slug' => 'Equipment-Purchase',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Аренда помещений',
                        'slug' => 'Rent-Expenditure',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Приобретение транспорта',
                        'slug' => 'Vehicle-Purchase',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Юридический',
                        'slug' => 'Legal-Expenditure',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Административный',
                        'slug' => 'Administrative-Expenditure',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Экономичный',
                        'slug' => 'Economical-Expenditure',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Дизайнер',
                        'slug' => 'Designer-Expenditure',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Коммуникация',
                        'slug' => 'Communication-Expenditure',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Бухгалтерские услуги',
                        'slug' => 'Accounting-Services-Expenditure',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Аналитика выплаченных комиссий',
                        'slug' => 'Paid-Commissions-Analytics',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Представительские расходы',
                        'slug' => 'Representative-Expenditure',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Список автоматических коробок передач',
                        'slug' => 'Automatic-Transmission-List',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Настройки автоматической коробки передач',
                        'slug' => 'Automatic-Transmission-Settings',
                        'is_active' => false
                    ],
                    'children' => []
                ],
            ]
        ],
        [
            'menu' => [
                'name' => 'Отмененные транзакции',
                'slug' => 'Cancelled-Transactions',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Отмененные',
                        'slug' => 'Cancelled',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Аналитика отмененных транзакций',
                'slug' => 'Cancelled-Transactions-Analytics',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Отсутствие продукта',
                        'slug' => 'Product-Absence',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Непоследовательность',
                        'slug' => 'Inconsistency',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Брошенный до доставки',
                        'slug' => 'Abandoned-Before-Delivery',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Неполная доставка',
                        'slug' => 'Partial-Delivery',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'В течение 14 дней без причины',
                        'slug' => 'Within-14-Days-Without-Reason',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Юридический блок',
                'slug' => 'Legal-Block',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Все контракты',
                        'slug' => 'All-Contracts',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Организации, скачавшие контракты',
                        'slug' => 'Organizations-Downloaded-Contracts',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Архив всех Трехсторонних фактуры',
                        'slug' => 'Archive-Of-All-Tripartite-Invoices',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Электронные квитанции о доставке / палец-покупатель',
                        'slug' => 'Electronic-Delivery-Receipts-Customer',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Электронные акты приема-передачи / Грузоотправитель-покупатель',
                        'slug' => 'Electronic-Acceptance-Transfer-Acts-Shipping-Sender-Customer',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Электронные квитанции о доставке / Доставка',
                        'slug' => 'Electronic-Delivery-Receipts-Delivery',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Документы, подтверждающие представительство',
                        'slug' => 'Representation-Confirmation-Documents',
                        'is_active' => false
                    ],
                    'children' => []
                ],
            ]
        ],
        [
            'menu' => [
                'name' => 'Блок дизайна',
                'slug' => 'Design-Block',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Выгрузка шаблонов материалов главной страницы',
                        'slug' => 'Main-Page-Material-Templates-Export',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Скачать шаблоны сомов',
                        'slug' => 'Download-SOM-Templates',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Скачать онлайн шаблоны подарочных карт',
                        'slug' => 'Download-Online-Gift-Card-Templates',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Пользователи с правами администратора',
                'slug' => 'Users-With-Administrator-Privileges',
                'is_active' => false
            ],
            'children' => [
                [
                    'menu' => [
                        'name' => 'Новый сотрудник TBUY',
                        'slug' => 'New-TBUY-Employee',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Список всех сотрудников по отделам',
                        'slug' => 'List-Of-All-Employees-By-Departments',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Уведомления для администраторов',
                        'slug' => 'Notifications-For-Administrators',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Анализ деятельности сотрудников',
                        'slug' => 'Employee-Activity-Analysis',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Настройки уведомлений о рисках',
                        'slug' => 'Risk-Notifications-Settings',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Это внутренний форум',
                        'slug' => 'Internal-Forum',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Аналитика эффективности сотрудников',
                        'slug' => 'Employee-Effectiveness-Analytics',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Аналитика модерации',
                        'slug' => 'Moderation-Analytics',
                        'is_active' => false
                    ],
                    'children' => []
                ],
                [
                    'menu' => [
                        'name' => 'Аналитика ввода и вывода системы',
                        'slug' => 'System-Input-Output-Analytics',
                        'is_active' => false
                    ],
                    'children' => []
                ]
            ]
        ],
        [
            'menu' => [
                'name' => 'Тендеры',
                'slug' => 'Tenders',
                'is_active' => false
            ],
            'children' => []
        ],
        [
            'menu' => [
                'name' => 'Аукционы',
                'slug' => 'Auctions',
                'is_active' => false
            ],
            'children' => []
        ],
        [
            'menu' => [
                'name' => 'Недвижимость',
                'slug' => 'Real Estate',
                'is_active' => false
            ],
            'children' => []
        ],
        [
            'menu' => [
                'name' => 'Упаковка',
                'slug' => 'Packaging',
                'is_active' => false
            ],
            'children' => []
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var Menu $tariff */
        $tariff = Menu::query()->create([
            'name' => 'Тарифы',
            'slug' => '/tariffs',
            'is_active' => true
        ]);

        $tariff->children()->createMany([
            [
                'name' => 'Список',
                'slug' => '/list',
                'menu_id' => $tariff->id,
                'is_active' => true
            ],
            [
                'name' => 'Создать',
                'slug' => '/new',
                'menu_id' => $tariff->id,
                'is_active' => true,
            ],
            [
                'name' => 'Логи',
                'slug' => '/logs',
                'menu_id' => $tariff->id,
                'is_active' => true
            ]
        ]);

        $this->createMenu($this->menus);
    }

    private function createMenu(array $menus, ?int $menu_id = null): void
    {
        foreach ($menus as $menu) {
            $menu['menu']['menu_id'] = $menu_id;
            $menu['menu']['slug'] ??= $menu['menu']['name'];

            /** @var Menu $menuModel */
            $menuModel = Menu::query()->create($menu['menu']);

            if (isset($menu['children']) && is_array($menu['children'])) {
                $this->createMenu($menu['children'], $menuModel->id);
            }
        }
    }
}
