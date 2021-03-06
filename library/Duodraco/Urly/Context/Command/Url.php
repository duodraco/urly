<?php
namespace Duodraco\Urly\Context\Command;

use Duodraco\Urly\Context\Command;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Url extends Command
{
    /** @var  \Duodraco\Urly\Data\Url */
    protected $url;

    /**
     * @param Request $request
     * @param array $attributes
     * @return Response
     */
    public function execute(Request $request, array $attributes = [])
    {
        $url = $this->commandee->getUrlById($attributes['id']);
        if (!$url) {
            return new Response('Not Found', 404);
        }
        $this->url = $url;
        return new RedirectResponse($url->getUrl(), 301);
    }
    public function __destruct()
    {
        if(!$this->url){
            return;
        }
        $this->commandee->addHit($this->url);
    }
}