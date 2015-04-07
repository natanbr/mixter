<?php

namespace App\Domain\Identity;

class SessionHandler {
    /**
     * @var ISessionRepository
     */
    private $sessionRepository;

    public function __construct(ISessionRepository $sessionRepository) {
        $this->sessionRepository = $sessionRepository;
    }

    public function handleUserConnected(UserConnected $userConnected)
    {
        $this->sessionRepository->save(
            new SessionProjection($userConnected->getUserId(), $userConnected->getSessionId()));
    }

    public function handleUserDisconnected(UserDisconnected $userDisconnected)
    {
        $this->sessionRepository->remove($userDisconnected->getSessionId());
    }
}