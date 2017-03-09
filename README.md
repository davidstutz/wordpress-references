# Wordpress References

Small and naive plugin to easily create labels and references as in LaTeX/BibTeX based on [davidstutz/jquery-references](https://github.com/davidstutz/jquery-references)

## Installation

In `wp-content/plugins`, create a new folder `wordpress-references` and put all files within this repository in this folder. In the backend, go to "Plugins" -> "Installed Plugins" and activate "Wordpress References".

## Usage

There are two forms of usage; the shorthand verison for placing a new label is

    [lbl name scope]

This will put a label at this place. Now using

    [ref name scope]

will place a reference to the label with the same name and in the same scope. Labels always start counting with 1; and counting is done separately for each scope. This means that

    [lbl fig1 figures]
    [ref fig1 figures]
    [lbl ref1 references]
    [ref ref1 references]

will output four times `1`, as the two created labels live in separate scopes.

The longer notation for both shortcodes are

    [lbl name="fig1" scope="figures]
    [ref name="fig1" scope="figures]

The shorthand version and the explicit version should **not** be mixed, e.g. as follows:

    [lbl name="fig1" figures] // will not work!
    [lbl fig1 scope="figures"] // will not work!

To directly place the labels in brackets:

    [lblb ref1 references]
    [refb ref1 references]

## License

Copyright (C) 2017 David Stutz

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

See [http://www.gnu.org/licenses/](http://www.gnu.org/licenses/).