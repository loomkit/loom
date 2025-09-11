module installer

import cli { Command }
import term

pub fn new_command() Command {
	return Command{
		name:        'new'
		description: 'Create a new ${term.blue('Loom')} application'
	}
}

pub fn init_command() Command {
	return Command{
		name:        'init'
		description: 'Initialize ${term.blue('Loom')} in the current project'
	}
}

pub fn create_command() Command {
	return Command{
		name:        'create'
		description: 'Create a new ${term.blue('Loom')} application from a custom starter kit'
	}
}
