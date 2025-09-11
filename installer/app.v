module installer

import os
import cli { Command }
import term

const logo = '
 ██╗       ██████╗   ██████╗  ███╗   ███╗
 ██║      ██╔═══██╗ ██╔═══██╗ ████╗ ████║
 ██║      ██║   ██║ ██║   ██║ ██╔████╔██║
 ██║      ██║   ██║ ██║   ██║ ██║╚██╔╝██║
 ███████╗ ╚██████╔╝ ╚██████╔╝ ██║ ╚═╝ ██║
 ╚══════╝  ╚═════╝   ╚═════╝  ╚═╝     ╚═╝
'

pub struct App {
	Command
}

pub fn new_app() App {
	mut app := App{Command{
		name:        'loom'
		description: '${term.blue('Loom')} — The Next-Generation Modular Digital Platform'
		execute:     fn (cmd Command) ! {
			args := cmd.args
			mut code := 1
			if args.len < 1 {
				println(term.blue(logo))
				code = 0
			}
			h := cmd.help_message()
			println(h)
			exit(code)
		}
	}}

	app.add(new_command())
	app.add(init_command())
	app.add(create_command())

	return app
}

pub fn (mut app App) add(cmd Command) App {
	app.commands << cmd
	return app
}

pub fn (mut app App) run() {
	app.setup()
	app.parse(os.args)
}
