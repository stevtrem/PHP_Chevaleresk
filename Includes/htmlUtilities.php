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
            return "<li><a href='Inventory.php'>Inventaire</a></li>".
                   "<li><a href='Includes/logout.php' id='btnLogout'>Déconnexion</a></li>".
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

function getInventaireJoueur(){
    
    if (isset($_SESSION["sql"])){
        return $_SESSION["sql"];
    }else{
        $id = $_SESSION['Id'];
        return "SELECT i.urlImageItem, j.qtItem, i.nomItem
                FROM   inventaireJoueur j INNER JOIN
                       Items i ON j.idItem = i.idItem
                WHERE  idJoueur = $id";
    }
}

function getSoldeJoueur(){
    if (isset($_SESSION["sql"])){
        return $_SESSION["sql"];
    }else{
        $id = $_SESSION['Id'];
        return "SELECT montantInitial
                FROM   Joueurs 
                WHERE  idJoueur = $id";
    }
}

function getItemsJoueurAdmin(){
    $idJoueur = $_SESSION['selectedPlayerId'];
    return "SELECT i.urlImageItem, j.qtItem, i.nomItem
            FROM   inventaireJoueur j INNER JOIN
                    Items i ON j.idItem = i.idItem
            WHERE  idJoueur = $idJoueur";
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

function ratingStarFilter($starNumber, $conn) {
    $stars = "";
    $initialStarCount = $starNumber;
    for($i = 0; $i < 5; $i++) {
        if($starNumber > 0) {
            $stars .= "<span class=\"glyphicon glyphicon-star\" style='color:white'></span>";
            $starNumber--;
        } 
        else $stars .= "<span class=\"glyphicon glyphicon-star-empty\" style='color:grey'></span>";
    }
    return "<div id=\"starFilter{$initialStarCount}\" style='color:white'>".$stars." <span id=\"ratingCount". $initialStarCount ."\" </span>"."</div>";
}

function getRatingAvg($itemId, $conn) {

    $params = array($itemId);

    $sql = "select avg(evaluation) as avg from evaluations where idItem = ?";

    $stmt = sqlsrv_query($conn, $sql, $params);

    $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);

    return $row['avg'];
}
function getRatingCount($itemId, $conn) {
    $params = array($itemId);

    $sql = "select count(evaluation) as count from evaluations where idItem = ?";

    $stmt = sqlsrv_query($conn, $sql, $params);

    $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);

    return "<span>(" . $row['count'] . ")</span>";
}
//Construct the rating stars based on the rating (starnumber)
//If null (has no reviews from db) return an error string
function ratingStar($starNumber, $idItem, $conn) {
    $stars = "";

    if($starNumber == null) return "<span class=\"noRatingText\">Cet objet n'a pas d'évaluation pour le moment </span>";

    for($i = 0; $i < 5; $i++) {
        if($starNumber > 0) {
            $stars .= "<span class=\"glyphicon glyphicon-star\"></span>";
            $starNumber--;
        } 
        else $stars .= "<span class=\"glyphicon glyphicon-star-empty\"></span>";
    }
    return "Évaluation:<div>".$stars. getRatingCount($idItem, $conn) . "</div>";
}


function GetItemType($id){
    return "SELECT typeItem
                FROM   Items 
                WHERE  idItem = $id";
}

function GetInfoPotion($id){
    return "SELECT i.nomItem, i.qtStockItem, i.prixUnitaireItem, i.urlImageItem, p.effet, p.duree
                FROM   Items i 
                INNER JOIN Potions p ON i.idItem = p.idItem
                WHERE  i.idItem = $id";
}

function GetInfoArme($id){
    return "SELECT i.nomItem, i.qtStockItem, i.prixUnitaireItem, i.urlImageItem, a.efficacite, a.genre, a.descriptionArme
        FROM Items i
        INNER JOIN Armes a ON i.idItem = a.idItem
        WHERE i.idItem = $id";
}

function GetInfoArmure($id){
    return "SELECT i.nomItem, i.qtStockItem, i.prixUnitaireItem, i.urlImageItem, a.matiere, a.poids, a.taille
        FROM Items i
        INNER JOIN Armures a ON i.idItem = a.idItem
        WHERE i.idItem = $id";
}

function GetInfoRessource($id){
    return "SELECT i.nomItem, i.qtStockItem, i.prixUnitaireItem, i.urlImageItem, r.description
        FROM Items i
        INNER JOIN Ressource r ON i.idItem = r.idItem
        WHERE i.idItem = $id";
}
?>