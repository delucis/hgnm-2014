# HGNM

Repository for WordPress theme development for new HGNM website.

## Roadmap

- [ ] WordPress core
	- [ ] style.css
		- [X] Theme Header
		- [ ] screen styling
			- [ ] small screens (mobile first)
				- [X] site title & menu
			- [ ] larger screens
				- [X] site title
				- [ ] menu
		- [ ] print styling
	- [ ] index.php
		- [X] call header
		- [ ] call content
		- [X] call footer
- [ ] header.php
	- [X] `<head>`
	- [X] responsive site title
	- [X] responsive menu
- [ ] content single post templates
	- [ ] HGNM Member (single-member.php)
	- [ ] Concert Post (single-concert.php)
	- [ ] Colloquium Post (single-colloquium.php)
- [ ] content archive templates
	- [ ] Members (archive-member.php)
	- [ ] Concerts (archive-concert.php)
	- [ ] Colloquia (archive-colloquium.php)
- [ ] footer.php
- [ ] functions.php

## Dependencies

[These are provisional and may change.]

- Elliot Condon’s [Advanced Custom Fields {v5}](https://github.com/AdvancedCustomFields/acf5-beta)
Used to manage complex custom back-end input fields, which will be displayed within the theme.
- [Custom URL field](https://github.com/delucis/acf-url-field) plug-in for ACF5

## Testing

Clone this repository to the themes directory of a vanilla [WordPress](http://wordpress.org) install.

Clone [ACF5](https://github.com/AdvancedCustomFields/acf5-beta) and [acf-url-field](https://github.com/delucis/acf-url-field) to the plugins directory.