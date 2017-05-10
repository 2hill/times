Symfony routing example
=======================

This project implements the following specs:
* `GET /time` returns "Il est 16h18"
* `GET /times/3/2` (3 and 2 are variables) returns "6"
* `GET /times/10` (10 is variable) returns "60" (last result 6 has been memorised from last request)
* `GET /times?x=3&y=7` returns "21"
* `GET /times/3/hello` returns "hello hello hello"
* `GET /times/3/2/1/4` (now even the number of route operands/arguments is variable) returns "24"

After cloning the repo, run:
$ composer install
To install dependencies
