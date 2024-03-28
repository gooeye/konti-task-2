# konti-task-2

This project provides a RESTful API built with the Laravel framework.

## Prerequisites

* PHP >= 8.2 (https://www.php.net/downloads.php) 
* Composer (https://getcomposer.org/download/)

## Setup Instructions

1. **Clone the repository:**

2. **Install dependencies**
```
composer install 
```

3. **Generate application key**
```
php artisan key:generate
```

4. **Run database migrations**
```
php artisan migrate
```

## Running the API
```
php artisan serve
```
The API will typically be accessible at `http://localhost:8000/api`.

## API Endpoints
- POST /posts: Create a new post.
- GET /posts: Fetch a list of all posts.
- GET /posts/{id}: Get a single post by ID.
- PUT /posts/{id}: Update a post.
- DELETE /posts/{id}: Delete a post.

### Common Response Structure
**POST /posts**
```json
{
  "message": "Post created successfully",
  "post": {
    "id": 1,
    "title": "Example Post Title",
    "content": "Sample post content.",
  }
}
```

**GET /posts**
```json
[
  {
    "id": 1,
    "title": "Example Post Title",
    "content": "Sample post content."
  },
  // ... Other post objects
]
```


## Testing
```
php artisan test
```
The tests can be found in `tests/Feature/PostTest.php`


