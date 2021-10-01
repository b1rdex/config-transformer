<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ConfigTransformer202110019\Symfony\Component\HttpKernel\EventListener;

use ConfigTransformer202110019\Psr\Log\LoggerInterface;
use ConfigTransformer202110019\Symfony\Component\Debug\Exception\FlattenException as LegacyFlattenException;
use ConfigTransformer202110019\Symfony\Component\ErrorHandler\Exception\FlattenException;
use ConfigTransformer202110019\Symfony\Component\EventDispatcher\EventSubscriberInterface;
use ConfigTransformer202110019\Symfony\Component\HttpFoundation\Request;
use ConfigTransformer202110019\Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use ConfigTransformer202110019\Symfony\Component\HttpKernel\Event\ExceptionEvent;
use ConfigTransformer202110019\Symfony\Component\HttpKernel\Event\ResponseEvent;
use ConfigTransformer202110019\Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use ConfigTransformer202110019\Symfony\Component\HttpKernel\HttpKernelInterface;
use ConfigTransformer202110019\Symfony\Component\HttpKernel\KernelEvents;
use ConfigTransformer202110019\Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class ErrorListener implements \ConfigTransformer202110019\Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    protected $controller;
    protected $logger;
    protected $debug;
    public function __construct($controller, \ConfigTransformer202110019\Psr\Log\LoggerInterface $logger = null, bool $debug = \false)
    {
        $this->controller = $controller;
        $this->logger = $logger;
        $this->debug = $debug;
    }
    /**
     * @param \Symfony\Component\HttpKernel\Event\ExceptionEvent $event
     */
    public function logKernelException($event)
    {
        $e = \ConfigTransformer202110019\Symfony\Component\ErrorHandler\Exception\FlattenException::createFromThrowable($event->getThrowable());
        $this->logException($event->getThrowable(), \sprintf('Uncaught PHP Exception %s: "%s" at %s line %s', $e->getClass(), $e->getMessage(), $e->getFile(), $e->getLine()));
    }
    /**
     * @param \Symfony\Component\HttpKernel\Event\ExceptionEvent $event
     */
    public function onKernelException($event)
    {
        if (null === $this->controller) {
            return;
        }
        $exception = $event->getThrowable();
        $request = $this->duplicateRequest($exception, $event->getRequest());
        try {
            $response = $event->getKernel()->handle($request, \ConfigTransformer202110019\Symfony\Component\HttpKernel\HttpKernelInterface::SUB_REQUEST, \false);
        } catch (\Exception $e) {
            $f = \ConfigTransformer202110019\Symfony\Component\ErrorHandler\Exception\FlattenException::createFromThrowable($e);
            $this->logException($e, \sprintf('Exception thrown when handling an exception (%s: %s at %s line %s)', $f->getClass(), $f->getMessage(), $e->getFile(), $e->getLine()));
            $prev = $e;
            do {
                if ($exception === ($wrapper = $prev)) {
                    throw $e;
                }
            } while ($prev = $wrapper->getPrevious());
            $prev = new \ReflectionProperty($wrapper instanceof \Exception ? \Exception::class : \Error::class, 'previous');
            $prev->setAccessible(\true);
            $prev->setValue($wrapper, $exception);
            throw $e;
        }
        $event->setResponse($response);
        if ($this->debug) {
            $event->getRequest()->attributes->set('_remove_csp_headers', \true);
        }
    }
    /**
     * @param \Symfony\Component\HttpKernel\Event\ResponseEvent $event
     */
    public function removeCspHeader($event) : void
    {
        if ($this->debug && $event->getRequest()->attributes->get('_remove_csp_headers', \false)) {
            $event->getResponse()->headers->remove('Content-Security-Policy');
        }
    }
    /**
     * @param \Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent $event
     */
    public function onControllerArguments($event)
    {
        $e = $event->getRequest()->attributes->get('exception');
        if (!$e instanceof \Throwable || \false === ($k = \array_search($e, $event->getArguments(), \true))) {
            return;
        }
        $r = new \ReflectionFunction(\Closure::fromCallable($event->getController()));
        $r = $r->getParameters()[$k] ?? null;
        if ($r && (!($r = $r->getType()) instanceof \ReflectionNamedType || \in_array($r->getName(), [\ConfigTransformer202110019\Symfony\Component\ErrorHandler\Exception\FlattenException::class, \ConfigTransformer202110019\Symfony\Component\Debug\Exception\FlattenException::class], \true))) {
            $arguments = $event->getArguments();
            $arguments[$k] = \ConfigTransformer202110019\Symfony\Component\ErrorHandler\Exception\FlattenException::createFromThrowable($e);
            $event->setArguments($arguments);
        }
    }
    public static function getSubscribedEvents() : array
    {
        return [\ConfigTransformer202110019\Symfony\Component\HttpKernel\KernelEvents::CONTROLLER_ARGUMENTS => 'onControllerArguments', \ConfigTransformer202110019\Symfony\Component\HttpKernel\KernelEvents::EXCEPTION => [['logKernelException', 0], ['onKernelException', -128]], \ConfigTransformer202110019\Symfony\Component\HttpKernel\KernelEvents::RESPONSE => ['removeCspHeader', -128]];
    }
    /**
     * Logs an exception.
     * @param \Throwable $exception
     * @param string $message
     */
    protected function logException($exception, $message) : void
    {
        if (null !== $this->logger) {
            if (!$exception instanceof \ConfigTransformer202110019\Symfony\Component\HttpKernel\Exception\HttpExceptionInterface || $exception->getStatusCode() >= 500) {
                $this->logger->critical($message, ['exception' => $exception]);
            } else {
                $this->logger->error($message, ['exception' => $exception]);
            }
        }
    }
    /**
     * Clones the request for the exception.
     * @param \Throwable $exception
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    protected function duplicateRequest($exception, $request) : \ConfigTransformer202110019\Symfony\Component\HttpFoundation\Request
    {
        $attributes = ['_controller' => $this->controller, 'exception' => $exception, 'logger' => $this->logger instanceof \ConfigTransformer202110019\Symfony\Component\HttpKernel\Log\DebugLoggerInterface ? $this->logger : null];
        $request = $request->duplicate(null, null, $attributes);
        $request->setMethod('GET');
        return $request;
    }
}
