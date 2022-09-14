GEL Studios Tools
=================

This is a set of useful generic development tools which can be used in your ModX projects

[GEL Studios Website](https://www.gelstudios.co.uk)

### Classes

* GelTools : functions for dumping, shortening, sanitizing, formatting etc

* GelDbTools : Useful database functions 


## Installation

Place the whole directory in your ModX project in:

```/core/components/geltools```

or you can git clone it into your project:

```cd ~/Projects/{my_project}```

```git clone https://markhaunton_gelstudios@bitbucket.org/markhaunton_gelstudios/geltools.git core/components/geltools```


To use the classes, simply include the autoloader in the top of your script:

```require_once MODX_CORE_PATH . 'components/geltools/autoload.php';```

You can then call the functions statically like so:

```GelTools::dump($my_var);```


## Contributing

Please help build this library by adding any other functions you think are often helpful

Please make sure you don't break existing ones!

Please note the docblock conventions [https://docs.phpdoc.org/](https://docs.phpdoc.org/)