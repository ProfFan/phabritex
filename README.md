# Phabritex

Phabritex is my rough effort for adding LaTeX support into the Phabricator system.

# Usage

First clone the `render2katex` utility [here](https://github.com/ProfFan/render2katex). Install as guided to somewhere outside the Phabricator directory.

Copy all files into the `phabricator` directory. 

Replace the path of `index.js` into the path you installed **render2katex** in the two files in `src/extensions`

Then run `./bin/celerity map` and restart Apache or php5-fpm (for nginx).
