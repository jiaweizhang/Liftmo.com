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

<h2>Database Schema</h2>
	<h3>users</h3>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>name</th>
				<th>type</th>
				<th>size</th>
				<th>description</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>id</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>fname</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>lname</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>email</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>passhash</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>apikey</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>status</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>createdat</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>unit</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>city</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>state</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>country</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<h3>lifts</h3>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>name</th>
				<th>type</th>
				<th>size</th>
				<th>description</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>id</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>name</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>nickname</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>description</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>videourl</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>parentid</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<h3>userlifts</h3>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>name</th>
				<th>type</th>
				<th>size</th>
				<th>description</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>id</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>liftid</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>timestamp</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>success</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>reps</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<h3>workouts</h3>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>name</th>
				<th>type</th>
				<th>size</th>
				<th>description</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>id</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>name</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>fname</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>lname</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>createdate</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<h3>workoutlifts</h3>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>name</th>
				<th>type</th>
				<th>size</th>
				<th>description</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>workoutid</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>liftid</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>liftnum</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>reps</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>amt</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<h3>maxes</h3>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>name</th>
				<th>type</th>
				<th>size</th>
				<th>description</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>id</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>userid</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>liftid</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>amt</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>timestamp</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>reps</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<h3>muscles</h3>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>name</th>
				<th>type</th>
				<th>size</th>
				<th>description</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>id</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>name</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>imageurl</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>nickname</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<h3>liftmuscles</h3>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>name</th>
				<th>type</th>
				<th>size</th>
				<th>description</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>muscleid</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>liftid</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>

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