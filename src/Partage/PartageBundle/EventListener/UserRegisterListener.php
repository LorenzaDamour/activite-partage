<?php

namespace Partage\PartageBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use FOS\UserBundle\Event\FilterUserResponseEvent;

/**
 * Listener responsible to change the redirection at the end of the password resetting
 */
class UserRegisterListener implements EventSubscriberInterface
{
    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_COMPLETED => 'onRegistrationCompleted',
        );
    }

    public function onRegistrationCompleted(FilterUserResponseEvent $event)
    {
        if($event->getUser()->getRoles() == 'ROLE_ASSOS' || in_array('ROLE_ASSOS',$event->getUser()->getRoles()) ){
            $url = $this->router->generate('association_new');
        }else{
            $url = $this->router->generate('particulier_new');
        }

        $response = $event->getResponse();
        $response->setTargetUrl($url);
    }
}