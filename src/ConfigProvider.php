<?php


namespace Pars\Component;


class ConfigProvider
{
    public function __invoke()
    {
        return [
            'assets' => [
                'list' => [
                ]
            ],
            'bundles' => [
                'entrypoints' => [
                  'component'
                ],
                'list' => [
                    [
                        'type' => 'js',
                        'output' => "component_vendor.js",
                        'sources' => [
                            __DIR__ . '/../bundles/js/vendor/01-jquery.min.js',
                            __DIR__ . '/../bundles/js/vendor/02-bootstrap.bundle.min.js',
                            __DIR__ . '/../bundles/js/vendor/03-bs-custom-file-input.min.js',
                            __DIR__ . '/../bundles/js/vendor/04-popper.min.js',
                            __DIR__ . '/../bundles/js/vendor/05-quill.min.js',
                            __DIR__ . '/../bundles/js/vendor/06-moment.js',
                            __DIR__ . '/../bundles/js/vendor/07-daterangepicker.js',
                            __DIR__ . '/../bundles/js/vendor/08-modernizr-inputtypes.js',
                            __DIR__ . '/../bundles/js/vendor/09-jquery.inputmask.min.js',
                        ]
                    ],
                  /*  [
                        'type' => 'js',
                        'output' => "component_base.js",
                        'sources' => [
                            __DIR__ . '/../bundles/js/overlay.js',
                            __DIR__ . '/../bundles/js/history.js',
                            __DIR__ . '/../bundles/js/bulk.js',
                            __DIR__ . '/../bundles/js/confirm.js',
                            __DIR__ . '/../bundles/js/fileselect.js',
                        ]
                    ],
                    [
                        'type' => 'js',
                        'output' => "component_ajax.js",
                        'sources' => [
                            __DIR__ . '/../bundles/js/injector.js',
                            __DIR__ . '/../bundles/js/load.js',
                            __DIR__ . '/../bundles/js/submit.js',
                            __DIR__ . '/../bundles/js/ajax.js',
                        ]
                    ],*/
                 /*   [
                        'type' => 'scss',
                        'import' => __DIR__ . '/../bundles/scss',
                        'output' => "component_base.css",
                        'entrypoint' =>  __DIR__ . '/../bundles/scss/base.scss',
                    ],
                    [
                        'type' => 'scss',
                        'import' => __DIR__ . '/../bundles/scss',
                        'output' => "component_quill.css",
                        'entrypoint' =>  __DIR__ . '/../bundles/scss/quill.scss',
                    ],
                    [
                        'type' => 'scss',
                        'import' => __DIR__ . '/../bundles/scss',
                        'output' => "component_fileselect.css",
                        'entrypoint' =>  __DIR__ . '/../bundles/scss/fileselect.scss',
                    ],
                    [
                        'type' => 'scss',
                        'import' => __DIR__ . '/../bundles/scss',
                        'output' => "component_overlay.css",
                        'entrypoint' =>  __DIR__ . '/../bundles/scss/overlay.scss',
                    ],
                    [
                        'type' => 'scss',
                        'import' => __DIR__ . '/../bundles/scss',
                        'output' => "component_cms.css",
                        'entrypoint' =>  __DIR__ . '/../bundles/scss/cms.scss',
                    ],
                    [
                        'type' => 'scss',
                        'import' => __DIR__ . '/../bundles/scss',
                        'output' => "component_daterangepicker.css",
                        'entrypoint' =>  __DIR__ . '/../bundles/scss/daterangepicker.scss',
                    ],*/
                ]

            ]
        ];
    }

}
