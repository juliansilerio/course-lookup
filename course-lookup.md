# Software Development Bootcamp Course Tool

## Overview
The goal of this project is to create a command line tool to query and provide statistics about departments and courses at Columbia. The course data is available in a CSV (course-lookup-courses.csv).

## Requirements
The tool must provide the following functionality:

* import into database
* lookup of course by call number in the database
* calculate statistics based on courses in the database

### Import courses into a database
Create a console command to import the courses into a database (preferably SQLite) so that the database can be queried later.

The command should have the signature:

```
$ php courses.php import [courses.csv]
```

#### Example
```
$ php courses.php import courses.csv
Successfully imported courses.
```
You will use the database to implement features 2 and 3.

### Course lookup
Implement a search for a call number by searching the database.

* The call number has the format `{Subject Area Code} {Bulletin Prefix Code}{Course Number}`, for example: `COMS W1001`, `ANTH W4400`, or `HIST W4900`.
* If the **lookup returns a result**, output all of the fields for the particular course.
* If **no results are found**, the tool should return the text `The course {lookup query} was not found.`, where `{lookup query}` is the user supplied query.

The command should have the signature:

```
$ php courses.php lookup CALL_NUMBER
```

#### Examples
Lookup course that exists

```
$ php course.php lookup "URBS V3530"
+------------+---------+-----------------+---------------+----------------------+------------+------------+
| Department | Subject | Bulletin Prefix | Course Number | Name                 | Min Points | Max Points |
+------------+---------+-----------------+---------------+----------------------+------------+------------+
| COMS       | COMS    | W               | 3157          | Advanced Programming | 4          | 0          |
+------------+---------+-----------------+---------------+----------------------+------------+------------+
```

Lookup course that does not exist

```
$ php course.php lookup "URBS V9999"
The course URBS V9999 was not found
```

### Calculate statistics
Implement statistics for the following:

* A list of the top top five departments with the most courses in descending order. Include the number of courses in each department.
* A list of the top ten most frequently used words (case insensitive) in course titles. Include the number of times this word was used. Exclude the following words: `the, and, in, of, to`.

The command should have the signature:

```
$ php courses.php stats
```

#### Example
```
$ php course.php stats
Departments with the most courses:
+---------------------+-------------------+
| Academic Department | Number of courses |
+---------------------+-------------------+
| ZZZZ                | 999               |
| ENCL                | 501               |
| HIST                | 499               |
| URBS                | 302               |
| COMS                | 222               |
+---------------------+-------------------+
```

The 10 most frequently used words (case insensitive):

```
+--------------+-----------+
| Word         | Frequency |
+--------------+-----------+
| foo          | 999       |
| bar          | 800       |
| literature   | 490       |
| ii           | 450       |
| i            | 441       |
| introduction | 300       |
| foobar       | 299       |
| hello        | 150       |
| world        | 100       |
+--------------+-----------+
```

## Notes
* Include a README.txt to describe how you implemented your program.
* You may use any functions or libraries to perform this task.
* Tests are encouraged.
* Target this application for PHP 5.3+.
