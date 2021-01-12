<?php


namespace Pars\Component;


class ConfigProvider
{

    protected static $hash = '';

    public static function hash() {
        if (self::$hash == '') {
            self::$hash = md5(random_bytes(5));
        }
        return self::$hash;
    }

    public function __invoke()
    {
        $hash = self::hash();
        return [
            'assets' => [
                'list' => [
                ]
            ],
            'bundles' => [
                'list' => [
                    [
                        'type' => 'js',
                        'output' => "component-bundle_$hash.js",
                        'unlink' => "component-bundle_*.js",
                        'sources' => [
                            __DIR__ . '/../bundles/js/01-jquery.min.js',
                            __DIR__ . '/../bundles/js/02-bootstrap.min.js',
                            __DIR__ . '/../bundles/js/03-bs-custom-file-input.min.js',
                            __DIR__ . '/../bundles/js/04-popper.min.js',
                            __DIR__ . '/../bundles/js/05-quill.min.js',
                            __DIR__ . '/../bundles/js/overlay.js',
                            __DIR__ . '/../bundles/js/history.js',
                            __DIR__ . '/../bundles/js/bulk.js',
                            __DIR__ . '/../bundles/js/confirm.js',
                            __DIR__ . '/../bundles/js/injector.js',
                            __DIR__ . '/../bundles/js/load.js',
                            __DIR__ . '/../bundles/js/submit.js',
                            __DIR__ . '/../bundles/js/ajax.js',
                        ]
                    ],
                    [
                        'type' => 'css',
                        'output' => "component-bundle_$hash.css",
                        'unlink' => "component-bundle_*.css",
                        'sources' => [
                            __DIR__ . '/../bundles/css/bootstrap.min.css',
                            __DIR__ . '/../bundles/css/quill.bubble.css',
                            __DIR__ . '/../bundles/css/quill.snow.css',
                            __DIR__ . '/../bundles/css/pars.css',
                        ]
                    ]
                ]

            ]
        ];
    }

}
