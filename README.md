
## Install
### Git
https://github.com/evandroabdao/exercise2.git

### Docker
At the folder project run this line code to build the containers services<br>
```
docker-compose build
```

Run this command to get containers UP<br>
```
docker-compose up -d
```

It is a good practice to run compose update inside the container to update the project dependences<br>
```
docker-compose exec app bash
composer update
```

### Postman
To test the API you can get the Postman collection at the folder<br>
storage/postman/Exercise2.postman_collection.json

Or simply access the links<br>
http://localhost:8989/api/v1/servers/list?ram=16GB,32GB<br>
http://localhost:8989/api/v1/servers/list?hdd=SAS<br>
http://localhost:8989/api/v1/servers/list?location=DallasDAL-10<br>
http://localhost:8989/api/v1/servers/list?storage=0,250GB<br>

It is possible to combine filters with & like the this example<br>
http://localhost:8989/api/v1/servers/list?ram=16GB,32GB&hdd=SAS

### Application
To use the application with the server list in datatable component, access the link http://localhost:8989/servers/
