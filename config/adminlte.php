<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'AdminLTE 2',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Admin</b>PANEL',

    'logo_mini' => '<b>P</b>ANEL',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [

        'ACCOUNT',
        [
            'text' => 'Profile',
            'url'  => 'admin/settings',
            'icon' => 'user',
        ],

        'GESTIONE SISTEMA',

        [
            'text' => 'Categories',
            'icon_color' => 'aqua',
            'url'  => 'admin/category/index',

        ],
        [
            'text' => 'Itineraries',
            'icon_color' => 'aqua',
            'url'  => 'admin/itinerary/index',
        ],
        [
            'text' => 'Events',
            'icon_color' => 'aqua',
            'url'  => 'admin/event/index',
        ],
        [
            'text' => 'News',
            'icon_color' => 'aqua',
            'url'  => 'admin/news/index',
        ],
        [
            'text' => 'Advices',
            'icon_color' => 'aqua',
            'url'  => 'admin/advice/index',
        ],
        [
            'text' => 'Cities',
            'icon_color' => 'aqua',
            'url'  => 'admin/city/index',
        ],


        'GESTIONE IMMAGINI',
        [
            'text' => 'Images',
            'icon_color' => 'aqua',
            'url'  => 'admin/image/index',
        ],
        [
            'text'    => 'Assign Image',
            'icon'    => 'share',
            'submenu' => [
                [
                    'text' => 'Assign to Itineraries',
                    'url'  => 'admin/image/assign/itinerary',
                ],
                [
                    'text'    => 'Assign to Users',
                    'url'     => 'admin/image/assign/user',

                ],
                [
                    'text'    => 'Assign to Events',
                    'url'     => 'admin/image/assign/event',

                ],
                [
                    'text'    => 'Assign to News',
                    'url'     => 'admin/image/assign/news',

                ],
                ],

            ],


        'GESTIONE RECENSIONI',

        [
            'text' => 'Reviews',
            'icon_color' => 'gray',
            'url'  => 'admin/review/index',
        ],




        'GESTIONE UTENTI',
        [
            'text' => 'Users',
            'icon_color' => 'yellow',
            'url'  => 'admin/user/index',
        ],
        [
            'text' => 'Groups',
            'icon_color' => 'yellow',
            'url'  => 'admin/group/index',
        ],






        /*[
            'text'    => 'Multilevel',
            'icon'    => 'share',
            'submenu' => [
                [
                    'text' => 'Level One',
                    'url'  => '#',
                ],
                [
                    'text'    => 'Level One',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'Level Two',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'Level Two',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'Level Three',
                                    'url'  => '#',
                                ],
                                [
                                    'text' => 'Level Three',
                                    'url'  => '#',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'text' => 'Level One',
                    'url'  => '#',
                ],
            ],
        ],*/

    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
    ],
];
