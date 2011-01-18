<?php
//include '../common.php';

$donnees_order_alpha = $user->get_user_checked();
$donnees_order_time = $user->get_list_user_time();
?>

<?php
foreach ($donnees as $donnee)
    {
        ?>



            <li data-theme="c" data-inset="true" class="ui-btn ui-btn-icon-right ui-li ui-btn-up-c">
                <a href="#" class="ui-link-inherit">
                    <?php
                    echo strtoupper($donnee["nom"])." ".ucfirst(strtolower($donnee["prenom"]));
                    ?>
                </a>
            </li>
        


    <?php
    }


?>