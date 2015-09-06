# Liftmo

Backend for JSON Web API used by Liftmo Android app.

## API Url Structure

| URL | Method | Parameters | Description |
| --- | ------ | ---------- | ----------- |
| /register | POST | (email), fname, lname, password | New user registration |
| /register | PUT | (email), [fname, lname, password, unit] | Update user info |
| /login | POST | (email, password) | User login |
| /lifts | POST | (name), description, [altname] | Create new lift |
| /lifts | GET | [id] | Fetch lift |
| /lifts | PUT | (id), name, description, [altname] | Update lift |
| /lifts | DELETE | (id) | Delete lift (should not be used) |
| /workouts | POST | (uniqueid), id, users.fname, users.lname, description, delay | Create new workout |
| /workouts | GET | (uniqueid) | Fetch workout |
| /workouts | PUT | (uniqueid), id, users.fname, users.lname, description, delay | Update workout |
| /workouts | DELETE | (uniqueid) | Delete a workout along with all its lifts |
| /workoutlifts | POST | (workouts.uniqueid, num), lifts.id, reps, ss | Add new lift within a workout |
| /workoutlifts | GET | (workouts.uniqueid, num) | Get lift from a workout |
| /workoutlifts | GET | (workouts.uniqueid) | Get lifts from a workout |
| /userlifts | POST | (users.id), lifts.id, reps, weight, [success, ss] | Create new user lift |
| /userlifts | GET | (users.id), [date range] | Get user lifts in a date range |
| /userlifts | PUT | (user.id), lifts.id, reps, weight, [success, ss] | Update user lift |
| /userlifts | DELETE | (id) | Remove user lift |
| /maxes | POST | (users.id, lifts.id, weight, reps) | Creates new max for a user |
| /maxes | GET | (users.id) | Get all maxes for a user |
| /maxes | PUT | (users.id, lifts.id, weight, reps) | Updates max for a user |

## About

Written by (Jiawei Zhang)[https://github.com/jiaweizhang]

## Libraries

App built with the help of these libs:

* [Slim, a micro framework for PHP](http://www.slimframework.com/)
* [AngularJS, HTML enhanced for web apps](https://angularjs.org/)

## Services

App built with the help of these services:

* [Google Cloud SQL](https://cloud.google.com/sql/)
* [Google App Engine](https://cloud.google.com/appengine/)

## Acknowledgements

* Alan Guo for helping with Android application
* Jeremy Lai for weightlifting knowledge