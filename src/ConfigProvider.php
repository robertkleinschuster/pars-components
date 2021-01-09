<?php


namespace Pars\Component;


class ConfigProvider
{
    public function __invoke()
    {
        return [
            'bundles' => [
                'list' => [
                    [
                        'type' => 'js',
                        'output' => 'component-bundle.js',
                        'sources' => [
                            __DIR__ . '/../bundles/js/01-jquery.min.js',
                            __DIR__ . '/../bundles/js/02-bootstrap.min.js',
                            __DIR__ . '/../bundles/js/03-bs-custom-file-input.min.js',
                            __DIR__ . '/../bundles/js/04-popper.min.js',
                            __DIR__ . '/../bundles/js/05-quill.min.js',
                            __DIR__ . '/../bundles/js/overlay.js',
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
                        'output' => 'component-bundle.css',
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
