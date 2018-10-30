How to use this Symfony REST API

This system already included
- REST Structure
- Logging
- Use of services, controllers, and models
- Use of Symfony4 as a framework
- Best practices
- Reusable code
- Decoupled code
- Ability to transform requirements into code

Authentication was implemented.
Only authenticated users can create, update, or delete a product. No authentication is required to retrieve or list.

Please follow these files to set up your same environment on Centos 7 so that the software will be running
https://github.com/lequanha/Symfony4/blob/master/HowToSetup.pdf
https://github.com/lequanha/Symfony4/blob/master/HowToSetup.docx
https://github.com/lequanha/Symfony4/blob/master/HowToSetup.txt

then you will have the same environment as mine

A) GITHUB re-development
After that, please develop the api again as
[root@ip-172-31-95-82 gitdeploy]# git clone https://github.com/lequanha/Symfony4.git
Cloning into 'Symfony4'...

[root@ip-172-31-95-82 gitdeploy]# cd Symfony4/

[root@ip-172-31-95-82 Symfony4]# ls -lai
total 1872
13700010 drwxr-xr-x. 11 root root   4096 Oct 30 21:25 .
 9828366 drwxr-xr-x.  3 root root     22 Oct 30 21:25 ..
 5790159 drwxr-xr-x.  2 root root     21 Oct 30 21:25 bin
13700030 -rw-r--r--.  1 root root   1655 Oct 30 21:25 composer.json
13700031 -rw-r--r--.  1 root root 183291 Oct 30 21:25 composer.lock
 9880159 drwxr-xr-x.  4 root root     95 Oct 30 21:25 config
13705593 -rw-r--r--.  1 root root    764 Oct 30 21:25 electronic-catalog.json
13700020 -rw-r--r--.  1 root root   1023 Oct 30 21:25 .env
13700021 -rw-r--r--.  1 root root   1029 Oct 30 21:25 .env.dist
 1059686 drwxr-xr-x.  8 root root    163 Oct 30 21:25 .git
13700022 -rw-r--r--.  1 root root    195 Oct 30 21:25 .gitignore
13700023 -rw-r--r--.  1 root root 209145 Oct 30 21:25 HowToDeploySymfony4.docx
13700024 -rw-r--r--.  1 root root 615073 Oct 30 21:25 HowToDeploySymfony4.pdf
13700025 -rw-r--r--.  1 root root  34620 Oct 30 21:25 HowToDeploySymfony4.txt
13700026 -rw-r--r--.  1 root root 182907 Oct 30 21:25 HowToSetup.docx
13700027 -rw-r--r--.  1 root root 623274 Oct 30 21:25 HowToSetup.pdf
13700028 -rw-r--r--.  1 root root   6332 Oct 30 21:25 HowToSetup.txt
13700029 -rw-r--r--.  1 root root   1495 Oct 30 21:25 ProblemDescription.txt
 5790164 drwxr-xr-x.  3 root root     38 Oct 30 21:25 public
 5818499 drwxr-xr-x.  7 root root    104 Oct 30 21:25 src
13705610 -rw-r--r--.  1 root root   8309 Oct 30 21:25 symfony.lock
13705611 drwxr-xr-x.  4 root root     59 Oct 30 21:25 templates
 8714635 drwxr-xr-x.  2 root root     24 Oct 30 21:25 translations
13705613 drwxr-xr-x.  4 root root     30 Oct 30 21:25 var
13695617 drwxr-xr-x. 19 root root   4096 Oct 30 21:25 vendor

Please make sure your MariaDB user and password are
user=root
password=admin2018

then
[root@ip-172-31-95-82 Symfony4]# ./bin/console doctrine:database:create
Created database `eStore` for connection named default

[root@ip-172-31-95-82 Symfony4]# ./bin/console doctrine:schema:update

[root@ip-172-31-95-82 Symfony4]# ./bin/console doctrine:schema:create

then please add in user-authentication and default values to start this API
[root@ip-172-31-95-82 Symfony4]# mysql --user=root --password=admin2018 eStore;
Reading table information for completion of table and column names
You can turn off this feature to get a quicker startup with -A

Welcome to the MariaDB monitor.  Commands end with ; or \g.
Your MariaDB connection id is 46
Server version: 5.5.60-MariaDB MariaDB Server

Copyright (c) 2000, 2018, Oracle, MariaDB Corporation Ab and others.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

MariaDB [eStore]> ALTER TABLE category MODIFY `created_at` timestamp NOT NULL DEFAULT current_timestamp();
Query OK, 0 rows affected (0.00 sec)
Records: 0  Duplicates: 0  Warnings: 0

MariaDB [eStore]> ALTER TABLE product MODIFY `created_at` timestamp NOT NULL DEFAULT current_timestamp();
Query OK, 0 rows affected (0.01 sec)
Records: 0  Duplicates: 0  Warnings: 0

MariaDB [eStore]> ALTER TABLE user MODIFY `created_at` timestamp NOT NULL DEFAULT current_timestamp();
Query OK, 0 rows affected (0.01 sec)
Records: 0  Duplicates: 0  Warnings: 0

MariaDB [eStore]> insert into user(name, email) values ("Bobby Fischer", "bobby@foo.com"), ("Betty Rubble", "betty@foo.com");
Query OK, 2 rows affected (0.00 sec)
Records: 2  Duplicates: 0  Warnings: 0

MariaDB [eStore]> commit;
Query OK, 0 rows affected (0.00 sec)

MariaDB [eStore]> exit;
Bye
[root@ip-172-31-95-82 Symfony4]#


Now you can start the API 
[root@ip-172-31-95-82 Symfony4]# ./bin/console server:start
 [OK] Server listening on http://127.0.0.1:8000
 
 
B) INSERTION of CATEGORY and PRODUCT
The insertion of category is not required of user authentication (while the production insertions are required to satisfy user auuthentication

B1) Insertion of categories
route:  /category/new
method:  POST

[root@ip-172-31-95-82 Symfony4]# curl -H 'content-type: application/json' -v -X POST -d '{"name": "Games"}' http://127.0.0.1:8000/category/new
* About to connect() to 127.0.0.1 port 8000 (#0)
*   Trying 127.0.0.1...
* Connected to 127.0.0.1 (127.0.0.1) port 8000 (#0)
> POST /category/new HTTP/1.1
> User-Agent: curl/7.29.0
> Host: 127.0.0.1:8000
> Accept: */*
> content-type: application/json
> Content-Length: 17
>
* upload completely sent off: 17 out of 17 bytes
< HTTP/1.1 201 Created
< Host: 127.0.0.1:8000
< Date: Tue, 30 Oct 2018 21:40:44 +0000
< Connection: close
< X-Powered-By: PHP/7.2.11
< Cache-Control: no-cache, private
< Date: Tue, 30 Oct 2018 21:40:44 GMT
< Content-Type: application/json
< Link: <http://127.0.0.1:8000/api/docs.jsonld>; rel="http://www.w3.org/ns/hydra/core#apiDocumentation"
<

* Closing connection 0
{"id":1,"name":"Games","created_at":"","modified_at":""}[root@ip-172-31-95-82 Symfony4]#
[root@ip-172-31-95-82 Symfony4]#
[root@ip-172-31-95-82 Symfony4]# curl -H 'content-type: application/json' -v -X POST -d '{"name": "Computers"}' http://127.0.0.1:8000/category/new
* About to connect() to 127.0.0.1 port 8000 (#0)
*   Trying 127.0.0.1...
* Connected to 127.0.0.1 (127.0.0.1) port 8000 (#0)
> POST /category/new HTTP/1.1
> User-Agent: curl/7.29.0
> Host: 127.0.0.1:8000
> Accept: */*
> content-type: application/json
> Content-Length: 21
>
* upload completely sent off: 21 out of 21 bytes
< HTTP/1.1 201 Created
< Host: 127.0.0.1:8000
< Date: Tue, 30 Oct 2018 21:40:55 +0000
< Connection: close
< X-Powered-By: PHP/7.2.11
< Cache-Control: no-cache, private
< Date: Tue, 30 Oct 2018 21:40:55 GMT
< Content-Type: application/json
< Link: <http://127.0.0.1:8000/api/docs.jsonld>; rel="http://www.w3.org/ns/hydra/core#apiDocumentation"
<

* Closing connection 0
{"id":2,"name":"Computers","created_at":"","modified_at":""}[root@ip-172-31-95-82 Symfony4]#
[root@ip-172-31-95-82 Symfony4]#
[root@ip-172-31-95-82 Symfony4]# curl -H 'content-type: application/json' -v -X POST -d '{"name": "TVs and Accessories"}' http://127.0.0.1:8000/category/new
* About to connect() to 127.0.0.1 port 8000 (#0)
*   Trying 127.0.0.1...
* Connected to 127.0.0.1 (127.0.0.1) port 8000 (#0)
> POST /category/new HTTP/1.1
> User-Agent: curl/7.29.0
> Host: 127.0.0.1:8000
> Accept: */*
> content-type: application/json
> Content-Length: 31
>
* upload completely sent off: 31 out of 31 bytes
< HTTP/1.1 201 Created
< Host: 127.0.0.1:8000
< Date: Tue, 30 Oct 2018 21:41:03 +0000
< Connection: close
< X-Powered-By: PHP/7.2.11
< Cache-Control: no-cache, private
< Date: Tue, 30 Oct 2018 21:41:03 GMT
< Content-Type: application/json
< Link: <http://127.0.0.1:8000/api/docs.jsonld>; rel="http://www.w3.org/ns/hydra/core#apiDocumentation"
<

* Closing connection 0
{"id":3,"name":"TVs and Accessories","created_at":"","modified_at":""}[root@ip-172-31-95-82 Symfony4]#
[root@ip-172-31-95-82 Symfony4]#


B2) Insertion of products
route: /product/new
method:  POST

Please always send users and passwords, there are 2 users inside the database 
"username": "Bobby Fischer", "password": "bobby@foo.com"  or  "username": "Betty Rubble", "password": "betty@foo.com" (in this exercise, may I use emails for passwords)

[root@ip-172-31-95-82 Symfony4]# curl -H 'content-type: application/json' -v -X POST -d '{"name": "Pong", "category": "Games", "sku": "A0001", "price": 69.99, "quantity": 20, "username":"Bobby Fischer", "password":"bobby@foo.com"}'  http://127.0.0.1:8000/product/new
* About to connect() to 127.0.0.1 port 8000 (#0)
*   Trying 127.0.0.1...
* Connected to 127.0.0.1 (127.0.0.1) port 8000 (#0)
> POST /product/new HTTP/1.1
> User-Agent: curl/7.29.0
> Host: 127.0.0.1:8000
> Accept: */*
> content-type: application/json
> Content-Length: 141
>
* upload completely sent off: 141 out of 141 bytes
< HTTP/1.1 201 Created
< Host: 127.0.0.1:8000
< Date: Tue, 30 Oct 2018 21:42:27 +0000
< Connection: close
< X-Powered-By: PHP/7.2.11
< Cache-Control: no-cache, private
< Date: Tue, 30 Oct 2018 21:42:27 GMT
< Content-Type: application/json
< Link: <http://127.0.0.1:8000/api/docs.jsonld>; rel="http://www.w3.org/ns/hydra/core#apiDocumentation"
<
* Closing connection 0
{"id":1,"name":"Pong","category":"Games","sku":"A0001","price":69.99,"quantity":20,"created_at":"","modified_at":""}[root@ip-172-31-95-82 Symfony4]#
[root@ip-172-31-95-82 Symfony4]#
[root@ip-172-31-95-82 Symfony4]# curl -H 'content-type: application/json' -v -X POST -d '{"name": "GameStation 5", "category": "Games", "sku": "A0002", "price": 269.99, "quantity": 15, "username":"Bobby Fischer", "password":"bobby@foo.com"}' http://127.0.0.1:8000/product/new
* About to connect() to 127.0.0.1 port 8000 (#0)
*   Trying 127.0.0.1...
* Connected to 127.0.0.1 (127.0.0.1) port 8000 (#0)
> POST /product/new HTTP/1.1
> User-Agent: curl/7.29.0
> Host: 127.0.0.1:8000
> Accept: */*
> content-type: application/json
> Content-Length: 151
>
* upload completely sent off: 151 out of 151 bytes
< HTTP/1.1 201 Created
< Host: 127.0.0.1:8000
< Date: Tue, 30 Oct 2018 21:42:37 +0000
< Connection: close
< X-Powered-By: PHP/7.2.11
< Cache-Control: no-cache, private
< Date: Tue, 30 Oct 2018 21:42:37 GMT
< Content-Type: application/json
< Link: <http://127.0.0.1:8000/api/docs.jsonld>; rel="http://www.w3.org/ns/hydra/core#apiDocumentation"
<
* Closing connection 0
{"id":2,"name":"GameStation 5","category":"Games","sku":"A0002","price":269.99,"quantity":15,"created_at":"","modified_at":""}[root@ip-172-31-95-82 Symfony4]#
[root@ip-172-31-95-82 Symfony4]#
[root@ip-172-31-95-82 Symfony4]# curl -H 'content-type: application/json' -v -X POST -d '{"name": "AP Oman PC - Aluminum", "category": "Computers", "sku": "A0003", "price": 1399.99, "quantity": 10, "username":"Bobby Fischer", "password":"bobby@foo.com"}' http://127.0.0.1:8000/product/new
* About to connect() to 127.0.0.1 port 8000 (#0)
*   Trying 127.0.0.1...
* Connected to 127.0.0.1 (127.0.0.1) port 8000 (#0)
> POST /product/new HTTP/1.1
> User-Agent: curl/7.29.0
> Host: 127.0.0.1:8000
> Accept: */*
> content-type: application/json
> Content-Length: 164
>
* upload completely sent off: 164 out of 164 bytes
< HTTP/1.1 201 Created
< Host: 127.0.0.1:8000
< Date: Tue, 30 Oct 2018 21:42:50 +0000
< Connection: close
< X-Powered-By: PHP/7.2.11
< Cache-Control: no-cache, private
< Date: Tue, 30 Oct 2018 21:42:50 GMT
< Content-Type: application/json
< Link: <http://127.0.0.1:8000/api/docs.jsonld>; rel="http://www.w3.org/ns/hydra/core#apiDocumentation"
<
* Closing connection 0
{"id":3,"name":"AP Oman PC - Aluminum","category":"Computers","sku":"A0003","price":1399.99,"quantity":10,"created_at":"","modified_at":""}[root@ip-172-31-95-82 Symfony4]#
[root@ip-172-31-95-82 Symfony4]#
[root@ip-172-31-95-82 Symfony4]# curl -H 'content-type: application/json' -v -X POST -d '{"name": "Fony UHD HDR 55\" 4k TV", "category": "TVs and Accessories", "sku": "A0004", "price": 1399.99, "quantity": 5, "username":"Bobby Fischer", "password":"bobby@foo.com"}' http://127.0.0.1:8000/product/new
* About to connect() to 127.0.0.1 port 8000 (#0)
*   Trying 127.0.0.1...
* Connected to 127.0.0.1 (127.0.0.1) port 8000 (#0)
> POST /product/new HTTP/1.1
> User-Agent: curl/7.29.0
> Host: 127.0.0.1:8000
> Accept: */*
> content-type: application/json
> Content-Length: 175
>
* upload completely sent off: 175 out of 175 bytes
< HTTP/1.1 201 Created
< Host: 127.0.0.1:8000
< Date: Tue, 30 Oct 2018 21:42:58 +0000
< Connection: close
< X-Powered-By: PHP/7.2.11
< Cache-Control: no-cache, private
< Date: Tue, 30 Oct 2018 21:42:58 GMT
< Content-Type: application/json
< Link: <http://127.0.0.1:8000/api/docs.jsonld>; rel="http://www.w3.org/ns/hydra/core#apiDocumentation"
<
* Closing connection 0
{"id":4,"name":"Fony UHD HDR 55\u0022 4k TV","category":"TVs and Accessories","sku":"A0004","price":1399.99,"quantity":5,"created_at":"","modified_at":""}[root@ip-172-31-95-82 Symfony4]#
[root@ip-172-31-95-82 Symfony4]#

If we do not send username, or if we donot setup a correct password, the unauthorized response will be returned and no data will be inserted
[root@ip-172-31-95-82 Symfony4]# curl -H 'content-type: application/json' -v -X POST -d '{"name": "Pong", "category": "Games", "sku": "A0001", "price": 69.99, "quantity": 20, "username":"Bobby Fischer", "password":"wrong passwprd test"}'  http://127.0.0.1:8000/product/new
* About to connect() to 127.0.0.1 port 8000 (#0)
*   Trying 127.0.0.1...
* Connected to 127.0.0.1 (127.0.0.1) port 8000 (#0)
> POST /product/new HTTP/1.1
> User-Agent: curl/7.29.0
> Host: 127.0.0.1:8000
> Accept: */*
> content-type: application/json
> Content-Length: 147
>
* upload completely sent off: 147 out of 147 bytes
< HTTP/1.1 401 Unauthorized
< Host: 127.0.0.1:8000
< Date: Tue, 30 Oct 2018 21:46:07 +0000
< Connection: close
< X-Powered-By: PHP/7.2.11
< Cache-Control: no-cache, private
< Date: Tue, 30 Oct 2018 21:46:07 GMT
< Content-Type: application/json
< Link: <http://127.0.0.1:8000/api/docs.jsonld>; rel="http://www.w3.org/ns/hydra/core#apiDocumentation"
<
* Closing connection 0
{"errors":"Not authorized!"}


C) List all products
route: /product/all
method: GET
no authentication required

[root@ip-172-31-95-82 Symfony4]# curl -X GET --header 'Accept: application/ld+json' http://127.0.0.1:8000/product/all
[{"id":1,"name":"Pong","category":"Games","sku":"A0001","price":69.99,"quantity":20,"created_at":"2018-10-30 21:42:27","modified_at":""},{"id":2,"name":"GameStation 5","category":"Games","sku":"A0002","price":269.99,"quantity":15,"created_at":"2018-10-30 21:42:37","modified_at":""},{"id":3,"name":"AP Oman PC - Aluminum","category":"Computers","sku":"A0003","price":1399.99,"quantity":10,"created_at":"2018-10-30 21:42:50","modified_at":""},{"id":4,"name":"Fony UHD HDR 55\u0022 4k TV","category":"TVs and Accessories","sku":"A0004","price":1399.99,"quantity":5,"created_at":"2018-10-30 21:42:58","modified_at":""}]

D) List all categories
route: /category/all
method: GET
no authentication required

[root@ip-172-31-95-82 Symfony4]# curl -X GET --header 'Accept: application/ld+json' http://127.0.0.1:8000/category/all

[{"id":1,"name":"Games","created_at":"2018-10-30 21:40:44","modified_at":""},{"id":2,"name":"Computers","created_at":"2018-10-30 21:40:55","modified_at":""},{"id":3,"name":"TVs and Accessories","created_at":"2018-10-30 21:41:03","modified_at":""}]

E) Retrieve a single product
route: /product/entry/{id}
method: GET
no authentication required

[root@ip-172-31-95-82 Symfony4]# curl -X GET --header 'Accept: application/ld+json' http://127.0.0.1:8000/product/entry/2
{"id":2,"name":"GameStation 5","category":"Games","sku":"A0002","price":269.99,"quantity":15,"created_at":"2018-10-30 21:42:37","modified_at":""}

F) Update a product
route: /product/update/{id}
method: PUT
User authentication required (if we does not include a correct user and password then unauthorizated response will be returened and no data will be updated)

We update new quantity and new sku for id=2 above
[root@ip-172-31-95-82 Symfony4]# curl -H 'content-type: application/json' -v -X PUT -d '{"id":2, "sku": "A9999", "quantity": 40, "username":"Bobby Fischer", "password":"bobby@foo.com"}' http://127.0.0.1:8000/product/update
* About to connect() to 127.0.0.1 port 8000 (#0)
*   Trying 127.0.0.1...
* Connected to 127.0.0.1 (127.0.0.1) port 8000 (#0)
> PUT /product/update HTTP/1.1
> User-Agent: curl/7.29.0
> Host: 127.0.0.1:8000
> Accept: */*
> content-type: application/json
> Content-Length: 96
>
* upload completely sent off: 96 out of 96 bytes
< HTTP/1.1 200 OK
< Host: 127.0.0.1:8000
< Date: Tue, 30 Oct 2018 21:54:08 +0000
< Connection: close
< X-Powered-By: PHP/7.2.11
< Cache-Control: no-cache, private
< Date: Tue, 30 Oct 2018 21:54:08 GMT
< Content-Type: application/json
< Link: <http://127.0.0.1:8000/api/docs.jsonld>; rel="http://www.w3.org/ns/hydra/core#apiDocumentation"
<
* Closing connection 0
{}

[root@ip-172-31-95-82 Symfony4]# curl -X GET --header 'Accept: application/ld+json' http://127.0.0.1:8000/product/entry/2                                                                    {"id":2,"name":"GameStation 5","category":"Games","sku":"A9999","price":269.99,"quantity":40,"created_at":"2018-10-30 21:42:37","modified_at":"2018-10-30 21:54:08"}


G) Delete a product
route: /product/remove/{id}
method: DELETE
User authentication required (if we does not include a correct user and password then unauthorizated response will be returened and no data will be updated)

We now delete product id=2
[root@ip-172-31-95-82 Symfony4]# curl -H 'content-type: application/json' -v -X DELETE -d '{"username":"Bobby Fischer","password":"bobby@foo.com"}' http://127.0.0.1:8000/product/remove/2
* About to connect() to 127.0.0.1 port 8000 (#0)
*   Trying 127.0.0.1...
* Connected to 127.0.0.1 (127.0.0.1) port 8000 (#0)
> DELETE /product/remove/2 HTTP/1.1
> User-Agent: curl/7.29.0
> Host: 127.0.0.1:8000
> Accept: */*
> content-type: application/json
> Content-Length: 55
>
* upload completely sent off: 55 out of 55 bytes
< HTTP/1.1 200 OK
< Host: 127.0.0.1:8000
< Date: Tue, 30 Oct 2018 21:56:53 +0000
< Connection: close
< X-Powered-By: PHP/7.2.11
< Cache-Control: no-cache, private
< Date: Tue, 30 Oct 2018 21:56:53 GMT
< Content-Type: application/json
< Link: <http://127.0.0.1:8000/api/docs.jsonld>; rel="http://www.w3.org/ns/hydra/core#apiDocumentation"
<
* Closing connection 0
{"deleted":null}

Now when we retrieve the product with id=2, we will not find it anymore because it was deleted
[root@ip-172-31-95-82 Symfony4]# curl -X GET --header 'Accept: application/ld+json' http://127.0.0.1:8000/product/entry/2
{"errors":"Not found!"}

H) This API installed logger
The log file is var/log/dev.log

We can view the last 20 lines of the log file to see the actions that we just took above
[root@ip-172-31-95-82 Symfony4]# tail -20 var/log/dev.log
[2018-10-30 21:54:08] doctrine.DEBUG: SELECT t0.id AS id_1, t0.name AS name_2, t0.category AS category_3, t0.sku AS sku_4, t0.price AS price_5, t0.quantity AS quantity_6, t0.created_at AS created_at_7, t0.modified_at AS modified_at_8 FROM product t0 WHERE t0.id = ? [2] []
[2018-10-30 21:54:08] doctrine.DEBUG: "START TRANSACTION" [] []
[2018-10-30 21:54:08] doctrine.DEBUG: UPDATE product SET sku = ?, quantity = ?, modified_at = ? WHERE id = ? ["A9999",40,"2018-10-30 21:54:08",2] []
[2018-10-30 21:54:08] doctrine.DEBUG: "COMMIT" [] []
[2018-10-30 21:54:19] request.INFO: Matched route "app_product_getproduct". {"route":"app_product_getproduct","route_parameters":{"_route":"app_product_getproduct","_controller":"App\\Controller\\ProductController::getProductAction","id":"2"},"request_uri":"http://127.0.0.1:8000/product/entry/2","method":"GET"} []
[2018-10-30 21:54:19] security.INFO: Populated the TokenStorage with an anonymous Token. [] []
[2018-10-30 21:54:19] php.INFO: User Deprecated: The "Sensio\Bundle\FrameworkExtraBundle\Configuration\Method" annotation is deprecated since version 5.2. Use "Symfony\Component\Routing\Annotation\Route" instead. {"exception":"[object] (ErrorException(code: 0): User Deprecated: The \"Sensio\\Bundle\\FrameworkExtraBundle\\Configuration\\Method\" annotation is deprecated since version 5.2. Use \"Symfony\\Component\\Routing\\Annotation\\Route\" instead. at /tmp/gitdeploy/Symfony4/vendor/sensio/framework-extra-bundle/Configuration/Method.php:14)"} []
[2018-10-30 21:54:19] doctrine.DEBUG: SELECT t0.id AS id_1, t0.name AS name_2, t0.category AS category_3, t0.sku AS sku_4, t0.price AS price_5, t0.quantity AS quantity_6, t0.created_at AS created_at_7, t0.modified_at AS modified_at_8 FROM product t0 WHERE t0.id = ? [2] []
[2018-10-30 21:56:53] request.INFO: Matched route "app_product_deleteproduct". {"route":"app_product_deleteproduct","route_parameters":{"_route":"app_product_deleteproduct","_controller":"App\\Controller\\ProductController::deleteProductAction","id":"2"},"request_uri":"http://127.0.0.1:8000/product/remove/2","method":"DELETE"} []
[2018-10-30 21:56:53] security.INFO: Populated the TokenStorage with an anonymous Token. [] []
[2018-10-30 21:56:53] php.INFO: User Deprecated: The "Sensio\Bundle\FrameworkExtraBundle\Configuration\Method" annotation is deprecated since version 5.2. Use "Symfony\Component\Routing\Annotation\Route" instead. {"exception":"[object] (ErrorException(code: 0): User Deprecated: The \"Sensio\\Bundle\\FrameworkExtraBundle\\Configuration\\Method\" annotation is deprecated since version 5.2. Use \"Symfony\\Component\\Routing\\Annotation\\Route\" instead. at /tmp/gitdeploy/Symfony4/vendor/sensio/framework-extra-bundle/Configuration/Method.php:14)"} []
[2018-10-30 21:56:53] doctrine.DEBUG: SELECT u0_.id AS id_0, u0_.name AS name_1, u0_.email AS email_2, u0_.created_at AS created_at_3, u0_.modified_at AS modified_at_4 FROM user u0_ WHERE u0_.name = ? AND u0_.email = ? ["Bobby Fischer","bobby@foo.com"] []
[2018-10-30 21:56:53] doctrine.DEBUG: SELECT t0.id AS id_1, t0.name AS name_2, t0.category AS category_3, t0.sku AS sku_4, t0.price AS price_5, t0.quantity AS quantity_6, t0.created_at AS created_at_7, t0.modified_at AS modified_at_8 FROM product t0 WHERE t0.id = ? [2] []
[2018-10-30 21:56:53] doctrine.DEBUG: "START TRANSACTION" [] []
[2018-10-30 21:56:53] doctrine.DEBUG: DELETE FROM product WHERE id = ? [2] []
[2018-10-30 21:56:53] doctrine.DEBUG: "COMMIT" [] []
[2018-10-30 21:57:04] request.INFO: Matched route "app_product_getproduct". {"route":"app_product_getproduct","route_parameters":{"_route":"app_product_getproduct","_controller":"App\\Controller\\ProductController::getProductAction","id":"2"},"request_uri":"http://127.0.0.1:8000/product/entry/2","method":"GET"} []
[2018-10-30 21:57:04] security.INFO: Populated the TokenStorage with an anonymous Token. [] []
[2018-10-30 21:57:04] php.INFO: User Deprecated: The "Sensio\Bundle\FrameworkExtraBundle\Configuration\Method" annotation is deprecated since version 5.2. Use "Symfony\Component\Routing\Annotation\Route" instead. {"exception":"[object] (ErrorException(code: 0): User Deprecated: The \"Sensio\\Bundle\\FrameworkExtraBundle\\Configuration\\Method\" annotation is deprecated since version 5.2. Use \"Symfony\\Component\\Routing\\Annotation\\Route\" instead. at /tmp/gitdeploy/Symfony4/vendor/sensio/framework-extra-bundle/Configuration/Method.php:14)"} []
[2018-10-30 21:57:04] doctrine.DEBUG: SELECT t0.id AS id_1, t0.name AS name_2, t0.category AS category_3, t0.sku AS sku_4, t0.price AS price_5, t0.quantity AS quantity_6, t0.created_at AS created_at_7, t0.modified_at AS modified_at_8 FROM product t0 WHERE t0.id = ? [2] []


