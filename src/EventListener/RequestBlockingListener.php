<?php
namespace Alsar\RequestBlockingBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpFoundation\Response;

class RequestBlockingListener
{
    /**
     * @var array
     */
    private $paths;

    public function setPaths(array $paths)
    {
        $this->paths = $paths;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
//         if (HttpKernel::MASTER_REQUEST != $event->getRequestType()) {
//             return;
//         }
        if ($this->paths == null) {
            return;
        }

        $path = $event->getRequest()->getPathInfo();

        if (in_array($path, $this->paths)) {
            $event->setResponse(new Response(''));
        }
    }
}