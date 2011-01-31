<a href="?action=liste">Retour à la liste</a><br/><br/>
<fieldset>
    <legend>Informations</legend>

<?php
//Nombre de participants
$rep = new ShowAnswer();
$nb_part = $rep->countParticipants($_GET['id']);
echo "<h5><u>Nombre de participant(s) unique(s) : ".$nb_part."</u></h5>";

	if ( !(isset($_GET['id']) && is_numeric($_GET['id'])) )
		die('Erreur');
	
	//echo 'TUDO : Page en construction..<br/>';

        
        $datas = $rep->getReponseForOneItem($_GET['id']);

        $flag = 0;
        $change_cat = "";
        $array_name = array();
        $array_count = array();
        array_push($datas, "");
        //print_r($datas);die();
        foreach ($datas as $data)
        {
            //echo ($change_cat."<br/>");
            
            if($data['form_item_id'] != $flag)
                {
                
                if($change_cat == 'select' || $change_cat == 'checkbox' || $change_cat == 'radio'){

                    //print_r($array_name);echo '</br>'; print_r($array_count);echo '</br>';


                    //On récupère le nombre de vote
                    $total = 0;

                    foreach($array_name as $name)
                    {
                        $key = array_search($name,$array_name);
                        $total += $array_count[$key];
                    }
                    
                    echo '<u>Nombre de votes :</u>'.$total."<br/>";

                    //On calcule de pourcentage
                foreach($array_name as $name)
                    {
                        $key = array_search($name,$array_name);
                        $cp = ($array_count[$key]*100)/$total;
                        echo $name." :".$array_count[$key]."(".round($cp,2)."%)<br/>";
                    }

                    
                   $total=0;
                }



                if(sizeof($array_name) != 0){$array_name = array(); }
                if(sizeof($array_count) != 0){$array_count = array(); }

                if($change_cat == 'text' || $change_cat == 'textarea')
                    {
                    echo '</ul>';$change_cat = "";
                    }

                if($data != 0){echo '<h2>'.$data['label'].' ('.$data['type'].')</h2>';}
                $flag = $data['form_item_id'];
                if($data != 0){

                    //Suivant le type on affiche le resultat
                    switch($data['type'])
                        {
                            case 'text':
                            case 'textarea':
                                echo '<ul>';
                                break;
                            default:
                                $change_cat = $data['type'];
                                $listofOption = $rep->getListOption($data['form_item_id']);
                                echo '<u>';
                                foreach($listofOption as $option)
                                    {
                                        //echo $option['label']. '_('.$option['id'].')  ';
                                        array_push($array_name, $option['label']);
                                        array_push($array_count, 0);
                                    }
                                    //print_r($array_name);echo '</br>';print_r($array_count);
                                echo '</u><br/>';
                                
                                break;
                        }
                    $change_cat = $data['type'];
                    
                }
                }

                    if($data != 0){

           if($data['type'] == 'text' || $data['type'] == 'textarea'){
               echo '<li>'.$data['value'].'</li>';
           }else{

               if($data['type'] == 'checkbox')
                   {
                   $res = explode(';', $data['value']);
                   foreach ($res as $re)
                   {
                       if($re != NULL)
                       {
                            //echo $re.'</br>';
                            $key = array_search($re, $array_name);
                            $var_count = $array_count[$key];
                            $var_count ++;
                            $array_count[$key] = $var_count;

                       }
                   }
                   }else{
                        //echo $data['value'];
                        //echo "</br>";

                        $key = array_search($data['value'], $array_name);
                        $var_count = $array_count[$key];
                        $var_count ++;
                        $array_count[$key] = $var_count;
                   }
               //print_r($data);
               
           }
            }

        }

        
	
	/*$answer = new Answer();
	$reponses = $answer->getAllAnswersByForm($_GET['id']);
	foreach ( $reponses as $val )
	{
		echo $val[0].'<br/>';
	}*/
	
?>
</fieldset>