<?php

/**
 * Admin configuration
 */
return [

    /**
     * Path To Admin
     */
    'slug' => 'admin',

    /**
     * Logo
     */
    'logo' => [
        'first'  => 'MU',
        'second' => 'AN',

        'title' => 'Dashboard',
        'route' => 'admin.dashboard'
    ],

    /**
     * Parameters for resize
     *
     * methods: fit, resize
     */
    'resize' => [

        /**
         * For User Model
         */
        'user' => [
            'method' => 'fit',
            'width' => 200,
            'height' => 200,
        ],

        /**
         * For Page Model
         */
        'page' => [
            'method' => 'fit',
            'width' => 600,
            'height' => 300,
        ],

        /**
         * For Category Model
         */
        'category' => [
            'method' => 'resize',
            'width' => 400,
        ],

        /**
         * For Post Model
         */
        'post' => [
            'method' => 'resize',
            'width' => 800
        ],

    ],

    /**
     * Navigation Bar
     */
    'nav-bar' => [
        [
            'title' => 'Application',
            'menu' => [
                [
                    'title' => 'Blocks',
                    'icon'  => 'fas fa-archive',
                    'route' => 'admin.blocks',
                ],
                [
                    'title' => 'Pages',
                    'icon'  => 'fas fa-paste',
                    'route' => 'admin.pages',
                ],
                [
                    'title' => 'Categories',
                    'icon'  => 'fas fa-map-signs',
                    'route' => 'admin.categories',
                ],
                [
                    'title' => 'Posts',
                    'icon'  => 'fas fa-file-code',
                    'route' => 'admin.posts',
                ],
            ],
        ],
        [
            'title' => 'Security',
            'menu' => [
                [
                    'title' => 'Users',
                    'icon'  => 'fas fa-users',
                    'route' => 'admin.users',
                ],
                [
                    'title' => 'Roles',
                    'icon'  => 'fas fa-chess',
                    'route' => 'admin.roles',
                ],
                [
                    'title' => 'Permissions',
                    'icon'  => 'fas fa-key',
                    'route' => 'admin.permissions',
                ],
            ],
        ],
        [
            'title' => 'Config',
            'menu' => [
                [
                    'title' => 'Group',
                    'icon'  => 'fas fa-cubes',
                    'route' => 'admin.groups',
                ],
                [
                    'title' => 'Properties',
                    'icon'  => 'fas fa-cube',
                    'route' => 'admin.properties',
                ],
            ],
        ],
    ],

    /**
     * User Menu
     */
    'user-menu' => [
        [
            'title' => 'Profile',
            'icon'  => '',
            'route' => 'admin.users.profile',
        ],
    ],

    /**
     * Left Menu
     */
    'left-menu' => [
        // Add if need
    ],

    /**
     * Right Menu
     */
    'right-menu' => [
        [
            'title' => 'Settings',
            'route' => 'admin.settings',
            'icon'  => 'fas fa-cog',
        ],
        [
            'title' => 'Messages',
            'route' => 'admin.messages',
            'icon'  => 'fas fa-envelope',
        ],
        [
            'title' => 'Logs',
            'route' => 'admin.logs',
            'icon'  => 'fas fa-bug',
        ],
    ],

];
