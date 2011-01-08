<u>Liste des quiz :</u>

        <?php
        $quiz = new Quiz();
        ?>

        <table border="1">
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th colspan="3">Actions</th>
            </tr>
            <?php
                $donnees = $quiz->getAll();
                foreach($donnees as $donnee){
                    echo "<tr>";
                    echo "<td>".$donnee["nom"]."</td>";
                    echo "<td>".$donnee["description"]."</td>";
                    echo "<td>";
                    ?> <img src="../img/edit.png" alt="Edition">
                    <?php echo "</td><td>"; ?>
                    <img src="../img/delete.png" alt="Supprimer">
                    <?php echo "</td><td>"; ?>
                    <a href="?action=insert&id=<?php echo $donnee[id];?>"><img src="../img/insert.png" alt="Inserer"></a>
                    <?php echo"</td>";
                    echo "</tr>";
                }
            ?>
        </table>
<br/>
<a href="index.php?action=create">Créer un formulaire</a>