<?php
require_once('fonctions/template.func.php');
require_once('fonctions/param.func.php');
$action='';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Belgiatheque</title>
    <link rel="stylesheet" type="text/css" href="style/normalize.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="style/media_style.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet"> 

</head>
<body>


    <header>
        <div>
            <img src="images/logo/logo_transparent.png" class="head_logo">
        </div>


    </header>
    <main>

        <?php
        $bas=0;
        $op=0;
        $cpt=1;
        $nbp=0;
//recuperation des données
        if (isset($_POST['action'])) {
            $action=$_POST['action'];
             $nbp=$_POST['nbp'];

            if ($action=='search') {
                $contenu=$_POST['contenu'];
             
            }

            $op=limitep($action);
            $bas=$_POST['bas'];
            $cpt=$_POST['cpt'];

            if ($op==1) {
                $bas=$bas+10;
                $cpt++;
            }
            else{
                if ($action<>'search') {
                    $bas=$bas-10;
                    $cpt--;
                }
            }
        }

 

        try{

            $dbh = new PDO(
                "mysql:dbname=mediatheque;host=localhost;port=3308",
                "root",
                "",
                array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                )
            );
            //compter nombre de page 
            if ($cpt<2 && $nbp==0) {
               $nbp=nbpage ($dbh);
            }
//recuparation base de donnée
            if ($action=='search') {
                $sql= search($bas,$cpt,$contenu);
                $nbp=nbpages ($dbh,$contenu);
            }
            else{
                $sql = recup($bas);

            }
            $stmt = $dbh -> prepare($sql);
    //3. Exécution de la requête
            $stmt->execute(); 
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $tab=$stmt->fetchAll();

        }catch (Exception $ex) {
            die("ERREUR FATALE : ". $ex->getMessage().'<form><input type="button" value="Retour" onclick="history.go(-1)"></form>');
        }

//appel la fonction qui contient les cartes
        //creation des bouttons
        $verif=count($tab);
        boutton($bas,$cpt,$verif,$nbp);
        bouttonserach($bas,$cpt,$verif,$nbp);
        echo '<p class="page">Page '.$cpt.' sur '.$nbp.'';
        rempli($tab);


        ?>
    </main>
    <p class="bg">HTML et CSS par <a href="https://github.com/kyomai22" target="_blank"> Dimitri Schira</a> - PHP et SQL par <a href="https://www.twitch.tv/seiikosama" target="_blank">Adrien de Spiegeleer</a> </p>
</body>
</html>