<?php

namespace Kingofzihua\EChartsjs;

use Encore\Admin\Admin;
use Illuminate\Support\ServiceProvider;

class EChartsjsServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(EChartsjs $extension)
    {
        if (! EChartsjs::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'echartsjs');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/echartsjs')],
                'echartsjs'
            );
        }

        Admin::booting(function () {
            Admin::js('vendor/laravel-admin-ext/echartsjs/echarts.min.js');
        });
    }
}
