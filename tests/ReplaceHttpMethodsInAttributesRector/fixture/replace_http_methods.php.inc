<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class SomeController
{
    #[Route('/search', methods: ['GET', 'POST'])]
    public function search() {}

    #[Route('/update', methods: ['PUT', 'DELETE'])]
    public function update() {}
}

?>
    -----
<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class SomeController
{
    #[Route('/search', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function search() {}

    #[Route('/update', methods: [Request::METHOD_PUT, Request::METHOD_DELETE])]
    public function update() {}
}

?>
