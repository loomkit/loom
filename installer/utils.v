module installer

import os

@[inline]
pub fn php(args []string, work_dir string) int {
	return exec(find_php(), args, work_dir)
}

@[inline]
pub fn composer(args []string, work_dir string) int {
	return exec(find_composer(), args, work_dir)
}

@[inline]
pub fn exec(cmd string, args []string, work_dir string) int {
	mut p := os.new_process(cmd)
	p.set_args(args)
	p.set_work_folder(work_dir)
	p.run()
	p.wait()
	return p.code
}

@[inline]
pub fn binary_command(cmd string, args []string) map[string][]string {
	return {
		cmd: args
	}
}

@[inline]
pub fn chdir(dir string) ! {
	os.chdir(dir)!
}

@[inline]
pub fn is_dir(dir string) bool {
	return os.is_dir(dir)
}

@[inline]
pub fn getenv(name string) ?string {
	env := os.getenv(name)
	return if env == '' {
		none
	} else {
		env
	}
}

@[inline]
pub fn real_path(path string) string {
	return os.real_path(path)
}

@[inline]
pub fn find_executable(name string) string {
	if is_executable(name) {
		return os.real_path(name)
	}
	return os.find_abs_path_of_executable(name) or { name }
}

@[inline]
pub fn path_separator() string {
	return if os.path_separator == '\\' {
		';'
	} else {
		':'
	}
}

@[inline]
pub fn add_path(dir string) {
	mut path := os.getenv('PATH')
	sep := path_separator()
	if !path.split(sep).contains(dir) {
		path = '${dir}${sep}${path}'
		os.setenv('PATH', path, true)
	}
}

@[inline]
pub fn is_executable(name string) bool {
	return os.exists(name) && os.is_executable(name) && !os.is_dir(name)
}

@[inline]
pub fn find_php() string {
	if php := getenv('PHP_BINARY') {
		if is_executable(php) {
			return php
		}
	}

	if php := getenv('PHP_PATH') {
		if is_executable(php) {
			return php
		}
	}

	if php := getenv('PHP_PEAR_PHP_BIN') {
		if is_executable(php) {
			return php
		}
	}

	if '\\' == os.path_separator {
		add_path('C:\\xampp\\php\\')
	}

	if herd_home := getenv('HERD_HOME') {
		add_path('${herd_home}${os.path_separator}bin')
	}

	return find_executable('php')
}

@[inline]
pub fn find_composer() string {
	return if os.exists('${os.getwd()}/composer.phar') {
		'${find_php()} composer.phar'
	} else {
		find_executable('composer')
	}
}
