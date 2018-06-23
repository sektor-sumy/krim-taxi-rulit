<?php

namespace AppBundle\Service;

use AppBundle\Entity\Callback;
use AppBundle\Entity\Message;
use AppBundle\Entity\OrderCar;
use AppBundle\Entity\SettingsSite;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Templating\EngineInterface;

class EmailNotificationService
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * EmailNotificationService constructor.
     * @var EngineInterface
     * @param \Swift_Mailer $mailer
     */
    protected $templating;

    public function __construct(\Swift_Mailer $mailer, EntityManager $em, EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->em = $em;
        $this->templating = $templating;
    }

    /**
     * @param $email
     * @param $reply
     */
    public function sendEmail($email, $reply)
    {
        $message = (new \Swift_Message('krim'))
            ->setFrom('send@example.com')
            ->setTo($email)
            ->setBody($reply);

        $this->mailer->send($message);
    }


    /**
     * @param Message $message
     */
    public function sendAdminNotificationMessage(Message $message)
    {
        $settings = $this->em->getRepository(SettingsSite::class)->getActive();

        foreach ($settings as $setting) {
            $messageToMail = (new \Swift_Message('Новое сообщение [krim-rulit-taxi.ru]'))
                ->setFrom('message@krim-rulit-taxi.ru')
                ->setTo($setting->getMail())
                ->setBody(
                    $this->templating->render('email/admin/notification.message.html.twig', [
                        'message' => $message,
                        'lang' => 'ru',
                    ]),
                    'text/html'
                );
            $this->mailer->send($messageToMail);
        }
    }

    /**
     * @param Callback $callback
     */
    public function sendAdminNotificationCallback(Callback $callback)
    {
        $settings = $this->em->getRepository(SettingsSite::class)->getActive();

        foreach ($settings as $setting)
        {
            $messageToMail = (new \Swift_Message('Обратный звонок [krim-rulit-taxi.ru]'))
                ->setFrom('callback@krim-rulit-taxi.ru')
                ->setTo($setting->getMail())
                ->setBody(
                    $this->templating->render('email/admin/notification.callback.html.twig', [
                        'callback' => $callback,
                        'lang' => 'ru',
                    ]),
                    'text/html'
                );
            $this->mailer->send($messageToMail);
        }
    }

    /**
     * @param OrderCar $orderCar
     */
    public function sendAdminNotificationOrderCar(OrderCar $orderCar)
    {
        $settings = $this->em->getRepository(SettingsSite::class)->getActive();

        foreach ($settings as $setting)
        {
            $messageToMail = (new \Swift_Message('Заказ автомобиля [krim-rulit-taxi.ru]'))
                ->setFrom('callback@krim-rulit-taxi.ru')
                ->setTo($setting->getMail())
                ->setBody(
                    $this->templating->render('email/admin/notification.ordercar.html.twig', [
                        'orderCar' => $orderCar,
                        'lang' => 'ru',
                    ]),
                    'text/html'
                );
            $this->mailer->send($messageToMail);
        }
    }
}
