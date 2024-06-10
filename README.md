## Laravel Test Task (2-3 hours max)

### Project init:
* Clone the project from the github repo:
`git clone https://github.com/andrewlynx/laravel-test-api.git`
* Install dependencies via composer `composer install`
* Copy the `.env.example` file and rename it to `.env` 
* Set the database connection environments in .env file
* Run migration `php artisan migrate`
* From the project folder run `php artisan serve`

### Project run
* Using Postman or other app that allows sending POST messages, send JSON to the URL:
* After running `php artisan serve` the project server is running locally, usually having address like `http://127.0.0.1:8000`
* Send JSON-formatted POST message 

```json
{
    "name": "John Doe",
    "email": "john.doe@example.com",
    "message": "This is a test message."
}
```
  to `http://127.0.0.1:8000/api/submit`
* Success:
```json
{
    "data": 
    [
        "Your request is being processed"
    ]
}
```
* Error:
```json
{
    "error_message": "The name field is required."
}
```
* Logs could be found in `/storage/logs/laravel.log`

### Requirements:
* API Endpoint: Develop a single API endpoint `/submit` that accepts a `POST` request with the following JSON payload structure:
```json
{
    "name": "John Doe",
    "email": "john.doe@example.com",
    "message": "This is a test message."
}
```
* Validate the data (ensure `name`, `email`, and `message` are present).
* Database Setup: Use Laravel migrations to create a table named `submissions` with columns for `id`, `name`, `email`, `message`, and timestamps (`created_at` and `updated_at`).
* Job Queue: Upon receiving the API request, the data should not be immediately saved to the database. Instead, dispatch a Laravel job to process the data. The job should perform the following tasks:
  * Save the data to the `submissions` table in the database.
* Events: After the data is successfully saved to the database, trigger a Laravel event named `SubmissionSaved`. Attach a listener to this event that logs a message indicating a successful save, including the `name` and `email` of the submission.
* Error Handling: Implement error handling for the API to respond with appropriate messages and status codes for the following scenarios:
  * Invalid data input (e.g., missing required fields).
  * Any errors that occur during the job processing.
* Documentation: 
  * Briefly document the following in a README file:
    * Instructions on setting up the project and running migrations.
    * A simple explanation of how to test the API endpoint.
* Write a simple Unit test.

