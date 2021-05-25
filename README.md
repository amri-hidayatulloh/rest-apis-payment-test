# Rest API Payment Demo

This APIs are create to simulate payment create, update and status read.

## Installation

Clone this project on your local machine, 
and make sure you have the PHP package manager [composer](https://getcomposer.org/download/) on your machine. Then you can run this line on your terminal to install **dotenv depedency**.

```bash
$ composer install
```

Go to your MySQL database client and create a database for this App. Then update your environment **(.env)** file on root directory 

```bash
DB_HOST = #YOUR DB HOST
DB_USER = #YOUR DB USER
DB_PASSWORD = #USER PASSWORD
DB_SCHEME = #YOUR DB SCHEME/NAME
```

Next step, run migration file from your terminal, go to project directory and run this line

```bash
$ php db/Migrate.php
```

And you are done.

## Restful API Usage

For postman documentation please go to this link 

[https://documenter.getpostman.com/view/9238433/TzXwEJVF](https://documenter.getpostman.com/view/9238433/TzXwEJVF)

There are two Endpoint URLs for this demo project, for creating payment and to get latest status of payment. 

**Create Payment**

For creating payment you can hit this API. Please refer to Postman documentation above for body payload

```bash
[POST] http://<baseurl>/api/create
```


**Get Status Payment**

For getting latest status payment you can simply hit this endpoint

```bash
[GET] http://<baseurl>/api/:merchantId/:invoice/status
```

If **you are not using apache and/or dont have htaccess enabled** on your machine, you can simply hit this raw endpoint

```bash
[GET] http://<baseurl>/Api.php?endpoint=status
&merchantid=<MERCHANTID>
&invoice=<INVOICE>
```

## CLI Usage

This project provides CLI module for updating payment status. It will be simulated callback for payment status changes. To update payment status via CLI, you can go to project directory via terminal and run this line

```bash
$ php Cli.php --invoiceid --status
```

for example

```bash
$ php Cli.php INV230421-1023 paid
```

Allowed status for payment is: **paid**, **pending**, and **failed**


And that's all, 