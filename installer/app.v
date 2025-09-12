module installer

import cli { Command }
import term
import console

const logo = '
 ██╗       ██████╗   ██████╗  ███╗   ███╗
 ██║      ██╔═══██╗ ██╔═══██╗ ████╗ ████║
 ██║      ██║   ██║ ██║   ██║ ██╔████╔██║
 ██║      ██║   ██║ ██║   ██║ ██║╚██╔╝██║
 ███████╗ ╚██████╔╝ ╚██████╔╝ ██║ ╚═╝ ██║
 ╚══════╝  ╚═════╝   ╚═════╝  ╚═╝     ╚═╝
'

pub fn app() console.Application {
	mut app := console.new_application(
		name:        'loom'
		logo:        logo
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
	)

	app.add(
		name:        'new'
		description: 'Create a new ${term.blue('Loom')} application'
	)

	app.add(
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
	)

	app.add(
		name:        'create'
		description: 'Create a new ${term.blue('Loom')} application from a custom starter kit'
	)

	return app
}
