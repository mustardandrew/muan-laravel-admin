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
        'first'  => 'Admin',
        'second' => 'Panel',

        'title' => 'Dashboard',
        'route' => 'admin.dashboard'
    ],

    /**
     * Filesystem Disk
     * Configure in config/filesystem.php file
     *
     * As default used 'public' filesystem
     */
    'diskname' => 'public',

    /**
     * Configuration config
     */
    'entities' => [
        'block' => [
            'model' => \Muan\Admin\Models\Block::class,
            'controller' => \Muan\Admin\Http\Controllers\Admin\BlockController::class,
        ],
        'page' => [
            'model' => \Muan\Admin\Models\Page::class,
            'controller' => \Muan\Admin\Http\Controllers\Admin\PageController::class,
        ],
        'category' => [
            'model' => \Muan\Admin\Models\Category::class,
            'controller' => \Muan\Admin\Http\Controllers\Admin\CategoryController::class,
        ],
        'post' => [
            'model' => \Muan\Admin\Models\Post::class,
            'controller' => \Muan\Admin\Http\Controllers\Admin\PostController::class,
        ],
        'tag' => [
            'model' => \Muan\Tags\Models\Tag::class,
            'controller' => \Muan\Admin\Http\Controllers\Admin\TagController::class,
        ],
        'comment' => [
            'model' => \Muan\Comments\Models\Comment::class,
            'controller' => \Muan\Admin\Http\Controllers\Admin\CommentController::class,
        ],
        'user' => [
            'controller' => \Muan\Admin\Http\Controllers\Admin\UserController::class,
        ],
        'role' => [
            'model' => \Muan\Acl\Models\Role::class,
            'controller' => \Muan\Admin\Http\Controllers\Admin\RoleController::class,
        ],
        'permission' => [
            'model' => \Muan\Acl\Models\Permission::class,
            'controller' => \Muan\Admin\Http\Controllers\Admin\PermissionController::class,
        ],
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
            'width'  => 200,
            'height' => 200,
        ],

        /**
         * For Page Model
         */
        'page' => [
            'method' => 'fit',
            'width'  => 600,
            'height' => 300,
        ],

        /**
         * For Category Model
         */
        'category' => [
            'method' => 'resize',
            'width'  => 400,
        ],

        /**
         * For Post Model
         */
        'post' => [
            'method' => 'resize',
            'width'  => 800
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
                [
                    'title' => 'Tags',
                    'icon'  => 'fas fa-tags',
                    'route' => 'admin.tags',
                ],
                [
                    'title' => 'Comments',
                    'icon'  => 'far fa-comments',
                    'route' => 'admin.comments',
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
