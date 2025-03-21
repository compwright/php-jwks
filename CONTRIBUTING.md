# Contributing to php-jwk

This is a very small library with a very limited scope but if you want to contribute please feel free to do so.

## How can I contribute?

### Reporting bugs

You can open [a new issue](https://github.com/compwright/php-jwks/issues) once you have checked one covering your issue hasn't been opened yet.

### Open a pull-request

If you want to fix a bug or add a missing feature you can open a new pull-request.

Please note that you need a PHP 8.3 or later for using this library.

Basic steps:

1. Fork this repository
2. Clone it locally
3. Install dependencies with Composer
    ```bash
    $ composer install
    ```
4. Create a branch on your fork
5. Commit & push
6. Open a pull-request from your branch
7. Profit

Some guidelines:

1. Before committing make sure to format the code accordingly:
    ```bash
    $ make style
    ```
1. Also make sure the tests pass successfully and you have sufficient coverage
    ```bash
    $ make test
    ```

### Git Commit Messages

* use [conventional commits](https://www.conventionalcommits.org/en/v1.0.0/) to make the commit messages more readable and to allow for automatic semantic versioning and changelog generation
* Use the present tense ("add feature" not "added feature")
* Use the imperative mood ("move cursor to..." not "moves cursor to...")
* Limit the first line to 72 characters, or less

## License

[MIT](https://github.com/compwright/php-jwks/blob/master/LICENSE)
