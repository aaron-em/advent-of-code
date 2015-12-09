SHELL=/bin/bash
.PHONY: all envcheck envprep test days

all: envcheck envprep test days

envcheck:
	@php -r 'if (function_exists("curl_init")) { exit(0); } else { print "===\ncURL extension is required but not installed\n===\n"; exit(1); };'
	@php -r 'if (file_exists("private/token")) { exit(0); } else { print "===\nNo AoC session token found in ./private/token\n===\n"; exit(1); };'
	@which composer; \
		if [[ "$?" != "0" ]]; then echo "===\nNo Composer install found via 'which composer'\n==="; exit 1; fi

envprep:
	composer update
	composer dump-autoload
	[ ! -d private ] && mkdir private
	[ ! -d input ] && mkdir input

test:
	for test in $$(ls test/day | cut -d. -f1 | sort -n); \
		do vendor/bin/mat test test/day/$$test.php; \
		done

days:
	time \
	for day in $$(ls day | cut -d. -f1 | sort -n); \
		do AOC_SESSION_TOKEN="$$(cat private/token)" \
			RUN_BY_MAKE=yes php -f day.php $$day; \
		if [[ "$$?" != "0" ]]; then exit $$?; fi \
		done
