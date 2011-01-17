<?php
include '../common.php';

$donnees = $user->get_user_checked();

foreach ($donnees as $donnee)
    {
        echo '<div id ="has_checked">';
        echo '<table border="0">';
        echo '<tr>';

            echo '<td>';
            echo strtoupper($donnee["nom"])."<br/>".ucfirst(strtolower($donnee["prenom"]));
            echo '</td>';

            echo '<td>';
            echo $donnee["time"];
            echo '</td>';

        echo '</tr>';
        echo '</table>';
        echo '</div>';
    }


?>