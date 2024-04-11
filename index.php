<?php
session_start();

require "App/controller/Autoload.php";
Autoloader::Require_controller();
Autoloader::Require_Model();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'logout': return CONTROLLER::logout() ;
        case 'P_login': return CONTROLLER::Login() ;
        case 'Register_user': return USER_CONTROLLER::Register() ;
        case 'Creatuser': return USER_CONTROLLER::creat_user() ;
        case 'Register_ass':return ASSOCIATION_CONTROLLER::Register() ;
        case 'creat_ass':return ASSOCIATION_CONTROLLER::Creat_association();
        case 'V_login': return CONTROLLER::V_Login() ;
        case 'getcomment': return CONTROLLER::get_comment();
    }
    if (isset($_SESSION["user"]) || isset($_SESSION["ass"])) {
        switch ($_GET['action']) {
            case 'recherchuser': return CONTROLLER::recherchuser();
            case 'getposts': return CONTROLLER::Posts();
            case 'Messge': return CONTROLLER::Message();
            case 'addcoment': return CONTROLLER::Addcomment();
            case 'usersuive': return USER_CONTROLLER::usersuive();            
            case 'toggelusersuive': return USER_CONTROLLER::toggleusersuivi();            
            case 'Accueil': return include_once('./App/Vue/User_Association/Accueil.php');
            case 'Pubinfo': return CONTROLLER::Publication_info() ; 
            case 'envoimess': return CONTROLLER::envoimess();
            case 'getDiscussions': return CONTROLLER::getDiscussions();
            case 'get_Message': return CONTROLLER::get_Message();
            case 'get_suive': return CONTROLLER::get_suive();
            case 'get_info_user' : return CONTROLLER::get_info_user();
            case 'get_nb_msg': return CONTROLLER::get_nb_msg();
            case 'get_dernier_msg': return CONTROLLER::get_dernier_msg();
            case "Recherch_desparu": return CONTROLLER::Recherch_desparu();

            case 'test': return include_once ("./test.php");
        }
    }
    if (isset($_SESSION["user"]))
    {
         
        switch ($_GET['action']) {
            case 'Pub': return USER_CONTROLLER::Publication() ;
            case 'DeletPub': return USER_CONTROLLER::Delet_Pub() ;    
            case 'Profile': return USER_CONTROLLER::Profile();
            case 'creat_desparu': return CONTROLLER::creat_desparu() ;
            case 'Disparues': return CONTROLLER::Get_disparus();
            default: return include_once('App/Vue/404.php');
        }
    }

    elseif(isset($_SESSION["ass"]))
    {
        switch ($_GET['action']) {
            //association pages
            case 'creat_Indi': return CONTROLLER::creat_desparu();
            case 'edite_indiv':return ASSOCIATION_CONTROLLER::Edit_Info_Individus();
            case 'delet_indv':return ASSOCIATION_CONTROLLER::Delet_Individus();
            case 'info_indiv': return ASSOCIATION_CONTROLLER::Get_Info_Individus() ;
            case 'Individue': return CONTROLLER::Get_disparus();
            case 'Profile': return ASSOCIATION_CONTROLLER::Profile();

            default: return include_once('App/Vue/404.php') ;
        }
    }else return CONTROLLER::Login() ;
}else return CONTROLLER::Login()  ;