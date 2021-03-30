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

function LoginBtn(){
    if (!isset($_SESSION['Id'])){
       return '<li><a href="loginForm.php">S\'authentifier</a></li>';
    }else{
       $alias = $_SESSION['alias'];
       if ($alias == 'admin'){
            return "<li><a href='Includes/logout.php' id='btnLogout'>Déconnexion</a></li>".
                   "<li><a href='admin.php' style='color:#22a314; font-weight:bold'>SECTION $alias</a></li>";
       }else{
            return "<li><a href='Includes/logout.php' id='btnLogout'>Déconnexion</a></li>".
                   "<li><a style='color:#22a314; font-weight:bold'>$alias</a></li>".
                   "<li><a href='Panier.php' id='LogoPanier'>Panier</a></li>";
       }
       
    }
}

function SignupBtn(){
    if (!isset($_SESSION["Id"])){
       return '<li><a href="signup.php">S\'inscrire</a></li>';
    }
}

function WelcomeMsg(){
    if (isset($_SESSION["Id"])){
        $alias = $_SESSION["alias"];
        return "<h1>Bienvenue <br><strong class='color'>$alias!</strong></h1>";
    }else{
        return "<h1>Chevaleresk <br><strong class='color'>La Boutique</strong></h1>";
    }
}
 
function showError($message){
    echo "<span style='color:red'>$message</span>";
}

function getItems(){
    if (isset($_SESSION["sql"])){
        return $_SESSION["sql"];
    }else{
        return "SELECT * FROM items ORDER BY prixUnitaireItem ASC";
    }
}

function getItemsJoueur(){
    if (isset($_SESSION["sql"])){
        return $_SESSION["sql"];
    }else{
        return "SELECT i.urlImageItem, j.qtItem, i.nomItem
                FROM   inventaireJoueur j INNER JOIN
                       Items i ON j.idItem = i.idItem
                WHERE  idJoueur = 1";
    }
}

function sanitizeString($str) {
    $str = trim($str) ;
    $str = stripslashes($str);
    $str = htmlentities($str);
    $str = strip_tags($str);
    return $str;
}

function strLengthOk($str){
    $input = wordwrap($str, 20);
    return (strlen($input) >= 3);
}

?>