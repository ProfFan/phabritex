# Phabritex

Phabritex is my rough effort for adding LaTeX support into the Phabricator system.

# Install

First clone the `render2katex` utility [here](https://github.com/ProfFan/render2katex). Install as guided to somewhere outside the Phabricator directory.

Copy all files into the `phabricator` directory and manually patch two files (to add the KaTeX CSS).

Patch `<phabricator>/webroot/rsrc/css/core/remarkup.css`, change the header into:

```css
/**
 * @provides phabricator-remarkup-css
 * @requires katex-css
 */
```

Patch `<phabricator>/webroot/rsrc/css/phui/phui-document.css`, change the header into:

```css
/**
 * @provides phui-document-view-css
 * @requires katex-css
**/
```

Replace the path of `index.js` into the path you installed **render2katex** in the two files in `src/extensions`

Then run `<phabricator>/bin/celerity map` and restart Apache or php5-fpm (for nginx).

# Upgrading Phabricator with Local Changes

It is recommended here that you manage your own local fork of the `stable` branch.

After you first patched the two css files, commit them (DO NOT commit `celerity.map`!) to your local `stable` branch. After that, you can upgrade as usual using `git pull` to the upstream.

# Troubleshooting

First check that you have already restarted everything(nginx, Apache, php daemon, etc.). If it still does not work, try the following (as suggested by @followyourheart):

- `bin/cache purge --purge-all`
- Disable SELinux or add exceptions

# Compatibility

Tested with upstream until 2019/09. Please report compatibility as you update from upstream so I can make the corresponding changes.

# Usage

You can use it everywhere with remarkup support :)

In Phriction wiki:

```latex
# This is currently a test

{nav Home}

The statistical model estimated the probability, {tex \pi_{i}}, of capturing dolphins on a tow, {tex i}. A year effect, {tex logit(\pi_i) = \lambda_{j[i]} + \sum_c \beta_c x_{ic}.} was estimated for each year, {tex j}, allowing for annual variation in the capture event rates that was unrelated to the covariates, {tex x}. The contribution of each covariate, indexed by {tex c}, was governed by a regression coefficient, {tex \beta_c}, that was estimated by the model. The logit transform of the capture event probability was defined as the sum of the year effect, {tex \lambda}, and the covariates:

katex {{{
logit(\pi_i) = \lambda_{j[i]} + \sum_c \beta_c x_{ic}.
}}}
determines the result.

# The following is more tests

katex {{{
f(x) = \int_{-\infty}^\infty
    \hat f(\xi)\,e^{2 \pi i \xi x}
    \,d\xi 
}}}

katex {{{
\begin{bmatrix}
    a & b \\
    c & a 
    \end{bmatrix}
}}}

katex {{{
\begin{bmatrix}
    a & c \\
    c & a 
    \end{bmatrix}
}}}
```

renders into 

![screenshot](https://raw.githubusercontent.com/ProfFan/phabritex/master/wiki-demo.png)

and in comments

![screenshot-comment](https://raw.githubusercontent.com/ProfFan/phabritex/master/comments-demo.png)

# Development

Please see this [post](https://blog.amayume.net/adding-latex-support-to-phabricator/) for a through introduction to the codebase.

# License

MIT
