<?php

namespace CleanWeb;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class View 
{
    protected $redirectUrl;
    protected $session;
    protected $content;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function notice($notice)
    {
        $this->session->getFlashBag()->add('notice', $notice);
    }

    public function error($error)
    {
        $this->session->getFlashBag()->add('error', $error);
    }

    public function redirectTo($url)
    {
        $this->redirectUrl = $url;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function render()
    {
        if ($this->redirectUrl) {
            return new RedirectResponse($this->redirectUrl);
        }

        return new Response($this->content);
    }
}
