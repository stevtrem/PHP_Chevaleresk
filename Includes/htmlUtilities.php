<?php 

function html_BR() {
    return '<br>';
}
function html_HR() {
    return '<hr>';
}
function html_H($title, $size){
    return "<h$size>$title</h$size>";
}

function showError($message){
    echo "<span style='color:red'>$message</span>";
}

function sanitizeString($str) {
    $str = trim($str) ;
    $str = stripslashes($str);
    $str = htmlentities($str);
    $str = strip_tags($str);
    return $str;
}

function strLengthOk($str){
    $alias = wordwrap($str, 20);
    return (strlen($alias) >= 3);
}

?>