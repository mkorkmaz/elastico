#Elastico
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mkorkmaz/elastico/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mkorkmaz/elastico/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/mkorkmaz/elastico/badges/build.png?b=master)](https://scrutinizer-ci.com/g/mkorkmaz/elastico/build-status/master)

Just another Elasticsearch Document Viewer.

* Lists indexes and types of these indexes.
* Lists the documents for the selected index types
* Helps to delete a document if you need it.

### Installation

```
mkdir elastico
cd elastico
$ composer require --prefer-dist mkorkmaz/elastico "1.*"

```

Default configuration assumes that Elastico will run on local machine.


### Running on local machine
```
php -S 127.0.0.1:8080 -t app/webroot
```

Open a web browser with the address: http://127.0.0.1:8080 and start using Elastico.


### Running on web server

 As you can see, Elastico does not have authentication. If you want to use Elastico with a real web address so that you
 can access it from anywhere, you have to make sure that nobody except you can access the address.

 At this point, I assume that you know how to configure a virtual host. Just make sure that virtual host's root path is
 path/to/**app/webroot**.

 After configuration of a virtual host and testing Elastico just to make sure it is working fine, you can set up
 basic auth for your web server. Here are the tutorials for Apache2 and Nginx:

 - [How To Set Up Password Authentication with Apache on Ubuntu 14.04](https://www.digitalocean.com/community/tutorials/how-to-set-up-password-authentication-with-apache-on-ubuntu-14-04)
 - [How To Set Up Password Authentication with Nginx on Ubuntu 14.04](https://www.digitalocean.com/community/tutorials/how-to-set-up-password-authentication-with-nginx-on-ubuntu-14-04)

 It's strongly recommended that you configure Elastico to use HTTPS. If you down want to buy a SSL certificate,
 you can create an SSL certificate with [Let’s Encrypt](https://letsencrypt.org/getting-started/)

 Also, you can create a free [Cloudflare](https://cloudflare.com) account and use its Flexible SSL feature for free.

### Extra

You can change the Elasticsearch host IP without changing app_config.php. Just add **?ES_SERVER=elasticsearch_host_ip_address** to the address.
For example, let say your Elasticsearch's host IP: 10.0.0.10 and your Elastico setup runs with the following web address: http://127.0.0.1:8080.
Just enter the address manually **http://127.0.0.1:8080?ES_SERVER=10.0.0.10**

After that Elastico will serve for the Elasticsearch host 10.0.0.10.


### Contribute
* Open issue if found bugs or sent pull request.
* Suggestions can be asked just opening an issue.
* Feel free to ask if have any questions.
