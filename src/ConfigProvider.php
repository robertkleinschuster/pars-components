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
                'list' => [
                    [
                        'type' => 'js',
                        'output' => "component.js",
                        'sources' => [
                            __DIR__ . '/../bundles/js/01-jquery.min.js',
                            __DIR__ . '/../bundles/js/02-bootstrap.bundle.min.js',
                            __DIR__ . '/../bundles/js/03-bs-custom-file-input.min.js',
                            __DIR__ . '/../bundles/js/04-popper.min.js',
                            __DIR__ . '/../bundles/js/05-quill.min.js',
                            __DIR__ . '/../bundles/js/06-moment.js',
                            __DIR__ . '/../bundles/js/07-daterangepicker.js',
                            __DIR__ . '/../bundles/js/08-modernizr-inputtypes.js',
                            __DIR__ . '/../bundles/js/09-jquery.inputmask.min.js',
                            __DIR__ . '/../bundles/js/overlay.js',
                            __DIR__ . '/../bundles/js/history.js',
                            __DIR__ . '/../bundles/js/bulk.js',
                            __DIR__ . '/../bundles/js/confirm.js',
                            __DIR__ . '/../bundles/js/fileselect.js',
                            __DIR__ . '/../bundles/js/injector.js',
                            __DIR__ . '/../bundles/js/load.js',
                            __DIR__ . '/../bundles/js/submit.js',
                            __DIR__ . '/../bundles/js/ajax.js',
                        ]
                    ],
                    [
                        'type' => 'scss',
                        'import' => __DIR__ . '/../bundles/scss',
                        'output' => "component.css",
                        'entrypoint' =>  __DIR__ . '/../bundles/scss/component.scss',
                    ],
                ]

            ]
        ];
    }

}
