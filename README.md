# Console Alias
This minimal bundle allows you to quickly define console commands that can be either aliases for other symfony console
commands or actual shell commands.

### Installation
`composer require kdauzickas/console-alias`

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

        list:
            name: "alias:list"
            description: Alias of the list symfony command
            command: list
            console: true
```
This will allow you to run a command `app/console pmd` that will execute 
`bin/phpmd src text cleancode,codesize,controversial,design,naming,unusedcode`. Command `app/console alias:list` 
will execute `app/console list`
