<?php
namespace App\v2CRM;
/**
 * Created by PhpStorm.
 * User: tuan3
 * Date: 10/21/2017
 * Time: 1:39 PM
 */
interface PluginInterface
{
    public function getName();

    public function getMenu();

    public function getSettings();

    public function getOptions();

    public function getTablename();
}