Course Lookup
Julian Silerio
June 1, 2017

This program allows a user to import a record of classes into a SQLite3 database, lookup a particular class via its call number, and also retrieve stats regarding the department with the most classes and the most used words in class titles. This program was implemented in PHP5.3 with no outside libraries. The user can perform the activities listed below.

import [file name]
The user can import a file into a database to later be consulted and analyzed for lookups and statistics. The recommendend and tested filetype for the record file is a .csv file. The program connects to a database, opens the file, reads each line in the file, and inserts each record into the database. Once the database is created, a user can lookup a particular class or see statistics for the classes available.

lookup [call number]
The user can look up a specific class if they have the call number for the class. Typically the call number is in the format "XXXX X####" or "XXXX XX####", and the program connects to the database, compares this search against the records already in the database, and returns relevant information regarding this class. If the class isn't found, the program tells the user that there is no such class in the database.

stats
The program has been set up to check two metrics: the five departments with the most courses and the ten most frequently used words in the names of the courses. Both are returned in a readable format for the user to see.
