<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
//$this->redirect('index.php?r=site/login');
$baseUrl = Yii::app()->theme->baseUrl;
?>

<div class="site-index">
<?php 
include "dashboard.php";
?>						
</div>
