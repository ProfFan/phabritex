# Phabritex

Phabritex is my rough effort for adding LaTeX support into the Phabricator system.

# Install

First clone the `render2katex` utility [here](https://github.com/ProfFan/render2katex). Install as guided to somewhere outside the Phabricator directory.

Copy all files into the `phabricator` directory and manually patch the conflicting file (to add the KaTeX CSS).

Replace the path of `index.js` into the path you installed **render2katex** in the two files in `src/extensions`

Then run `./bin/celerity map` and restart Apache or php5-fpm (for nginx).

# Usage

In Phriction wiki:

```
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

![screenshot](https://raw.githubusercontent.com/ProfFan/phabritex/master/2016-02-20.3.12.25.png)

# License

MIT
