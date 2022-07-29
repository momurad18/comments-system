# comments-system
 
## Features
-   Vue 2
-   Laravel 9
-   Vuex 3
-   Load comments from database with 2 options CTE OR NESTED

## Installation

- Downlaod or clone the repo.
- run 
```
composer install
```
Edit .env and set your database connection details and set the comment settings
```
COMMENT_SYSTEM=CTE  # choose how do you want query database by choose betwee CTE OR NESTED
MIX_COMMENT_MAX_DEPTH=3 # Reply Levels by default 3
MIX_COMMENT_PER_PAGE=5   # How many reply per page
```
- Run these command below to prepare the system
```
php artisan key:generate
```
```
php artisan migrate
```
```
npm install
```

## Usage

# start Laravel
```
php artisan serve
```

# start Vue.js
```
npm run dev
```
Access your application at http://127.0.0.1:8000.

## Common Table Expressions (CTE)

A CTE (Common Table Expression) is a temporary result set that you can reference within another SELECT, INSERT, UPDATE, or DELETE statement.  They were introduced in SQL Server version 2005.  They are SQL-compliant and part of the ANSI SQL 99 specification.

More details you can see

https://docs.microsoft.com/en-us/sql/t-sql/queries/with-common-table-expression-transact-sql?view=sql-server-ver16

