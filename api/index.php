<?php
require_once 'include/DbHandler.php';
require_once 'include/PassHash.php';
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// Instantiate global user id from the db
$user_id = NULL;


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
            $response['api_key'] = $user['api_key'];
            $response['created_at'] = $user['created_at'];
            $response['profile_created'] = $user['profile_created'];
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
 * Api key check
 * url - /check
 * method - POST
 * params - n/a
 */
$app->post('/check', function () use ($app) {
    $headers = $app->request->headers;
    $response = array();
    // Verifying Authorization Header
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
        $response["error"] = false;
        $response["message"] = "Access Granted. Valid Api key";
        echoRespnse(200, $response);
    }
});


/**
 * Create user profile in db
 * method POST
 * params - name, unit, city, state, country
 * url - /profile
 */
$app->post('/profile', 'authenticate', function () use ($app) {
    verifyRequiredParams(array('name', 'unit', 'city', 'state', 'country'));

    $response = array();
    $name = $app->request->post('name');
    $unit = $app->request->post('unit');
    $city = $app->request->post('city');
    $state = $app->request->post('state');
    $country = $app->request->post('country');

    global $user_id;
    $db = new DbHandler();

    // creating new task
    $res = $db->createProfile($user_id, $name, $unit, $city, $state, $country);

    if ($res == USERPROFILE_CREATED_SUCCESSFULLY) {
        $response["error"] = false;
        $response["message"] = "Profile successfully created.";
        echoRespnse(201, $response);
    } else if ($res == USERPROFILE_CREATE_FAILED) {
        $response["error"] = true;
        $response["message"] = "Oops! An error occurred while creating profile.";
        echoRespnse(200, $response);
    } else if ($res == USERPROFILE_ALREADY_EXISTED) {
        $response["error"] = true;
        $response["message"] = "Sorry, this profile already existed.";
        echoRespnse(200, $response);
    }
});

//-----------------------usermultiworkout

/**
 * Create usermultiworkout
 * method - POST
 * params - TODO
 * url - /usermultiworkout
 */

/**
 * Get usermultiworkout
 * output - array of multiworkout
 * method - GET
 * params - TODO sort-by: [date, popularity, featured, uploader popularity], range: [date, number of results]
 * url - /usermultiworkout
 */

/**
 * Edit usermultiworkout
 * method - PUT
 * params - TODO
 * url - /usermultiworkout
 */

/**
 * Delete usermultiworkout
 * method - DELETE
 * params - TODO
 * url - /usermultiworkout
 */

//---------------------------usersingleworkout

/**
 * Add usersingleworkout to usermultiworkout
 * method - POST
 * params - TODO
 * url - /usersingleworkout
 */

/**
 * Get usersingleworkout within usermultiworkout
 * output - singleworkout characteristic >> array of liftgroup >> array of lifts
 * method - GET
 * params - TODO
 * url - /usersingleworkout
 */

/**
 * Edit usersingleworkout within usermultiworkout
 * method - PUT
 * params - TODO
 * url - /usersingleworkout
 */

/**
 * Delete usersingleworkout from usermultiworkout
 * method - DELETE
 * params - TODO
 * url - /usersingleworkout
 */

//--------------------------userliftgroup

/**
 * Add userliftgroup to user singleworkout
 * method - POST
 * params - TODO
 * url - /userliftgroup
 */

/**
 * Edit userliftgroup in user singleworkout
 * method - PUT
 * params - TODO
 * url - /userliftgroup
 */

/**
 * Delete userliftgroup from user singleworkout
 * method - DELETE
 * params - TODO
 * url - /userliftgroup
 */

//---------------------------userlift - TODO maybe not necessary

/**
 * Add userlift to userliftgroup within user singleworkout
 * method - POST
 * params - TODO
 * url - /userlift
 */

/**
 * Edit userlift within userliftgroup within user singleworkout
 * method - PUT
 * params - TODO
 * url - /userlift
 */

/**
 * Delete userlift from userliftgroup within user singleworkout
 * method - DELETE
 * params - TODO
 * url - /userlift
 */

//--------------------------------usermaxes

/**
 * Add usermaxes
 * method - POST
 * params - TODO userid
 * url - /usermaxes
 */

/**
 * Edit usermaxes
 * method - PUT
 * params - TODO userid
 * url - /usermaxes
 */

/**
 * Get usermaxes
 * output - array of lifts containing maxes for different number of reps
 * method - GET
 * params - TODO userid
 * url - /usermaxes
 */

//--------------------------------lifts

/**
 * Get all lifts (including array of muscles)
 * method - GET
 * params - [none]
 * url - /lifts
 */

//--------------------------------muscles

/**
 * Get all muscles
 * method - GET
 * params - [none]
 * url - /muscles
 */




/**
 * Adding Middle Layer to authenticate every request
 * Checking if the request has valid api key in the 'Authorization' header
 */
function authenticate() {
    $app = \Slim\Slim::getInstance();
    // Getting request headers
    $headers = $app->request->headers;
    $response = array();
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
            $user_id = $db->getUserId($api_key)['id'];
        }
    } else {
        // api key is missing in header
        $response["error"] = true;
        $response["message"] = "Api key is misssing";
        echoRespnse(400, $response);
        $app->stop();
    }
}

;

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

$app->run();
