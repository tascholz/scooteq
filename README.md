# scooteq

## setup
make sure, docker and docker-compose is installed

1. open terminal and run
> docker-compose up -d

to start the container

the first time will take a while

2. go to localhost:8080 and log in with 
>username: root
>password: secret

3. create a new database 'scooteq' and a table 'destinations' 

4. create the following columns in 'destinations'
>'id' int, primary key, auto increment
>'name' varchar(50)
>'actual_quantity' int
>'target_quantity' int
>'routeID' int

5. populate destinations