<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Density</h1>
    <br>
</p>

Yii 2 Density based on Yii2 basic template.


DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      migrations/         contains migrations classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 7.0.


INSTALLATION
------------

### Install via Composer

Clone project from over git

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:
Edit the file `config/test_db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=density',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
Run migration for application
`php yii migrate/up` for base application
`php yii_test migrate/up` for tests

TESTING
-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](http://codeception.com/).
By default there are 3 test suites:

- `unit`
- `functional`
- `acceptance`

Tests can be executed by running

```
vendor/bin/codecept run unit
```

The command above will execute unit and functional tests. Unit tests are testing the system components, while functional
tests are for testing user interaction. Acceptance tests are disabled by default as they require additional setup since
they perform testing in real browser. 


### Code coverage support

By default, code coverage is disabled in `codeception.yml` configuration file, you should uncomment needed rows to be able
to collect code coverage. You can run your tests and collect coverage with the following command:

```
#collect coverage for all tests
vendor/bin/codecept run -- --coverage-html --coverage-xml

#collect coverage only for unit tests
vendor/bin/codecept run unit -- --coverage-html --coverage-xml

#collect coverage for unit and functional tests
vendor/bin/codecept run functional,unit -- --coverage-html --coverage-xml
```

You can see code coverage output under the `tests/_output` directory.
