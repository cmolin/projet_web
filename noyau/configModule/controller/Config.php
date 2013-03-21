<?php

function indexConfig()
{
    include('/../views/vues1.php');
}

function bdConfig()
{
    //Création du formulaire 
    $form = new Formulaire('POST');
    $form->add(array('type' => 'text', 'name' => 'database_name', 'label' => 'Host '));
    $form->add(array('type' => 'text', 'name' => 'database_user', 'label' => 'Utilisateur '));
    $form->add(array('type' => 'password', 'name' => 'database_password', 'label' => 'Mot de passe '));
    $form->add(array('type' => 'text', 'name' => 'database_db', 'label' => 'Base de donnees '));
    $form->addBouton(array('type' => 'submit', 'name' => 'submit', 'value' => 'Valider'));
    $form->_destruct();
    
    //Si le formulaire est valider
    if(isset($_POST['database_name']))
    {
        try
        {
            $bd = new PDO('mysql:host='.$_POST['database_name'].';dbname='.$_POST['database_db'], $_POST['database_user'], $_POST['database_password']);
            $array['database_name']  = $_POST['database_name'];
            $array['database_db']  = $_POST['database_db'];
            $array['database_user']  = $_POST['database_user'];
            $array['database_password']  = $_POST['database_password'];
            $yaml = Spyc::YAMLDump($array);
            $fp = fopen('config/parameters_database.yml', 'w');
            fwrite($fp, $yaml);
            fclose($fp);
        }
        catch(PDOException $e)
        {
            $erreur = "Erreur les parametres de connexion ne sont pas valides";
            //Chargement de la vue
            include('/../views/vues_bd.php');
        }
    }
    else
    {
        //Chargement de la vue
        include('/../views/vues_bd.php');
    }
}

function fonc()
{
    echo "coucou";
}


?>