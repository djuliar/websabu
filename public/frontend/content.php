<?php
if(@$_GET['page'] == 'home'){
    include('contents/hero.php');
} else if(@$_GET['page'] == 'about'){
    include('contents/about.php');
} else {
    include('contents/hero.php');
}