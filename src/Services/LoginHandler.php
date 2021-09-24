<?php

namespace App\Services;

use App\Core\Session;
use App\Entity\User;
use App\Repository\UserManager;
use Core\BaseController;

class LoginHandler extends BaseController
{
    const URL = "http://localhost:8888";

    /**
     * Allows the user to register an account on the blog
     * 
     * @return void 
     */
    public function register()
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
                $body = "<p>Bonjour " . $lastUser->getFirstNameSQL() . " " . $lastUser->getLastNameSQL() . ",</p><p>Pour valider votre inscription, vous devez prouver que vous disposez d'une adresse courriel valide :</p><a href='" . self::URL . "/verification/" . $lastUser->getToken() . "'><button>Cliquez ici pour vérifier mon adresse</button></a></p><p>Merci pour votre confiance,</p><p>Marc Lassort</p>";

                $mailer->sendEmail($lastUser->getEmail(), $subject, $body);
                
                $this->render('frontend/registering.html.twig', []);
            } else 
            {
                echo 'Vous ne pouvez pas utiliser cette adresse email.';
                $this->render('frontend/register.html.twig', []);
            }
        } else
        {
            $this->render('frontend/register.html.twig', []);
        }
    }

    /**
     * Checks if the email address is valid 
     * 
     * @return void
     */
    public function verifyEmailAddress($token)
    {
        $userManager = new UserManager('user', 'User');
         
        if ($userManager->getUserByToken($token) != NULL)
        {
            $user = $userManager->getUserByToken($token);
            $userManager->setActiveModeForUser($user);

            $this->redirect('registered');
            header('Location: /registered');
            $this->render('frontend/registered.html.twig', []);
        } else
        {
            $this->render('frontend/registering.html.twig', []);
        }
    }

    /**
     * Send an email with a new token when an user wants to create a new password
     * 
     * @return void
     */
    public function createNewTokenAndSendEmailForNewPassword()
    {
        $user = new User($_POST);

        $userManager = new UserManager('user', 'User');

        if ($userManager->getByMail($_POST['email']) != NULL)
        {
            $user = $userManager->getByMail($_POST['email']);
            $userManager->createNewTokenForUser($user);

            $user = $userManager->getByMail($_POST['email']);
            
            $mailer = new Mailer();

            $subject = "Blog Marc Lassort - Création d'un nouveau mot de passe";
            $body = "<p>Bonjour " . $user->getFirstNameSQL() . ' ' . $user->getLastNameSQL() . ",</p><p>Pour créer un nouveau mot de passe, vous devez valider la procédure via ce courriel :</p><a href='" . self::URL . "/verification-password/" . $user->getToken() . "'><button>Cliquez ici pour recréer mon mot de passe</button></a></p><p>Merci pour votre confiance,</p><p>Marc Lassort</p>";

            $mailer->sendEmail($user->getEmail(), $subject, $body);
            
            $this->render('frontend/password-sent.html.twig');
        } else 
        {
            $this->redirect('password');
            header('Location: /password');
            $this->render('frontend/forgot-password.html.twig', []);
        }
    }

    /**
     * Checks if the email address is valid and allows to create a new password
     * 
     * @return void
     */
    public function verifyEmailAddressForNewPassword($token)
    {
        $userManager = new UserManager('user', 'User');
         
        if ($userManager->getUserByToken($token) != NULL)
        {
            $user = $userManager->getUserByToken($token);

            if ($user->getToken() == $token)
            {
                $this->redirect('create-new-password');
                header('Location: /create-new-password');
                $this->render('frontend/create-new-password.html.twig', []);
            } else
            {
                $this->redirect('password');
                header('Location: /password');
                $this->render('frontend/forgot-password.html.twig', []);
            }
        } else
        {
            $this->redirect('password');
            header('Location: /password');
            $this->render('frontend/forgot-password.html.twig', []);
        }
    }

    /**
     * Create new password for the user
     * 
     * @return void
     */
    public function createNewPassword()
    {
        $userManager = new UserManager('user', 'User');

        if (isset($_POST['email']))
        {
            $user = $userManager->getByMail($_POST['email']);
            $userManager->setNewPassword($user);
            
            $this->render('frontend/password-registered.html.twig', []);
        } else 
        {
            $this->redirect('password');
            header('Location: /password');
            $this->render('frontend/forgot-password.html.twig', []);
        }
    }

    /**
     * Check if the users
     */
    public function login2()
    {
        $user = new User($_POST);

        if (!empty($_POST))
        {
            $userManager = new UserManager('user', 'User');
            $userManager->addUser($user);
            
            $this->render('frontend/registered.html.twig', []);
        } else 
        {
            $this->render('frontend/login.html.twig', []);
        }
    }

    /**
     * Checks if the user is admin or not and if the login and password are correct
     * 
     * @return void 
     */
    public function checkLogin()
    {
        if (!empty($_POST))
        {
            $userManager = new UserManager('user', 'User');
            $user = $userManager->getByMail($_POST['email']);

            if (!empty($user))
            {
                if ($user->getRole() != NULL && $user->getRole() != "" && $user->getRole() == 1)
                {
                    if (password_verify($_POST['password'], $user->getPassword()) == true)
                    {
                        $session = new Session();
                        $session->set('username', $user->getUsername());
                        $session->set('email', $user->getEmail());

                        $this->redirect('admin');
                        $this->render('backend/admin.html.twig', []);
                    } else 
                    {
                        echo "<p class='text-white'>Votre identifiant et/ou votre mot de passe ne sont pas valides.</p>";
                        $this->render('frontend/login.html.twig', []);
                    };
                } else 
                {
                    if ($user->getIsActive() != NULL && $user->getIsActive() != "" && $user->getIsActive() == 1)
                    {
                        if (password_verify($_POST['password'], $user->getPassword()) == true)
                        {
                            $session = new Session();
                            $session->set('username', $user->getUsername());
                            $session->set('email', $user->getEmail());
                            
                            $this->redirect('profil');
                            $this->render('frontend/profile.html.twig', []);
                        } else 
                        {
                            echo "<p class='text-white'>Votre identifiant et/ou votre mot de passe ne sont pas valides.</p>";
                            $this->render('frontend/login.html.twig', []);
                        };
                    } else
                    {
                        if (password_verify($_POST['password'], $user->getPassword()) == true)
                        {
                            echo "<p class='text-white'>Vous n'avez pas encore activé votre compte. Veuillez vérifier votre boîte mail.</p>";
                            $this->render('frontend/login.html.twig', []);
                        } else 
                        {
                            echo "<p class='text-white'>Votre identifiant et/ou votre mot de passe ne sont pas valides.</p>";
                            $this->render('frontend/login.html.twig', []);
                        };
                    }
                }
            } else 
            {
                echo "<p class='text-white'>Veuillez saisir votre identifiant et/ou votre mot de passe.</p>";
                $this->render('frontend/login.html.twig', []);
            }
        } else
        {
            $this->render('frontend/login.html.twig', []);
        }
    }
}