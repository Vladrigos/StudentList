Task: https://github.com/codedokode/pasta/blob/master/student-list.md
# StudentList
Student list with registration

# Requirements
1. Web server with [PHP](https://secure.php.net/) >=7.3 support.
2. MySQL database

# Installation
1. Clone the repository
2. Import **abiturients.sql** into your database.
3. Change database-password in **config/db_params.php**
4. In file apache/conf/extra/httpd-vhosts.conf add:
```
<VirtualHost *:80>
    ServerAdmin webmaster@studentlist
    DocumentRoot "C:/xampp/htdocs/studentlist"
    ServerName studentlist
    ServerAlias www.studentlist
</VirtualHost>
```
5.In file hosts (Windows/System32/drivers/etc/hosts) add
```
127.0.0.1 studentlist
127.0.0.1 www.studentlist
```
