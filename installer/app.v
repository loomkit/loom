module installer

import os
import cli
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
	cli.Command
}

pub fn new_app() App {
	return App{cli.Command{
		name:        'loom'
		description: '${term.blue('Loom')} — The Next-Generation Modular Digital Platform'
		execute:     fn (cmd cli.Command) ! {
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
}

pub fn (mut app App) run() {
	app.setup()
	app.parse(os.args)
}
