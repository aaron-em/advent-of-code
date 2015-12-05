SHELL=/bin/bash

all: envcheck days

envcheck:
	@php -r 'if (function_exists("curl_init")) { exit(0); } else { print "===\ncURL extension is required but not installed\n===\n"; exit(1); };'
	@php -r 'if (file_exists("private/token")) { exit(0); } else { print "===\nNo AoC session token found in ./private/token\n===\n"; exit(1); };'

days:
	for day in $$(ls day | cut -d. -f1 | sort -n); \
		do AOC_SESSION_TOKEN="$$(cat private/token)" \
			RUN_BY_MAKE=yes php -f day.php $$day; \
    if [[ "$$?" != "0" ]]; then exit $$?; fi \
		done
