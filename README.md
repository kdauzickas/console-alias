# Console Alias
This minimal bundle allows you to quickly define console commands that can be either aliases for other symfony console
commands or actual shell commands.

### Installation
1. Run `composer require kdauzickas/console-alias`
2. Add `new KD\Console\AliasBundle\KDConsoleAliasBundle()` to `$bundles` in your `AppKernel`

### Configuration
Commands are created from what is defined in your `config.yml`. Configuration shoud be done in the manner shown below.
Only `name` and `command` fields are mondatory.
```
kd_console_alias:
    commands:
        commandName:
            name: "command name that will be used to call the command"
            description: "description to be shown in command list"
            console: "is this a symfony console command alias? Default: false"
            command: "actual command"
            arguments:
                - list of
                - arguments
                - to be passed
                - to the command
```
Example:
```
kd_console_alias:
    commands:
        pmd:
            name: pmd
            description: Run phpmd
            command: bin/phpmd
            arguments:
                - src
                - text
                - cleancode,codesize,controversial,design,naming,unusedcode

        config:
            name: "c:d"
            description: Alias of the config:debug symfony command
            command: "config:debug"
            console: true
```
This will allow you to run a command `app/console pmd` that will execute 
`bin/phpmd src text cleancode,codesize,controversial,design,naming,unusedcode`. Command `app/console c:d` 
will execute `app/console config:debug`
