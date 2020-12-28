<?php


namespace Pars\Component;


class ConfigProvider
{
    public function __invoke()
    {
        return [
            'assets' => [
                'sources' => [
                ]
            ],
            'bundles' => [
                'sources' => [
                    'js' => [
                        __DIR__ . '/../bundles/js'
                    ],
                    'css' => [
                        __DIR__ . '/../bundles/css'
                    ]
                ]
            ]
        ];
    }

}
