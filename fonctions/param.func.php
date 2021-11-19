<?php  function boutton($bas,$cpt,$verif,$nbp){

    echo '<form action="media.php" method="post">';
if ($bas>0) {
    echo '<input type="submit" name="action" value="<" class="precedent">';   
}
if ($verif==10) {
    echo '<input type="submit" name="action" value=">" class="suivant">';
}
echo '<input type="hidden"  name="cpt" value="'.$cpt.'">';
    echo '<input type="hidden"  name="bas" value="'.$bas.'">';
     echo '<input type="hidden"  name="nbp" value="'.$nbp.'">';
       echo '</form>';

}

function bouttonserach($bas,$cpt,$verif,$nbp){
    echo '<form action="media.php" method="post">';
echo '<input type="text" name="contenu" value="" class="bar" placeholder="Tape quelque chose de gentil">';
echo '<input type="submit" name="action" value="search" class="search">';
echo '<input type="hidden"  name="cpt" value="'.$cpt.'">';
 echo '<input type="hidden"  name="bas" value="'.$bas.'">';
  echo '<input type="hidden"  name="nbp" value="'.$nbp.'">';
 echo '</form>';

}
function limitep($action){
$op=0;

if ($_POST['action']=='>') {
    $op=1;

}
return $op;
}

function recup($bas){
    $sql='SELECT films_titre,films_resume,films_annee,films_affiche,films_duree,GROUP_CONCAT(DISTINCT(acteurs_nom)) as "acts",GROUP_CONCAT(DISTINCT(genres_nom)) as "genr",real_nom as "reali" FROM films LEFT JOIN films_acteurs ON films_id=fa_films_id LEFT JOIN acteurs on fa_acteurs_id=acteurs_id LEFT JOIN films_genres ON films_id=fg_films_id LEFT JOIN genres ON fg_genres_id=genres_id LEFT JOIN realisateurs ON real_id=films_real_id GROUP BY films_titre,films_resume,films_annee,films_affiche,films_duree,real_nom ORDER BY films_titre LIMIT '.$bas.',10;';

    return $sql;
}



function search($bas,$cpt,$contenu){
    $sql='SELECT films_titre,films_resume,films_annee,films_affiche,films_duree,GROUP_CONCAT(DISTINCT(acteurs_nom)) as "acts",GROUP_CONCAT(DISTINCT(genres_nom)) as "genr",real_nom as "reali" FROM films LEFT JOIN films_acteurs ON films_id=fa_films_id LEFT JOIN acteurs on fa_acteurs_id=acteurs_id LEFT JOIN films_genres ON films_id=fg_films_id LEFT JOIN genres ON fg_genres_id=genres_id LEFT JOIN realisateurs ON real_id=films_real_id where films_titre LIKE "%'.$contenu.'%" || "acts" LIKE "%'.$contenu.'%" || "genr" LIKE "%'.$contenu.'%" || "reali" LIKE "%'.$contenu.'%" GROUP BY films_titre,films_resume,films_annee,films_affiche,films_duree,real_nom ORDER BY films_titre  LIMIT '.$bas.',10;';

    

   

    return $sql;
}
function nbpage ($dbh){
    $nbpage=0;
    $stmt="";
    $sql='SELECT films_titre,films_resume,films_annee,films_affiche,films_duree,GROUP_CONCAT(DISTINCT(acteurs_nom)) as "acts",GROUP_CONCAT(DISTINCT(genres_nom)) as "genr",real_nom as "reali" FROM films LEFT JOIN films_acteurs ON films_id=fa_films_id LEFT JOIN acteurs on fa_acteurs_id=acteurs_id LEFT JOIN films_genres ON films_id=fg_films_id LEFT JOIN genres ON fg_genres_id=genres_id LEFT JOIN realisateurs ON real_id=films_real_id GROUP BY films_titre,films_resume,films_annee,films_affiche,films_duree,real_nom ORDER BY films_titre;';

    $stmt = $dbh -> prepare($sql);
    //3. Exécution de la requête
            $stmt->execute(); 
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $tab=$stmt->fetchAll();
            $nbpage=count($tab);

            $nbpage=$nbpage/10;
            $nbpage=ceil($nbpage);
            return $nbpage;
}

function nbpages ($dbh,$contenu){
    $nbpage=0;
    $stmt="";
    $sql="";
    
$sql='SELECT films_titre,films_resume,films_annee,films_affiche,films_duree,GROUP_CONCAT(DISTINCT(acteurs_nom)) as "acts",GROUP_CONCAT(DISTINCT(genres_nom)) as "genr",real_nom as "reali" FROM films LEFT JOIN films_acteurs ON films_id=fa_films_id LEFT JOIN acteurs on fa_acteurs_id=acteurs_id LEFT JOIN films_genres ON films_id=fg_films_id LEFT JOIN genres ON fg_genres_id=genres_id LEFT JOIN realisateurs ON real_id=films_real_id where films_titre LIKE "%'.$contenu.'%" || "acts" LIKE "%'.$contenu.'%" || "genr" LIKE "%'.$contenu.'%" || "reali" LIKE "%'.$contenu.'%" GROUP BY films_titre,films_resume,films_annee,films_affiche,films_duree,real_nom ORDER BY films_titre;';
    $stmt = $dbh -> prepare($sql);
    //3. Exécution de la requête
            $stmt->execute(); 
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $tab=$stmt->fetchAll();
            $nbpage=count($tab);

            $nbpage=$nbpage/10;
            $nbpage=ceil($nbpage);
            return $nbpage;
}
?>