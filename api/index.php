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
$app = new \Slim\Slim();

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

// GET route
$app->get( '/', function () {
    echo 'This is a GET route';
});

// PUT route
$app->put( '/put', function () {
    echo 'This is a PUT route';
});

// PATCH route
$app->patch('/patch', function () {
    echo 'This is a PATCH route';
});

// DELETE route
$app->delete('/delete', function () {
    echo 'This is a DELETE route';
});

/**
 * User Registration
 * url - /register
 * method - POST
 * params - (email), fname, lname, password
 */
$app->post('/register', function() use ($app) {
    echo 'User registration';
});

/**
 * User Update
 * url - /register
 * method - PUT
 * params - (email), [fname, lname, password, unit] 
 */
$app->put('/register', function() use ($app) {
    echo 'Update user info';
});

/**
 * User Login
 * url - /login
 * method - POST
 * params - (email, password)
 */
$app->post('/login', function() use ($app) {
    echo 'User login';
});

/**
 * Create new lift
 * url - /lifts
 * method - POST
 * params - (name), description, [altname]
 */
$app->post('/lifts', function() use ($app) {
    echo 'Create new lift';
});

/**
 * Fetch lift
 * url - /lifts
 * method - GET
 * params - (name)
 */
$app->get( '/lifts', function () use ($app) {
    echo 'Fetch lift';
});

/**
 * Update lift
 * url - /lifts
 * method - PUT
 * params - (name), description, [altname]
 */
$app->put('/lifts', function() use ($app) {
    echo 'Update lift';
});

/**
 * Delete lift (minimal)
 * url - /lifts
 * method - DELETE
 * params - (name)
 */
$app->delete('/lifts', function () {
    echo 'Delete lift';
});

/**
 * Create new workout
 * url - /workout
 * method - POST
 * params - (uniqueid), id, users.fname, users.lname, description, delay
 */
$app->post('/workouts', function() use ($app) {
    echo 'Create new workout';
});

/**
 * Fetch workout
 * url - /workouts
 * method - GET
 * params - (uniqueid)
 */
$app->get( '/workouts', function () use ($app) {
    echo 'Fetch workout';
});

/**
 * Update workout
 * url - /workouts
 * method - PUT
 * params - (uniqueid), id, users.fname, users.lname, description, delay
 */
$app->put('/workouts', function() use ($app) {
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
 * params - (workouts.uniqueid, num), lifts.name, reps, ss
 */
$app->post('/workoutlifts', function() use ($app) {
    echo 'Adds new lift within a workout';
});

/**
 * Gets lift(s) from a workout
 * url - /workoutlifts
 * method - GET
 * params - (workouts.uniqueid, num)
 */
$app->get( '/workoutlifts', function () use ($app) {
    echo 'Fetch lift(s) from a workout. If num is null, fetch all';
});

/**
 * Create new user lift
 * url - /userlifts
 * method - POST
 * params - (users.id), lifts.name, reps, weight, [success, ss]
 */
$app->post('/userlifts', function() use ($app) {
    echo 'Create new user lift';
});

/**
 * Gets user lifts in a date range
 * url - /userlifts
 * method - GET
 * params - (users.id), [date range]
 */
$app->get( '/userlifts', function () use ($app) {
    echo 'Gets user lifts in a date range';
});

/**
 * Update user lift
 * url - /userlifts
 * method - PUT
 * params - (user.id), lifts.name, reps, weight, [success, ss]
 */
$app->put('/userlifts', function() use ($app) {
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
 * params - (users.id, lifts.name, weight, reps)
 */
$app->post('/maxes', function() use ($app) {
    echo 'Creates new max for a user';
});

/**
 * Get all maxes for user
 * url - /maxes
 * method - GET
 * params - (users.id)
 */
$app->get('/maxes', function() use ($app) {
    echo 'Get all maxes for user';
});

/**
 * Update max for user
 * url - /maxes
 * method - PUT
 * params - (users.id, lifts.name, weight, reps)
 */
$app->put('/maxes', function() use ($app) {
    echo 'Updates max for user';
});

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
