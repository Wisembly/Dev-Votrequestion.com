<div id="jqm-home" class="ui-page ui-body-b ui-page-active" data-theme="b" data-role="page">
          <a href="test.html" class="ui-link-inherit" data-rel="dialog" data-inline="true">ICI</a>

          <div class="ui-content">



          - <a href="import/index.php">Import file</a>
    <br/>

    <div id="refrech"><a href="index.php"><input type="button" value="Rafraichir"/></a></div>
    <br/>

    <?php

        //On affiche les participants
        $data = $main->get_list_main();
        echo '<u>NOM :</u> '.$data[0]['nom'];

        $list_user = $user->get_list_user();
        ?>
    <form class="" role="search">
        <div class="ui-input-search ui-shadow-inset ui-btn-corner-all ui-btn-shadow ui-icon-search ui-body-c">
            <input class="ui-input-text ui-body-null"/>
        </div>
    </form>
        <ul class="ui-listview ui-listview-inset ui-corner-all ui-shadow" data-dividertheme="b" data-theme="c" data-inset="true" role="listbox">
            <li class="ui-li ui-li-divider ui-btn ui-bar-b ui-corner-top ui-btn-up-undefined"
                data-role="list-divider" role="heading" tabindex="0">Liste des inscrits</li>

        <?php
        foreach ($list_user as $one_user)
        {

            if($one_user['has_checked'] != 0){
                ?>

            <li class="ui-btn ui-btn-icon-right ui-li ui-btn-up-c" role="option" tabindex="-1" data-theme="c">
                <div class="ui-btn-inner">
                    <div class="ui-btn-text">
                        <?php
                        echo strtoupper($one_user["nom"])."<br/>".ucfirst(strtolower($one_user["prenom"]));
                        ?>
                    </div>

                </div>

            </li>

            <?php

            }else{
            ?>

        <li class="ui-btn ui-btn-icon-right ui-li ui-btn-up-c" role="option" tabindex="-1" data-theme="c">
            <div class="ui-btn-inner">
            <div class="ui-btn-text">
                <a href="index.php?user=<?php echo $one_user['id']; ?>" class="ui-link-inherit" data-rel="dialog"  >
                <?php
                echo strtoupper($one_user["nom"])."<br/>".ucfirst(strtolower($one_user["prenom"]));
                ?>
                </a>
            </div>
            <span class="ui-icon ui-icon-arrow-r"></span>
        </div>
        </li>
            <?php
            }
        }
        ?>
        <li class="ui-li ui-li-divider ui-btn ui-bar-b ui-corner-bottom ui-btn-up-undefined"
                data-role="list-divider" role="heading"></li>
        </ul>


<a href="logout.php" data-role="button" data-icon="delete">Logout (<?php echo $_SESSION['connect'];?>)</a>
  </div>
    <div style="text-align: center">Powered by Balloon</div>
      </div>