module console

import cli { Command }
import os

@[params]
pub struct CommandConfig {
pub mut:
	name         string
	description  string
	pre_execute  Execute = unsafe { nil }
	execute      Execute = unsafe { nil }
	post_execute Execute = unsafe { nil }
}

@[params]
pub struct ApplicationConfig {
	CommandConfig
pub mut:
	logo    string
	color   string
	version string
}

pub struct Application {
	Command
	logo  string
	color string
}

pub fn new_application(config ApplicationConfig) Application {
	mut app := Application{
		Command: Command{
			name:         config.name
			description:  config.description
			version:      config.version
			pre_execute:  config.execute
			execute:      config.execute
			post_execute: config.execute
		}
		logo:    config.logo
		color:   config.color
	}

	if app.execute == unsafe { nil } {
		app.execute = fn [app] (cmd Command) ! {
			$if app is Configurable {
				app.configure(cmd)
			}

			$if app is Interactive {
				app.interact(cmd)
			}

			$if app is Executable {
				app.execute(cmd)
			}
		}
	}

	return app
}

pub fn (mut app Application) add(config CommandConfig) Application {
	cmd := Command{
		name:         config.name
		description:  config.description
		pre_execute:  config.execute
		execute:      config.execute
		post_execute: config.execute
	}

	app.commands << cmd

	return app
}

pub fn (mut app Application) run() {
	app.setup()
	app.parse(os.args)
}
