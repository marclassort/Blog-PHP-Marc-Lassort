<?php

namespace App\Services;

use App\Core\Session;
use App\Entity\User;
use App\Repository\UserManager;
use Core\BaseController;
use Ramsey\Uuid\Uuid;

class LoginHandler extends BaseController
{
    const URL = "http://localhost:8888";
    
    /**
     * Allows the user to register an account on the blog
     * 
     * @return void 
     */
    public function register(): void
    {
        $user = new User($_POST);

        if (!empty($_POST))
        {            
            $userManager = new UserManager('user', 'User');

            $userByMail = $userManager->getByMail($_POST['email']);

            if ($userByMail == NULL)
            {
                $hashPassword = password_hash($user->getPassword(), PASSWORD_BCRYPT);
                $user->password = $hashPassword;
    
                $userManager->addUser($user);

                $lastUser = $userManager->getLastUserAdded();

                $mailer = new Mailer();

                $subject = "Confirmation d'inscription au blog de Marc Lassort";
                $body = "<p>Bonjour " . $lastUser->getFirstName() . " " . $lastUser->getLastName() . ",</p><p>Pour valider votre inscription, vous devez prouver que vous disposez d'une adresse courriel valide :</p><a href='" . self::URL . "/verification/" . $lastUser->getToken() . "'><button>Cliquez ici pour vérifier mon adresse</button></a></p><p>Merci pour votre confiance,</p><p>Marc Lassort</p>";

                $mailer->sendEmail($lastUser->getEmail(), $subject, $body);
                
                $this->redirect('mot-de-passe-enregistre');
            } else 
            {
                echo 'Vous ne pouvez pas utiliser cette adresse email.';
            }
        } 
    }

    /**
     * Checks if the email address is valid 
     * 
     * @param string $token
     * 
     * @return void
     */
    public function verifyEmailAddress($token): void
    {
        $userManager = new UserManager('user', 'User');
         
        if ($userManager->getUserByToken($token) != NULL)
        {
            $user = $userManager->getUserByToken($token);
            $userManager->setActiveModeForUser($user);

            $this->redirect('mot-de-passe-enregistre');
        } else
        {
            $this->redirect('echec-verification');
        }
    }

    /**
     * Send an email with a new token when an user wants to create a new password
     * 
     * @return void
     */
    public function createNewTokenAndSendEmailForNewPassword()
    {
        $userManager = new UserManager('user', 'User');

        if ($userManager->getByMail($_POST['email']) != NULL)
        {
            $user = $userManager->getByMail($_POST['email']);
            $userManager->createNewTokenForUser($user);

            $user = $userManager->getByMail($_POST['email']);
            
            $mailer = new Mailer();

            $subject = "Blog Marc Lassort - Création d'un nouveau mot de passe";
            $body = "<p>Bonjour " . $user->getFirstName() . ' ' . $user->getLastName() . ",</p><p>Pour créer un nouveau mot de passe, vous devez valider la procédure via ce courriel :</p><a href='" . self::URL . "/creer-nouveau-mot-de-passe/" . $user->getToken() . "'><button>Cliquez ici pour recréer mon mot de passe</button></a></p><p>Merci pour votre confiance,</p><p>Marc Lassort</p>";

            $mailer->sendEmail($user->getEmail(), $subject, $body);
        } else 
        {
            $this->redirect('mot-de-passe-oublie');
        }
    }

    /**
     * Checks if the email address is valid and allows to create a new password for the user
     * 
     * @param string $token
     * 
     * @return void
     */
    public function createNewPassword($token)
    {
        $userManager = new UserManager('user', 'User');
        $user = $userManager->getUserByToken($token);
         
        if ($user != NULL && $user->getToken() == $token)
        {
            if ($this->isSubmitted('changeInput') && $this->isValid($user))
            {                
                $hashPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $user->password = $hashPassword;

                $userManager->setNewPassword($user);

                $this->redirect('mot-de-passe-enregistre');
            }
        } else
        {
            echo 'Cet utilisateur n\'existe pas.';
            $this->redirect('login');
        }  
    }

    /**
     * Checks if the user is admin or not and if the login and password are correct
     * 
     * @param mixed $user
     * 
     * @return void 
     */
    public function checkLogin($user)
    {
        if (!empty($user) && password_verify($_POST['password'], $user->getPassword()))
        {
            $token = Uuid::uuid4()->toString();

            if ($user->getRole() != NULL && $user->getRole() != false)
            {
                $session = new Session();
                $session->set('username', $user->getUsername());
                $session->set('email', $user->getEmail());
                $session->set('id', $user->getId());
                $session->set('isActive', $user->getIsActive());
                $session->set('token', $token);

                return true;
            } else 
            {
                if ($user->getIsActive() != NULL && $user->getIsActive() != "" && $user->getIsActive() == 1)
                {                    
                    $session = new Session();
                    $session->set('username', $user->getUsername());
                    $session->set('email', $user->getEmail());
                    $session->set('id', $user->getId());
                    $session->set('token', $token);

                    $this->redirect('profil');
                } else
                {
                    echo "<p class='text-white'>Vous n'avez pas encore activé votre compte. Veuillez vérifier votre boîte mail.</p>";
                }
            }
        } else 
        {
            echo "<p class='text-white'>Votre identifiant et/ou votre mot de passe ne sont pas valides.</p>";
        }
    }
}