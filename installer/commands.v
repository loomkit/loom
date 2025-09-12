module installer

import cli { Command }
import term

pub fn new_command() Command {
	mut cmd := Command{
		name:        'new'
		description: 'Create a new ${term.blue('Loom')} application'
	}
	return cmd
}

pub fn init_command() Command {
	mut cmd := Command{
		name:        'init'
		description: 'Initialize ${term.blue('Loom')} in the current project'
		execute:     fn (cmd Command) ! {
			args := cmd.args
			dir := if args.len < 1 {
				'.'
			} else {
				args[0]
			}
			if !is_dir(dir) {
				println(term.red('${dir} is not a directory'))
				return
			}
			composer(['require', 'loomkit/core'], dir)
			php(['artisan', 'loom:install'], dir)
		}
	}
	return cmd
}

pub fn create_command() Command {
	mut cmd := Command{
		name:        'create'
		description: 'Create a new ${term.blue('Loom')} application from a custom starter kit'
	}
	return cmd
}
