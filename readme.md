This is a simple web application framework

Web server runs index.php and loads the classes that are needed 

What it does?

1. It creates an object of the web application
    $wa = new webApplication();

2. And runs the start method
    $wa->run();

What runs when the application starts ?

The application runs the following executions when the applicaton starts

1. Load requested HTTP Method [get,post,etc..] and fields from the request or messagebody
2. Authenticate the user request
3. Route to the requested path
4. Run the controller for the requested path as a requested method
5. Show the result


How does each execution step run?

1. Load requested HTTP Method [get,post,etc..] and fields from the request or messagebody
	1. WebApplication initializes the $http->method type and $http->body in the constructior of webApplication();
	2. Check if username and password fields exist in the $http->body
	3. If they do then set the flag in the webApplication validate = true

2. Authenticate the user request
	1. check if username and password are correct
	2. load the list of authotized paths
	3. check if the path he requested is valid
	4. if its not then send him to the login page or a message that he is not authorized
	5. if it is then route him the requested path

3. Route to the requested path
	1. loads the base controller $controler = new Controller();
	2. resolve the url and load the specific controller in the Controller constructor
	3. run the specific controller requested method

4. Run the controller for the requested path as a requested method
	1. runs the method
	2. loads the needed models
	3. returns the result in SOME FORFM or shows the result

5. Show the result
	1. check if its json or html or xml
	2. build the result
	3. return the result

	



