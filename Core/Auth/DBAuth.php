<?php
/**
 * Created by PhpStorm.
 * User: su
 * Date: 7/5/2015
 * Time: 10:21 AM
 */

namespace Projet\Auth;


use Projet\Database\Log;
use Projet\Database\User;
use Projet\Model\App;
use Projet\Model\Table;


class DBAuth {

	private $session;

	/*
	 * Constructeur avec les messages d'options à personnaliser
	 */
	public  function __construct($session){
		$this->session = $session;
	}

	/*
	 * retourne la session en cours
	 */
	public function getSession(){
		return $this->session;
	}

	/**
	 * fonction qui permet a un utilisateur de se connecter
	 * @param $username
	 * @param $password
	 * @return boolean
	 */
	public function login($login,$password){
		$user = Table::query('SELECT * FROM entreprise WHERE numero = :login',[':login'=>$login], true);
		if($user){
			if($user->password == ($password)){
				$this->session->write('dbauth',$user);
				return true;
			}else{
				return "Votre mot de passe est incorrect";
			}
		}else{
			return "Votre numéro de téléphone est invalide";
		}
	}

	/**
	 * Fonction qui test si un utilisateur est conecte
	 * @return bool
	 */
	public function isLogged(){
		return isset($_SESSION['dbauth']);
	}

	/**
	 * Fonction permettante de se deconecter a l'interface
	 */
	public function signOut(){
		$this->session->delete('dbauth');
		$this->session->write('succes','Vous avez été déconnecter avec succès');
		return true;
	}
	/*
	 * fonction qui retourne le user ou pas
	 */
	public function user(){
		if (!$this->isLogged()){
			return false;
		}
		return $_SESSION['dbauth'];
	}
	
}