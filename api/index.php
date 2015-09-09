<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require_once 'include/DbHandler.php';
require_once 'include/PassHash.php';
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim ();

// Instantiate global user id from the db
$user_id = NULL;

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */

// POST route
$app->post('/', function () {
    echo 'This is a POST route';
});

// GET route
$app->get('/', function () {
    echo 'This is a GET route';
});

// PUT route
$app->put('/', function () {
    echo 'This is a PUT route';
});

// PATCH route
$app->patch('/', function () {
    echo 'This is a PATCH route';
});

// DELETE route
$app->delete('/', function () {
    echo 'This is a DELETE route';
});

/**
 * User Registration
 * url - /register
 * method - POST
 * params - name, email, password
 */
$app->post('/register', function () use ($app) {
    // check for required params
    verifyRequiredParams(array('email', 'password'));

    $response = array();

    // reading post params
    $email = $app->request->post('email');
    $password = $app->request->post('password');

    // validating email address
    validateEmail($email);

    $db = new DbHandler();
    $res = $db->createUser($email, $password);

    if ($res == USER_CREATED_SUCCESSFULLY) {
        $response["error"] = false;
        $response["message"] = "You are successfully registered";
        echoRespnse(201, $response);
    } else if ($res == USER_CREATE_FAILED) {
        $response["error"] = true;
        $response["message"] = "Oops! An error occurred while registereing";
        echoRespnse(200, $response);
    } else if ($res == USER_ALREADY_EXISTED) {
        $response["error"] = true;
        $response["message"] = "Sorry, this email already existed";
        echoRespnse(200, $response);
    }
});

/**
 * User Login
 * url - /login
 * method - POST
 * params - email, password
 */
$app->post('/login', function () use ($app) {
    // check for required params
    verifyRequiredParams(array('email', 'password'));

    // reading post params
    $email = $app->request()->post('email');
    $password = $app->request()->post('password');
    $response = array();

    $db = new DbHandler();
    // check for correct email and password
    if ($db->checkLogin($email, $password)) {
        // get the user by email
        $user = $db->getUserByEmail($email);

        if ($user != NULL) {
            $response["error"] = false;
            $response['email'] = $user['email'];
            $response['apiKey'] = $user['api_key'];
            $response['createdAt'] = $user['created_at'];
        } else {
            // unknown error occurred
            $response['error'] = true;
            $response['message'] = "An error occurred. Please try again";
        }
    } else {
        // user credentials are wrong
        $response['error'] = true;
        $response['message'] = 'Login failed. Incorrect credentials';
    }

    echoRespnse(200, $response);
});

/**
 * Creating new user profile in db
 * method POST
 * params - name
 * url - /tasks/
 */
$app->post('/tasks', 'authenticate', function () use ($app) {
    // check for required params
    verifyRequiredParams(array('task'));

    $response = array();
    $task = $app->request->post('task');

    global $user_id;
    $db = new DbHandler();

    // creating new task
    $task_id = $db->createTask($user_id, $task);

    if ($task_id != NULL) {
        $response["error"] = false;
        $response["message"] = "Task created successfully";
        $response["task_id"] = $task_id;
    } else {
        $response["error"] = true;
        $response["message"] = "Failed to create task. Please try again";
    }
    echoRespnse(201, $response);
});


/**
 * Fetch lift
 * url - /lifts
 * method - GET
 * params - none
 */
$app->get('/lifts', function () use ($app) {
    // echo 'Fetch lift if name is not null. Else fetch all lifts';
    $db = new DbHandler ();

    // fetching all user tasks
    $result = $db->getLifts();

    $response ["error"] = false;
    $response ["lifts"] = array();

    // looping through result and preparing tasks array
    while ($lift = $result->fetch_assoc()) {
        $tmp = array();
        $tmp ["id"] = $lift ["id"];
        $tmp ["name"] = $lift ["name"];
        $tmp ["nickname"] = $lift ["nickname"];
        $tmp ["description"] = $lift ["description"];
        $tmp ["videourl"] = $lift ["videourl"];
        $tmp ["parentname"] = $lift ["parentname"];
        array_push($response ["lifts"], $tmp);
    }
    echoRespnse(200, $response);
});

/**
 * Create new workout
 * url - /workout
 * method - POST
 * params - (uniqueid), id, users.fname, users.lname, description, delay
 */
$app->post('/workouts', function () use ($app) {
    echo 'Create new workout';
});

/**
 * Fetch workout
 * url - /workouts
 * method - GET
 * params - (uniqueid)
 */
$app->get('/workouts', function () use ($app) {
    echo 'Fetch workout';
});

/**
 * Update workout
 * url - /workouts
 * method - PUT
 * params - (uniqueid), id, users.fname, users.lname, description, delay
 */
$app->put('/workouts', function () use ($app) {
    echo 'Update workout';
});

/**
 * Delete workout along with all its lifts
 * url - /workouts
 * method - DELETE
 * params - (uniqueid)
 */
$app->delete('/workouts', function () {
    echo 'Delete workouts along with all its lifts';
});

/**
 * Adds new lift within a workout
 * url - /workoutlifts
 * method - POST
 * params - (workouts.uniqueid, num), lifts.id, reps, ss
 */
$app->post('/workoutlifts', function () use ($app) {
    echo 'Adds new lift within a workout';
});

/**
 * Gets lifts from a workout
 * url - /workoutlifts
 * method - GET
 * params - (workouts.uniqueid, num)
 */
$app->get('/workoutlifts', function () use ($app) {
    echo 'Fetch lifts from a workout';
});

/**
 * Create new user lift
 * url - /userlifts
 * method - POST
 * params - (users.id), lifts.id, reps, weight, [success, ss]
 */
$app->post('/userlifts', function () use ($app) {
    echo 'Create new user lift';
});

/**
 * Gets user lifts in a date range
 * url - /userlifts
 * method - GET
 * params - (users.id), [date range]
 */
$app->get('/userlifts', function () use ($app) {
    echo 'Gets user lifts in a date range';
});

/**
 * Update user lift
 * url - /userlifts
 * method - PUT
 * params - (user.id), lifts.id, reps, weight, [success, ss]
 */
$app->put('/userlifts', function () use ($app) {
    echo 'Updates user lift';
});

/**
 * Delete user lift
 * url - /userlifts
 * method - DELETE
 * params - (id)
 */
$app->delete('/userlifts', function () {
    echo 'Removes user lift';
});

/**
 * Create new max for user
 * url - /maxes
 * method - POST
 * params - (users.id, lifts.id, weight, reps)
 */
$app->post('/maxes', function () use ($app) {
    echo 'Creates new max for a user';
});

/**
 * Get all maxes for user
 * url - /maxes
 * method - GET
 * params - (users.id)
 */
$app->get('/maxes', function () use ($app) {
    echo 'Get all maxes for user';
});

/**
 * Update max for user
 * url - /maxes
 * method - PUT
 * params - (users.id, lifts.id, weight, reps)
 */
$app->put('/maxes', function () use ($app) {
    echo 'Updates max for user';
});

/**
 * Verifying required params posted or not
 */
function verifyRequiredParams($required_fields) {
    $error = false;
    $error_fields = "";
    $request_params = array();
    $request_params = $_REQUEST;
    // Handling PUT request params
    if ($_SERVER ['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $request_params);
    }
    foreach ($required_fields as $field) {
        if (!isset ($request_params [$field]) || strlen(trim($request_params [$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        // Required field(s) are missing or empty
        // echo error json and stop the app
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response ["error"] = true;
        $response ["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echoRespnse(400, $response);
        $app->stop();
    }
}

/**
 * Validating email address
 */
function validateEmail($email) {
    $app = \Slim\Slim::getInstance();
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["error"] = true;
        $response["message"] = 'Email address is not valid';
        echoRespnse(400, $response);
        $app->stop();
    }
}

/**
 * Adding Middle Layer to authenticate every request
 * Checking if the request has valid api key in the 'Authorization' header
 */
function authenticate(\Slim\Route $route) {
    // Getting request headers
    $headers = apache_request_headers();
    $response = array();
    $app = \Slim\Slim::getInstance();

    // Verifying Authorization Header
    if (isset($headers['Authorization'])) {
        $db = new DbHandler();

        // get the api key
        $api_key = $headers['Authorization'];
        // validating api key
        if (!$db->isValidApiKey($api_key)) {
            // api key is not present in users table
            $response["error"] = true;
            $response["message"] = "Access Denied. Invalid Api key";
            echoRespnse(401, $response);
            $app->stop();
        } else {
            global $user_id;
            // get user primary key id
            $user = $db->getUserId($api_key);
            if ($user != NULL)
                $user_id = $user["id"];
        }
    } else {
        // api key is missing in header
        $response["error"] = true;
        $response["message"] = "Api key is misssing";
        echoRespnse(400, $response);
        $app->stop();
    }
}

/**
 * Echoing json response to client
 *
 * @param String $status_code
 *            Http response code
 * @param Int $response
 *            Json response
 */
function echoRespnse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);

    // setting response content type to json
    $app->contentType('application/json');

    echo json_encode($response);
}

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
