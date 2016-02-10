#SimpleFramework

[TOC]

> ##Router
Le router est la pièce maitresse du framework et va permettre d'associer des urls à une méthode d'un controller.

Il est possible de d'utiliser des regex dans les urls, si celle-ci ne contient pas de parenthèses.

index.php :
```
<?php

require_once('Core'.DIRECTORY_SEPARATOR.'config.php');
require_once('Core'.DS.'Autoloader.php');

Autoloader::register();

use Core\Routing\Router;

$router = new Router();

// Ajoute une route en méthode GET pour la méthode 'index' du controller 'PageController'
$router->get('/home', 'PageController::index');
// Ajoute une route en méthode POST pour la méthode 'index' du controller 'PageController'
$router->post('/home', 'PageController::index_post');

// Ajout d'une regex dans une url, elle doit être entouré de parenthèses
$router->get('/home/([0-9]{5})', 'PageController::index');

// Ajoute une page 404, elle est appelée quand l'url demandée n'existe pas
$router->add_404('PageController::error_404');

// Lance le router
$router->run();

?>
```

> ##Controller

Les controllers par conventions se termine par 'Controller'.
Leurs namespaces doivent correspondre à leurs chemins d'accès en partant du dossier du framework.

Exemple :
Controller/admin/PagesController.php => namespace Controller\admin;
Controller/client/AccountController.php => namespace Controller\client;

Vous pouvez faire une redirection vers une url avec la fonction 'redirect' :
Controller/ExempleController.php :
```
	public function exemple()
	{
		$this->redirect('/home');
	}
```

Code de base d'un controller : 
```
<?php

// PageController se trouve dans le dossier 'Controller'
namespace Controller;

use Controller\Controller;

class PageController extends Controller
{
	...
}
 
?>
```

> ##View

Les vues sont la partie visible pour le visiteur. Elles doivent être dans le dossier 'View'.
Vous pouvez faire passer des variables du controller à la vue, celles-ci doivent être contenues dans un tableau.

Pour les appeler dans un controller :
```
	public function exemple()
	{
		// Rend la vue 'View/index.php'
		$this->view('index');

		// Rend la vue 'View/admin/home.php'
		$this->view('admin/home', array('id' => 2));
	}
```

View/admin/home :
```
	<?php
		// Affiche la valeur de l'index 'id' du tableau passé a la vue.
		echo $this->data['id'];
	?>
```

Fonctions disponibles dans la vue :
```
	<?php
		// Affiche l'url de la route '/home'
		$this->url('/home');

		// Affiche l'url pour le fichier /public/css/app.css
		$this->asset('css/app.css');
	?>
```

> ##Model