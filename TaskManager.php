<?php
/**
 * Created by PhpStorm.
 * User: Артём
 * Date: 23.06.2019
 * Time: 21:40
 */

use WHMCS\Module\Addon\TaskManager\Pages\AdminCronViewPage;
use \WHMCS\Module\Addon\TaskManager\API\AdminAjaxApi;

function TaskManager_config()
{
    $config = [
        "name" => "Менеджер задач WHMCS",
        "description" => "",
        "version" => "1",
        "author" => "service-voice",
        "fields" => []
    ];

    return $config;
}

function TaskManager_output($var)
{	$AdminAjaxApi = new AdminAjaxApi();
    $AdminAjaxApi->boot();

    $page = new AdminCronViewPage();
    $page->render();
 }