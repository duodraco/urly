<?php
namespace Duodraco\Urly\Context\Command;

use Duodraco\Urly\Context\Command;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUser extends Command
{
    /**
     * @param Request $request
     * @param array $attributes
     * @return Response
     */
    public function execute(Request $request, array $attributes = [])
    {
        try{
            $user = $this->commandee->createUser();
        } catch (\InvalidArgumentException $e){
            return new Response('',409);
        }
        if (!$user) {
            return new Response('Server Error', 500);
        }
        return new JsonResponse((object)['id'=>$user->getHash()],201);
    }
}