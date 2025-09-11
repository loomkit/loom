module main

import installer

fn main() {
	mut app := installer.new_app()

	app.run()
}
