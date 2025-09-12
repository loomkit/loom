module console

import cli { Command }

type Execute = fn (cmd Command) !

pub interface Configurable {
	configure(cmd Command)
}

pub interface Interactive {
	interact(cmd Command)
}

pub interface Executable {
	execute(cmd Command)
}
