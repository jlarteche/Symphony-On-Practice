<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #ojo porque hay que acceder con http://localhost/sfcourse/public/index.php/ o montando un Virtual Host
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        #return new Response('<h1>Hola Caracola</h1>');
        #return new Response(content: '<h1>Hola Caracola v2</h1>');
        //mejor si lo devolvemos con una vista twig (blend en laravel)
        return $this->render(view: 'home/index.html.twig');
    }

    /* #ojo porque hay que acceder con http://localhost/sfcourse/public/index.php/custom o montando un Virtual Host
    #[Route('/custom/{nombre}', name: 'custom')]
    public function custom($nombre): Response
    {
        return new Response(content: "<h1>Hola Custom $nombre!</h1>");
    } */

    #ojo porque hay que acceder con http://localhost/sfcourse/public/index.php/custom/nombre o montando un Virtual Host
    //#[Route('/custom/{nombre?}', name: 'custom')] //para variables opcionales, interrogación al final.
    #[Route('/custom/{nombre?}', name: 'custom')]
    public function custom(Request $request): Response
    {
        #dump($request); //módulo symfony para mostrar una salida formateada visual. Descomentar para verlo.
        #return new Response(content: "<h1>Hola Custom " . $request->get('nombre') . "!</h1>");
        //el método get de la request symfony accede a los parameters del parameterBag
        #return new Response(content: "<h1>Hola Custom " . $request->server->get(key: 'MYSQL_HOME') . "!</h1>");
        
        $nombre = $request->get(key: 'nombre');
        #return new Response(content: "<h1>Hola Custom " . $nombre . "!</h1>");
        //pero mejor si lo hacemos con una vista (ojo que al pasar argumentos, no admite parametros con nombre y otros no)
        /* return $this->render(view: 'home/custom.html.twig', parameters: [
            'nombre'=>$nombre
        ]); */

        //también funcionará por no tener nombre los parámetros, ni view ni parameters
        return $this->render('home/custom.html.twig', compact('nombre'));

        //no funcionará por tener nombre "view" pero no nombre para los parametros
        /* return $this->render(view: 'home/custom.html.twig', [
            'nombre'      => $nombre,
        ]); */
    }
}
