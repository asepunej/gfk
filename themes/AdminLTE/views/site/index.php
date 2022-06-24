<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
//$this->redirect('index.php?r=site/login');
$baseUrl = Yii::app()->theme->baseUrl;
?>

<div class="site-index">
<?php 
// ==============================================
$this->redirect('/index.php?r=Dashboard/Dashboard');
?>						
</div>
