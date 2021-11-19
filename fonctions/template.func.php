<?php 
function rempli($tab){
    $class='class="impair"';

foreach ($tab as $i => $row ) {
    

 
    
     echo '<li class="card" id="card_'.(is_integer($row)).'">';
        if ($i%2<>0) {
        echo '<div class="impair">';
    }
 else{
           echo '<div class="card__content">';
       }

            echo  ' <div class="card_inner_block">';
                   echo '<h2>'.$row["films_titre"].'</h2>';
                   echo '<h3>Genre:</h3>';
                    echo '<p>'.$row["genr"].'</p>';
                    echo '<h3>réalisateur:</h3>';
                    echo '<p>'.$row["reali"].'</p>';
                    echo '<h3>Acteur:</h3>';
                    echo '<p>'.$row["acts"].'</p>';
                    echo '<h3>durée:</h3>';
                    echo '<p>'.$row["films_duree"].'</p>';
                    echo '<h3>date de sortie:</h3>';
                    echo '<p>'.$row["films_annee"].'</p>';
                    echo '</div>';
                    echo '<div class="Synopsis">';
                    echo '<h3>Synopsis:</h3>';
                 echo '<p>'.$row["films_resume"].'</p>';
                 echo '</div>';
                 
                
                
                echo '<figure>';
                    echo '<img src="images/'.$row["films_affiche"].'" alt="Image description">';
                echo '</figure>';
            echo '</div>';
       echo  '</li>';
}


}




 ?>
