Simple Web Application Framwork SWAF  
----------------------------------------------------------------  
This is a simple web application framework.. Just another php framework.
I just wanted to play around and practice frameworks and mvc. So here it is. 

Web server runs index.php and loads the classes that are needed 


1. It creates an object of the web application
	$app = new App(dirname(__DIR__));

2. And runs the start method
	$app->start();

When start runs

1. Load requested HTTP Method [get,post,etc..] and fields from the request or messagebody
2. Authenticate the user request
3. Route to the requested path
4. Run the controller for the requested path as a requested method
5. Show the result

How to USE
----------------------------------------------------------------
1. You can download and set unzip the file in your web server or clone the project in your local web directory.
2. You need to change the config file. set the fields you need for your server

define('CONFIG', array(
    'db.user' => 'root',  <= the username of the database
    'db.password' => '',  <= the password of the database
    'db.host' => 'localhost',<= the host or ip of the server where you have the database 
    'db.name' => 'samplewebapp', <= and the name of the database
));

3. You can now start playing around. You can have restricted pages and public pages
for public pages you can create your own folder in views/publicPages/{the name of your folder}
in your folder you need to create a controller.php and a view.php. The controller has 4 basic methods in it that correspond to the http methods. I intended to make this a rest api framework thats why I used these methods, post,get,put,delete. 

4. In the methods you can use the Database class in order to access the database. This framework uses a custom ORM that selects stuf from the database check the components/core/Model for more. I have already made some examples on how to work with the database. Check the products controller and view to see how they work. 
   	
        $p = new Products();
        $p->select();

You can specify a more precise select like $p->select(['id = '=> 1]); you can simply play like this

		$p->select(['id = '=> 1]);  
		$p->select(['id > '=> 1]);  
		$p->select(['id < '=> 1]);  
		$p->select(['id >= '=> 1]);  
		$p->select(['id = '=> 1, 'name =', 'johny']);  
		$p->select(['id = '=> 1, 'and name like', '%johny%']);  
		$p->select(['id = '=> 1, 'or name like', '%johny%']);  

You can you the =, and or like or any sql operators. If you see how the Model is implemented you will understand more. 

5. You can pass any variables in your views and they will be shows
use the following statement echo $view->render('main', 'main' , $products);
Ths will load the main layout and the main view and pass in an array of $products with key value pair. 
for example. If the array is like ['id'=> 123, 'name' = 'keyboard'] you can access the variables with their name like $id or $name

There is still work to be done.. So please have patience. 
If your a developer and looking for some custom framework that you need to hack around and play with it, feel free to download it and do whatever you want with it. 

Thank you.





