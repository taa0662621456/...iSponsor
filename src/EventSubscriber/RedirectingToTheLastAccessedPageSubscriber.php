<?php

	namespace App\EventSubscriber;

	use Symfony\Component\EventDispatcher\EventSubscriberInterface;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	use Symfony\Component\HttpKernel\Event\RequestEvent;
	use Symfony\Component\HttpKernel\KernelEvents;
	use Symfony\Component\Security\Http\Util\TargetPathTrait;

	class RedirectingToTheLastAccessedPageSubscriber
		implements EventSubscriberInterface
	{
		use TargetPathTrait;

		private $session;

		public function __construct(SessionInterface $session)
		{
			$this->session = $session;
		}

		public function onKernelRequest(RequestEvent $event): void
		{
			$request = $event->getRequest();
			if (!$event->isMasterRequest() || $request->isXmlHttpRequest()) {
				return;
			}

			$this->saveTargetPath($this->session, 'main', $request->getUri());
		}

		public static function getSubscribedEvents()
		{
			return [
				KernelEvents::REQUEST => ['onKernelRequest']
			];
		}
	}