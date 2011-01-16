<u>Liste des form :</u>

        <?php
        $form = new Form();
        ?>

        <table border="1">
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th colspan="4">Actions</th>
            </tr>
            <?php
                $donnees = $form->getAll();
                foreach($donnees as $donnee){
                    echo "<tr>";
                    echo "<td>".$donnee["nom"]."</td>";
                    echo "<td>".$donnee["description"]."</td>";
                    echo "<td>";
                    ?> <a href="../index.php?form_id=<?php echo $donnee[id];?>"><img src="../img/viewForm.png" alt="Voir le Form"></a>
                    <?php echo "</td><td>"; ?>
					<a href="?action=reponses&id=<?php echo $donnee[id];?>"><img src="../img/chart.png" alt="Voir les réponses"></a>
                    <?php echo "</td><td>"; ?>
                    <a href="?action=delete&id=<?php echo $donnee[id];?>"><img src="../img/delete.png" alt="Supprimer"></a>
                    <?php echo "</td><td>"; ?>
                    <a href="?action=insert&id=<?php echo $donnee[id];?>"><img src="../img/insert.png" alt="Inserer"></a>
                    <?php echo"</td>";
                    echo "</tr>";
                }
            ?>
        </table>
<br/>
<a href="index.php?action=create">Créer un formulaire</a>