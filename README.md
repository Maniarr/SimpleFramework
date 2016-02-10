#SimpleFramework

##Router
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

##Controller
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

##View

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

##Model

Le model est la partie qui fait la relation entre un controller et la base de données.
Un model est associé à une table, pour cela le nom de votre table doit être celui de votre model en minuscule.

Exemple :
Model => Message : Table => message

Code de base d'un model :
```
<?php

namespace Model;

use Model\Model;

class Message extends Model
{
	...
}

?>
```

Vous pouvez ajouter des fonctions dans le model pour recupérer/créer des informations dans la base de données.

Model/Exemple.php
```
	public function get_message()
	{
		// Créer la requête SQL : SELECT * FROM message
		$this->select('*'); 

		// Créer la requête SQL : SELECT * FROM message
		$this->request = 'SELECT * FROM message';

		// Retourne tous les résultats correspondant à la requête
		return ($this->fetchAll());
	}
```

Controller/ExempleController.php :
```
<?php

namespace Controller;

use Controller\Controller;

class ExempleController extends Controller
{
	public function index()
	{
		// Initialisation du model 'Model/Exemple.php'
		$message_model = $this->model('Exemple');

		// Appelle de la méthode 'get_message' du model
		$messages = $message_model->get_message();
	}
}
 
?>
```

Fontions disponibles pour créer une requête :

select($field, ...) => SELECT $field, ... FROM table

insert(array('field' => $value)) => INSERT INTO table (field) VALUES ($value)

update(array('field' => $value)) => UPDATE table SET field = $value

delete() => DELETE FROM table

limit($number) => LIMIT $number

order_by($order) => ORDER BY $order

where($condition) => WHERE $condition

and_where($condition) => AND $condition

or_where($condition) => OR $condition

execute() => Execute la requête

fetch() => Récupère le premier résultat

fetchAll() => Récupère tous les résultats

Exemple :
```
	// Retourne les résultats de la requête : SELECT id, name WHERE id = 5
	return ($this->select('id', 'name')->where('id = 5')->fetchAll());
```